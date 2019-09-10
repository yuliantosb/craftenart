@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title')
	@lang('label.shop')
@endsection

@section('content')

<div class="page_header" style="background: linear-gradient(
	  rgba(0, 0, 0, 0.45),
	  rgba(123, 123, 123, 0.45)
    ), url('uploads/{{ $category->feature_image }}'); background-attachment:fixed; background-repeat: no-repeat !important; background-position: left bottom; background-size: contain">
	<div class="container">
		<div class="page_header_info text-center">
			<div class="page_header_info_inner">
				<h2>{{ !empty(request()->category) ? $category->name : trans('label.shop') }}</h2>
			</div>
		</div>
	</div>
</div>

<div class="bcrumbs">
	<div class="container">
		<ul>
			<li><a href="{{ url('/') }}">Home</a></li>
			@if (!empty(request()->category) || !empty(request()->tags))
				@if (!empty(request()->category))
				<li><a href="{{ url('shop') }}">Shop</a></li>
				<li>Category : {{ App\Category::where('slug', request()->category)->first()->name }}</li>
				@else
				<li><a href="{{ url('shop') }}">Shop</a></li>
				<li>Tags: {{ App\Tag::where('slug', request()->tags)->first()->name }}</li>
				@endif
			@else
				<li>Shop</li>
			@endif

		</ul>
	</div>
</div>
<div class="space10"></div>

<div class="shop-content">
	<div class="container">
		<div class="row">
			<aside class="col-md-3 col-sm-4">
				@include('frontend.themes.'.config('app.themes').'.layouts.sidebar', ['categories' => $categories])
			</aside>
			<div class="col-md-9 col-sm-8">
				@include('frontend.themes.'.config('app.themes').'.layouts.shop_header', ['products' => $products, 'sort_type' => $sort_type])
				<div class="pagenav-wrap">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							Results: <span>{{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} items</span>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="pull-right">
								{{ $products->appends(request()->except('page'))->links('frontend.themes.'.config('app.themes').'.pagination') }}
							</div>
						</div>
					</div>
				</div>
				<div class="space50"></div>
				<div class="row products-list">
					@foreach ($products as $product)
					<div class="col-md-12 col-sm-12">
						<div class="product-item">
							<div class="item-thumb col-md-4 col-sm-4">
								@if (!empty($product->sale))
								<span class="badge offer">-{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}%</span>
								@endif

								<img src="{{ url('uploads/'.$product->picture) }}" class="img-responsive" alt="{{ $product->name }}"/>
								<div class="overlay-rmore fa fa-search quickview" onclick="onView({{ $product->id }})"></div>
								<div class="product-overlay">
									<form style="display: none" action="{{ route('cart.store') }}" method="post" id="new-product-{{ $product->id }}">
									@csrf
									<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
									</form>

									<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="new-product-wishlist-{{ $product->id }}">
										@csrf
										<input type="text" name="product_id" value="{{ $product->id }}" hidden="hidden">
									</form>
									{!! Share::page(route('shop.show', $product->slug), $product->name)->facebook()->whatsapp()->twitter() !!}
									<a href="javascript:void(0)" onclick="document.getElementById('new-product-{{ $product->id }}').submit()" class="addcart fa fa-shopping-cart"></a>
									
									@if (auth()->check())

										@if (in_array($product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

										<a data-toggle="tooltip" title="@lang('label.you_like_this')" class="likeitem fa fa-heart-o active"></a>


										@else
										<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
										@endif

									@else
										<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
									@endif

								</div>
							</div>
							<div class="product-info col-md-8 col-sm-8">
								<h4 class="product-title"><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></h4>
								@if (!empty($product->sale))
								<span class="product-price"><sup class="text-muted"><s>{{ Helper::currency($product->price) }}</s></sup> {{ Helper::currency($product->sale) }}</span>
								@else
								<span class="product-price">{{ Helper::currency($product->price) }}</span>
								@endif
								{!! Helper::getRate($product->reviews->avg('rate')) !!} 
								<p>{{ substr(strip_tags($product->description), 0, 200) }} ...</p>

							</div>
						</div>
					</div>

					@endforeach
				</div>
				<div class="pagenav-wrap">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							Results: <span>{{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} items</span>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="pull-right">
								{{ $products->appends(request()->except('page'))->links('frontend.themes.'.config('app.themes').'.pagination') }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="space50"></div>
	</div>
</div>
	

@endsection

@push('js')
<script src="{{ url('frontend/'.config('app.themes').'/js/pages/shop.js') }}"></script>
@endpush