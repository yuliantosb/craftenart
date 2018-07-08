<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;

class MyWishlistController extends Controller
{
    public function index()
    {
    	$wishlists = Wishlist::where('user_id', auth()->user()->id)
    					->get();

    	return view('frontend.wishlist', compact(['wishlists']));
    }
}
