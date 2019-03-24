<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class MyOrderController extends Controller
{
    public function index()
    {
    	$orders = Order::where('user_id', auth()->user()->id)
    				->orderBy('id', 'desc')
    				->paginate(5);

    	return view('frontend.themes.'.config('app.themes').'.order', compact(['orders']));
    }
}
