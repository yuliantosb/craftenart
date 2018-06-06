@extends('frontend.layouts.master')

@section('title', 'Shop')

@section('content')
	
	<main id="mt-main">
		<!-- Mt Contact Banner of the Page -->
		<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ $placeholder }});">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h1>Shop</h1>
						<!-- Breadcrumbs of the Page -->
						<nav class="breadcrumbs">
							<ul class="list-unstyled">
								@if (!empty($category))
									<li><a href="{{ url('shop') }}">Shop <i class="fa fa-angle-right"></i></a></li>
									<li>{{ $category->name }}</li>
								@else
								
								<li>Shop</li>

								@endif
							</ul>
						</nav><!-- Breadcrumbs of the Page end -->
					</div>
				</div>
			</div>
		</section><!-- Mt Contact Banner of the Page end -->
		<div class="container">
			<div class="row">
				<!-- sidebar of the Page start here -->
				<aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
					<!-- shop-widget filter-widget of the Page start here -->
					<section class="shop-widget filter-widget bg-grey">
						@widget('filter_product')
					</section><!-- shop-widget filter-widget of the Page end here -->
					<!-- shop-widget of the Page start here -->
					<section class="shop-widget">
						@widget('categories_list', ['count' => 10, 'name' => trans('label.categories')])
					</section><!-- shop-widget of the Page end here -->
					<!-- shop-widget of the Page start here -->
					<section class="shop-widget">
						@widget('hot_sale', ['count' => 10, 'name' => trans('label.hot_sale')])
					</section><!-- shop-widget of the Page end here -->
				</aside><!-- sidebar of the Page end here -->
				<div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
					<!-- mt shoplist header start here -->
					<header class="mt-shoplist-header">
						<!-- btn-box start here -->
						<div class="btn-box">
							<ul class="list-inline">
								<li>
									<a href="#" class="drop-link">
										Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
									</a>
									<div class="drop">
										<ul class="list-unstyled">
											<li><a href="#">ASC</a></li>
											<li><a href="#">DSC</a></li>
											<li><a href="#">Price</a></li>
											<li><a href="#">Relevance</a></li>
										</ul>
									</div>
								</li>
								<li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a></li>
								<li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
							</ul>
						</div><!-- btn-box end here -->
						<!-- mt-textbox start here -->
						<div class="mt-textbox">
							<p>Showing  <strong>{{ $products->currentPage() }}–{{ $products->count() }}</strong> of  <strong>{{ $products->total() }}</strong> results</p>
							<p>View   <a href="#">9</a> / <a href="#">18</a> / <a href="#">27</a> / <a href="#">All</a></p>
						</div><!-- mt-textbox end here -->
					</header><!-- mt shoplist header end here -->
					<!-- mt productlisthold start here -->
					@if (count($products) > 0)
					<ul class="mt-productlisthold list-inline">
						@foreach ($products as $product)
						<li>
							<!-- mt product1 large start here -->
							<div class="mt-product1 mt-paddingbottom20">
								<div class="box">
									<div class="b1">
										<div class="b2">
											<a href="{{ route('shop.show', $product->slug) }}"><img src="{{ url('uploads/thumbs/'.$product->picture) }}" alt="image description" style="width: 215px; height: 215px; object-fit: cover"></a>

											<span class="caption">
												@if (!empty($product->sale))
												<span class="off">{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}% Off</span>
												@endif
											</span>

											{!! Helper::getRate($product->reviews->avg('rate')) !!} 
											<ul class="links">
												<li>
													<form style="display: none" action="{{ route('cart.store') }}" method="post" id="cart-{{ $product->id }}">
														{{ csrf_field() }}
														<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
													</form>
													<a href="javascript:void(0)" onclick="document.getElementById('cart-{{ $product->id }}').submit()">
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
									<strong class="title"><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></strong>
									<span class="price">{!! $product->price_amount !!}</span>
								</div>
							</div><!-- mt product1 center end here -->
						</li>
						@endforeach
					</ul><!-- mt productlisthold end here -->
					@else

					<center><h1 class="text-muted">Ooops..! Result not found!</h1></center>

					@endif
					<!-- mt pagination start here -->
					{{ $products->links('vendor.pagination.custom') }}
					<!-- mt pagination end here -->
				</div>
			</div>
		</div>
	</main><!-- mt main end here -->

@endsection

@push('js')
<script src="{{ url('frontend/js/shop.js') }}"></script>
@endpush