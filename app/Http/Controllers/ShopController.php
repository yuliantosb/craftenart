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


        if ($request->has('limit')) {
            session()->put('limit', $request->limit);
        }

        if ($request->has('view')) {
            session()->put('view', $request->view);
        }

        if ($request->has('sort') && $request->has('type')) {
            session()->put(['sort' => $request->sort, 'type' => $request->type]);
        }

        $limit = session()->has('limit') ? session()->get('limit') : 12;
        $products = Product::getProduct($request->category, $request->tags, $request->keyword, $request->price_range)
                        ->paginate($limit);

        $category = Category::where('slug', $request->category)->first();
        $default_placeholder = Setting::getSetting('default_placeholder');

        $placeholder = !empty($request->category) ? url('uploads/'.$category->feature_image) : url('uploads/'.$default_placeholder->img);

        $sort = session()->get('sort');
        $type = session()->get('type');

        if ($sort == 'price' && $type == 'asc') {
            $sort_type = trans('label.low_to_high');
        } else if ($sort == 'price' && $type == 'desc') {
            $sort_type = trans('label.high_to_low');
        } else if ($sort == 'name' && $type == 'desc') {
            $sort_type = trans('label.z_to_a');
        } else {
            $sort_type = trans('label.a_to_z');
        }

        if (session()->get('view') == 'list') {

            return view('frontend.shop.list', compact(['products', 'placeholder', 'category', 'sort_type']));    
        }

        return view('frontend.shop.grid', compact(['products', 'placeholder', 'category', 'sort_type']));


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
