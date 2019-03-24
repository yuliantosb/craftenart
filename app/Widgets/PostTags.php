<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Tag;

class PostTags extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 5,
        'title' => 'Tags'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $tags = Tag::where('type', 'post')
                    ->take($this->config['count'])
                    ->get();

        return view('frontend.themes.'.config('app.themes').'.widgets.post_tags', [
            'config' => $this->config,
            'tags' => $tags
        ]);
    }
}
