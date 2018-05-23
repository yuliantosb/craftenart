<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Product;
use App\Coupon;
use App\User;
use LaraCart;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $coupon = Coupon::get();

            return DataTables::of($coupon)

            ->rawColumns(['code'])

            ->addColumn('user.name', function($data){

                return '<p class="text-primary"><a href="'.route('admin.coupon.show', $data->id).'">'.$data->code.'</a><br><small>'.Carbon::parse($data->created_at)->format('m/d/Y').'</small></p>
                <p>
                <a href="'.route('admin.coupon.show', $data->id).'" class="btn btn-primary btn-xs">View</a>
                <button class="btn btn-danger btn-xs" onClick="on_delete('.$data->id.')">Delete</button>
                    
                <form action="'. route('admin.coupon.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>

                </p>
                ';
            })

            ->addColumn('amount', function($data){

                return $data->type == 'fixed' ? Helper::currency($data->amount) : $data->amount.'%';
            })

            ->addColumn('valid_thru', function($data){
                return Carbon\Carbon::parse($data->valid_thru)->format('m/d/Y');
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


    public function apply(Request $request)
    {

        if ($request->coupon_code == 'ASDF123') {

            $coupon = new \LukePOLO\LaraCart\Coupons\Fixed($request->coupon_code, 10, [
                'description' => '$10 OFF'
            ]);

            $add_coupon = LaraCart::addCoupon($coupon);
        }

        $coupon = new \LukePOLO\LaraCart\Coupons\Percentage($request->coupon_code, .10, [
            'description' => '10% OFF'
        ]);

        $add_coupon = LaraCart::addCoupon($coupon);
        
        return redirect()->back();

    }

    public function remove($code)
    {
        LaraCart::removeCoupon($code);
        return redirect()->back();
    }
}
