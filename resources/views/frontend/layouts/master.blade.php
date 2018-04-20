<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<link rel="icon" href="{{ url('frontend/images/favicon.ico') }}">
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
	<!-- include the site stylesheet -->
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/bootstrap.css') }}">
  	<!-- include the site stylesheet -->
 	<link rel="stylesheet" href="{{ url('frontend/css/animate.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/icon-fonts.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/main.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/responsive.css') }}">

	<style type="text/css">
		.nav {
		    list-style: none;
		    font-weight: bold;
		    margin-bottom: 10px;
		    float: left !important;
		    width: 100%;
		}
		.nav li {
		    float: left;
		    margin-right: 10px;
		    position: relative;
		}
		.nav a {
		    display: block;
		    padding: 5px;
		    text-decoration: none;
		}
		.nav a:hover {
		 	color: #333;   
		}
		.nav ul {
		    list-style: none;
		    position: absolute;
		    left: -9999px;
		}
		.nav ul li {
		    padding-top: 1px;
		    float: none;
		}
		.nav ul a {
		    white-space: nowrap;
		}
		.nav li:hover ul {
		    left: 0;
		}
		.nav li:hover a {
		    color: #333;
		}
		.nav li:hover ul a {
		    text-decoration: none;
		}

		.dropdown {
			padding: 0px;
			z-index: 1;
			background-color: #fff;
		}

		.dropdown li {
			border-left: none !important;
			border-bottom: 1px solid #e1e1e1;
			text-align: right !important;
			padding: 0px 10px !important;
		}

		.dropdown li:last {
			border: none;
		}

	</style>

</head>

<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="{{ url('frontend/images/svg/rings.svg') }}" alt="loader">
      </div>
    </div>
		<!-- W1 start here -->
		<div class="w1">
			<!-- mt header style4 start here -->
			<header id="mt-header" class="style17">
				<div class="mt-top-bar">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-6 hidden-xs">
								<span class="tel"> <i class="fa fa-phone" aria-hidden="true"></i> +1 (555) 333 22 11</span>
								<a href="#" class="tel"> <i class="fa fa-envelope-o" aria-hidden="true"></i>  info@schon.chairs</a>
							</div>
							<div class="col-xs-12 col-sm-6 text-right">
	
								<ul class="nav mt-top-list2">
								    <li>
								        <a href="#">
								        	{{ session()->has('currency') ? strtoupper(session()->get('currency')) : 'USD' }}
							        	</a>
								        <ul class="dropdown">
								        	@foreach (App\Currency::get() as $currency)
								            <li><a href="{{ route('currency.set', $currency->alias) }}">{{ $currency->name }}</a></li>
								            @endforeach
								        </ul>
								    </li>
								    <li>
								        <a href="#">English</a>
								        <ul class="dropdown">
								            <li><a href="#">English</a></li>
								            <li><a href="#">Bahasa</a></li>
								        </ul>
								    </li>
								</ul>

							</div>
						</div>
					</div>
				</div>
				@include('frontend.layouts.header')
			</header><!-- mt header style4 end here -->
			<!-- mt side menu start here -->
			<div class="mt-side-menu">
				@include('frontend.layouts.sidemenu')
			</div><!-- mt side menu end here -->
			<!-- mt search popup start here -->
			<div class="mt-search-popup">
				@include('frontend.layouts.search')
			</div><!-- mt search popup end here -->
			<!-- mt main slider start here -->

			@yield('content')

			<!-- footer of the Page -->
			<footer id="mt-footer" class="style1 wow fadeInUp" data-wow-delay="0.4s">
				@include('frontend.layouts.footer')
			</footer><!-- footer of the Page end -->
		</div><!-- W1 end here -->
		<span id="back-top" class="fa fa-arrow-up"></span>
	</div>
	<!-- include jQuery -->
	<script src="{{ url('frontend/js/jquery.js') }}"></script>
	<!-- include jQuery -->
	<script src="{{ url('frontend/js/plugins.js') }}"></script>
	<!-- include jQuery -->
	<script src="{{ url('frontend/js/jquery.main.js') }}"></script>
	<!-- custom -->
	<script src="{{ url('frontend/js/custom.js') }}"></script>
</body>
</html>