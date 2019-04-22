<div class="side-widget">
	<h3><span>Shop by</span></h3>
	<h5>Categories</h5>
	<ul class="cat-list">
		<li><a href="{{ url('shop') }}">All Categories</a></li>
		@foreach ($categories as $category)
		<li><a href="{{ url('shop?category='.$category->slug) }}">{{ $category->name }}</a></li>
		@endforeach
	</ul>
	<div class="clearfix space20"></div>
	@widget('filter_product', ['name' => trans('label.filter'), 'subtitle_one' => trans('label.filter_by_tag'), 'subtitle_two' => trans('label.filter_by_price')])
</div>

<div class="clearfix space50"></div>
<div class="side-widget">
	<h3><span>@lang('label.hot_sale')</span></h3>
	
	<div class="f-widget-content">
		<ul>
		@foreach (\App\Product::whereNotNull('sale')->take(4)->get() as $product)
			<li>
				<div class="fw-thumb">
					<img alt="{{ $product->name }}" src="{{ url('uploads/thumbs/'.$product->picture) }}">
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

@push('js')
<script type="text/javascript">
	var thousand_separator = '{{ Helper::takeCurrency()->thousand_separator }}';
	var decimal_separator = '{{ Helper::takeCurrency()->decimal_separator }}';
</script>
@endpush