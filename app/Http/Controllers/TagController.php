<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Helper;
use App\Tag;

class TagController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$tag = Tag::get();

    		return DataTables::of($tag)
    		->rawColumns(['name'])
    		->addColumn('name', function($data){
    			return '<p class="text-primary">'.$data->name.'</p>
    			<p>
    			<a href="'.route('admin.tag.edit', $data->id).'" class="btn btn-success btn-xs">Edit</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.tag.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})
    		->addColumn('description', function($data){
    			return strip_tags($data->description);
    		})
    		->toJson();


    	} else {
    		return view('backend.tag.index');
    	}
    }

    public function create()
    {
    	return view('backend.tag.create');
    }

    public function store(Request $request)
    {
    	$tag = new Tag;
    	$tag->name = $request->name;
    	$tag->description = $request->description;
    	$tag->slug = Helper::createSlug($request->name, 'tag');
    	$tag->feature_image = $request->feature_image;
    	$tag->save();

    	return redirect()
    			->route('admin.tag.index')
    			->with('message', 'Data saved successfully');
    }

    public function edit($id)
    {
    	$tag = Tag::find($id);
    	return view('backend.tag.edit', compact(['tag']));
    }

    public function update(Request $request, $id)
    {
    	$tag = Tag::find($id);
    	$tag->name = $request->name;
    	$tag->description = $request->description;
    	$tag->slug = Helper::createSlug($request->name, 'tag');
    	$tag->feature_image = $request->feature_image;
    	$tag->save();

    	return redirect()
    			->route('admin.tag.index')
    			->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
    	$tag = Tag::find($id);
    	$tag->delete();

    	return redirect()
    			->route('admin.tag.index')
    			->with('message', 'Data deleted successfully');
    }
}
