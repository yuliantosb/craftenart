<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function show($slug)
    {
    	$post = Article::where('type', 'page')->where('slug', $slug)->first();
    	return view('frontend.article', compact(['post']));
    }
}
