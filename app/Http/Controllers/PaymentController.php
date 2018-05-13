<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Order;
use App\OrderDetails;
use App\Ship;

use App\Veritrans\Veritrans;

class PaymentController extends Controller
{
    public function index()
    {
    	return view('frontend.payment');
    }

    public function store(Request $request)
    {
        
        DB::transaction(function() use ($request){

          $shipping = session()->get('shipping');

          $order = new Order;
          $order->number = $order_id;
          $order->amount = $shipping['order_total'];
          $order->first_name = $shipping['first_name'];
          $order->last_name = $shipping['last_name'];
          $order->phone = $shipping['phone_number'];
          $order->email = $shipping['email'];
          $order->address = $shipping['address'];
          $order->payment_date = $request->transaction_time;
          $order->transaction_status = $request->transaction_status;
          $order->payment_type = $request->payment_type;
          $order->fraud_status = $request->fraud_status;

          if (!empty(LaraCart::getCoupons())) {
            $order->coupon_code = array_keys(LaraCart::getCoupons())[0];  
          }
          
          $order->save();

          foreach (LaraCart::getItems() as $item) {
            $order_details = new OrderDetails;
            $order_details->product_id = $item->id;
            $order_details->price = $item->price;
            $order_details->qty = $item->qty;
            $order->details()->save($order_details);
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

    }

    public function finish(Request $request)
    {

    }

    public function unfinish(Request $request)
    {

    }

    public function error(Request $request)
    {

    }
}
