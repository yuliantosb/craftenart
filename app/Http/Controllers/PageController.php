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

class PageController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

			$articles = Article::where('type', 'page')->with(['user', 'categories', 'tags', 'comments'])
    					->get();

    		return DataTables()

    		->of($articles)

    		->rawColumns(['title'])
    		
    		->addColumn('title', function($data){
    			return '<p class="text-primary">'.$data->title.'</p>
    			<p>
    			<a href="'.route('admin.page.edit', $data->id).'" class="btn btn-success btn-xs">Edit</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.page.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
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

    	return view('backend.page.index');
    }

    public function create()
    {
    	$categories = Category::where('type', 'page')->get();
    	$tags = Tag::where('type', 'page')->get();
    	$widgets = Widget::get();

    	return view('backend.page.create', compact(['categories', 'tags', 'widgets']));
    }

    public function store(Request $request)
    {
    	DB::transaction(function() use ($request){

    		$page = new Article;
			$page->title_en = $request->title_en;
            $page->title_id = $request->title_id;
			$page->user_id = auth()->user()->id;
			$page->feature_image = $request->feature_image;
			$page->slug = Helper::createSlug($request->title_en, 'article');
			$page->content_en = $request->content_en;
            $page->content_id = $request->content_id;
			$page->widget_id = $request->widget_id;
			$page->type = 'page';
			$page->save();

			if (count($request->tags) > 0){

                foreach ($request->tags as $tag) {

                    $tag = Tag::firstOrCreate([
                                    'name_en' => $tag,
                                    'slug' => str_slug($tag),
                                    'type' => 'page', ]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                
                $page->tags()->sync($tagIds);
            }

            if (count($request->categories) > 0){

                foreach ($request->categories as $category) {

                    $category = Category::firstOrCreate([
                                'name_en' => $category,
                                'slug' => str_slug($category),
                                'type' => 'page', ]);

                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                
                $page->categories()->sync($categoryIds);
            }

    	});


        return redirect()
        		->route('admin.page.index')
        		->with('message', 'Data saved successfully!');
    }

    public function edit($id)
    {
    	$categories = Category::where('type', 'page')->get();
    	$tags = Tag::where('type', 'page')->get();
    	$widgets = Widget::get();
    	$article = Article::find($id);

    	return view('backend.page.edit', compact(['categories', 'tags', 'widgets', 'article']));
    }

    public function update(Request $request, $id)
    {
    	DB::transaction(function() use ($request, $id){

    		$page = Article::find($id);
			$page->title_en = $request->title_en;
            $page->title_id = $request->title_id;
			$page->user_id = auth()->user()->id;
			$page->feature_image = $request->feature_image;
			$page->slug = Helper::createSlug($request->title_en, 'article', $id);
            $page->content_en = $request->content_en;
			$page->content_id = $request->content_id;
			$page->widget_id = $request->widget_id;
			$page->type = 'page';
			$page->save();

			if (count($request->tags) > 0){

                foreach ($request->tags as $tag) {

                    $tag = Tag::firstOrCreate([
                                    'name_en' => $tag,
                                    'slug' => str_slug($tag),
                                    'type' => 'page', ]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
                
                $page->tags()->sync($tagIds);
            }

            if (count($request->categories) > 0){

                foreach ($request->categories as $category) {

                    $category = Category::firstOrCreate([
                                'name_en' => $category,
                                'slug' => str_slug($category),
                                'type' => 'page', ]);

                    if ($category) {
                        $categoryIds[] = $category->id;
                    }
                }
                
                $page->categories()->sync($categoryIds);
            }

    	});


        return redirect()
        		->route('admin.page.index')
        		->with('message', 'Data updated successfully!');
    }

    public function destroy($id)
    {
    	DB::transaction(function() use ($id){

   			$page = Article::find($id);
   			$page->tags()->detach();
   			$page->categories()->detach();
   			$page->comments()->delete();
   			$page->delete();

   		});

   		return redirect()
        		->route('admin.page.index')
        		->with('message', 'Data deleted successfully!');
    }
}
