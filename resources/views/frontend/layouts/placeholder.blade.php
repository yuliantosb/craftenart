@php ($placeholder_img = (App\Setting::getSetting('banner_placeholder')->img))

<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(&quot;{{ url('uploads/'.$placeholder_img)  }}&quot;); visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1>{{ $placeholder_title }}</h1>
				<!-- Breadcrumbs of the Page -->
				<nav class="breadcrumbs">
					<ul class="list-unstyled">
						@foreach ($placeholder_breadcumbs as $breadcumb)
							@if ($loop->last)
								<li>{{ $breadcumb['name'] }}</li>
							@else
								<li><a href="{{ $breadcumb['url'] }}">{{ $breadcumb['name'] }}<i class="fa fa-angle-right"></i></a></li>
							@endif
						@endforeach
					</ul>
				</nav><!-- Breadcrumbs of the Page end -->
			</div>
		</div>
	</div>
</section>