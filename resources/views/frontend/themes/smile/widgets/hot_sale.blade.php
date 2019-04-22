<h2>{{ $config['name'] }}</h2>

@foreach ($products as $product)
	<!-- mt product4 start here -->
	<div class="mt-product4 mt-paddingbottom20">
		<div class="img">
			<a href="{{ route('shop.show', $product->slug) }}"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
		</div>
		<div class="text">
			<div class="frame">
				<strong><a href="{{ route('shop.show', $product->slug) }}" style="text-transform: capitalize;">{{ $product->name }}</a></strong>
				{!! Helper::getRate($product->reviews->avg('rate')) !!}
			</div>
			<del class="off">{{ Helper::currency($product->price) }}</del>
			<span class="price">{{ Helper::currency($product->sale) }}</span>
		</div>
	</div><!-- mt product4 end here -->
@endforeach