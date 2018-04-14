<div class="mt-main-slider">
	<!-- slider banner-slider start here -->
	<div class="slider banner-slider">

		@foreach (App\Setting::getSetting('banner') as $banner)
		<!-- holder start here -->
		<div class="holder text-center" style="background-image: url({{ url('uploads/'.$banner->img)  }});">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="text {{ $banner->align }}">
							<strong class="title">{{ $banner->title }}</strong>
							<h1>{{ $banner->header }}</h1>
							<h2>{{ $banner->subheader }}</h2>
							<div class="txt">
								<p>{{ $banner->content }}</p>
							</div>
							<a href="{{ url($banner->url) }}" class="shop">{{ $banner->url_text }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- holder end here -->
		@endforeach

	</div>
	<!-- slider regular end here -->
</div><!-- mt main slider end here -->