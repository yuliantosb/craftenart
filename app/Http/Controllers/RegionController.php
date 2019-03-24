<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RajaOngkir;
use LaraCart;

class RegionController extends Controller
{
    public function city(Request $request)
    {
    	$cities = RajaOngkir::getCity($request->province_id);
    	$result = [];

    	$result[] = ['id' => '', 'text' => ''];
    	foreach ($cities as $city) {
    		$result[] = ['id' => $city->city_id, 'text' => $city->type.' '.$city->city_name];
    	}
    	
    	return $result;
    }

    public function cost(Request $request)
    {
        $carts = LaraCart::getItems();
        $weight = collect($carts)->pluck('weight')->sum();
        $costs = [];
        $couriers = ['jne', 'pos', 'tiki'];

        foreach ($couriers as $courier) {
            $costs[] = RajaOngkir::getCost($request->destination, $weight, $courier);
        }

        return view('frontend.themes.'.config('app.themes').'.cart.partial', ['costs' => collect($costs), 'total_weight' => $weight])->render();
    }
}
