@if (!empty($config['name']))
	<h3 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h3>
@endif
<div class="f-widget-about">
	{!! $config['widget']->content !!}
</div>