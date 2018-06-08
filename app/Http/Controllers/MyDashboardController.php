<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Review;

class MyDashboardController extends Controller
{
    public function index()
    {
    	$orders = Order::where('user_id', auth()->user()->id)
    				->get();

    	$reviews = Review::where('user_id', auth()->user()->id)
    				->get();

    	return view('frontend.dashboard', compact(['orders', 'reviews']));
    }
}
