<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class MyReviewController extends Controller
{
    public function index()
    {
    	$reviews = Review::where('user_id', auth()->user()->id)
    				->get();

    	return view('frontend.review', compact(['reviews']));
    }
}
