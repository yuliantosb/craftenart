<section class="widget popular-widget">
  <h3>{{ $config['title'] }}</h3>
  <ul class="list-unstyled text-right popular-post">
    @foreach ($posts as $post)
    <li>
      <div class="img-post">
        <a href="{{ url('blog/'.$post->slug) }}"><img src="{{ url('uploads/thumbs/'.$post->feature_image) }}" style="width: 60px; height: 60px; object-fit: cover" alt="{{ $post->title }}"></a>
      </div>
      <div class="info-dscrp">
        <p>{{ $post->title }}</p>
        <time datetime="{{ $post->created_at }}">{{ Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}</time>
      </div>
    </li>
    @endforeach
  </ul>
</section>