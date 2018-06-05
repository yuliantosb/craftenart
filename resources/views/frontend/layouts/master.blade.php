<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- <link rel="icon" href="{{ url('frontend/images/favicon.ico') }}"> -->

	<link rel="icon" type="image/png" href="{{ url('uploads/'.App\Setting::getSetting('favicon')->img) }}" />

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
	<link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">
  	<!-- include the site stylesheet -->
 	<link rel="stylesheet" href="{{ url('frontend/css/animate.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/icon-fonts.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/main-custom.css') }}">
	<link rel="stylesheet" href="{{ url('frontend/css/rating.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ url('frontend/css/responsive.css') }}">
	<!-- Select2 -->
    <link href="{{ url('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120224836-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-120224836-1');

	  ga('require', 'ecommerce');
	  
	</script>


	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MV4B887');</script>
	<!-- End Google Tag Manager -->

	<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="60010c4e-5f04-496d-8efa-3b787043c221";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

    @stack('css')

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
			width: 100%;
		}

		.dropdown li:last {
			border: none;
		}

		.dropdown li > a {
			text-align: left !important;
		}

	</style>

	<script type="text/javascript">
	    var SITE_URL = "{{ url('') }}";
	</script>

</head>

<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MV4B887"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="{{ url('uploads/'.App\Setting::getSetting('loading')->img) }}" alt="loader">
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
								<span class="tel"> <i class="fa fa-phone" aria-hidden="true"></i>{{ App\Setting::getSetting('phone')->text }}</span>
								<a href="#" class="tel"> <i class="fa fa-envelope-o" aria-hidden="true"></i>  {{ App\Setting::getSetting('email')->text }}</a>
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
								        <a href="#">{{ strtoupper(app()->getLocale()) }}</a>
								        <ul class="dropdown">
								            <li><a href="{{ route('language.set', 'lang=en') }}">EN</a></li>
								            <li><a href="{{ route('language.set', 'lang=id') }}">ID</a></li>
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
	<!-- jquery validate -->
	<script src="{{ url('backend/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>	
 	<!-- Select2 -->
    <script src="{{ url('backend/plugins/select2/js/select2.min.js') }}"></script>
	<!-- custom -->
	<script src="{{ url('frontend/js/custom.js') }}"></script>
	<script src="{{ url('frontend/js/form.js') }}"></script>
	@stack('js')
</body>
</html>