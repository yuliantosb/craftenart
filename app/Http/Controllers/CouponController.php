<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use LaraCart;

class CouponController extends Controller
{
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

    public function index()
    {
    	dd(session()->all());
    }

    public function destroy($code)
    {
        LaraCart::removeCoupon($code);
        return redirect()->back();
    }
}
