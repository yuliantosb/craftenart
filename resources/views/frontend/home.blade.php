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
						<!-- banner-1 start here -->
						<div class="banner-1 wow fadeInLeft" data-wow-delay="0.4s">
							<img alt="image description" src="http://placehold.it/385x480">
							<div class="holder">
								<h2>MY SMALL WRITING <br>DESK</h2>
								<div class="txts">
									<a class="btn-shop" href="product-detail.html">
										<span>shop now</span>
										<i class="fa fa-angle-right"></i>
									</a>
									<div class="discount">
										<span>-20%</span>
									</div>
								</div>
							</div>
						</div>
						<!-- banner-1 end here -->

						<!-- banner-box first start here -->
						<div class="banner-box first">
							<!-- banner-2 start here -->
							<div class="banner-2 wow fadeInUp" data-wow-delay="0.4s">
								<img alt="image description" src="http://placehold.it/385x225">
								<div class="holder">
									<h2>MODULAR LOUNGE <br>TEAK</h2>
									<span class="price">$ 129.00</span>
								</div>
							</div>
							<!-- banner-2 end here -->

							<!-- banner-3 start here -->
							<div class="banner-3 right wow fadeInDown" data-wow-delay="0.4s">
								<img alt="image description" src="http://placehold.it/385x225">
								<div class="holder">
									<h2>Modular technical <br>fabric sofa</h2>
									<a href="product-detail.html" class="shop">SHOP NOW</a>
								</div>
							</div>
							<!-- banner-3 end here -->
						</div>
						<!-- banner-box first end here -->

						<!-- banner-4 start here -->
						<div class="banner-4 hidden-sm wow fadeInRight" data-wow-delay="0.4s">
							<img alt="image description" src="http://placehold.it/385x480">
							<div class="holder">
								<h2>Direct light <br>pendant lamp</h2>
								<span class="price">$ 129.00</span>
								<a class="btn-shop add" href="product-detail.html">
									<span>shop now</span>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div>
						<!-- banner-4 end here -->
					</div>
					<!-- banner frame end here -->
					<!-- mt producttabs start here -->
					<div class="mt-producttabs wow fadeInUp" data-wow-delay="0.4s">
						<!-- producttabs start here -->
						<ul class="producttabs">
							<li><a href="#tab1" class="active">FEATURED</a></li>
							<li><a href="#tab2">LATEST</a></li>
							<li><a href="#tab3">BEST SELLER</a></li>
						</ul>
						<!-- producttabs end here -->
						<div class="tab-content text-center">
							<div id="tab1" class="tab-pane">
								<!-- tabs slider start here -->
								<div class="tabs-slider">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="new">NEW</span>
														</span>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Puff Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Easy chair with armrests</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Upholstered chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Trestle-based chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
															<span class="new">NEW</span>
														</span>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Upholstered chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
								</div>
								<!-- tabs slider end here -->
							</div>
							<div id="tab2" class="tab-pane">
								<!-- tabs slider start here -->
								<div class="tabs-slider">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Easy chair with armrests</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="new">NEW</span>
														</span>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Puff Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Upholstered chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Trestle-based chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
															<span class="new">NEW</span>
														</span>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Upholstered chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
								</div>
								<!-- tabs slider end here -->
							</div>
							<div id="tab3" class="tab-pane">
								<!-- tabs slider start here -->
								<div class="tabs-slider">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="new">NEW</span>
														</span>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Puff Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Easy chair with armrests</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Upholstered chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Trestle-based chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
															<span class="new">NEW</span>
														</span>
														<ul class="mt-stars">
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<span class="caption">
															<span class="off">15% Off</span>
														</span>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Upholstered chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div>
										<!-- mt product1 center end here -->
										<!-- mt product1 center start here -->
										<div class="mt-product1 mt-paddingbottom20">
											<div class="box">
												<div class="b1">
													<div class="b2">
														<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
														<ul class="links">
															<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
															<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
															<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="txt">
												<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div>
										</div><!-- mt product1 center end here -->
									</div>
									<!-- slide end here -->
								</div>
								<!-- tabs slider end here -->
							</div>
						</div>
					</div>
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
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/275x285" alt="image description"></a>
												<span class="caption">
													<span class="best-price">Best Price</span>
												</span>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/275x285" alt="image description"></a>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/275x285" alt="image description"></a>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Puff  Armchair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/275x285" alt="image description"></a>
												<span class="caption">
													<span class="best-price">Best Price</span>
												</span>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/275x285" alt="image description"></a>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
							<div class="slide">
								<!-- mt product1 center start here -->
								<div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/275x285" alt="image description"></a>
												<span class="caption">
													<span class="off">15% Off</span>
												</span>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Puff  Armchair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1 center end here -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- mt bestseller start here -->
		<div class="mt-smallproducts wow fadeInUp" data-wow-delay="0.4s">
			@include('frontend.layouts.widget')
		</div><!-- mt bestseller end here -->
	</main><!-- mt main end here -->

@endsection