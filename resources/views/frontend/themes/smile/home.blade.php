@extends('frontend.themes.'.config('app.themes').'.layouts.master', ['type' => 'home'])

@section('title', 'Home')

@section('content')
	
	@include('frontend.themes.'.config('app.themes').'.layouts.slider')

	<div class="space10"></div>
		<div class="clearfix space10"></div>
		<!-- BLOCK -->
		<div class="block-main container no-padding-top">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					@foreach ($category_chunks[0] as $category)
					<div class="block-content space30">
						<img src="{{ url('uploads/'.$category->feature_image) }}" class="img-responsive" alt="" style="height:290px; width:100%; object-fit:cover" />
						<div class="text-style1">
							<h6>{{ collect(explode(' ', $category->name))->implode('<br>') }}</h6>
							<p>{{ strip_tags($category->description) }}</p>
						</div>
					</div>
					@endforeach
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="home-carousel">
						@foreach ($categories->whereHas('products')->take(4)->get() as $category)
						<div>
							<img src="{{ url('uploads/'.$category->feature_image) }}" class="img-responsive" style="height:610px; width:100%; object-fit:cover" alt=""/>
							<div class="c-text">
								<h4>{{ $category->name }}</h4>
								<p>{{ strip_tags($category->description) }}</p>
								<a href="{{ url('shop?category='.$category->slug) }}">@lang('label.shop_now') <i class="fa fa-caret-right"></i></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					@foreach ($category_chunks[1] as $category)
					<div class="block-content space30">
						<img src="{{ url('uploads/'.$category->feature_image) }}" class="img-responsive" alt="" style="height:290px; width:100%; object-fit:cover" />
						<div class="text-style1">
							<h6>{{ collect(explode(' ', $category->name))->implode('<br>') }}</h6>
							<p>{{ strip_tags($category->description) }}</p>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<!-- PRODUCTS -->
		<div class="container padding40">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="heading-sub heading-sub2 text-center">
						<h5><span>New Arrival</span></h5>
						<p>Find a new arrival products here</p>
					</div>
					<div class="product-carousel3">
						@foreach ($products->orderBy('id', 'desc')->take(10)->get() as $new_product)

						<div class="pc-wrap">
							<div class="product-item">
								<div class="item-thumb">
									@if (!empty($new_product->sale))
									<span class="badge offer">-{{ round(( ($new_product->price - $new_product->sale) / $new_product->price) * 100) }}%</span>
									@endif

									<img src="{{ url('uploads/'.$new_product->picture) }}" class="img-responsive" alt="{{ $new_product->name }}"/>
									<div class="overlay-rmore fa fa-search quickview" onclick="onView({{ $new_product->id }})"></div>
									<div class="product-overlay">
										<form style="display: none" action="{{ route('cart.store') }}" method="post" id="new-product-{{ $new_product->id }}">
										@csrf
										<input type="text" name="id" value="{{ $new_product->id }}" hidden="hidden">
										</form>

										<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="new-product-wishlist-{{ $new_product->id }}">
											@csrf
											<input type="text" name="product_id" value="{{ $new_product->id }}" hidden="hidden">
										</form>
										<a href="javascript:void(0)" onclick="document.getElementById('new-product-{{ $new_product->id }}').submit()" class="addcart fa fa-shopping-cart"></a>
										
										@if (auth()->check())

											@if (in_array($new_product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

											<a data-toggle="tooltip" title="@lang('label.you_like_this')" class="likeitem fa fa-heart-o active"></a>


											@else
											<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $new_product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
											@endif

										@else
											<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $new_product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
										@endif

									</div>
								</div>
								<div class="product-info">
									<h4 class="product-title"><a href="{{ route('shop.show', $new_product->slug) }}">{{ $new_product->name }}</a></h4>
									@if (!empty($new_product->sale))
									<span class="product-price"><sup class="text-muted"><s>{{ Helper::currency($new_product->price) }}</s></sup> {{ Helper::currency($new_product->sale) }}</span>
									@else
									<span class="product-price">{{ Helper::currency($new_product->price) }}</span>
									@endif
								</div>
								<div class="text-center">
									{!! Helper::getRate($new_product->reviews->avg('rate')) !!} 
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix space20"></div>

		
		<!-- PRODUCTS -->
		<div class="clearfix space50"></div>
		<div class="featured-products">
			<div class="container">
				<div class="row">
					<div class="heading-sub text-center">
						<h5><span>Categories</span></h5>
						<p>Ut ut ipsum imperdiet libero viverra blandit. Aliquam ultricies libero ullamcorper, dignissim ipsum sed, placerat ante. Sed luctus, ex<br>id gravida venenatis, diam enim tristique turpis, eget dapibus velit eros sed ligula.</p>
					</div>
					<ul class="filter" data-option-key="filter">
						@foreach ($categories->whereHas('products')->take(5)->get() as $category)
						<li><a {{ $loop->first ? 'class=selected' : '' }} href="#" data-option-value=".{{ $category->slug }}">{{ $category->name }}</a></li>
						@endforeach
					</ul>
					<div id="isotope" class="isotope">
					@php($i = 0)
					@foreach($categories->whereHas('products')->take(5)->get() as $category_products)
						@php($ids[$i] = $category_products->products->pluck('id'))
						@if (!$loop->first)
							@foreach ($category_products->products->whereNotIn('id', $ids[$i-1])->take(4) as $category_product)
						
							<div class="isotope-item second {{ $category_product->categories->pluck('slug')->implode(' ') }}">
								<div class="product-item">
										<div class="item-thumb">
											@if (!empty($category_product->sale))
											<span class="badge offer">-{{ round(( ($category_product->price - $category_product->sale) / $category_product->price) * 100) }}%</span>
											@endif

											<img src="{{ url('uploads/'.$category_product->picture) }}" class="img-responsive" alt="{{ $category_product->name }}"/>
											<div class="overlay-rmore fa fa-search quickview" onclick="onView({{ $category_product->id }})"></div>
											<div class="product-overlay">
												<form style="display: none" action="{{ route('cart.store') }}" method="post" id="new-product-{{ $category_product->id }}">
												@csrf
												<input type="text" name="id" value="{{ $category_product->id }}" hidden="hidden">
												</form>

												<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="new-product-wishlist-{{ $category_product->id }}">
													@csrf
													<input type="text" name="product_id" value="{{ $category_product->id }}" hidden="hidden">
												</form>
												<a href="javascript:void(0)" onclick="document.getElementById('new-product-{{ $category_product->id }}').submit()" class="addcart fa fa-shopping-cart"></a>
												
												@if (auth()->check())

													@if (in_array($category_product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

													<a data-toggle="tooltip" title="@lang('label.you_like_this')" class="likeitem fa fa-heart-o active"></a>


													@else
													<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $category_product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
													@endif

												@else
													<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $category_product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
												@endif

											</div>
										</div>
										<div class="product-info">
											<h4 class="product-title"><a href="{{ route('shop.show', $category_product->slug) }}">{{ $category_product->name }}</a></h4>
											@if (!empty($category_product->sale))
											<span class="product-price"><sup class="text-muted"><s>{{ Helper::currency($category_product->price) }}</s></sup> {{ Helper::currency($category_product->sale) }}</span>
											@else
											<span class="product-price">{{ Helper::currency($category_product->price) }}</span>
											@endif
										</div>
										<div class="text-center">
											{!! Helper::getRate($category_product->reviews->avg('rate')) !!} 
										</div>
									</div>
							</div>
							@endforeach
						@else
							@foreach ($category_products->products->take(4) as $category_product)

							<div class="isotope-item {{ $category_product->categories->pluck('slug')->implode(' ') }}">
								<div class="product-item">
										<div class="item-thumb">
											@if (!empty($category_product->sale))
											<span class="badge offer">-{{ round(( ($category_product->price - $category_product->sale) / $category_product->price) * 100) }}%</span>
											@endif

											<img src="{{ url('uploads/'.$category_product->picture) }}" class="img-responsive" alt="{{ $category_product->name }}"/>
											<div class="overlay-rmore fa fa-search quickview" onclick="onView({{ $category_product->id }})"></div>
											<div class="product-overlay">
												<form style="display: none" action="{{ route('cart.store') }}" method="post" id="new-product-{{ $category_product->id }}">
												@csrf
												<input type="text" name="id" value="{{ $category_product->id }}" hidden="hidden">
												</form>

												<form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="new-product-wishlist-{{ $category_product->id }}">
													@csrf
													<input type="text" name="product_id" value="{{ $category_product->id }}" hidden="hidden">
												</form>
												<a href="javascript:void(0)" onclick="document.getElementById('new-product-{{ $category_product->id }}').submit()" class="addcart fa fa-shopping-cart"></a>
												
												@if (auth()->check())

													@if (in_array($category_product->id, auth()->user()->wishlist->pluck('product_id')->toArray()))

													<a data-toggle="tooltip" title="@lang('label.you_like_this')" class="likeitem fa fa-heart-o active"></a>


													@else
													<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $category_product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
													@endif

												@else
													<a href="javascript:void(0)" onclick="document.getElementById('new-product-wishlist-{{ $category_product->id }}').submit()" class="likeitem fa fa-heart-o"></a>
												@endif

											</div>
										</div>
										<div class="product-info">
											<h4 class="product-title"><a href="{{ route('shop.show', $category_product->slug) }}">{{ $category_product->name }}</a></h4>
											@if (!empty($category_product->sale))
											<span class="product-price"><sup class="text-muted"><s>{{ Helper::currency($category_product->price) }}</s></sup> {{ Helper::currency($category_product->sale) }}</span>
											@else
											<span class="product-price">{{ Helper::currency($category_product->price) }}</span>
											@endif
										</div>
										<div class="text-center">
											{!! Helper::getRate($category_product->reviews->avg('rate')) !!} 
										</div>
									</div>
							</div>
							@endforeach
						@endif
						@php($i++)
					@endforeach
					</div>
				</div>
			</div>
		</div>


	
		<div class="clearfix"></div>
		
		<div class="f-widgets">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<h6>@lang('label.hot_sale')</h6>
						<div class="f-widget-content">
							<ul>
								@foreach ($products->whereNotNull('sale')->take(4)->get() as $product)
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
					<div class="col-md-3 col-sm-3">
						<h6>@lang('label.new_product')</h6>
						<div class="f-widget-content">
							<ul>
								@foreach ($products->orderBy('id', 'desc')->take(4)->get() as $product)
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
					<div class="col-md-3 col-sm-3">
						<h6>@lang('label.stared_product')</h6>
						<div class="f-widget-content">
							<ul>
							@foreach ($products->whereHas('reviews')->take(4)->get() as $product)
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
					<div class="col-md-3 col-sm-3">
						<h6>@lang('label.best_seller')</h6>
						<div class="f-widget-content">
							<ul>
							@foreach ($products->whereHas('orders')->withCount('orders')->orderBy('orders_count', 'desc')->take(4)->get() as $product)
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
				</div>
			</div>
		</div>
	<!-- Newsletter -->
	<form id="form-subscribe-popup" action="{{ route('subscribe.save') }}" method="post">
		@csrf
		<div class="subscribe-me" style="display:none">
			<a href="#close" class="sb-close-btn">x</a>
			<div id="popup-newsletter">
				<div class="block-content">
					<div class="form-subscribe-header">
						<label>Join Our Email Letter</label>
					</div>
					<div class="clearfix space30"></div>
					<span class="promo-panel-sale">TAKE 25% OFF YOUR NEXT PURCHASE !</span>
					<div class="clearfix space30"></div>
					<span class="promo-panel-text"></span>
					<div class="clearfix space30"></div>
					<div class="form-group">
					<div class="input-box">
						<input name="email" id="pnewsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" type="text">
					</div>
					<div class="actions">
						<button type="submit" title="JOIN NOW !" class="button"><span><span>JOIN NOW !</span></span></button>
					</div>
					<span class="help-block" style="display: inline-block;font-weight: bold;"></span>
					</div>
					<span class="promo-panel-text1">No Thank ! I'm not interested in this promotion </span><br>
					<span class="promo-panel-text2">Entering your email also subscribe you to the latest Sunshine furniture news and offers *</span>
					<label class="subscribe-bottom"><input type="checkbox"><span>Don't show this popup again</span></label>
				</div>
			</div>
		</div>
	</form>
@endsection
@push('js')
<script src="{{ url('frontend/'.config('app.themes').'/js/pages/home.js') }}"></script>
@endpush