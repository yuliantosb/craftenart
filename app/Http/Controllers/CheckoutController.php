<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Order;
use App\OrderDetails;
use App\Ship;
use App\Stock;
use App\StockDetails;
use App\OrderAttribute;

use LaraCart;
use GuzzleHttp;
use Helper;
use RajaOngkir;
use DB;

class CheckoutController extends Controller
{
    public function index()
    {

        if (!session()->has('shipping') || empty(LaraCart::getItems())) {
            return redirect('cart');
        }

        $address = Address::where('user_id', auth()->user()->id)
                        ->where(function($where){
                            if (session()->has('address')) {
                                $where->where('id', session()->get('address'));
                            }
                        })
                    ->first();

        $carts = LaraCart::getitems();
        $amount['subtotal'] = LaraCart::subTotal($format = false, $withDiscount = true);
        $amount['taxes'] = LaraCart::taxTotal($formatted = false);
        $amount['shipping_fee'] = LaraCart::getFee('shippingFee')->amount;

        if (!empty(LaraCart::getCoupons())) {
            $amount['discount'] = LaraCart::totalDiscount($formatted = false);
        } else {
            $amount['discount'] = 0;
        }

        $amount['total'] = ($amount['subtotal'] + $amount['taxes'] + $amount['shipping_fee']) - $amount['discount'];
                        
        return view('frontend.themes.'.config('app.themes').'.checkout', compact([
            'address',
            'carts',
            'amount'
        ]));
    }

    public function checkCard($card_number)
    {
        try {

            $client = new GuzzleHttp\Client;
            $res = $client->get('https://api.sandbox.midtrans.com/v1/bins/'.substr($card_number, 0, 6), [
                'headers' => [
                                'Accept' => 'application/json',
                                'Authorization' => 'Basic '.base64_encode(config('midtrans.server_key').':'),
                                'Content-Type' => 'application/json'
                ]
            ]);

            $results = $res->getBody()->getContents();
            $response = json_decode($results);
            
            if ($response->data->brand == 'VISA') {
                $image = url('frontend/'.config('app.themes').'/images/cards/visa.png');
            } else if ($response->data->brand == 'MASTERCARD') {
                $image = url('frontend/'.config('app.themes').'/images/cards/mastercard.png');
            } else if ($response->data->brand == 'JCB') {
                $image = url('frontend/'.config('app.themes').'/images/cards/jcb.png');
            } else if ($response->data->brand == 'AMERICAN EXPRESS') {
                $image = url('frontend/'.config('app.themes').'/images/cards/amex.png');
            } else if ($response->data->brand == 'DISCOVER') {
                $image = url('frontend/'.config('app.themes').'/images/cards/discover.png');
            }  else {
                $image = null;
            }

            return response()->json(
                [
                    'type' => 'success',
                    'message' => 'success fetch bin data',
                    'data' => $response->data,
                    'image' => $image
                ], 200
            );

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            
            if ($e->getCode() == 404) {
                return response()->json(
                    [
                        'type' => 'error',
                        'message' => 'Your card is invalid, we cannot find any of your card',
                    ], $e->getCode()
                );
            }

            return response()->json(
                [
                    'type' => 'error',
                    'message' => json_decode($e->getResponse()->getBody()->getContents()),
                ], $e->getCode()
            );
        }
    }

    public function store(Request $request)
    {
        $token = $this->getToken($request);
        $order_id = auth()->user()->id.date('mdY').mt_rand(100000,999999);

        if ($token->status_code == 200) {

            $pay = $this->payCreditCard($request, $token->token_id, $order_id);

            if ($pay->status_code == 200) {

                $order = $this->storeToDatabase($request, $order_id, $pay);
                LaraCart::destroyCart();
                session()->forget('shipping');

                return redirect('checkout/complete')->with('checkout', [
                    'status' => 'success',
                    'message' => $pay->status_message,
                    'order' => $order
                ]);

            } else {
                return redirect('checkout/complete')->with('checkout', [
                    'status' => 'error',
                    'message' => $pay->status_message
                    ]);
            }

        } else {
            return redirect('checkout/complete')->with('checkout', [
                'status' => 'error',
                'message' => $token->status_message
            ]);
        }
    }

    public function getToken($request)
    {
        try {
            $expiration_date = explode('/', $request->expiration_date);
            $card_month_exp = $expiration_date[0];
            $card_year_exp = $expiration_date[1];

            $gross_amount = LaraCart::total($formatted=false);
            $client = new GuzzleHttp\Client;
            $res = $client->request('get', 'https://api.sandbox.midtrans.com/v2/token?client_key='.config('midtrans.client_key').'&gross_amount='.$gross_amount.'&card_number='.$request->card_number.'&card_exp_month='.$card_month_exp.'&card_exp_year='.$card_year_exp.'&card_cvv='.$request->card_cvv.'&secure=false');

            $result = $res->getBody()->getContents();
            return json_decode($result);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            return json_decode($e->getResponse()->getBody()->getContents());
        }

    }

