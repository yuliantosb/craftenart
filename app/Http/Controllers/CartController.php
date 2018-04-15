<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraCart;
use App\Product;

class CartController extends Controller
{
    public function store(Request $request)
    {
    	$product = Product::find($request->id);
    	$price = !empty($product->sale) ? $product->sale : $product->price;
    	LaraCart::add(
		    $product->id,
		    $name = $product->name,
		    $qty = $request->has('qty') ? $request->qty : 1,
		    $price = $price,
		    $options = ['thumbnail' => $product->picture, 'tax' => .10],
		    $taxable = true,
		    $lineItem = false
		);

		return redirect()->back();
    }

    public function destroy($id)
    {
    	LaraCart::removeItem($id);
    	return redirect()->back();
    }
}
