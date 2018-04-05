
<div class="logo">
    <a href="http://www.creative-tim.com" class="simple-text">
        {{ config('app.name') }}
    </a>
</div>

<ul class="nav">
@include(config('laravel-menu.views.custom'), ['items' => $MyNavBar->roots()])
</ul>