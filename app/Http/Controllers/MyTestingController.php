<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyTestingController extends Controller
{

	public function index()
	{
    	return view('frontend.themes.'.config('app.themes').'.testing');
	}
}
