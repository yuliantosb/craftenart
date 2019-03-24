<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Tag;

class ProductTags extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'count' => 10,
        'name' => 'Tag',
        'children' => null

    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $tags = Tag::where('type', 'product')->take($this->config['count'])
                        ->get();

        return view('frontend.themes.'.config('app.themes').'.widgets.product_tags', [
            'config' => $this->config,
            'tags' => $tags
        ]);
    }
}
