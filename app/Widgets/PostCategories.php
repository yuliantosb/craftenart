<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Category;

class PostCategories extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'count' => 5,
        'title' => 'Categories'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $categories = Category::where('type', 'post')
                        ->take($this->config['count'])
                        ->get();

        return view('widgets.post_categories', [
            'config' => $this->config,
            'categories' => $categories
        ]);
    }
}
