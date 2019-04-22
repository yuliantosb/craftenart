
<!-- SLIDER -->
<div class="slider-wrap">
	<div class="tp-banner-container">
		<div class="tp-banner slider-4">
			<ul>
				@foreach (App\Setting::getSetting('banner') as $banner)
				<!-- SLIDE  -->
				<!-- SLIDE  -->
				@if (!empty($banner->title) && !empty($banner->content))
				<li data-transition="fade" data-slotamount="2" data-masterspeed="500" data-thumb="{{ url('uploads/'.$banner->img)  }}"  data-saveperformance="on"  data-title="Intro Slide">
					<!-- MAIN IMAGE -->
					<img src="{{ url('uploads/'.$banner->img)  }}" alt="slidebg1" data-lazyload="{{ url('uploads/'.$banner->img)  }}" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
					<div class="tp-caption lft ss-color skewtoleftshort rs-parallaxlevel-9"
							data-x="5"
							data-y="220"
							data-speed="1000"
							data-start="1400"
							data-easing="Power3.easeInOut"
							data-elementdelay="0.1"
							data-endelementdelay="0.1"
							data-end="7300"
							data-endspeed="1000"
							style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;	font-family: Montserrat;
							font-size: 23px;
							font-weight: bold;
							text-transform: uppercase;
							color: #d6644a;
							">{{ $banner->title }}</div>
					<div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
							data-x="5"
							data-y="250"
							data-speed="1000"
							data-start="1400"
							data-easing="Power3.easeInOut"
							data-elementdelay="0.1"
							data-endelementdelay="0.1"
							data-end="7300"
							data-endspeed="1000"
							style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;font-family: Montserrat;
							font-size: 46px;
							font-weight: bold;
							line-height:44px;
							text-transform: uppercase;
							color: #fff;">{{ $banner->header }} <br> {{ $banner->subheader }}</div>
					<div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
							data-x="5"
							data-y="395"
							data-speed="1000"
							data-start="1800"
							data-easing="Power3.easeInOut"
							data-elementdelay="0.1"
							data-endelementdelay="0.1"
							data-end="7300"
							data-endspeed="1000"
							style="z-index: 3; max-width: 80px; max-height: 4px; width:100%;height:100%;background:#fff;"></div>
					<div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
							data-x="5"
							data-y="410"
							data-speed="1000"
							data-start="2200"
							data-easing="Power3.easeInOut"
							data-elementdelay="0.1"
							data-endelementdelay="0.1"
							data-end="7300"
							data-endspeed="1000"
							style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;		font-family: Raleway;
							font-size: 18px;
							color: #fff;">
						{{ $banner->content }}
					</div>
					<a href="{{ url($banner->url) }}" class="tp-caption lft ss-bg-color skewtoleftshort rs-parallaxlevel-9"
						data-x="5"
						data-y="480"
						data-speed="1000"
						data-start="2300"
						data-easing="Power3.easeInOut"
						data-elementdelay="0.1"
						data-endelementdelay="0.1"
						data-end="7300"
						data-endspeed="1000"
						style="z-index: 3; height:43px;line-height:43px;color:#fff;font-family: Montserrat;
						font-size: 12px;
						font-weight: bold;
						text-transform:uppercase;padding:0 25px;background:#d6644a;">
						{{ $banner->url_text }}
					</a>
				</li>
				@endif
				@endforeach
			</ul>
			<div class="tp-bannertimer"></div>
		</div>
	</div>
</div>