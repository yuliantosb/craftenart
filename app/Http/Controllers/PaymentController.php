<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Order;
use App\OrderDetails;
use App\Ship;
use App\Stock;
use App\StockDetails;
use LaraCart;
use Helper;

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

class PaymentController extends Controller
{

    private $_api_context;

    public function __construct()
    {

      $this->middleware('auth'); 

      parent::__construct();

      Veritrans::$serverKey = 'VT-server-LKBf4dk76gQmJHcIIc2Gh5_K';
      Veritrans::$isProduction = false;

      /** setup PayPal api context **/
      $paypal_conf = config()->get('paypal');
      $this->_api_context = new ApiContext(
                              new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));

      $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function store(Request $request)
    {

      $json_result = file_get_contents('php://input');
      $result = stripslashes(trim($json_result, '"'));
      $data = json_decode($result, true);

      /*$order = new Order;
      $order->number = $data['order_id'];
      $order->amount = Helper::setCurrency($data['gross_amount'], 'idr');
      $order->payment_date = $data['transaction_time'];
      $order->transaction_status = $data['transaction_status'];
      $order->payment_type = $data['payment_type'];
      $order->fraud_status = $data['fraud_status'];
      $order->save();*/

      return response()->json(true);

    }

    public function complete($status, Request $request)
    {

      $order = '';

      if (session()->has('shipping') && !empty($request)) {
        DB::transaction(function() use($request, &$order){

          /*$order = Order::where('number', $request->order_id);

          

          $order->update([
              'first_name' => $shipping['first_name'],
              'last_name' => $shipping['last_name'],
              'phone' => $shipping['phone_number'],
              'email' => $shipping['email'],
              'address' => $shipping['address']
          ]);

          if (!empty(LaraCart::getCoupons()))
          {
            $order->update(['coupon_code' => array_keys(LaraCart::getCoupons())[0]]);
          }
            
          $order = $order->first();*/

          $shipping = session()->get('shipping');
          $check_order = Veritrans::status($request->order_id);

          $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
          $tax = LaraCart::taxTotal($formatted = false);
          $shipping_fee = LaraCart::getFee('shippingFee')->amount;
          $discount = LaraCart::totalDiscount($formatted = false);

          $order = new Order;
          $order->number = $check_order->order_id;
          $order->subtotal = $subtotal;
          $order->shipping_fee = $shipping_fee;
          $order->discount = $discount;
          $order->tax = $tax;
          $order->total = Helper::setCurrency($check_order->gross_amount, 'idr');
          $order->payment_date = $check_order->transaction_time;
          $order->transaction_status = $check_order->transaction_status;
          $order->payment_type = $check_order->payment_type;
          $order->fraud_status = $check_order->fraud_status;
          $order->first_name = $shipping['first_name'];
          $order->last_name = $shipping['last_name'];
          $order->phone = $shipping['phone_number'];
          $order->email = $shipping['email'];
          $order->address = $shipping['address'];

          if (!empty(LaraCart::getCoupons())){ 
            $order->coupon_code = array_keys(LaraCart::getCoupons())[0];
          }

          $order->save();

          foreach (LaraCart::getItems() as $item) {

            $order_details = new OrderDetails;
            $order_details->product_id = $item->id;
            $order_details->price = $item->price;
            $order_details->qty = $item->qty;
            $order->details()->save($order_details);

            $stock = Stock::where('product_id', $item->id)->first();

            $stock_update = Stock::find($stock->id);
            $stock_update->decrement('amount', $item->qty);
            $stock_update->save();

            $stock_details = new StockDetails;
            $stock_details->amount = '-'.$item->qty;
            $stock_details->description = 'Ordered by '.auth()->user()->name;
            $stock_update->details()->save($stock_details);


          }
            
          $ship = new Ship;
          $ship->first_name = $shipping['first_name'];
          $ship->last_name = $shipping['last_name'];
          $ship->email = $shipping['email'];
          $ship->phone_number = $shipping['phone_number'];
          $ship->country_id = $shipping['country_id'];
          $ship->province_id = $shipping['province_id'];
          $ship->city_id = $shipping['city_id'];
          $ship->zip = $shipping['zip'];
          $ship->address = $shipping['address'];
          $ship->courier_id = $shipping['courier_id'];
          $ship->courier_name = $shipping['courier_name'];
          $ship->total_weight = $shipping['total_weight'];
          $ship->cost = $shipping['cost'];
          $ship->service_name = $shipping['service_name'];
          $ship->service_description = $shipping['service_description'];
          $ship->estimate_delivery = $shipping['estimate_delivery'];
          $order->ship()->save($ship);

        });

        LaraCart::destroyCart();
        session()->forget('shipping');

        $order_id = $request->order_id;
        $transaction = $check_order->transaction_status;
        $type = $check_order->payment_type;
        $fraud = $check_order->fraud_status;

        if ($transaction == 'capture') {
          if ($type == 'credit_card'){
            if($fraud == 'challenge'){
              $message = 'Transaction order id: <strong>' . $order_id . ' </strong> is challenged by FDS';
              } 
              else {
              $message = 'Transaction order id: <strong>' . $order_id . ' </strong> successfully captured using <strong>' . $type . '</strong>';
              }
            }
        }
        else if ($transaction == 'settlement'){
          $message = 'Transaction order id: <strong>' . $order_id . ' </strong> successfully transfered using <strong>' . $type . '</strong>';
        } 
        else if($transaction == 'pending'){
        $message = 'Waiting customer to finish transaction order id: <strong>' . $order_id . ' </strong> using <strong>' . $type . '</strong>';
        } 
        else if ($transaction == 'deny') {
        $message = 'Payment using <strong>' . $type . '</strong> for transaction order id: <strong>' . $order_id . ' </strong> is denied.';
        }

        return redirect()->route('payment.index')->with('message', ['status' => $status, 'content' => $message]);

      }


      return redirect()->route('cart.index');

      
    }

