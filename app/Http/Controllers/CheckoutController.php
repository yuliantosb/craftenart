<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraCart;
use RajaOngkir;
use Helper;
use App\Order;

use App\Veritrans\Veritrans;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class CheckoutController extends Controller
{

    private $_api_context;
    
    public function __construct()
    {
    	$this->middleware('auth');

        parent::__construct();

	 	Veritrans::$serverKey = 'VT-server-LKBf4dk76gQmJHcIIc2Gh5_K';
        Veritrans::$isProduction = false;
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index()
    {
    	$carts = LaraCart::getItems();

        if (!empty($carts)) {
            $provinces = RajaOngkir::getProvince();
            $weight = collect($carts)->pluck('weight')->sum();

            if (session()->has('shipping') || !empty(auth()->user()->cust->province_id)) {

                $province_id = !empty(auth()->user()->cust->province_id) ? auth()->user()->cust->province_id : session()->get('shipping.province_id');

                $cities = RajaOngkir::getCity($province_id);
                $city_id = !empty(auth()->user()->cust->city_id) ? auth()->user()->cust->city_id : session()->get('shipping.city_id');

                $costs = [];
                $couriers = ['jne', 'pos', 'tiki'];

                foreach ($couriers as $courier) {
                    $costs[] = RajaOngkir::getCost($city_id, $weight, $courier);
                }

            } else {

                $cities = collect([]);
                $costs = collect([]);
            }

            $amount['subtotal'] = LaraCart::subTotal($format = false, $withDiscount = true);
            $amount['taxes'] = LaraCart::taxTotal($formatted = false);
            $amount['shipping_fee'] = LaraCart::getFee('shippingFee')->amount;
            
            if (!empty(LaraCart::getCoupons())) {
                $amount['discount'] = LaraCart::totalDiscount($formatted = false);
            } else {
                $amount['discount'] = 0;
            }

            $amount['total'] = ($amount['subtotal'] + $amount['taxes'] + $amount['shipping_fee']) - $amount['discount'];
            

            return view('frontend.checkout', compact(['carts', 'provinces', 'cities', 'costs', 'weight', 'amount']));
        }
        return redirect()->route('cart.index');
        
    }

    public function store(Request $request)
    {

        if (session()->has('shipping')) {
            session()->forget('shipping');
        }

        $index = $request->fee;

        $data = [

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country_id' => $request->country_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'zip' => $request->zip,
            'address' => $request->address,
            'total_weight' => $request->total_weight,
            'courier_id' => $request->courier_id[$index],
            'courier_name' => $request->courier_name[$index],
            'cost' => $request->cost[$index],
            'service_name' => $request->service_name[$index],
            'service_description' => $request->service_description[$index],
            'estimate_delivery' => $request->estimate_delivery[$index]

        ];

        $shipping = session()->put('shipping', $data);

        LaraCart::addFee('shippingFee', $request->cost[$index], $taxable =  false, $options = []);

        if ($request->payment_method == 'midtrans') {

            return $this->payWithMidtrans($request);

        }

        return $this->payWithPayPal($request);

    }


    private function payWithMidtrans($request)
    {
        $vt = new Veritrans;

        $subtotal = round(Helper::getCurrency(LaraCart::subTotal($format = false, $withDiscount = true), 'idr'));
        $taxes = round(Helper::getCurrency(LaraCart::taxTotal($formatted = false), 'idr'));
        $shipping_fee = round(Helper::getCurrency(LaraCart::getFee('shippingFee')->amount, 'idr'));
        $discount = round(Helper::getCurrency(LaraCart::totalDiscount($formatted = false), 'idr'));
        $total = ($subtotal + $taxes + $shipping_fee) - $discount;

        $user_id = auth()->user()->id;
        $count_order = Order::where('user_id', $user_id)
                            ->count();
        $pad = str_pad($count_order, 5, "0", STR_PAD_LEFT);

        $transaction_details = array(
            'order_id' => time().'-'.$user_id.'-'.$pad,
            'gross_amount' => $total
        );

        // Populate items

        $items = [];

        foreach (LaraCart::getItems() as $item) {
            $items[] = [
                            'id' => $item->id,
                            'price' => round(Helper::getCurrency($item->price, 'idr')),
                            'quantity' => $item->qty,
                            'name' => $item->name
                        ];
        }

        if ($discount > 0) {

            $items[] = [
                        'id' => 'discount',
                        'price' => -$discount,
                        'quantity' => 1,
                        'name' => 'Discount'
                    ];
        }

        $items[] = [
                        'id' => 'shipping_fee',
                        'price' => $shipping_fee,
                        'quantity' => 1,
                        'name' => 'Shipping Fee'
                    ];


        $items[] = [
                        'id' => 'tax',
                        'price' => $taxes,
                        'quantity' => 1,
                        'name' => 'Tax'
                    ];

        // Populate customer's billing address
        $billing_address = array(

            'first_name' => session()->get('shipping.first_name'),
            'last_name' => session()->get('shipping.last_name'),
            'address' => session()->get('shipping.address'),
            'city' => RajaOngkir::getCityAttr(
                        session()->get('shipping.city_id'),
                        session()->get('shipping.province_id')),
            'postal_code' => session()->get('shipping.zip'),
            'phone' => session()->get('shipping.phone_number'),
            'country_code'  => 'IDN'

        );

        // Populate customer's shipping address
        $shipping_address = array(

            'first_name' => session()->get('shipping.first_name'),
            'last_name' => session()->get('shipping.last_name'),
            'address' => session()->get('shipping.address'),
            'city' => RajaOngkir::getCityAttr(
                        session()->get('shipping.city_id'),
                        session()->get('shipping.province_id')),
            'postal_code' => session()->get('shipping.zip'),
            'phone' => session()->get('shipping.phone_number'),
            'country_code'  => 'IDN'
        );

        // Populate customer's Info
        $customer_details = array(

            'first_name' => session()->get('shipping.first_name'),
            'last_name' => session()->get('shipping.last_name'),
            'email' => session()->get('shipping.email'),
            'phone' => session()->get('shipping.phone_number'),
            'billing_address' => $billing_address,
            'shipping_address'=> $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
            'payment_type'          => 'vtweb', 
            'vtweb'                         => array(
                //'enabled_payments'    => [],
                'credit_card_3d_secure' => true
            ),
            'transaction_details'=> $transaction_details,
            'item_details'           => $items,
            'customer_details'   => $customer_details
        );
    
        try
        {
            $vtweb_url = $vt->vtweb_charge($transaction_data);
            return redirect($vtweb_url);
        } 
        catch (Exception $e) 
        {   
            return $e->getMessage;
        }
    }

    private function payWithPayPal($request)
    {

        $user_id = auth()->user()->id;
        $count_order = Order::where('user_id', $user_id)
                            ->count();

        $pad = str_pad($count_order, 5, "0", STR_PAD_LEFT);

        $order_id = time().'-'.$user_id.'-'.$pad;
        $subtotal = Helper::getCurrency(LaraCart::subTotal($format = false, $withDiscount = true), 'usd');
        $taxes = Helper::getCurrency(LaraCart::taxTotal($formatted = false), 'usd');
        $shipping_fee = Helper::getCurrency(LaraCart::getFee('shippingFee')->amount, 'usd');
        $discount = Helper::getCurrency(LaraCart::totalDiscount($formatted = false), 'usd');
        $total = ($subtotal + $taxes + $shipping_fee) - $discount;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = [];

        foreach (LaraCart::getItems() as $item) {

            $items[] = (new Item)->setName($item->name)
                                ->setCurrency('USD')
                                ->setQuantity($item->qty)
                                ->setPrice(Helper::getCurrency($item->price, 'usd'));

        }

        if ($discount > 0) {

            $items[] = (new Item)->setName('Discount')
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setPrice(-$discount);
        }

        $items[] = (new Item)->setName('Shipping Fee')
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setPrice($shipping_fee);
                                

        $items[] = (new Item)->setName('Tax')
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setPrice($taxes);


        $item_list = new ItemList;
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency('USD')
                    ->setTotal($total);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Craftenart payment #'.$order_id);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url()->route('payment.paypal')) /** Specify return URL **/
                        ->setCancelUrl(url()->route('payment.paypal'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/

        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            
            if (config()->get('app.debug')) {

                return redirect()->route('payment.paypal')
                                    ->with('message', ['status' => 'failed', 'content' => 'Error timeout, please try again']);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/

            } else {
                
                return redirect()->route('payment.paypal')
                                ->with('message', ['status' => 'failed', 'content' => 'Some error occur, sorry for inconvenient']);
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach($payment->getLinks() as $link) {

            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        session()->put('paypal_payment_id', $payment->getId());
        session()->put('order_number', $order_id);

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return redirect()->away($redirect_url);
        }

        return redirect()->route('payment.paypal')
                        ->with('message', ['status' => 'failed', 'content' => 'Unknown error occurred']);

    }
        

    
}
