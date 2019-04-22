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

use App\Stock;
use App\StockDetails;

use Helper;

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
        $categories = new Category;
        $category_chunks = $categories->whereHas('products')->take(4)->get()->chunk(2);

        return view('frontend.themes.'.config('app.themes').'.home', compact(['products', 'categories', 'category_chunks']));


        
    }
}