    public function paypal(Request $request)
    {

      if (session()->has('shipping') && !empty($request)) {

        $payment_id = session()->get('paypal_payment_id');
        $order_number = session()->get('order_number');


        /** clear the session payment ID **/
        session()->forget('paypal_payment_id');

        if (empty($request->PayerID) || empty($request->token)) {

            return redirect()->route('checkout.index');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/

            DB::transaction(function() use ($order_number){

                $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
                $tax = LaraCart::taxTotal($formatted = false);
                $shipping_fee = LaraCart::getFee('shippingFee')->amount;
                $discount = LaraCart::totalDiscount($formatted = false);
                $total = LaraCart::total($formatted = false, $withDiscount = true);

                $shipping = session()->get('shipping');

                $order = new Order;
                $order->number = $order_number;
                $order->subtotal = $subtotal;
                $order->shipping_fee = $shipping_fee;
                $order->discount = $discount;
                $order->tax = $tax;
                $order->total = $total;
                $order->payment_date = Carbon::now();
                $order->payment_type = 'paypal';
                $order->first_name = $shipping['first_name'];
                $order->last_name = $shipping['last_name'];
                $order->phone = $shipping['phone_number'];
                $order->email = $shipping['email'];
                $order->address = $shipping['address'];

                if (!empty(LaraCart::getCoupons())){ 
                  $order->coupon_code = array_keys(LaraCart::getCoupons())[0];
                }

                $order->save();

                foreach (LaraCart::getItems() as $item) {

                  $order_details = new OrderDetails;
                  $order_details->product_id = $item->id;
                  $order_details->price = $item->price;
                  $order_details->qty = $item->qty;
                  $order->details()->save($order_details);

                  $stock = Stock::where('product_id', $item->id)->first();

                  $stock_update = Stock::find($stock->id);
                  $stock_update->decrement('amount', $item->qty);
                  $stock_update->save();

                  $stock_details = new StockDetails;
                  $stock_details->amount = '-'.$item->qty;
                  $stock_details->description = 'Ordered by '.auth()->user()->name;
                  $stock_update->details()->save($stock_details);


                }
                  
                $ship = new Ship;
                $ship->first_name = $shipping['first_name'];
                $ship->last_name = $shipping['last_name'];
                $ship->email = $shipping['email'];
                $ship->phone_number = $shipping['phone_number'];
                $ship->country_id = $shipping['country_id'];
                $ship->province_id = $shipping['province_id'];
                $ship->city_id = $shipping['city_id'];
                $ship->zip = $shipping['zip'];
                $ship->address = $shipping['address'];
                $ship->courier_id = $shipping['courier_id'];
                $ship->courier_name = $shipping['courier_name'];
                $ship->total_weight = $shipping['total_weight'];
                $ship->cost = $shipping['cost'];
                $ship->service_name = $shipping['service_name'];
                $ship->service_description = $shipping['service_description'];
                $ship->estimate_delivery = $shipping['estimate_delivery'];
                $order->ship()->save($ship);

            });

            LaraCart::destroyCart();
            session()->forget('shipping');

            return redirect()->route('payment.index')
                            ->with('message', ['status' => 'finish', 'content' => 'Your payment using <strong>Paypal</strong> with order number #'.$order_number.' is success']);
        }

            return redirect()->route('payment.index')
                            ->with('message', ['status' => 'error', 'content' => 'Payment with <strong> Paypal </strong> is failed']);

      }

      return redirect()->route('cart.index');

    }

    public function index()
    {
      if (session()->has('message')) {
        return view('frontend.payment');  
      }
      return redirect()->route('cart.index');
    }


}
