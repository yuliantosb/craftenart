<div class="f-widget-tabs">
	@if (!empty($config['name']))
	<h3 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h3>
	@endif
	
	<ul class="list-unstyled tabs">
		@foreach ($tags as $tag)
		<li><a href="{{ url('shop/tag/'.$tag->slug) }}">{{ $tag->name }}</a></li>
		@endforeach
	</ul>
</div>