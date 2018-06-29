<section class="widget tag-widget">
  <h3>{{ $config['title'] }}</h3>
  <ul class="list-unstyled text-right tags">
    @foreach ($tags as $tag)
    <li><a href="{{ url('blog?tag='.$tag->slug) }}">{{ $tag->name }}</a></li>
    @endforeach
  </ul>
</section>