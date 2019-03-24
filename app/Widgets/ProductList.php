<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Product;

class ProductList extends AbstractWidget
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

        $products = Product::take($this->config['count'])
                        ->orderby('id', 'desc')
                        ->get();

        return view('frontend.themes.'.config('app.themes').'.widgets.product_list', [
            'config' => $this->config,
            'products' => $products
        ]);
    }
}
