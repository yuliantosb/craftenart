<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Product;

class BestSeller extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'count' => 10,
        'name' => 'New Product',
        'children' => null,

    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $products = Product::whereHas('orders')
                        ->withCount('orders')
                        ->orderBy('orders_count', 'desc')
                        ->take($this->config['count'])
                        ->get();

        return view('frontend.themes.'.config('app.themes').'.widgets.best_seller', [
            'config' => $this->config,
            'products' => $products
        ]);
    }
}
