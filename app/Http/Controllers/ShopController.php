<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Tag;
use App\Setting;
use App\Category;
use Helper;

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
        $categories = Category::get();
        $products = Product::getProduct($request->category, $request->tags, $request->keyword, $request->price_range)
                        ->paginate($limit);

        if (!empty($request->category)) {
            $category = Category::where('slug', $request->category)->first();
        } else {
            $category = Category::inRandomOrder()->first();
        }
        
        // $default_placeholder = Setting::getSetting('default_placeholder');

        // $placeholder = !empty($request->category) ? url('uploads/'.$category->feature_image) : url('uploads/'.$default_placeholder->img);

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

            return view('frontend.themes.'.config('app.themes').'.shop.list', compact(['products', 'categories', 'category', 'sort_type']));    
        }

        return view('frontend.themes.'.config('app.themes').'.shop.grid', compact(['products', 'categories', 'category', 'sort_type']));


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

    		return view('frontend.themes.'.config('app.themes').'.shop.show', compact(['product', 'relateds']));
    	}
    }

    public function ajax($id)
    {
        $product = Product::with(['galleries', 'reviews', 'stock'])->find($id)->setAppends(['description']);
        $product->price_formatted = Helper::currency($product->price);
        $product->sale_formatted = Helper::currency($product->sale);
        $product->description_cut = substr(strip_tags($product->description), 0, 200).' ...';
        $discount = !empty($product->sale_product) ? round(( ($product->price - $product->sale) / $product->price) * 100) : '';
        $ratings = $product->reviews->avg('rate');
        $attributes = '';

        if ($product->attributes->count() > 0) {
            foreach ($product->attributes as $attribute) {
                $attributes .= '<div class="col-md-4 col-sm-4">
                                <p>'.$attribute->name.'</p>
                                <input type="text" name="attribute_name[]" value="'.$attribute->name.'" hidden="hidden">
                                <select name="attribute_value[]" class="selectBoxIt">';
                    foreach (json_decode($attribute->value) as $value) {
                        $attributes .= '<option value="'.$value.'">'.$value.'</option>';
                    }
                        
                $attributes .= '</select>
                                </div>';
            }
        }

        if (auth()->check()){

            if (in_array($product->id, auth()->user()->wishlist->pluck('product_id')->toArray())) {
                $wishlist = '<a data-toggle="tooltip" title="'.trans('label.you_like_this').'" class="likeitem fa fa-heart-o active"></a>';
            } else {
                $wishlist = '<a href="javascript:void(0)" onclick="document.getElementById(\'popup-product-wishlist\').submit()" class="likeitem fa fa-heart-o"></a>';
            }
        } else {
            $wishlist = '<a href="javascript:void(0)" onclick="document.getElementById(\'popup-product-wishlist\').submit()" class="likeitem fa fa-heart-o"></a>';
        }

        return response()->json([
            'data' => $product,
            'discount' => $discount,
            'ratings' => $ratings,
            'wishlist' => $wishlist,
            'attributes' => $attributes
        ]);
    }
}
