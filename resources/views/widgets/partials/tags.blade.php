<div class="sub-dropcont">
	<strong class="title"><a href="product-grid-view.html" class="mt-subopener">{{ $name }}</a></strong>
	<div class="sub-drop">
		<ul>
			@foreach ($tags as $tags)
				<li><a href="{{ url('shop/tag/'.$tags->slug) }}">{{ $tags->name }}</a></li>
			@endforeach
		</ul>
	</div>
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