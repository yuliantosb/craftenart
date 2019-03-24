<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraCart;
use App\Product;
use RajaOngkir;
use Helper;

class CartController extends Controller
{

    public function index()
    {

        $carts = LaraCart::getItems();
        $provinces = RajaOngkir::getProvince();
        $weight = collect($carts)->pluck('weight')->sum();

        if (!empty($carts)) {

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

        return view('frontend.themes.'.config('app.themes').'.cart', compact(['carts', 'provinces', 'cities', 'costs', 'weight', 'amount']));
    }
    
    public function store(Request $request)
    {
    	$product = Product::find($request->id);

        if ($product->stock->amount < 1) {

            return redirect()
                    ->back()
                    ->with('alert', ['type' => 'warning',
                        'title' => 'Information',
                        'message' => 'This product is out of stock!']);

        } else if ($product->stock->amount < $request->qty) {

            return redirect()
                    ->back()
                    ->with('alert', ['type' => 'warning',
                        'title' => 'Information',
                        'message' => 'Your order exceeded stock limit!']);

        } else {

            $price = !empty($product->sale) ? $product->sale : $product->price;
            LaraCart::add(
                $product->id,
                $name = $product->name,
                $qty = $request->has('qty') ? $request->qty : 1,
                $price = $price,
                $options = ['thumbnail' => $product->picture, 'tax' => .10, 'weight' => $product->weight],
                $taxable = true,
                $lineItem = false
            );

            return redirect()->back();
        }

    }

    public function destroy($id)
    {
    	LaraCart::removeItem($id);
    	return redirect()->back();
    }

    public function addFee(Request $request)
    {

        if (session()->has('shipping')) {
            session()->forget('shipping');
        }

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
            'courier_id' => $request->courier_id,
            'courier_name' => $request->courier_name,
            'cost' => $request->cost,
            'service_name' => $request->service_name,
            'service_description' => $request->service_description,
            'estimate_delivery' => $request->estimate_delivery,
            'order_total' => LaraCart::total($formatted = false, $withDiscount = true)

        ];

        $shipping = session()->put('shipping', $data);

        LaraCart::addFee('shippingFee', $request->cost, $taxable =  false, $options = []);

        if ($request->wantsJson()) {

            $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
            $taxes = LaraCart::taxTotal($formatted = false);
            $shipping_fee = LaraCart::getFee('shippingFee')->amount;

            if (!empty(LaraCart::getCoupons())) {
                $discount = LaraCart::totalDiscount($formatted = false);
            } else {
                $discount = 0;
            }

            $total = ($subtotal + $taxes + $shipping_fee) - $discount;

            $cost['subtotal'] = Helper::currency($subtotal);
            $cost['taxes'] = Helper::currency($taxes);
            $cost['shipping_fee'] = Helper::currency($shipping_fee);
            $cost['discount'] = Helper::currency($discount);
            $cost['total'] = Helper::currency($total);

            return response()->json(['data' => $cost, 'type' => 'success'], 201);
        }

        return redirect()->back();
    }

    public function bulkUpdate(Request $request)
    {

        if ($request->has('delete')) {

            LaraCart::removeItem($request->delete);

        } else {

            foreach ($request->id as $key => $value) {
                LaraCart::updateItem($request->id[$key], 'qty', $request->qty[$key]);
            }

                
        }
        
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        LaraCart::updateItem($request->id, 'qty', $request->qty);
        $price = LaraCart::getItems()[$request->id]->options['price'];
        $qty = LaraCart::getItems()[$request->id]->options['qty'];

        $total_cart = $price * $qty;
        $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
        $taxes = LaraCart::taxTotal($formatted = false);
        $shipping_fee = LaraCart::getFee('shippingFee')->amount;

        if (!empty(LaraCart::getCoupons())) {
            $discount = LaraCart::totalDiscount($formatted = false);
        } else {
            $discount = 0;
        }

        $total = ($subtotal + $taxes + $shipping_fee) - $discount;

        $cost['total_cart'] = Helper::currency($total_cart);
        $cost['subtotal'] = Helper::currency($subtotal);
        $cost['taxes'] = Helper::currency($taxes);
        $cost['shipping_fee'] = Helper::currency($shipping_fee);
        $cost['discount'] = Helper::currency($discount);
        $cost['total'] = Helper::currency($total);

        return response()->json(['data' => $cost, 'type' => 'success'], 201);
    }

    public function removeCart($id)
    {
        LaraCart::removeItem($id);
        $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
        $taxes = LaraCart::taxTotal($formatted = false);
        $shipping_fee = LaraCart::getFee('shippingFee')->amount;

        if (!empty(LaraCart::getCoupons())) {
            $discount = LaraCart::totalDiscount($formatted = false);
        } else {
            $discount = 0;
        }

        $total = ($subtotal + $taxes + $shipping_fee) - $discount;

        $cost['subtotal'] = Helper::currency($subtotal);
        $cost['taxes'] = Helper::currency($taxes);
        $cost['shipping_fee'] = Helper::currency($shipping_fee);
        $cost['discount'] = Helper::currency($discount);
        $cost['total'] = Helper::currency($total);

        $count = count(LaraCart::getItems());

        return response()->json(['data' => $cost, 'count' => $count, 'type' => 'success'], 201);
    }
}
