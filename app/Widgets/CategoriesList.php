<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Category;

class CategoriesList extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 10,
        'name' => 'Categories'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $categories = Category::where('type', 'product')->get();

        return view('widgets.categories_list', [
            'config' => $this->config,
            'categories' => $categories
        ]);
    }
}
