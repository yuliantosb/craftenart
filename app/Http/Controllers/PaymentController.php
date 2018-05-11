<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
    	return view('frontend.payment');
    }

    public function finish(Request $request)
    {

    }

    public function unfinish(Request $request)
    {

    }

    public function error(Request $request)
    {

    }
}
