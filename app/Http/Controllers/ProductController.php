<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Product;
use App\Category;
use App\Tag;
use App\Stock;
use App\StockDetails;
use App\ProductGalleries;
use App\ProductAttributes;
use DB;
use Helper;


class ProductController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$products = Product::with(['stock', 'categories', 'tags', 'galleries'])
    					->get();

    		return DataTables()

    		->of($products)

    		->rawColumns(['name', 'price'])
    		
    		->addColumn('name', function($data){
    			return '<p class="text-primary">'.$data->name.'</p>
    			<p>
    			<a href="'.route('admin.product.edit', $data->id).'" class="btn btn-success btn-xs">Edit</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.product.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})

    		->addColumn('categories.name', function($data){
    			return $data->categories->pluck('name')->implode(', ');
    		})

    		->addColumn('tags.name', function($data){
    			$tags =  $data->tags->pluck('name');
				return '<span class="label label-info label-xs">'.$tags->implode('</span>&nbsp;<span class="label label-info label-xs">');
    		})

    		->addColumn('price', function($data){
    			return $data->price_amount;
    		})

    		->addColumn('description', function($data){
    			return strip_tags($data->description);
    		})

    		->toJson();

    	} else {
    		return view('backend.product.index');
    	}
    }

    public function create()
    {
    	$categories = Category::get();
    	$tags = Tag::get();
    	return view('backend.product.create', compact(['categories', 'tags']));
    }

    public function store(Request $request)
    {
    	DB::transaction(function() use ($request){

    		$product = new Product;
			$product->name = $request->name;
			$product->picture = $request->feature_image;
			$product->slug = Helper::createSlug($request->name, 'product');
			$product->price = $request->price;
			$product->sale = $request->sale;
			$product->sku = $request->sku;
			$product->weight = $request->weight;
			$product->description = $request->description;
			$product->save();

			$stock = new Stock;
			$stock->amount = $request->stock;
			$product->stock()->save($stock);

			$stock_details = new StockDetails;
			$stock_details->amount = $request->stock;
			$stock_details->description = 'Init new product';
			$product->stock->details()->save($stock_details);

			if (count($request->tags) > 0){

                foreach ($request->tags as $tag) {

                    $tag = Tag::firstOrCreate([
                                    'name' => $tag,
                                    'slug' => str_slug($tag)]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                
                $product->tags()->sync($tagIds);
            }

            if (count($request->categories) > 0){

                foreach ($request->categories as $category) {

                    $category = Category::firstOrCreate([
                                'name' => $category,
                                'slug' => str_slug($category)]);

                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                
                $product->categories()->sync($categoryIds);
            }

            if (count($request->galleries) > 0) {
            	foreach ($request->galleries as $gallery) {

            		$product_gallery = new ProductGalleries;
            		$product_gallery->picture = $gallery;
            		$product->galleries()->save($product_gallery);

            	}            	
            }

            if (count($request->attribute_name) > 0) {
            	foreach ($request->attribute_name as $index => $attribute) {

            		$attribute = new ProductAttributes;
            		$attribute->name = $request->attribute_name[$index];
            		$attribute->value = json_encode($request->attribute_value[$index]);
            		$product->attributes()->save($attribute);

            	}
            }

    	});


        return redirect()
        		->route('admin.product.index')
        		->with('message', 'Data saved successfully!');
    }

   	public function edit($id)
   	{
   		$categories = Category::get();
    	$tags = Tag::get();
    	$product = Product::find($id);

    	return view('backend.product.edit', compact(['categories', 'tags', 'product']));
   	}

   	public function update(Request $request, $id)
   	{
   		DB::transaction(function() use ($request, $id){

    		$product = Product::find($id);
			$product->name = $request->name;
			$product->picture = $request->feature_image;
			$product->slug = Helper::createSlug($request->name, 'product', $id);
			$product->price = $request->price;
			$product->sale = $request->sale;
			$product->sku = $request->sku;
			$product->weight = $request->weight;
			$product->description = $request->description;
			$product->save();

			$product->stock()->delete();

			$stock = new Stock;
			$stock->amount = $request->stock;
			$product->stock()->save($stock);

			$product->stock->details()->delete();

			$stock_details = new StockDetails;
			$stock_details->amount = $request->stock;
			$stock_details->description = 'Init new product';
			$product->stock->details()->save($stock_details);

			if (count($request->tags) > 0){

                foreach ($request->tags as $tag) {

                    $tag = Tag::firstOrCreate([
                                    'name' => $tag,
                                    'slug' => str_slug($tag)]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                
                $product->tags()->sync($tagIds);
            }

            if (count($request->categories) > 0){

                foreach ($request->categories as $category) {

                    $category = Category::firstOrCreate([
                                'name' => $category,
                                'slug' => str_slug($category)]);

                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                
                $product->categories()->sync($categoryIds);
            }

            if (count($request->galleries) > 0) {

            	$product->galleries()->delete();

            	foreach ($request->galleries as $gallery) {

            		$product_gallery = new ProductGalleries;
            		$product_gallery->picture = $gallery;
            		$product->galleries()->save($product_gallery);

            	}            	
            }

            if (count($request->attribute_name) > 0) {

            	$product->attributes()->delete();

            	foreach ($request->attribute_name as $index => $attribute) {

            		$attribute = new ProductAttributes;
            		$attribute->name = $request->attribute_name[$index];
            		$attribute->value = json_encode($request->attribute_value[$index]);
            		$product->attributes()->save($attribute);

            	}
            }

    	});


        return redirect()
        		->route('admin.product.index')
        		->with('message', 'Data udpated successfully!');
   	}

   	public function destroy($id)
   	{
   		DB::transaction(function() use ($id){

   			$product = Product::with(['stock.details'])->find($id);
   			$product->stock()->delete();
   			$product->stock->details()->delete();
   			$product->galleries()->delete();
   			$product->attributes()->delete();
   			$product->categories()->detach();
   			$product->tags()->detach();
   			$product->delete();

   		});

   		return redirect()
        		->route('admin.product.index')
        		->with('message', 'Data deleted successfully!');
   	}
}
