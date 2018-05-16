<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Order;
use App\OrderDetails;
use App\Ship;
use LaraCart;
use Helper;

use App\Veritrans\Veritrans;

class PaymentController extends Controller
{
    public function index()
    {
    	return view('frontend.payment');
    }

    public function store(Request $request)
    {

      $json_result = file_get_contents('php://input');
      $result = json_decode(stripslashes(trim($json_result, '"')));
      return $result;

      // $order = new Order;
      // $order->number = $result['order_id'];
      // $order->amount = Helper::setCurrency($result['gross_amount'], 'idr');
      // $order->payment_date = $result['transaction_time'];
      // $order->transaction_status = $result['transaction_status'];
      // $order->payment_type = $result['payment_type'];
      // $order->fraud_status = $result['fraud_status'];
      // $order->save();

      // return response()->json(true);

      //return response()->json($data);

    }

    public function complete($type, Request $request)
    {

      if (session()->has('shipping') && !empty($request)) {
        DB::transaction(function() use($request){

          $order = Order::where('number', $request->order_id);

          $shipping = session()->get('shipping');

          if (!empty(LaraCart::getCoupons()))
          {
            $order->update(['coupon_code' => array_keys(LaraCart::getCoupons())[0]]);
          }
            
          $order = $order->first();

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

          LaraCart::destroyCart();
          session()->forget('shipping');

        });

        $order_number = $request->order_id;

        if ($order->transaction_status ==  'captured') {
          if($fraud == 'challenge'){
            $status = 'challenged by FDS';
          } 
          else {
            $status = 'successfully captured using ' . $order->payment_type;
            }
        }  else if ($transaction == 'settlement'){
         
            $status = 'successfully transfered using ' . $order->payment_type;
          } 
          else if($transaction == 'pending'){
            $status = 'waiting customer to finish using ' . $order->payment_type;
          } 
          else if ($transaction == 'deny') {
          
            $status = 'denied using '. $order->payment_type;
        }


        $message = 'Your payment with order number '.$order_number.' is '.$status;

        return view('frontend.payment.show', compact(['type', 'message']));
      } else {
        return redirect()->route('cart.index');
      }
      
    }
}
