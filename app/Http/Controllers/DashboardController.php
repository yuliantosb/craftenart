<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\User;
use App\Product;
use App\Stock;
use App\Review;

class DashboardController extends Controller
{
    public function index()
    {
    	$order = Order::whereDate('payment_date', '>=', Carbon::now()->startOfMonth())
    					->whereDate('payment_date', '<=', Carbon::now())
    					->where('status', 1);

    	$users = User::get();

    	$orders = Order::where('status', 0)->get();

    	$add_years = Carbon::now()->addYears(5);
    	$sub_years = Carbon::now()->subYears(5);
    	$years = collect(['add' => $add_years, 'sub' => $sub_years]);

    	$stocks = Stock::orderBy('amount')->take(5)->get();
        $reviews = Review::where('status', 0)->get();

    	return view('backend.dashboard', compact(['order', 'users', 'orders', 'years', 'stocks', 'reviews']));

    }

    public function getDataPayment(Request $request)
    {

    	$order_type = Order::get();

    	$data = [];

    	$ykeys = [
    				'paypal',
					'credit_card',
					'bca_klikpay',
					'bca_klikbca',
					'bri_epay',
					'cimb_clicks',
					'mandiri_clickpay',
					'telkomsel_cash',
					'xl_tunai',
					'echannel',
					'indosat_dompetku',
					'mandiri_ecash',
					'cstore',
					'gift_card_indonesia',
					'danamon_online',
					'bank_transfer'
    			];

    	$label = [
    				'Paypal',
					'Credit Card',
					'BCA Klik Pay',
					'Klik BCA',
					'BRI E-Pay',
					'CIMB Clicks',
					'Mandiri Click Pay',
					'Telkomsel Cash',
					'XL Tunai',
					'Mandiri Bill',
					'Indosat Dompetku',
					'Mandiri e-cash',
					'Indomaret',
					'Gift Card Indonesia',
					'Danamon Online',
					'Bank Transfer'
				];

		$colors = [

					'#00b894',
					'#00cec9',
					'#0984e3',
					'#6c5ce7',
					'#fdcb6e',
					'#e17055',
					'#d63031',
					'#e84393',
					'#f1c40f',
					'#e67e22',
					'#e74c3c',
					'#f39c12',
					'#d35400',
					'#c0392b',
					'#16a085',
					'#2980b9'

				];

    	$months = [
    				'1' => 'Jan',
    				'2' => 'Feb',
    				'3' => 'March',
    				'4' => 'Apr',
    				'5' => 'May',
    				'6' => 'Jun',
    				'7' => 'Jul',
    				'8' => 'Aug',
    				'9' => 'Sep',
    				'10' => 'Oct',
    				'11' => 'Nov',
    				'12' => 'Dec',
    			];

    	foreach ($months as $index => $month) {

    		$data[] = [
    					'y' => $month,
    					'paypal' => Order::countByType($request->year, $index, 'paypal'),
    					'credit_card' => Order::countByType($request->year, $index, 'credit_card'),
    					'bca_klikpay' => Order::countByType($request->year, $index, 'bca_klikpay'),
    					'bca_klikbca' => Order::countByType($request->year, $index, 'bca_klikbca'),
    					'bri_epay' => Order::countByType($request->year, $index, 'bri_epay'),
    					'cimb_clicks' => Order::countByType($request->year, $index, 'cimb_clicks'),
    					'mandiri_clickpay' => Order::countByType($request->year, $index, 'mandiri_clickpay'),
    					'telkomsel_cash' => Order::countByType($request->year, $index, 'telkomsel_cash'),
    					'xl_tunai' => Order::countByType($request->year, $index, 'xl_tunai'),
    					'echannel' => Order::countByType($request->year, $index, 'echannel'),
    					'indosat_dompetku' => Order::countByType($request->year, $index, 'indosat_dompetku'),
    					'mandiri_ecash' => Order::countByType($request->year, $index, 'mandiri_ecash'),
    					'cstore' => Order::countByType($request->year, $index, 'cstore'),
    					'gift_card_indonesia' => Order::countByType($request->year, $index, 'gift_card_indonesia'),
    					'danamon_online' => Order::countByType($request->year, $index, 'danamon_online'),
    					'bank_transfer' => Order::countByType($request->year, $index, 'bank_transfer')
					];


    	}


		return response()->json(['data' => $data, 'ykeys' => $ykeys, 'label' => $label, 'colors' => $colors]);
    	
    }

    public function getDataTop()
    {
    	$products = Product::whereHas('orders')
                        ->withCount('orders')
                        ->orderBy('orders_count', 'desc')
                        ->take(5)
                        ->get();

        foreach ($products as $product) {
        	$data[] = [
        				'label' => $product->name,
        				'value' => $product->orders->count()
        				];
		}

		$colors = ['#68B3C8', '#EB5E28', '#F3BB45', '#7AC29A', '#9b59b6'];

		return response()->json(['data' => $data, 'colors' => $colors]);
    
    }

    public function getDataOrderStatus(Request $request)
    {
        $orders = Order::whereYear('payment_date', $request->year)
                    ->get();

        $data = [];
        $data[] = ['y' => 'Complete', 'a' => Order::countOrderStatus('complete', $request->year)];
        $data[] = ['y' => 'Process', 'a' => Order::countOrderStatus('process', $request->year)];
        $data[] = ['y' => 'Pending', 'a' => Order::countOrderStatus('pending', $request->year)];
        $data[] = ['y' => 'Challenge', 'a' => Order::countOrderStatus('challenge', $request->year)];
        $data[] = ['y' => 'Failure', 'a' => Order::countOrderStatus('deny', $request->year)];

        return response()->json(['data' => $data]);
    }
}
