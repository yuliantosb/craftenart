
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">

			<h3 class="heading">@lang('label.hot_sale')</h3>

			@foreach ($products->whereNotNull('sale')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="{{ route('shop.show', $product->slug) }}"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></strong>
						{!! Helper::getRate($product->reviews->avg('rate')) !!}
					</div>
					@if (!empty($product->sale))
					<del class="off">{{ Helper::currency($product->price) }}</del>
					<span class="price">{{ Helper::currency($product->sale) }}</span>
					@else
					<span class="price">{{ Helper::currency($product->price) }}</span>
					@endif
				</div>
			</div><!-- mt product4 end here -->
			@endforeach
		</div>


		<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
			<h3 class="heading">@lang('label.new_product')</h3>

			@foreach ($products->orderBy('id', 'desc')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="{{ route('shop.show', $product->slug) }}"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></strong>
						{!! Helper::getRate($product->reviews->avg('rate')) !!}
					</div>
					@if (!empty($product->sale))
					<del class="off">{{ Helper::currency($product->price) }}</del>
					<span class="price">{{ Helper::currency($product->sale) }}</span>
					@else
					<span class="price">{{ Helper::currency($product->price) }}</span>
					@endif
				</div>
			</div><!-- mt product4 end here -->
			@endforeach

		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
			<h3 class="heading">@lang('label.stared_product')</h3>
			@foreach ($products->whereHas('reviews')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="{{ route('shop.show', $product->slug) }}"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></strong>
						{!! Helper::getRate($product->reviews->avg('rate')) !!}
					</div>
					@if (!empty($product->sale))
					<del class="off">{{ Helper::currency($product->price) }}</del>
					<span class="price">{{ Helper::currency($product->sale) }}</span>
					@else
					<span class="price">{{ Helper::currency($product->price) }}</span>
					@endif
				</div>
			</div><!-- mt product4 end here -->
			@endforeach
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3">
			<h3 class="heading">@lang('label.best_seller')</h3>
			@foreach ($products->whereHas('orders')->withCount('orders')->orderBy('orders_count', 'desc')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="{{ route('shop.show', $product->slug) }}"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></strong>
						{!! Helper::getRate($product->reviews->avg('rate')) !!}
					</div>
					@if (!empty($product->sale))
					<del class="off">{{ Helper::currency($product->price) }}</del>
					<span class="price">{{ Helper::currency($product->sale) }}</span>
					@else
					<span class="price">{{ Helper::currency($product->price) }}</span>
					@endif
				</div>
			</div><!-- mt product4 end here -->
			@endforeach
		</div>
	</div>
</div>