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
        $categories = Category::take(3)->get();
        $order = Order::find(1);
        $order_details = [];

        foreach ($order->details as $details) {

            $order_details[] = [
                                    'sku' => $details->product->sku,
                                    'name' => $details->product->name,
                                    'price' => Helper::getCurrency($details->price, 'usd'),
                                    'qty' => $details->qty

                                ];

        }


        $order_details_data = collect($order_details)->toJson();

        return view('frontend.home', compact(['products', 'categories', 'order', 'order_details_data']));


        
    }
}
