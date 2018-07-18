<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Helper;
use App\Article;
use App\Category;
use App\Tag;
use App\Widget;

class PostController extends Controller
{

    public function index(Request $request)
    {
    	if ($request->ajax()) {

			$articles = Article::where('type', 'post')->with(['user', 'categories', 'tags', 'comments'])
    					->get();

    		return DataTables()

    		->of($articles)

    		->rawColumns(['title'])
    		
    		->addColumn('title', function($data){
    			return '<p class="text-primary">'.$data->title.'</p>
    			<p>
    			<a href="'.route('admin.post.edit', $data->id).'" class="btn btn-success btn-xs">Edit</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.post.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})

    		->addColumn('comment.count', function($data){
    			return $data->comments->count();
    		})

    		->addColumn('categories.name', function($data){
    			return $data->categories->pluck('name')->implode(', ');
    		})

    		->addColumn('tags.name', function($data){
    			$tags =  $data->tags->pluck('name');
				return '<span class="label label-info label-xs">'.$tags->implode('</span>&nbsp;<span class="label label-info label-xs">');
    		})

    		->toJson();

    	}

    	return view('backend.post.index');
    }

    public function create()
    {
    	$categories = Category::where('type', 'post')->get();
    	$tags = Tag::where('type', 'post')->get();
    	$widgets = Widget::get();

    	return view('backend.post.create', compact(['categories', 'tags', 'widgets']));
    }

    public function store(Request $request)
    {
    	DB::transaction(function() use ($request){

    		$post = new Article;
			$post->title_en = $request->title_en;
            $post->title_id = $request->title_id;
			$post->user_id = auth()->user()->id;
			$post->feature_image = $request->feature_image;
			$post->slug = Helper::createSlug($request->title_en, 'article');
			$post->content_en = $request->content_en;
            $post->content_id = $request->content_id;
			$post->widget_id = $request->widget_id;
			$post->type = 'post';
			$post->save();

			if (count($request->tags) > 0){

                foreach ($request->tags as $tag) {

                    $tag = Tag::firstOrCreate([
                                    'name_en' => $tag,
                                    'slug' => str_slug($tag),
                                    'type' => 'post', ]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                
                $post->tags()->sync($tagIds);
            }

            if (count($request->categories) > 0){

                foreach ($request->categories as $category) {

                    $category = Category::firstOrCreate([
                                'name_en' => $category,
                                'slug' => str_slug($category),
                                'type' => 'post', ]);

                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                
                $post->categories()->sync($categoryIds);
            }

    	});


        return redirect()
        		->route('admin.post.index')
        		->with('message', 'Data saved successfully!');
    }

    public function edit($id)
    {
    	$categories = Category::where('type', 'post')->get();
    	$tags = Tag::where('type', 'post')->get();
    	$widgets = Widget::get();
    	$article = Article::find($id);

    	return view('backend.post.edit', compact(['categories', 'tags', 'widgets', 'article']));
    }

    public function update(Request $request, $id)
    {
    	DB::transaction(function() use ($request, $id){

    		$post = Article::find($id);
			$post->title_en = $request->title_en;
            $post->title_id = $request->title_id;
			$post->user_id = auth()->user()->id;
			$post->feature_image = $request->feature_image;
			$post->slug = Helper::createSlug($request->title_en, 'article', $id);
			$post->content_en = $request->content_en;
            $post->content_id = $request->content_id;
			$post->widget_id = $request->widget_id;
			$post->type = 'post';
			$post->save();

			if (count($request->tags) > 0){

                foreach ($request->tags as $tag) {

                    $tag = Tag::firstOrCreate([
                                    'name_en' => $tag,
                                    'slug' => str_slug($tag),
                                    'type' => 'post', ]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                
                $post->tags()->sync($tagIds);
            }

            if (count($request->categories) > 0){

                foreach ($request->categories as $category) {

                    $category = Category::firstOrCreate([
                                'name_en' => $category,
                                'slug' => str_slug($category),
                                'type' => 'post', ]);

                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                
                $post->categories()->sync($categoryIds);
            }

    	});


        return redirect()
        		->route('admin.post.index')
        		->with('message', 'Data updated successfully!');
    }

    public function destroy($id)
    {
    	DB::transaction(function() use ($id){

   			$post = Article::find($id);
   			$post->tags()->detach();
   			$post->categories()->detach();
   			$post->comments()->delete();
   			$post->delete();

   		});

   		return redirect()
        		->route('admin.post.index')
        		->with('message', 'Data deleted successfully!');
    }
}
