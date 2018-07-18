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

        return view('frontend.cart', compact(['carts', 'provinces', 'cities', 'costs', 'weight', 'amount']));
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
            'estimate_delivery' => $request->estimate_delivery[$index],
            'order_total' => LaraCart::total($formatted = false, $withDiscount = true)

        ];

        $shipping = session()->put('shipping', $data);

        LaraCart::addFee('shippingFee', $request->cost[$index], $taxable =  false, $options = []);
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
}
