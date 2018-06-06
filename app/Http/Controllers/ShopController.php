<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Tag;
use App\Setting;
use App\Category;

class ShopController extends Controller
{

    public function index(Request $request)
    {

        $limit = !empty($request->limit) ? $request->limit : 12;
        $products = Product::getProduct($request->category, $request->tags, $request->keyword, $request->price_range)
                        ->paginate($limit);

        $category = Category::where('slug', $request->category)->first();
        $default_placeholder = Setting::getSetting('default_placeholder');

        $placeholder = !empty($request->category) ? url('uploads/'.$category->feature_image) : url('uploads/'.$default_placeholder->img);

        return view('frontend.shop', compact(['products', 'placeholder', 'category']));


    }

    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();

    	if (empty($product)) {
    		abort(404);
    	} else {
            
            $relateds = Product::whereHas('categories', function($where) use($product){
                        $where->whereIn('category_id', $product->categories->pluck('id'));
                    })
                    ->where('id', '!=', $product->id)
                    ->take(5)
                    ->get();

    		return view('frontend.shop.show', compact(['product', 'relateds']));
    	}
    }
}
