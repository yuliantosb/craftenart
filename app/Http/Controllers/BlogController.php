<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Setting;
use App\Comment;

class BlogController extends Controller
{
    public function index(Request $request)
    {

    	$posts = Article::where('type', 'post')

                    ->where(function($where) use ($request){
                        
                        if (!empty($request->category)) {
                            $where->whereHas('categories', function($has) use ($request){
                                $has->where('slug', 'like', '%'.$request->category.'%');
                            });
                        }

                        if (!empty($request->tag)) {
                            $where->whereHas('tags', function($has) use ($request){
                                $has->where('slug', 'like', '%'.$request->tag.'%');
                            });
                        }

                        if (!empty($request->author)) {
                            $where->whereHas('user', function($has) use ($request){
                                $has->where('id', $request->author);
                            });
                        }
                    })

                    ->orderBy('id', 'desc')
    				->paginate(10);

    	$banner = Setting::getSetting('default_placeholder');

    	return view('frontend.blog', compact(['posts', 'banner']));
    }

    public function show($slug)
    {
    	$post = Article::where('type', 'post')->where('slug', $slug)->first();
        if (!empty($post)) {
            return view('frontend.blog.show', compact(['post']));    
        }
    	abort(404);
    }

    public function comment(Request $request, $article_id)
    {
        $comment = new Comment;
        $comment->article_id = $article_id;
        $comment->parent_id = $request->parent_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->content = $request->content;
        $comment->save();

        return redirect()
                ->back()
                ->with('message', 'Comment has been posted!');

    }
}
