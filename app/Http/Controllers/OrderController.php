<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Helper;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$order = Order::get();

    		return DataTables::of($order)

    		->rawColumns(['fullname', 'status', 'number'])

    		->addColumn('fullname', function($data){

    			return '<p class="text-primary"><a href="'.route('admin.order.show', $data->id).'">'.$data->fullname.'</a></p>
    			<p>
    			<a href="'.route('admin.order.show', $data->id).'" class="btn btn-primary btn-xs">View</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.order.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})

    		->addColumn('number', function($data){
    			return '<p>'.$data->number.'<br><small class="text-muted">'.Carbon::parse($data->created_at)->format('m/d/Y').'</small></p>';
    		})

			->addColumn('status', function($data){
				return $data->status ? '<span class="label label-success">COMPLETE</span>' : '<span class="label label-primary">PROCESSING</span>';
			})

			->addColumn('total', function($data){
				return Helper::currency($data->total);
			})

			->toJson();
    	}

    	return view('backend.order.index');
    }
}
