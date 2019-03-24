<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Review;
use App\User;

class MyDashboardController extends Controller
{
    public function index()
    {
    	$orders = Order::where('user_id', auth()->user()->id)
    				->orderBy('id', 'desc')
                    ->take(5)
    				->get();

    	$reviews = Review::where('user_id', auth()->user()->id)
                    ->take(3)
    				->get();

    	$user = User::find(auth()->user()->id);

    	return view('frontend.themes.'.config('app.themes').'.dashboard', compact(['orders', 'reviews', 'user']));
    }
}
