<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use DataTables;
use Carbon\Carbon;

class WidgetController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$widget = Widget::get();

    		return DataTables::of($widget)
    		->rawColumns(['name'])

    		->addColumn('name', function($data){

    			return '<p class="text-primary">'.$data->name.'<br><small>'.Carbon::parse($data->created_at)->format('m/d/Y').'</small></p>
    			<p>
    			<a href="'.route('admin.widget.edit', $data->id).'" class="btn btn-primary btn-xs">Edit</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.widget.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})


    		->toJson();

    	}

		return view('backend.widget.index');
    }

    public function create()
    {
		return view('backend.widget.create');
    }

    public function store(Request $request)
    {
    	$widget = new Widget;
    	$widget->name = $request->name;
		$widget->content = $request->content;
		$widget->type = $request->type;
		$widget->limit = $request->limit;
		$widget->save();

		return redirect()
                ->route('admin.widget.index')
                ->with('message', 'Date saved successfully!');
    }

    public function edit($id)
    {
        $widget = Widget::find($id);
        return view('backend.widget.edit', compact(['widget']));
    }


    public function update(Request $request, $id)
    {
        $widget = Widget::find($id);
        $widget->name = $request->name;
        $widget->content = $request->content;
        $widget->type = $request->type;
        $widget->limit = $request->limit;
        $widget->save();

        return redirect()
                ->route('admin.widget.index')
                ->with('message', 'Date updated successfully!');
    }

    public function destroy($id)
    {
        $widget = Widget::find($id);
        $widget->delete();

        return redirect()
                ->route('admin.widget.index')
                ->with('message', 'Date deleted successfully!');
    } 

}
