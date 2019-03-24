<section class="widget category-widget">
  <h3>{{ $config['title'] }}</h3>
  <ul class="list-unstyled widget-nav">
  	@foreach ($categories as $category)
    <li><a href="{{ url('blog?category='.$category->slug) }}">{{ $category->name }}</a></li>
    @endforeach
  </ul>
</section>