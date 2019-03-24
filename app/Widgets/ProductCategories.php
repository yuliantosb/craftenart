<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Category;

class ProductCategories extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 10,
        'name' => 'Category',
        'children' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        $categories = Category::where('type', 'product')->take($this->config['count'])
                        ->get();

        return view('frontend.themes.'.config('app.themes').'.widgets.product_categories', [
            'config' => $this->config,
            'categories' => $categories
        ]);
    }
}
