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

      $this->middleware('auth', ['except' => ['store', 'tes']]); 

      parent::__construct();

      Veritrans::$serverKey = 'VT-server-LKBf4dk76gQmJHcIIc2Gh5_K';
      Veritrans::$isProduction = false;

      /** setup PayPal api context **/
      $paypal_conf = config()->get('paypal');
      $this->_api_context = new ApiContext(
                              new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));

      $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function store()
    {

      DB::transaction(function(){

          $vt = new Veritrans;
          $json_result = file_get_contents('php://input');
          $result = json_decode($json_result);

          if($result){
            $notif = $vt->status($result->order_id);
          }
          
          $transaction = $notif->transaction_status;
          $order_id = $notif->order_id;

          if (!empty($notif->fraud_status)) {
            $fraud = $notif->fraud_status;
          } else {
            $fraud = null;
          }

          $order = Order::FirstOrNew(['number' => $order_id]);
          $order->number = $order_id;
          $order->subtotal = $result->gross_amount;
          $order->tax = 0;
          $order->discount = 0;
          $order->shipping_fee = 0;
          $order->total = $result->gross_amount;
          $order->user_id = 3;
          $order->transaction_status = $transaction;
          $order->fraud_status = $fraud;
          $order->save();

          if ($transaction == 'settlement') {

              foreach ($order->details as $details) {

                $stock = Stock::where('product_id', $details->product_id)->first();

                $stock_update = Stock::find($stock->id);
                $stock_update->decrement('amount', $details->qty);
                $stock_update->save();

                $stock_details = new StockDetails;
                $stock_details->amount = '-'.$details->qty;
                $stock_details->description = '#'.$order->number;
                $stock_update->details()->save($stock_details);

            }

          }


      });

      return response()->json(true);


    }

    public function complete($status, Request $request)
    {

      $check_order = '';
      $transaction = '';
      $type = '';
      $fraud = '';
      $order_id = '';

      if (session()->has('shipping') && !empty($request)) {
        DB::transaction(function() use($request, &$check_order, &$transaction, &$type, &$fraud, &$order_id){

          $shipping = session()->get('shipping');
          $check_order = Veritrans::status($request->order_id);

          $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
          $tax = LaraCart::taxTotal($formatted = false);
          $shipping_fee = LaraCart::getFee('shippingFee')->amount;
          $discount = LaraCart::totalDiscount($formatted = false);
          $total = LaraCart::total($formatted = false, $withDiscount = true);
          $order_id = $request->order_id;
          $transaction = $check_order->transaction_status;
          $type = $check_order->payment_type;

          if ($type == 'credit_card') {
            $fraud = $check_order->fraud_status;
          }

          $order = new Order;
          $order->number = $order_id;
          $order->user_id = auth()->user()->id;
          $order->subtotal = $subtotal;
          $order->shipping_fee = $shipping_fee;
          $order->discount = $discount;
          $order->tax = $tax;
          $order->total = $total;
          $order->payment_date = $check_order->transaction_time;
          $order->transaction_status = $transaction;

          if ($transaction == 'capture') {
            if ($type == 'credit_card'){
              $order->fraud_status = $fraud;
            }
          }

          $order->payment_type = $type;
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

        return redirect()->route('payment.index')->with('message', ['status' => $status, 'content' => $message, 'order_number' => $order_id]);

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
                $order->user_id = auth()->user()->id;
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
                $order->transaction_status = 'settlement';

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
                            ->with('message', ['status' => 'finish', 'content' => 'Transaction <strong>'.$order_number.'</strong> using <strong>Paypal</strong> is success', 'order_number' => $order_number]);
        }

            return redirect()->route('payment.index')
                            ->with('message', ['status' => 'error', 'content' => 'Payment with <strong> Paypal </strong> is failed', 'order_number' => $order_number]);

      }

      return redirect()->route('cart.index');

    }

    public function index()
    {
      if (session()->has('message')) {

        if (session()->get('message')['status'] == 'finish') {

          $order_number = session()->get('message')['order_number'];
          $order = Order::where('number', $order_number)
                    ->first();

          $order_details = [];

        foreach ($order->details as $details) {

            $order_details[] = [
                                    'sku' => $details->product->sku,
                                    'name' => $details->product->name,
                                    'price' => Helper::getCurrency($details->price, 'usd'),
                                    'quantity' => $details->qty

                                ];

        }


        } else {
          $order = collect([]);
          $order_details = [];
        }

        return view('frontend.payment', compact(['order', 'order_details']));

      }

      return redirect()->route('cart.index');
    }

}
