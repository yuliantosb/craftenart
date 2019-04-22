<div>
	<h5>{{ $name }}</h5>
	<div class="mega-widget-content">
		<ul>
			@foreach ($products as $product)
			<li>
				<div class="fw-thumb">
					<img src="{{ url('uploads/thumbs/'.$product->picture) }}" alt="{{ $product->name }}">
				</div>
				<div class="fw-info">
					<h4><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></h4>
					{!! Helper::getRate($product->reviews->avg('rate')) !!}
					@if (!empty($product->sale))
						<del class="text-muted">{{ Helper::currency($product->price) }}</del>
						<span class="fw-price">{{ Helper::currency($product->sale) }}</span>
					@else
						<span class="fw-price">{{ Helper::currency($product->price) }}</span>
					@endif
				</div>
			</li>
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