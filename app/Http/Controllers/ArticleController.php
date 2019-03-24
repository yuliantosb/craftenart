<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function show($slug)
    {
    	$post = Article::where('type', 'page')->where('slug', $slug)->first();
    	
    	if (!empty($post)) {
    		return view('frontend.themes.'.config('app.themes').'.article', compact(['post']));
    	}
    	abort(404);
    	
    }
}
