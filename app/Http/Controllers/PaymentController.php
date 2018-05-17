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

class PaymentController extends Controller
{
    public function index()
    {
    	return view('frontend.payment');
    }

    public function store(Request $request)
    {

      $json_result = file_get_contents('php://input');
      $result = stripslashes(trim($json_result, '"'));
      $data = json_decode($result, true);

      $order = new Order;
      $order->number = $data['order_id'];
      $order->amount = Helper::setCurrency($data['gross_amount'], 'idr');
      $order->payment_date = $data['transaction_time'];
      $order->transaction_status = $data['transaction_status'];
      $order->payment_type = $data['payment_type'];
      $order->fraud_status = $data['fraud_status'];
      $order->save();

      return response()->json(true);

    }

    public function complete($status, Request $request)
    {

      $order = '';

      if (session()->has('shipping') && !empty($request)) {
        DB::transaction(function() use($request, &$order){

          $order = Order::where('number', $request->order_id);

          $shipping = session()->get('shipping');

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
            
          $order = $order->first();

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
        $transaction = $order->transaction_status;
        $type = $order->payment_type;
        $fraud = $order->fraud_status;

        if ($transaction == 'capture') {
          if ($type == 'credit_card'){
            if($fraud == 'challenge'){
              $message = 'Transaction order id: <strong>' . $order_id . ' </strong> is challenged by FDS';
              } 
              else {
              $message = 'Transaction order id: <strong>' . $order_id . ' </strong> successfully captured using <strong>' . str_replace($type, ' ', '_') . '</strong>';
              }
            }
          }
        else if ($transaction == 'settlement'){
          $message = 'Transaction order id: <strong>' . $order_id . ' </strong> successfully transfered using <strong>' . str_replace($type, ' ', '_') . '</strong>';
          } 
          else if($transaction == 'pending'){
          $message = 'Waiting customer to finish transaction order id: <strong>' . $order_id . ' </strong> using <strong>' . str_replace($type, ' ', '_') . '</strong>';
          } 
          else if ($transaction == 'deny') {
          $message = 'Payment using <strong>' . str_replace($type, ' ', '_') . '</strong> for transaction order id: <strong>' . $order_id . ' </strong> is denied.';
        }

        return view('frontend.payment.show', compact(['status', 'message']));

      }

      else {
        return redirect()->route('cart.index');
      }
      
    }
}
