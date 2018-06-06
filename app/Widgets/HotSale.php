<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Product;

class HotSale extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'count' => 10,
        'name' => 'Hot Sale',

    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        $products = Product::whereNotNull('sale')->take($this->config['count'])
                        ->orderby('id', 'desc')
                        ->get();

        return view('widgets.hot_sale', [
            'config' => $this->config,
            'products' => $products
        ]);
    }
}
