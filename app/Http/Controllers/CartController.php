<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraCart;
use App\Product;
use App\Address;
use RajaOngkir;
use Helper;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'], ['only' => ['index']]);
    }
    public function index()
    {
        $address = Address::where('user_id', auth()->user()->id)
                        ->where(function($where){
                            if (session()->has('address')) {
                                $where->where('id', session()->get('address'));
                            }
                        })
                        ->first();

        $carts = LaraCart::getItems();
        $provinces = RajaOngkir::getProvince();
        $weight = collect($carts)->pluck('weight')->sum();

        if (!empty($carts) && !empty($address)) {

                $province_id = $address->province_id;
                $city_id = $address->city_id;

                $costs = [];
                $couriers = config('rajaongkir.courier');

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

        return view('frontend.themes.'.config('app.themes').'.cart', compact(['carts', 'provinces', 'costs', 'weight', 'amount', 'address']));
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
            $attribute = [];
            
            if (!empty($request->attribute_name)) {

                foreach ($request->attribute_name as $index => $attribute_name) {
                    $attribute[] = ['name' => $attribute_name, 'value' => $request->attribute_value[$index]];
                }
            }

            LaraCart::add(
                $product->id,
                $name = $product->name,
                $qty = $request->has('qty') ? $request->qty : 1,
                $price = $price,
                $options = ['thumbnail' => $product->picture, 'tax' => .10, 'weight' => $product->weight, 'attributes' => $attribute],
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
        LaraCart::removeCoupons();
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
        LaraCart::removeCoupons();
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

    public function addAddress(Request $request)
    {
        $address = new Address;
        $address->province_id = $request->province_id;
        $address->city_id = $request->city_id;
        $address->address = $request->address;
        $address->user_id = auth()->user()->id;
        $address->postal_code = $request->postal_code;
        $address->save();

        $new_addresses = [];
        $addresses = Address::where('user_id', auth()->user()->id)->get();

        foreach ($addresses as $address_new) {
            $new_addresses[] = [
                                    'id' => $address_new->id,
                                    'text' => $address_new->address.', '.RajaOngkir::getCityAttr($address_new->city_id, $address_new->province_id).' '.RajaOngkir::getProvinceAttr($address_new->province_id).', '.$address->postal_code,
                            ];
        }

        return response()->json(['data' => $new_addresses ]);
    }

    public function removeAddress($id)
    {
        $address = Address::find($id);
        $address->delete();

        $new_addresses = [];
        $addresses = Address::where('user_id', auth()->user()->id)->get();

        foreach ($addresses as $address_new) {
            $new_addresses[] = [
                                    'id' => $address_new->id,
                                    'text' => $address_new->address.', '.RajaOngkir::getCityAttr($address_new->city_id, $address_new->province_id).' '.RajaOngkir::getProvinceAttr($address_new->province_id).', '.$address->postal_code,
                            ];
        }

        return response()->json(['data' => $new_addresses ]);
    }

    public function changeAddresses(Request $request)
    {
        session()->forget('shipping');
        LaraCart::removeFee('shippingFee');
        session()->put('address', $request->address_id);

        $address = Address::find(session()->get('address'));
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

        $carts = LaraCart::getItems();
        $weight = collect($carts)->pluck('weight')->sum();
        $costs = [];
        $couriers = config('rajaongkir.courier');

        foreach ($couriers as $courier) {
            $costs[] = RajaOngkir::getCost($address->city_id, $weight, $courier);
        }

        $cost['couriers'] = view('frontend.themes.'.config('app.themes').'.cart.partial', ['costs' => collect($costs), 'total_weight' => $weight])->render();
        $cost['address'] = $address->address.', '.RajaOngkir::getCityAttr($address->city_id, $address->province_id).' '.RajaOngkir::getProvinceAttr($address->province_id).', '.$address->postal_code;

        return response()->json(['cost' => $cost, 'address_id' => session()->get('address')], 200);
    }
}
