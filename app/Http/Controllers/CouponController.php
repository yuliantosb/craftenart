<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use LaraCart;

class CouponController extends Controller
{
    public function apply(Request $request)
    {

    	$coupon = new \LukePOLO\LaraCart\Coupons\Percentage('ASDF10', .5);
        $apply = LaraCart::addCoupon($coupon);
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
