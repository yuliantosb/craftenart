<div>
	<h5>{{ $name }}</h5>
	@foreach ($tags as $tag)
		<a class="list-mm" href="{{ url('shop?tag='.$tag->slug) }}">{{ $tag->name }}</a>
	@endforeach
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