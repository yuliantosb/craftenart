<div class="mt-promobox">
	{!! $config['widget']->content !!}
</div>

@if (!empty($config['children']))

	@foreach ($config['children'] as $child)

		@widget($child->widget->type, [
			'count' => $child->widget->limit,
			'name' => $child->name,
			'widget' => $child->widget,
			'children' => $child->child
		])

	@endforeach

@endif