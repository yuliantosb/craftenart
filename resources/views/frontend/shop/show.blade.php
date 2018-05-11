@extends('frontend.layouts.master')

@section('title')
{{ $product->name }}
@endsection

@section('content')

<main id="mt-main">
	<!-- Mt Product Detial of the Page -->
	<section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!-- Slider of the Page -->
					<div class="slider">
						<ul class="list-unstyled comment-list">
							
						</ul>
						<!-- Comment List of the Page end -->
						<!-- Product Slider of the Page -->
						<div class="product-slider">
							<div class="slide">
								<img src="{{ url('uploads/'.$product->picture) }}" alt="{{ $product->name }}">
							</div>
							@foreach ($product->galleries as $gallery)
							<div class="slide">
								<img src="{{ url('uploads/'.$gallery->picture) }}" alt="{{ $product->name }}">
							</div>
							@endforeach
						</div>
						<!-- Product Slider of the Page end -->
						<!-- Pagg Slider of the Page -->
						<ul class="list-unstyled slick-slider pagg-slider">
							<li><div class="img"><img src="{{ url('uploads/'.$product->picture) }}" alt="{{ $product->name }}"></div></li>
							@foreach ($product->galleries as $gallery)
							<li><div class="img"><img src="{{ url('uploads/'.$gallery->picture) }}" alt="{{ $product->name }}"></div></li>
							@endforeach
						</ul>
						<!-- Pagg Slider of the Page end -->
					</div>
					<!-- Slider of the Page end -->
					<!-- Detail Holder of the Page -->
					<div class="detial-holder">
						<!-- Breadcrumbs of the Page -->
						<ul class="list-unstyled breadcrumbs">
							<li><a href="#">Chairs <i class="fa fa-angle-right"></i></a></li>
							<li>Products</li>
						</ul>
						<!-- Breadcrumbs of the Page end -->
						<h2>{{ $product->name }}</h2>
						<!-- Rank Rating of the Page -->
						<div class="rank-rating">
							<span class="total-price">Reviews ({{ $product->reviews->count() }})</span>
							{!! Helper::getRate($product->reviews->avg('rate'), ['class' => 'list-unstyled rating-list']) !!} 
						</div>

						<div class="txt-wrap">
							{!! $product->description !!}
						</div>
						<div class="text-holder">
							@if (!empty($product->sale))
							<span class="price">{{ Helper::currency($product->sale) }} <del>{{ Helper::currency($product->price) }}</del></span>
							@else
							<span class="price">{{ Helper::currency($product->price) }}</span>
							@endif
						</div>
						<!-- Product Form of the Page -->

						<form action="{{ route('cart.store') }}" class="product-form" method="post">
							{{ csrf_field() }}
							<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
							<fieldset>
								<div class="row-val">
									<label for="qty">qty</label>
									<input type="number" id="qty" placeholder="1" name="qty" value="1" min="1">
								</div>
								<div class="row-val">
									<button type="submit">ADD TO CART</button>
								</div>
							</fieldset>
						</form>
						<!-- Product Form of the Page end -->

						<hr>

						@if (!empty(LaraCart::getCoupons()))

							@foreach (LaraCart::getCoupons() as $coupon)

								<form style="display: none" action="{{ route('coupon.destroy', $coupon->code) }}" method="post" id="coupon-{{ $coupon->code }}">

									{{ csrf_field() }}
									{{ method_field('DELETE') }}

								</form>

								<div class="alert alert-success">
								  <button class="close" data-toggle="tooltip" title="Remove Coupon" onclick="document.getElementById('coupon-{{ $coupon->code }}').submit()">&times;</button>
								  <strong>Coupon Applied</strong>
								</div>

							@endforeach

						@else

							<form action="{{ route('coupon.apply') }}" method="post">
								{{ csrf_field() }}
								<div class="form-group form-inline" style="margin-top: 20px">
									<input type="text" name="coupon" class="input-custom" placeholder="Add Coupon">
									<button class="btn btn-type4" type="submit">Apply Coupon</button>
								</div>
							</form>

						@endif

						<div id="mt-footer" style="margin-top: 20px">
							<div class="f-widget-tabs">
								<hr>
								<ul class="list-unstyled tabs">
									<li style="margin-right: 10px"><i class="fa fa-tags"></i></li>
									@foreach ($product->tags as $tag)
									<li><a href="#">{{ $tag->name }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>

					</div>
					<!-- Detail Holder of the Page end -->
				</div>
			</div>
		</div>
	</section><!-- Mt Product Detial of the Page end -->
	<div class="product-detail-tab wow fadeInUp" data-wow-delay="0.4s">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="mt-tabs text-center text-uppercase">
						<li><a href="#tab1" class="active">DESCRIPTION</a></li>
						<li><a href="#tab2">REVIEWS ({{ count($product->reviews) }})</a></li>
					</ul>
					<div class="tab-content">
						<div id="tab1">
							{!! $product->description !!}
						</div>
						<div id="tab2">
							<div class="product-comment">
								@foreach ($product->reviews as $review)
								<div class="mt-box">
									<div class="mt-hold">

										<div class="col-md-2 text-center">
											<img src="{{ $review->user->cust->picture }}" alt="{{ $review->user->name }}" class="img img-circle img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
										</div>

										<div class="col-md-10">
											{!! Helper::getRate($review->rate, ['class' => 'mt-star']) !!}
											<span class="name">{{ $review->user->name }}</span>
											<time>{{ Carbon\Carbon::parse($review->created_at)->format('F jS, Y') }}</time>
											<p>{{ $review->content }}</p>
										</div>
									</div>
								</div>
								@endforeach
								
								@if (auth()->check())

								@if(session()->has('message'))

								<div class="alert alert-success alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  <strong>Success!</strong> {{ session()->get('message') }}
								</div>

								@endif

								<form action="{{ route('review.store') }}" class="p-commentform" method="post">
									@csrf
									<fieldset>
										<h2>Add  Review</h2>
										<input type="text" name="product_id" value="{{ $product->id }}" hidden="hidden">
										<div class="mt-row">
											<label>Rate</label>
											<fieldset class="rating text-left">
											    <input type="radio" id="star5" name="rate" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
											    <input type="radio" id="star4" name="rate" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
											    <input type="radio" id="star3" name="rate" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
											    <input type="radio" id="star2" name="rate" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
											    <input type="radio" id="star1" name="rate" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
											</fieldset>
										</div>
										<div class="mt-row">
											<label>Review</label>
											<textarea class="form-control" name="content"></textarea>
										</div>
										<button type="submit" class="btn-type4">ADD REVIEW</button>
									</fieldset>
								</form>
								@else
								<h3>You must sign in to give a review</h3>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- related products start here -->
	<div class="related-products wow fadeInUp" data-wow-delay="0.4s">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
				<h2>RELATED PRODUCTS</h2>
					<div class="row">
						<div class="col-xs-12">
							@foreach ($relateds as $related)
							<!-- mt product1 center start here -->
							<div class="mt-product1 mt-paddingbottom20">
								<div class="box">
									<div class="b1">
										<div class="b2">
											<a href="{{ route('shop.show', $related->slug) }}"><img src="{{ url('uploads/thumbs/'.$related->picture) }}" alt="{{ $related->name }}"></a>
											<span class="caption">
												@if (!empty($related->sale))
												<span class="off">{{ round(( ($related->price - $related->sale) / $related->price) * 100) }}% Off</span>
												@endif
											</span>

											{!! Helper::getRate($related->reviews->avg('rate')) !!} 
											<ul class="links">
												<li>
													<form style="display: none" action="{{ route('cart.store') }}" method="post" id="cart-{{ $related->id }}">
														{{ csrf_field() }}
														<input type="text" name="id" value="{{ $related->id }}" hidden="hidden">
													</form>
													<a href="javascript:void(0)" onclick="document.getElementById('cart-{{ $related->id }}').submit()">
														<i class="icon-handbag"></i>
														<span>Add to Cart</span>
													</a>
												</li>
												<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="txt">
									<strong class="title"><a href="product-detail.html">{{ $related->name }}</a></strong>
									<span class="price">{!! $related->price_amount !!}</span>
								</div>
							</div><!-- mt product1 center end here -->
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div><!-- related products end here -->
	</div>
</main><!-- mt main end here -->

@endsection