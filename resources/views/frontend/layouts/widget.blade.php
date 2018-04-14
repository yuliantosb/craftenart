
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">

			<h3 class="heading">Hot Sale</h3>

			@foreach ($products->whereNotNull('sale')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="product-detail.html"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="product-detail.html">{{ $product->name }}</a></strong>
						{!! Helper::getRate($product->reviews->avg('rate')) !!}
					</div>
					<del class="off">{{ Helper::currency($product->price) }}</del>
					<span class="price">{{ Helper::currency($product->sale) }}</span>
				</div>
			</div><!-- mt product4 end here -->
			@endforeach
		</div>


		<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
			<h3 class="heading">New Product</h3>

			@foreach ($products->orderBy('id', 'desc')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="product-detail.html"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="product-detail.html">{{ $product->name }}</a></strong>
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
			<h3 class="heading">Stared Product</h3>
			@foreach ($products->whereHas('reviews')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="product-detail.html"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="product-detail.html">{{ $product->name }}</a></strong>
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
			<h3 class="heading">Best Seller</h3>
			@foreach ($products->whereHas('orders')->withCount('orders')->orderBy('orders_count', 'desc')->take(3)->get() as $product)
			<!-- mt product4 start here -->
			<div class="mt-product4 mt-paddingbottom20">
				<div class="img">
					<a href="product-detail.html"><img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 80px; height: 80px; object-fit: cover;"></a>
				</div>
				<div class="text">
					<div class="frame">
						<strong><a href="product-detail.html">{{ $product->name }}</a></strong>
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