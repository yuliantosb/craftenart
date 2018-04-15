<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();
    	$relateds = Product::whereHas('categories', function($where) use($product){
			    		$where->whereIn('category_id', $product->categories->pluck('id'));
			    	})
    				->where('id', '!=', $product->id)
    				->take(5)
    				->get();

    	// if (!empty($product)) {
    	// 	abort(404);
    	// } else {
    		return view('frontend.shop.show', compact(['product', 'relateds']));
    	// }
    }
}
