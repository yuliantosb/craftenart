<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Article;

class PostRecent extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 5,
        'title' => 'Recent Post'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $posts = Article::where('type', 'post')
                    ->orderBy('id', 'desc')
                    ->take($this->config['count'])
                    ->get();

        return view('widgets.post_recent', [
            'config' => $this->config,
            'posts' => $posts
        ]);
    }
}
