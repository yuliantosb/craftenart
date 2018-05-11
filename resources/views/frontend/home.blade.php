@extends('frontend.layouts.master')

@section('title', 'Home')

@section('content')
	
	@include('frontend.layouts.slider')
	<!-- mt main start here -->
	
	<main id="mt-main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!-- banner frame start here -->
					<div class="banner-frame">


						@foreach ($products->limit(4)->inRandomOrder()->get() as $product)
							@if ($loop->first)
								<!-- banner-1 start here -->
								<div class="banner-1 wow fadeInLeft" data-wow-delay="0.4s">
									<img alt="{{ $product->name }}" src="{{ url('uploads/'.$product->picture) }}" style="width: 385px; height: 480px; object-fit: contain;">
									<div class="holder">
										<h2>{{ $product->name }}</h2>
										<span class="price">{!! $product->price_amount !!}</span>
										<div class="txts">
											<a class="btn-shop" href="{{ route('shop.show', $product->slug) }}">
												<span>shop now</span>
												<i class="fa fa-angle-right"></i>
											</a>
											@if (!empty($product->sale))
											<div class="discount">
												<span>-{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}%</span>
											</div>
											@endif
										</div>
									</div>
								</div>

								<div class="banner-box first">

							@elseif ($loop->last)

								</div>

								<!-- banner-1 start here -->
								<div class="banner-1 wow fadeInLeft" data-wow-delay="0.4s">
									<img alt="{{ $product->name }}" src="{{ url('uploads/'.$product->picture) }}" style="width: 385px; height: 480px; object-fit: contain;">
									<div class="holder">
										<h2>{{ $product->name }}</h2>
										<span class="price">{!! $product->price_amount !!}</span>
										<div class="txts">
											<a class="btn-shop" href="{{ route('shop.show', $product->slug) }}">
												<span>shop now</span>
												<i class="fa fa-angle-right"></i>
											</a>
											@if (!empty($product->sale))
											<div class="discount">
												<span>-{{ round(( ($product->price - $product->sale) / $product->price) * 100) }}%</span>
											</div>
											@endif
										</div>
									</div>
								</div>

							@else
								
								<!-- banner-2 start here -->
								<div class="banner-2 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
									<img alt="image description" src="{{ url('uploads/thumbs/'.$product->picture) }}" style="width: 385px; height: 225px; object-fit: contain;">
									<div class="holder">
										<h2>{{ $product->name }}</h2>
										<span class="price">{!! $product->price_amount !!}</span>
										<a href="{{ route('shop.show', $product->slug) }}" class="shop">SHOP NOW</a>
									</div>
								</div>
									
							@endif

						@endforeach

						
					</div>
					<!-- banner frame end here -->
					<!-- mt producttabs start here -->

					<div class="mt-producttabs style2 wow fadeInUp" data-wow-delay="0.4s">
						<!-- producttabs start here -->
						<ul class="producttabs">
							@foreach ($categories as $category)
							<li>
								<a href="#tab{{ $category->id }}" class="{{ $loop->first ? 'active' : '' }}">{{ $category->name }}</a>
							</li>
							@endforeach
						</ul>
						<!-- producttabs end here -->
						<div class="tab-content">
							@foreach ($categories as $category)
							<div id="tab{{ $category->id }}">
								<!-- tabs slider start here -->
								<div class="tabs-sliderlg">
									@foreach ($category->products as $product)

									<form style="display: none" action="{{ route('cart.store') }}" method="post" id="tab-{{ $product->id }}">
										{{ csrf_field() }}
										<input type="text" name="id" value="{{ $product->id }}" hidden="hidden">
									</form>

									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 large start here -->
										<div class="mt-product1 large">
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
																<a href="javascript:void(0)" onclick="document.getElementById('tab-{{ $product->id }}').submit()">
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
									</div>
									@endforeach
								</div>
								<!-- tabs slider end here -->
							</div>
							@endforeach
						</div>
					</div><!-- mt producttabs end here -->

					<!-- mt producttabs end here -->
				</div>
			</div>
		</div>
		<!-- mt bestseller start here -->
		<div class="mt-bestseller bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 mt-heading text-uppercase">
						<h2 class="heading">BEST SELLER</h2>
						<p>EXCEPTEUR SINT OCCAECAT</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="bestseller-slider">
							@foreach ($products->whereHas('orders')->withCount('orders')->orderBy('orders_count', 'desc')->take(10)->get() as $best)
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="{{ route('shop.show', $best->slug) }}"><img src="{{ url('uploads/thumbs/'.$best->picture) }}" style="width: 275px; height: 285px; object-fit: scale-down;"></a>
												<ul class="links add">
													<form style="display: none" action="{{ route('cart.store') }}" method="post" id="best-{{ $best->id }}">
														{{ csrf_field() }}
														<input type="text" name="id" value="{{ $best->id }}" hidden="hidden">
													</form>
													
													
													<li><a href="javascript:void(0)" onclick="document.getElementById('best-{{ $best->id }}').submit()"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="{{ route('shop.show', $best->slug) }}">{{ $best->name }}</a></strong>
										<span class="price">{{ $best->price_amount }}</span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- mt bestseller start here -->
		<div class="mt-smallproducts wow fadeInUp" data-wow-delay="0.4s">
			@include('frontend.layouts.widget', ['products' => $products])
		</div><!-- mt bestseller end here -->
	</main><!-- mt main end here -->

@endsection