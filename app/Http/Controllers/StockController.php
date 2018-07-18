<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use DB;
use App\Stock;
use App\StockDetails;

class StockController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$stock = Stock::get();

    		return DataTables::of($stock)

    		->rawColumns(['product.name'])

    		->addColumn('product.name', function($data){

    			return '<p class="text-primary"><a href="'.route('admin.stock.show', $data->id).'">'.$data->product->name.'</a>
    			</p>';
    		})

    		->addColumn('last_record', function($data){

    			return !empty($data->details->first()) ? $data->details->first()->description : '';
    		})

			->toJson();
    	}

    	return view('backend.stock.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {

            $res = '';

            DB::transaction(function() use ($request, &$res){

                $stock_details = new StockDetails;
                $stock_details->stock_id = $request->stock_id;
                $stock_details->amount = $request->amount - $request->current_amount;
                $stock_details->description = $request->description;
                $stock_details->save();

                $stock = Stock::find($request->stock_id);
                $stock->amount = $request->amount;
                $stock->save();

                $res = ['title' => 'Success', 'type' => 'success', 'message' => 'Data stock updated', 'current_stock' => $request->amount];

            });

            return response()->json($res);

        }
    }

    public function show(Request $request, $id)
    {

        $stock = Stock::find($id);

        if ($request->ajax()) {

            $stock_details = $stock->details;

            return DataTables::of($stock_details)

            ->rawColumns(['description'])

            ->addColumn('description', function($data){
                return '<p class="text-primary">'.$data->description.'</p>
                <p>
                <small class="text-default">'.Carbon::parse($data->created_at)->format('m/d/Y').'</small>
                </p>
                ';
            })

            ->toJson();

        }

    	return view('backend.stock.show', compact(['stock']));
    }

}
