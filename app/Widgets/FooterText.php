<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Widget;

class FooterText extends AbstractWidget
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
        return view('frontend.themes.'.config('app.themes').'.widgets.footer_text', [
            'config' => $this->config,
        ]);
    }
}
