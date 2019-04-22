@if (!empty($config['name']))
	<h5 class="{{ !empty($config['align']) ? $config['align'] : '' }}">{{ $config['name'] }}</h5>
@endif
<p>
	{!! str_replace_array('[url]', [url('/')], $config['widget']->content) !!}
</p>