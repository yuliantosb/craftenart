<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Tag;

class FooterTag extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

        'count' => 10,
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
        $tags = Tag::take($this->config['count'])
                        ->get();

        return view('widgets.footer_tag', [
            'config' => $this->config,
            'tags' => $tags
        ]);
    }
}
