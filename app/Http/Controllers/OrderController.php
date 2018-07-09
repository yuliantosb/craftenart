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

    		$order = Order::orderBy('id', 'desc')->get();

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
    			return '<p>'.$data->number.'<br><small class="text-primary">'.Carbon::parse($data->created_at)->format('m/d/Y').'</small></p>';
    		})

			->addColumn('status', function($data){
				return '<label class="label label-'.$data->status_transaction['label'].'" style="color:#fff">
                        '.$data->status_transaction['status'].'</label>';
			})

			->addColumn('total', function($data){
				return Helper::currency(($data->subtotal + $data->tax + $data->ship->cost ) - $data->discount);
			})

			->toJson();
    	}

    	return view('backend.order.index');
    }

    public function show($id)
    {
    	$order = Order::with('ship')->find($id);

    	return view('backend.order.show', compact(['order']));

    }

    public function update(Request $request, $id)
    {
    	$order = Order::find($id);
    	$order->status = $request->status;
    	$order->save();

    	return redirect()->route('admin.order.index')
    			->with('message', 'Order has been updated');
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $order = Order::find($id);
            $order->ship()->delete();
            $order->details()->delete();
            $order->delete();

        });

        return redirect()->route('admin.order.index')
                ->with('message', 'Order has been deleted');
    }
}
