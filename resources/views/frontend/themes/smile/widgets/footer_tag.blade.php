@if (!empty($config['name']))
<h5 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h5>
@endif

<ul class="widget-tags">
	@foreach ($tags as $tag)
	<li><a href="{{ url('shop?tags%5B%5D='.$tag->slug) }}">{{ $tag->name }}</a></li>
	@endforeach
</ul>