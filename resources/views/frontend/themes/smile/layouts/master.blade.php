<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- set the encoding of your site -->
		<meta charset="utf-8">
		<!-- <link rel="icon" href="{{ url('frontend/images/favicon.ico') }}"> -->

		<link rel="icon" type="image/png" href="{{ !empty(App\Setting::getSetting('favicon')->img) ? url('uploads/'.App\Setting::getSetting('favicon')->img) : '' }}" />

		<!-- set the viewport width and initial-scale on mobile devices -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name="description" content="@yield('meta_description')">
		<meta name="keywords" content="@yield('meta_keyword')">

		<meta property="og:title" content="@yield('title')">
		<meta property="og:description" content="@yield('meta_description')">
		<meta property="og:image" content="@yield('meta_image')">
		<meta property="og:url" content="@yield('meta_url')">

		<meta name="twitter:title" content="@yield('title')">
		<meta name="twitter:description" content="@yield('meta_description')">
		<meta name="twitter:image" content="@yield('meta_image')">
		<meta name="twitter:card" content="@yield('meta_description')">

		<title>{{ config('app.name') }} | @yield('title') </title>

		<!-- Google Webfont -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,300italic,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/css/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/js/vendors/isotope/isotope.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/js/vendors/slick/slick.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/js/vendors/rs-plugin/css/settings.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/js/vendors/select/jquery.selectBoxIt.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/css/subscribe-better.css') }}">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/plugin/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/plugin/owl-carousel/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/'.config('app.themes').'/css/style.css') }}">
        <!-- Select2 -->
        <link href="{{ url('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120224836-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-120224836-1');
        
        </script>


        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KC2N9FP');</script>
        <!-- End Google Tag Manager -->

        @stack('gtm')

        @stack('css')

	</head>
	<body>
        <script>
            var SITE_URL = "{{ url('/') }}";
        </script>
        <!-- PRELOADER -->
        <div id="loader"></div>

        <div class="body">
			<!-- HEADER -->
			<div {{ !empty($type) ? 'id=header4' : '' }}>
				@include('frontend.themes.'.config('app.themes').'.layouts.header')
				<header>
					@include('frontend.themes.'.config('app.themes').'.layouts.nav')
				</header>
            </div>
            
            @yield('content')

            <!-- FOOTER -->
            @include('frontend.themes.'.config('app.themes').'.layouts.footer')

        </div>

        <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                            <div class="owl-carousel owl-1" id="galleries_big">
                            </div>

                            <div class="owl-carousel owl-2" id="galleries_small">
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-6">
                            <div class="product-single">
                                <div class="ps-header">
                                    <span class="badge offer" id="discount">-50%</span>
                                    <h3 id="product_name">Product fashion</h3>
                                    <div class="ratings-wrap">
                                        <div class="ratings" id="rating">
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                        </div>
                                        <em id="review_count">(6 reviews)</em>
                                    </div>
                                    <div class="ps-price" id="price"><span>$ 200.00</span> $ 99.00</div>
                                </div>
                                <p id="desc"></p>

                                <div class="ps-stock">
                                    Available: <a href="#" id="stock_count">In Stock</a>
                                </div>
                                <div class="sep"></div>

                                <div class="space10"></div>
                                <div class="row select-wraps">

                                    <form style="display: inline" action="{{ route('cart.store') }}" method="post" id="form-popup">
									    @csrf
									    <input type="text" name="id" hidden="hidden" id="popup-product-id">
									
                                        <div class="col-md-4 col-sm-4">
                                            <p>Quantity<span>*</span></p>
                                            <select name="qty" class="selectBoxIt">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>

                                        <div id="attributes-popup"></div>

                                    </form>

                                    <form style="display: none" action="{{ route('wishlist.store') }}" method="post" id="popup-product-wishlist">
										@csrf
										<input type="text" name="product_id" id="popup-wishlist-product-id" hidden="hidden">
									</form>

                                    <div class="col-md-12" style="margin-top:25px">
                                        <div class="share">
                                            <span id="wishlist">
                                                <a href="#" class="fa fa-heart-o" onclick="return false;"></a>
                                            </span>
                                            <!-- <div class="addthis_native_toolbox"></div> -->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space20"></div>
                                <div class="sep"></div>
                                <a class="btn-color" href="#" onclick="document.getElementById('form-popup').submit()">Add to Bag</a>
                                <a class="btn-black btn-go-to-details" href="#">Go to Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="backtotop"><i class="fa fa-chevron-up"></i></div>


        <!-- Javascript -->
        <script src="{{ url('frontend/'.config('app.themes').'/js/jquery.js') }}"></script>

        <!-- ADDTHIS -->

        <script src="{{ url('frontend/'.config('app.themes').'/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/plugin/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/bs-navbar.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/isotope/isotope.pkgd.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/slick/slick.min.js') }}"></script>
        <!-- <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/tweets/tweecool.min.js') }}"></script> -->
        <!-- Select2 -->
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/jquery.sticky.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/jquery.subscribe-better.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/autoNumeric/jquery.number.min.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/vendors/select/jquery.selectBoxIt.min.js') }}"></script>
        <script src="{{ url('backend/plugins/select2/js/select2.min.js') }}"></script>
        <!-- jquery validate -->
        <script src="{{ url('backend/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>	
        <script src="{{ url('frontend/'.config('app.themes').'/js/main.js') }}"></script>
        <script src="{{ url('frontend/'.config('app.themes').'/js/custom.js') }}"></script>
        @stack('js')
</html>