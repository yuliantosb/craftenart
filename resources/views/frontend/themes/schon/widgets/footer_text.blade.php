@if (!empty($config['name']))
	<h3 class="f-widget-heading {{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h3>
@endif
<div class="f-widget-about">
	{!! str_replace_array('[url]', [url('/')], $config['widget']->content) !!}
</div>