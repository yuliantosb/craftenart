<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Menu;
use App\Widget;
use App\Category;

class MenuController extends Controller
{
    public function index(Request $request)
    {

        $menus = Menu::where('parent_id', 0)
                    ->orderBy('order_number')
                    ->get();

        $widgets = Widget::get();
        $categories = Category::get();

        if ($request->ajax()) {

            return view('backend.menu.get_data', ['menus' => $menus])->render();
        }

    	$data = [

    		'menus',
    		'categories',
            'widgets',

    	];

    	return view('backend.menu.index', compact($data));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {

            if ($request->type == 'url') {

                $menu = New Menu;
                $menu->name_en = $request->name_en;
                $menu->name_id = $request->name_id;
                $menu->url = $request->url;
                $menu->order_number = Menu::count() + 1;
                $menu->is_mega = $request->is_mega;
                $menu->save();

            }

            if ($request->type == 'widget') {

                $widget_id = $request->widget_id;

                $menu = New Menu;
                $menu->widget_id = $widget_id;
                $menu->name_en = $request->widget_name_en;
                $menu->name_id = $request->widget_name_id;
                $menu->is_mega = 0;
                $menu->order_number = Menu::count() + 1;
                $menu->save();
            }

            $res = [
                        'title' => 'Success',
                        'type' => 'success',
                        'message' => 'Data has been saved successfuly!'
                    ];

            return response()->json($res);

        }
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            if ($request->type == 'url') {

                $menu = Menu::find($id);
                $menu->name_en = $request->name_en;
                $menu->name_id = $request->name_id;
                $menu->url = $request->url;
                $menu->order_number = Menu::count() + 1;
                $menu->is_mega = $request->is_mega;
                $menu->save();

            }

            if ($request->type == 'widget') {

                $widget_id = $request->widget_id;

                $menu = Menu::find($id);
                $menu->widget_id = $widget_id;
                $menu->name_en = $request->widget_name_en;
                $menu->name_id = $request->widget_name_id;
                $menu->is_mega = 0;
                $menu->order_number = Menu::count() + 1;
                $menu->save();
            }

            $res = [
                        'title' => 'Success',
                        'type' => 'success',
                        'message' => 'Data has been updated successfuly!'
                    ];

            return response()->json($res);

        }
    }

    public function bulkEdit(Request $request)
    {
        if ($request->ajax()) {

            foreach ($request->data as $data) {
                
                if (isset($data['id'])) {
                    $menu = Menu::find($data['id']);
                    $menu->parent_id = $data['parent_id'] == null ? 0 : $data['parent_id'];
                    $menu->order_number = $data['left'];
                    $menu->save();
                }
            }

            $res = [
                        'title' => 'Success',
                        'type' => 'success',
                        'message' => 'Data has been updated successfuly!'
                    ];

            return response()->json($res);

        }
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){
            $menu = Menu::find($id);
            $menu->child()->delete();
            $menu->delete();
        });

         $res = [
                'title' => 'Success',
                'type' => 'success',
                'message' => 'Data has been deleted successfuly!'
            ];

        return response()->json($res);
    }
}
