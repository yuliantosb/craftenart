<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
    	if (auth()->check()) {
    		
    		$wishlist = new Wishlist;
	    	$wishlist->product_id = $request->product_id;
	    	$wishlist->user_id = auth()->user()->id;
	    	$wishlist->save();

	    	return redirect()
	    			->back()
	    			->with('alert', ['type' => 'success', 'title' => 'Success', 'message' => 'Product saved to your wishlist!']);
    	}

    	return redirect()->route('login');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();

        return redirect()
                    ->back()
                    ->with('alert', ['type' => 'success', 'title' => 'Success', 'message' => 'Your favorite removed from list!']);

    }
}
