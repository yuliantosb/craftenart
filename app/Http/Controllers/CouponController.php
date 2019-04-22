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

                if ($coupon->min_amount > LaraCart::subTotal($formatted = false, $withDiscount = true)) {

                    $data = [
                                'type' => 'error',
                                'message' => 'Your cart subtotal must be more than '. Helper::currency($coupon->min_amount),
                                'code' => '500'
                            ];

                }

            }

            if (!empty($coupon->max_amount)) {

                if ($coupon->max_amount < LaraCart::subTotal($formatted = false, $withDiscount = true)) {

                    $data = [
                                'type' => 'error',
                                'message' => 'Your cart subtotal must be less than '. Helper::currency($coupon->max_amount),
                                'code' => '500'
                            ];

                }


            }

            if (strtotime($coupon->valid_thru) < strtotime(Carbon::now()) ) {

                $data = [
                            'type' => 'error',
                            'message' => 'Coupon expired',
                            'code' => '500'
                        ];

            }

            if ($coupon->is_single_use) {

                if (auth()->check()) {

                    $check_order = Order::where('user_id', auth()->user()->id)
                                    ->where('coupon_code', $coupon->code)->count();

                    if ($check_order > 0) {
                        $data = [
                                    'type' => 'error',
                                    'message' => 'This coupon is limited',
                                    'code' => '500'
                                ];
                    }

                } else {
                    $data = [
                                'type' => 'error',
                                'message' => 'This coupon is for specific user only',
                                'code' => '500'
                            ];
                }
            }

            if ($coupon->is_single_user) {

                if ($coupon->include_user !== 'null') {

                    if (auth()->check()) {
                        if (in_array(auth()->user()->id, json_decode($coupon->include_user, true))) {
                            $data = [
                                        'type' => 'error',
                                        'message' => 'this coupon is for specific user only!',
                                        'code' => '500'
                                    ];
                        }
                    } else {
                        $data = [
                                    'type' => 'error',
                                    'message' => 'this coupon is for specific user only!',
                                    'code' => '500'
                                ];
                    }
                }

                $data = [
                            'type' => 'error',
                            'message' => 'this coupon is for specific user only!',
                            'code' => '500'
                        ];
            }

            if (empty($data)) {
                $coupon_value = $coupon->type == '1' ? $coupon->amount.'%' : Helper::currency($coupon->amount);
                $datas['coupon_applied'] = '<div class="coupon-fee" id="coupon">
                                    <span class="coupon-badge">'.$coupon->code.'
                                    <br><small class="text-center">('.$coupon_value.')</small>
                                    </span>
                                    <p class="text-primary text-center">'.$coupon->description.'</p>
                                    <button class="btn btn-fixed btn-sm btn-circle btn-danger" type="button" data-id="'.$coupon->code .'" id="btn-remove-coupon">
                                    <i class="fa fa-times"></i>
                                    </button>
                                </div>';


                if ($coupon->type) {

                    $coupon = new \LukePOLO\LaraCart\Coupons\Percentage($coupon->code, $coupon->amount / 100);

                } else {

                    $coupon = new \LukePOLO\LaraCart\Coupons\Fixed($coupon->code, $coupon->amount);

                }

                $add_coupon = LaraCart::addCoupon($coupon);

                $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
                $taxes = LaraCart::taxTotal($formatted = false);
                $shipping_fee = LaraCart::getFee('shippingFee')->amount;
                $discount = LaraCart::totalDiscount($formatted = false);

                $datas['discount'] = Helper::currency($discount);
                $datas['total'] = Helper::currency(($subtotal + $taxes + $shipping_fee) - $discount);

                $data = [
                    'type' => 'success',
                    'message' => 'Coupon applied ',
                    'data' => $datas,
                    'code' => '200'
                ];

            }

        } else {

            $data = [
                        'type' => 'error',
                        'message' => 'Coupon not found!',
                        'code' => '500'
                    ];
        }
        

        if ($request->wantsJson()) {

            return response()->json($data, $data['code']);

        } else {
            return redirect()
                ->back()
                ->with('data', $data);
        }
        

    }

    public function remove(Request $request, $code)
    {
        LaraCart::removeCoupon($code);
        if ($request->wantsJson()) {

            $subtotal = LaraCart::subTotal($format = false, $withDiscount = true);
            $taxes = LaraCart::taxTotal($formatted = false);
            $shipping_fee = LaraCart::getFee('shippingFee')->amount;
            $discount = LaraCart::totalDiscount($formatted = false);

            $datas['discount'] = Helper::currency($discount);
            $datas['total'] = Helper::currency(($subtotal + $taxes + $shipping_fee) - $discount);

            return response()->json(['message' => 'Coupon removed', 'data' => $datas], 200);
        }
        return redirect()->back();
    }
}
