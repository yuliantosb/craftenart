<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Newsletter extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
    
        'count' => null,
        'name' => null,
        'widget' => null,
        'children' => null,
        'align' => 'left'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.newsletter', [
            'config' => $this->config,
        ]);
    }
}
