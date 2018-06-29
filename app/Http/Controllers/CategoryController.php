<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DataTables;
use Helper;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$category = Category::where(function($where) use ($request){
                if ($request->type != 'all') {
                    $where->where('type', $request->type);
                }
            })->get();

    		return DataTables::of($category)
    		->rawColumns(['name'])
    		->addColumn('name', function($data){
    			return '<p class="text-primary">'.$data->name.'</p>
    			<p>
    			<a href="'.route('admin.category.edit', $data->id).'" class="btn btn-success btn-xs">Edit</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.category.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})
    		->addColumn('description', function($data){
    			return substr(strip_tags($data->description), 0, 150).'...';
    		})
    		->toJson();

    	} else {
    		return view('backend.category.index');
    	}
    }

    public function create()
    {
    	return view('backend.category.create');
    }

    public function store(Request $request)
    {
    	$category = new Category;
    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->slug = Helper::createSlug($request->name, 'category');
    	$category->feature_image = $request->feature_image;
        $category->type = $request->type;
    	$category->save();

    	return redirect()
    			->route('admin.category.index')
    			->with('message', 'Data saved successfully');
    }

    public function edit($id)
    {
    	$category = Category::find($id);
    	return view('backend.category.edit', compact(['category']));
    }

    public function update(Request $request, $id)
    {
    	$category = Category::find($id);
    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->slug = Helper::createSlug($request->name, 'category', $id);
    	$category->feature_image = $request->feature_image;
        $category->type = $request->type;
    	$category->save();

    	return redirect()
    			->route('admin.category.index')
    			->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
    	$category = Category::find($id);
    	$category->delete();

    	return redirect()
    			->route('admin.category.index')
    			->with('message', 'Data deleted successfully');
    }
}
