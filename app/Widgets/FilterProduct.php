<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Tag;
use App\Product;
use Helper;

class FilterProduct extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'name' => 'Filter',
        'subtitle_one' => 'Filter by Tag',
        'subtitle_two' => 'Filter by Price',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        $min = Product::min('price');
        $max = Product::max('price');



        if (!empty(request()->category)) {

            $tags = Tag::where('type', 'product')->whereHas('products.categories', function($where){
                    $where->where('slug', request()->category);
            })->get();

        } else {
            
            $tags = Tag::where('type', 'product')->get();
        }

        return view('widgets.filter_product', [
            'tags' => $tags,
            'min' => Helper::getCurrency($min),
            'max' => Helper::getCurrency($max),
            'config' => $this->config,
        ]);
    }
}
