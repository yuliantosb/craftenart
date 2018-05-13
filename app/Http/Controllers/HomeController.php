<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use LaraCart;
use DB;
use App\Order;
use App\OrderDetails;
use App\Ship;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = new Product;
        $categories = Category::take(3)->get();
        return view('frontend.home', compact(['products', 'categories']));
         // dd(LaraCart::getItems());
        //dd(array_keys(LaraCart::getCoupons())[0]);
    }
}
