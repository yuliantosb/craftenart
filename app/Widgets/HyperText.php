<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class HyperText extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'count' => 10,
        'name' => 'Category',
        'widget' => null,
        'children' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('frontend.themes.'.config('app.themes').'.widgets.hyper_text', [
            'config' => $this->config,
        ]);
    }
}
