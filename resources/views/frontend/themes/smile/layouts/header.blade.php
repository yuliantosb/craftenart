
	<div class="top_bar">
		<div class="container">
			<div class="row">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="tb_left pull-left">
							<p>Welcome to our online store !</p>
						</div>
						<div class="tb_center pull-left">
							<ul>
								<li><i class="fa fa-phone"></i> Hotline: <a href="#">{{ !empty(App\Setting::getSetting('phone')->text) ? App\Setting::getSetting('phone')->text : '' }}</a></li>
								<li><i class="fa fa-envelope-o"></i> <a href="#">{{ !empty(App\Setting::getSetting('email')->text) ? App\Setting::getSetting('email')->text : '' }}</a></li>
							</ul>
						</div>
						<div class="tb_right pull-right">
							<ul>
								@if (auth()->check())
								<li>
									<div class="tbr-info">
										<span>Account <i class="fa fa-caret-down"></i></span>
										<div class="tbr-inner">
											<a href="{{ route('user.dashboard.index') }}">My Account</a>
											<a href="{{ route('user.wishlist.index') }}">My Wishlist</a>
											<a href="{{ url('logout') }}">Logout</a>
										</div>
									</div>
								</li>
								@else
								<li>
									<div class="tbr-info bebeb">
										<span><i class="fa fa-lock"></i><a href="{{ url('login') }}">Login</a></span>
									</div>
								</li>
								@endif
								<li>
									<div class="tbr-info">
										<span>{{ app()->getLocale() == 'en' ? 'English' : 'Bahasa Indonesia' }} <i class="fa fa-caret-down"></i></span>
										<div class="tbr-inner">
											<a href="{{ route('language.set', 'lang=en') }}">English</a>
											<a href="{{ route('language.set', 'lang=id') }}">Bahasa Indonesia</a>
										</div>
									</div>
								</li>
								<li>
									<div class="tbr-info">
										<span>{{ session()->has('currency') ? strtoupper(session()->get('currency')) : 'USD' }} <i class="fa fa-caret-down"></i></span>
										<div class="tbr-inner">
										@foreach (App\Currency::get() as $currency)
											<a href="{{ route('currency.set', $currency->alias) }}">{{ $currency->symbol }} {{ $currency->name }}</a>
										@endforeach
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
