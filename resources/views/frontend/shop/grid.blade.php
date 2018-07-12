@extends('frontend.layouts.master')

@section('title')
	@lang('label.shop')
@endsection

@section('content')
	
	<main id="mt-main">
		<!-- Mt Contact Banner of the Page -->
		<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ $placeholder }});">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h1>@lang('label.shop')</h1>
						<!-- Breadcrumbs of the Page -->
						<nav class="breadcrumbs">
							<ul class="list-unstyled">
								@if (!empty($category))
									<li><a href="{{ url('shop') }}">@lang('label.shop') <i class="fa fa-angle-right"></i></a></li>
									<li>{{ $category->name }}</li>
								@else
								
								<li>@lang('label.shop')</li>

								@endif
							</ul>
						</nav><!-- Breadcrumbs of the Page end -->
					</div>
				</div>
			</div>
		</section><!-- Mt Contact Banner of the Page end -->
		<div class="container">
			<div class="row">
				
				@include('frontend.layouts.sidebar')

				<div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
					<!-- mt shoplist header start here -->
					@include('frontend.layouts.shop_header', ['products' => $products, 'sort_type' => $sort_type])
					<!-- mt productlisthold start here -->
					@if (count($products) > 0)
					<ul class="mt-productlisthold list-inline">
						@foreach ($products as $product)

						<form style="display: none" action="{{ route('cart.store') }}" method="post" id="cart-{{ $product->id }}">
							{{ csrf_field() }}
							<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
						</form>

						<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="cart-wishlist-{{ $product->id }}">
							{{ csrf_field() }}
							<input type="text" name="product_id" value="{{ $product->id }}" hidden="hidden">
						</form>

						<li>
							<!-- mt product1 large start here -->
							<div class="mt-product1 mt-paddingbottom20">
								<div class="box">
									<div class="b1">
										<div class="b2">
											<a href="{{ route('shop.show', $product->slug) }}"><img src="{{ url('uploads/thumbs/'.$product->picture) }}" alt="{{ $product->name }}" style="width: 215px; height: 215px; object-fit: cover"></a>

											<span class="caption">

												@if ($product->stock->amount <= 0)
													<span class="stock">@lang('label.out_of_stock')</span>
												@endif


												@if (!empty($product->sale))
												<span class="off">{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}% Off</span>
												@endif
											</span>

											{!! Helper::getRate($product->reviews->avg('rate')) !!} 
											<ul class="links">
												<li>
													
													<a href="javascript:void(0)" onclick="document.getElementById('cart-{{ $product->id }}').submit()">
														<i class="icon-handbag"></i>
														<span>@lang('label.add_to_cart')</span>
													</a>
												</li>
												<li>
													@if (auth()->check())

														@if (in_array($product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

														<a class="icon-active">
															<i class="fa fa-heart"></i>
														</a>


														@else
														<a href="javascript:void(0)" onclick="document.getElementById('cart-wishlist-{{ $product->id }}').submit()">
															<i class="icomoon icon-heart-empty"></i></a>
														@endif

													@else
														<a href="javascript:void(0)" onclick="document.getElementById('cart-wishlist-{{ $product->id }}').submit()">
															<i class="icomoon icon-heart-empty"></i></a>
													@endif
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="txt">
									<strong class="title"><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></strong>
									<span class="price">{!! $product->price_amount !!}</span>
								</div>
							</div><!-- mt product1 center end here -->
						</li>
						@endforeach
					</ul><!-- mt productlisthold end here -->
					@else

					<center><h1 class="text-muted">@lang('label.oops')</h1></center>

					@endif
					<!-- mt pagination start here -->
					{{ $products->appends(request()->except('page'))->links('vendor.pagination.custom') }}
					<!-- mt pagination end here -->
				</div>
			</div>
		</div>
	</main><!-- mt main end here -->

@endsection

@push('js')
<script src="{{ url('frontend/js/shop.js') }}"></script>
@endpush

@push('css')
<link href="{{ url('frontend/bootstrap-slider/bootstrap-slider.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
