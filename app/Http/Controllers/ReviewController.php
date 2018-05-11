<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Auth;
use DataTables;
use Carbon\Carbon;
use Helper;

class ReviewController extends Controller
{

	public function index(Request $request)
    {
    	if ($request->ajax()) {

    		$review = Review::with(['user', 'product'])->get();

    		return DataTables::of($review)
    		->rawColumns(['user.name', 'status', 'rate'])

    		->addColumn('user.name', function($data){

    			return '<p class="text-primary"><a href="'.route('admin.review.show', $data->id).'">'.$data->user->name.'</a><br><small>'.Carbon::parse($data->created_at)->format('m/d/Y').'</small></p>
    			<p>
    			<a href="'.route('admin.review.show', $data->id).'" class="btn btn-primary btn-xs">View</a>
    			<button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.review.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

    			</p>
    			';
    		})

    		->addColumn('content', function($data){
    			return substr($data->content, 0, 150).'...';
    		})

			->addColumn('status', function($data){
				return $data->status ? '<span class="label label-success">APPROVED</span>' : '<span class="label label-primary">WAITING</span>';
			})

			->addColumn('rate', function($data){
				return Helper::getRate($data->rate);
			})

    		->toJson();

    	} else {

    		return view('backend.review.index');
    	}
    }

    public function store(Request $request)
    {
    	$review = new Review;
    	$review->user_id = Auth::user()->id;
		$review->product_id = $request->product_id;
		$review->rate = $request->rate;
		$review->content = $request->content;
		$review->save();

		return redirect()
				->back()
				->with('message', 'Your review will appear when approved by Admin');
    }

    public function show($id)
    {
    	$review = Review::find($id);
		return view('backend.review.show', compact(['review']));
    }

    public function update(Request $request, $id)
    {
    	$review = Review::find($id);
    	$review->status = $request->status;
    	$review->save();

    	return redirect()
				->route('admin.review.index')
				->with('message', 'Review status updated');
    }

    public function destroy($id)
    {
    	$review = Review::find($id);
    	$review->delete();

    	return redirect()
				->route('admin.review.index')
				->with('message', 'Review deleted successfully');
    }

}