    public function payCreditCard($request, $token_id, $order_id)
    {
        $subtotal = round(Helper::getCurrency(LaraCart::subTotal($format = false, $withDiscount = true), 'idr'));
        $taxes = round(Helper::getCurrency(LaraCart::taxTotal($formatted = false), 'idr'));
        $shipping_fee = round(Helper::getCurrency(LaraCart::getFee('shippingFee')->amount, 'idr'));
        $discount = round(Helper::getCurrency(LaraCart::totalDiscount($formatted = false), 'idr'));
        $total = ($subtotal + $taxes + $shipping_fee) - $discount;

        $address = Address::where('user_id', auth()->user()->id)
                        ->where(function($where){
                            if (session()->has('address')) {
                                $where->where('id', session()->get('address'));
                            }
                        })
                    ->first();
        $items = [];

        foreach (LaraCart::getItems() as $item) {
            $items[] = [
                'id' => $item->name,
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

        $customer = [
            'first_name' => auth()->user()->name,
            'last_name' => '',
            'email' => auth()->user()->email,
            'address' => $address->address.', '.RajaOngkir::getCityAttr($address->city_id, $address->province_id).' '.RajaOngkir::getProvinceAttr($address->province_id),
            'city' => RajaOngkir::getCityAttr($address->city_id, $address->province_id),
            'postal_code' => $address->postal_code,
            'phone' => auth()->user()->cust->phone_number,
            'country_code' => 'IDN'
        ];

        $body = [
                'payment_type' => 'credit_card',
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total
                ],
                'credit_card' => [
                    'token_id' => $token_id
                ],
                'item_details' => $items,
                'customer_details' => $customer,
                'shipping_address' => $customer,
            ];
        
        $headers['ContentType'] = 'application/json';
        $headers['Authorization'] = 'Basic '.base64_encode(config('midtrans.server_key').':');

        $client = new GuzzleHttp\Client;
        $res = $client->post(
            'https://api.sandbox.midtrans.com/v2/charge',
            ['headers' => $headers, 'json' => $body]
        );

        $result = $res->getBody()->getContents();
        return json_decode($result);

    }

    public function storeToDatabase($request, $order_id, $pay)
    {
        $return = '';

        DB::transaction(function() use ($request, $order_id, $pay, &$return){
            $items = LaraCart::getItems();
            $address = Address::where('user_id', auth()->user()->id)
                            ->where(function($where){
                                if (session()->has('address')) {
                                    $where->where('id', session()->get('address'));
                                }
                            })
                        ->first();
            
            $shipping_data = session()->get('shipping');

            $order = new Order;
            $order->number = $order_id;
            $order->subtotal = LaraCart::subTotal($format = false, $withDiscount = false);
            $order->tax = LaraCart::taxTotal($formatted = false);
            $order->discount = LaraCart::totalDiscount($formatted = false);
            $order->shipping_fee = LaraCart::getFee('shippingFee')->amount;
            $order->total = LaraCart::total($formatted = false, $withDiscount = true);
            if (!empty(LaraCart::getCoupons())){ 
                $order->coupon_code = array_keys(LaraCart::getCoupons())[0];
            }
            $order->user_id = auth()->user()->id;
            $order->payment_date = $pay->transaction_time;
            $order->transaction_status = $pay->transaction_status;
            $order->payment_type = $pay->payment_type;
            $order->fraud_status = $pay->fraud_status;
            $order->bank_name = $pay->bank;
            $order->first_name = auth()->user()->name;
            $order->last_name = '';
            $order->phone = auth()->user()->cust->phone_number;
            $order->email = auth()->user()->email;
            $order->address = $address->address;
            $order->save();

            $shipping = new Ship;
            $shipping->first_name = auth()->user()->name;
            $shipping->last_name = '';
            $shipping->email = auth()->user()->email;
            $shipping->phone_number = auth()->user()->cust->phone_number;
            $shipping->country_id = 'IDN';
            $shipping->province_id = $address->province_id;
            $shipping->city_id = $address->city_id;
            $shipping->zip = $address->postal_code;
            $shipping->address = $address->address;
            $shipping->courier_id = $shipping_data['courier_id'];
            $shipping->total_weight = $shipping_data['total_weight'];
            $shipping->cost = $shipping_data['cost'];
            $shipping->service_name = $shipping_data['service_name'];
            $shipping->service_description = $shipping_data['service_description'];
            $shipping->estimate_delivery = $shipping_data['estimate_delivery'];

            $order->ship()->save($shipping);

            foreach ($items as $item) {

                $order_details = new OrderDetails;
                $order_details->product_id = $item->id;
                $order_details->price = $item->price;
                $order_details->qty = $item->qty;
                $order->details()->save($order_details);

                if (!empty($item->attributes)) {
                    foreach ($item->attributes as $attributes) {

                        $order_attributes = new OrderAttribute;
    
                        $order_attributes->name = $attributes['name'];
                        $order_attributes->value = $attributes['value'];
    
                        $order_details->attributes()->save($order_attributes);
    
                    }
                }
            }

            $return = $order;

        });

        return $return;
    }

    public function complete()
    {
        if (session()->has('checkout')) {
            return view('frontend.themes.'.config('app.themes').'.checkout.complete');
        } else {
            return redirect('cart');
        }
    }
}
