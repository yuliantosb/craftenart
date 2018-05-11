<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraCart;
use RajaOngkir;
use Helper;
use App\Veritrans\Veritrans;

class CheckoutController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');

	 	Veritrans::$serverKey = 'VT-server-LKBf4dk76gQmJHcIIc2Gh5_K';
        Veritrans::$isProduction = false;
    }

    public function index()
    {
    	$carts = LaraCart::getItems();
    	$carts = LaraCart::getItems();
        $provinces = RajaOngkir::getProvince();
        $weight = collect($carts)->pluck('weight')->sum();

        if (session()->has('shipping')) {

            $cities = RajaOngkir::getCity(session()->get('shipping.province_id'));
            $costs = [];
            $couriers = ['jne', 'pos', 'tiki'];

            foreach ($couriers as $courier) {
                $costs[] = RajaOngkir::getCost(session()->get('shipping.city_id'), $weight, $courier);
            }

        } else {

            $cities = collect([]);
            $costs = collect([]);
        }

        $amount['subtotal'] = LaraCart::subTotal($format = false, $withDiscount = true);
        $amount['taxes'] = LaraCart::taxTotal($formatted = false);
        $amount['shipping_fee'] = LaraCart::getFee('shippingFee')->amount;
        $amount['discount'] = LaraCart::totalDiscount($formatted = false);
        $amount['total'] = ($amount['subtotal'] + $amount['taxes'] + $amount['shipping_fee']) - $amount['discount'];
        

    	return view('frontend.checkout', compact(['carts', 'provinces', 'cities', 'costs', 'weight', 'amount']));
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

        $vt = new Veritrans;

        $subtotal = round(Helper::getCurrency(LaraCart::subTotal($format = false, $withDiscount = true), 'idr'));
        $taxes = round(Helper::getCurrency(LaraCart::taxTotal($formatted = false), 'idr'));
        $shipping_fee = round(Helper::getCurrency(LaraCart::getFee('shippingFee')->amount, 'idr'));
        $discount = round(Helper::getCurrency(LaraCart::totalDiscount($formatted = false), 'idr'));
        $total = ($subtotal + $taxes + $shipping_fee) - $discount;

        $transaction_details = array(
            'order_id' => uniqid(),
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
}
