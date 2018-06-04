<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Product;
use App\Coupon;
use App\User;
use LaraCart;
use Carbon\Carbon;
use Helper;
use App\Order;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $coupon = Coupon::get();

            return DataTables::of($coupon)

            ->rawColumns(['code'])

            ->addColumn('code', function($data){

                return '<p class="text-primary">'.$data->code.'<br><small>'.Carbon::parse($data->created_at)->format('m/d/Y').'</small></p>
                <p>
                <a href="'.route('admin.coupon.edit', $data->id).'" class="btn btn-primary btn-xs">Edit</a>
                <button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.coupon.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

                </p>
                ';
            })

            ->addColumn('amount', function($data){

                return $data->type ? $data->amount.'%' : Helper::currency($data->amount);
            })

            ->addColumn('valid_thru', function($data){
                return Carbon::parse($data->valid_thru)->format('m/d/Y');
            })

            ->addColumn('min_amount_values', function($data){
                return $data->min_amount_values;
            })

            ->addColumn('max_amount_values', function($data){
                return $data->max_amount_values;
            })

            ->addColumn('include_user_values', function($data){
                return $data->include_user_values;
            })

            ->toJson();
        }

    	return view('backend.coupon.index');
    }

    public function create()
    {

        $users = User::get();
        return view('backend.coupon.create', compact(['users']));
    }

    public function store(Request $request)
    {

        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->valid_thru = $request->valid_thru;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->min_amount = $request->min_amount;
        $coupon->max_amount = $request->max_amount;
        $coupon->is_single_use = $request->is_single_use;
        $coupon->is_single_user = $request->is_single_user;
        $coupon->include_user = json_encode($request->include_user);
        $coupon->save();

        return redirect()
                ->route('admin.coupon.index')
                ->with('message', 'Data saved successfully');
    }

    public function edit($id)
    {
        $users = User::get();
        $coupon = Coupon::find($id);
        $include_user = json_decode($coupon->include_user, true) == null ? [] : json_decode($coupon->include_user, true);

        return view('backend.coupon.edit', compact(['users', 'coupon', 'include_user']));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->valid_thru = $request->valid_thru;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->min_amount = $request->min_amount;
        $coupon->max_amount = $request->max_amount;
        $coupon->is_single_use = $request->is_single_use;
        $coupon->is_single_user = $request->is_single_user;
        $coupon->include_user = json_encode($request->include_user);
        $coupon->save();

        return redirect()
                ->route('admin.coupon.index')
                ->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()
                ->route('admin.coupon.index')
                ->with('message', 'Data deleted successfully');
    }

    public function apply(Request $request)
    {

        $coupon = Coupon::where('code', $request->coupon_code)
                    ->first();        

        if (!empty($coupon)) {

            if (!empty($coupon->min_amount)) {

                if ($coupon->min_amount > LaraCart::total($formatted = false, $withDiscount = true)) {

                    $data = ['type' => 'error', 'message' => 'Your cart total must be more than '. Helper::currency($coupon->min_amount)];

                }

            }

            if (!empty($coupon->max_amount)) {

                if ($coupon->max_amount < LaraCart::total($formatted = false, $withDiscount = true)) {

                    $data = ['type' => 'error', 'message' => 'Your cart total must be less than '. Helper::currency($coupon->max_amount)];

                }


            }

            if (strtotime($coupon->valid_thru) < strtotime(Carbon::now()) ) {

                $data = ['type' => 'error', 'message' => 'Coupon expired'];

            }

            if ($coupon->is_single_use) {

                if (auth()->check()) {

                    $check_order = Order::where('user_id', auth()->user()->id)
                                    ->where('coupon_code', $coupon->code)->count();

                    if ($check_order > 0) {
                        $data = ['type' => 'error', 'message' => 'This coupon is limited'];
                    }

                } else {
                    $data = ['type' => 'error', 'message' => 'This coupon is for specific user only'];
                }
            }

            if ($coupon->is_single_user) {

                if ($coupon->include_user !== 'null') {

                    if (auth()->check()) {
                        if (in_array(auth()->user()->id, json_decode($coupon->include_user, true))) {
                            $data = ['type' => 'error', 'message' => 'this coupon is for specific user only!'];
                        }
                    } else {
                        $data = ['type' => 'error', 'message' => 'this coupon is for specific user only!'];
                    }
                }

                $data = ['type' => 'error', 'message' => 'this coupon is for specific user only!'];
            }

            if (empty($data)) {

                $data = ['type' => 'success', 'message' => 'Coupon applied '];

                if ($coupon->type) {

                    $coupon = new \LukePOLO\LaraCart\Coupons\Percentage($coupon->code, $coupon->amount / 100);

                } else {

                    $coupon = new \LukePOLO\LaraCart\Coupons\Fixed($coupon->code, $coupon->amount);

                }

                $add_coupon = LaraCart::addCoupon($coupon);

            }

        } else {

            $data = ['type' => 'error', 'message' => 'Coupon not found!'];    
        }
        

        return redirect()
                ->back()
                ->with('data', $data);

    }

    public function remove($code)
    {
        LaraCart::removeCoupon($code);
        return redirect()->back();
    }
}
