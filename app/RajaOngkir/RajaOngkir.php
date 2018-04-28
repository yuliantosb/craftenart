<?php

namespace App\RajaOngkir;
use GuzzleHttp\Client as Client;

class RajaOngkir
{
	public static function getProvince()
	{
		$client = new Client;

		$res = $client->request('GET', 'https://api.rajaongkir.com/'.config('rajaongkir.type').'/province', [
		    'headers' => [
		    			'key' => config('rajaongkir.api')
	    			]
		]);

		$results = $res->getBody()->getContents();
		return json_decode($results)->rajaongkir->results;
	}

	public static function getCity($province_id)
	{
		$client = new Client;

		$res = $client->request('GET', 'https://api.rajaongkir.com/'.config('rajaongkir.type').'/city?province='.$province_id, [
		    'headers' => [
		    			'key' => config('rajaongkir.api')
	    			]
		]);

		$results = $res->getBody()->getContents();
		return json_decode($results)->rajaongkir->results;
	}

	public static function getCost($destination, $weight, $courier)
	{
		$client = new Client;

		$res = $client->request('POST', 'https://api.rajaongkir.com/'.config('rajaongkir.type').'/cost', [
		    'headers' => [
		    			'key' => config('rajaongkir.api'),
		    			'content-type' => 'application/x-www-form-urlencoded'
	    			],
	    	'body' => [

	    				'origin' => config('rajaongkir.origin'),
	    				'destination' => $destination,
	    				'weight' => $weight,
	    				'courier' => $courier
	    			]
		]);

		$results = $res->getBody()->getContents();
		return json_decode($results)->rajaongkir->results;
	}
}