<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RajaOngkir;

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
}
