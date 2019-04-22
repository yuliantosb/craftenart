<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- Logo -->
			<a class="navbar-brand" href="./index.html">
				<img src="{{ url('frontend/'.config('app.themes').'/images/basic/logo-lite.png') }}" class="img-responsive" alt="" id="not-sticky-brand" />
				<img src="{{ url('frontend/'.config('app.themes').'/images/basic/logo.png') }}" class="img-responsive" alt="" id="sticky-brand" style="display:none"/>
			</a>
		</div>
		<!-- Cart & Search -->
		<div class="header-xtra pull-right">
			<div class="topcart">
				<span><i class="fa fa-shopping-cart"></i></span>
				<div class="cart-info">
					<small>You have <em class="highlight">{{ count(LaraCart::getItems()) }} item(s)</em> in your shopping bag</small>
					@if (count(LaraCart::getItems()) > 0)

					@foreach (LaraCart::getItems() as $item)
					<div class="ci-item">
						<img src="{{ url('uploads/thumbs/'.$item->thumbnail) }}" width="80" alt=""/>
						<div class="ci-item-info">
							<h5><a href="./single-product.html">{{ $item->name }}</a></h5>
							<p>{{ $item->qty }} x {{ Helper::currency($item->price) }}</p>

							<form action="{{ route('cart.destroy', $item->getHash()) }}" method="post" style="display: none;" id="destroy-{{ $item->getHash() }}">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
							</form>

							<div class="ci-edit">
								<a href="javascript:void(0)" onclick="document.getElementById('destroy-{{ $item->getHash() }}').submit()" class="edit fa fa-trash"></a>
							</div>
						</div>
					</div>
					@endforeach
					
					<div class="ci-total">@lang('label.subtotal'): {{ Helper::currency(LaraCart::subTotal($format = false, $withDiscount = true)) }}</div>
					<div class="ci-total">@lang('label.discount'): ({{ Helper::currency(LaraCart::totalDiscount($formatted = false)) }})</div>
					<div class="ci-total">@lang('label.tax'): {{ Helper::currency(LaraCart::taxTotal($formatted = false)) }}</div>
					<div class="ci-total">@lang('label.total'): {{ Helper::currency(LaraCart::total($formatted = false)) }}</div>

					<div class="cart-btn">
						<a href="{{ route('cart.index') }}">@lang('label.view_cart')</a>
						<a href="{{ route('checkout.index') }}">@lang('label.checkout')</a>
					</div>
					@else

					<div class="cart-row text-center">
						<strong>@lang('label.empty_cart')</strong>
					</div>

					@endif
				</div>
			</div>
			<div class="topsearch">
				<span>
					<i class="fa fa-search"></i>
				</span>
				<form class="searchtop">
					<input type="text" placeholder="Search entire store here.">
				</form>
			</div>
		</div>
		<!-- Navmenu -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				@foreach (App\Menu::getMenu() as $menu)
				
				@if (!empty($menu->child))
				
					@if ($menu->is_mega)
						<li class="dropdown mmenu">
							<a href="{{ $menu->url }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $menu->name }}</a>
							<ul class="mega-menu dropdown-menu" role="menu">
								@foreach ($menu->child as $child)
								<li class="col-md-3">
									@widget($child->widget->type, [
										'count' => $child->widget->limit,
										'name' => $child->name,
										'widget' => $child->widget,
										'children' => $child->child
									])
								</li>
								@endforeach
							</ul>
						</li>
					@else
					<li class="dropdown">
						<a href="{{ $menu->url }}" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false">{{ $menu->name }}</a>
						<ul class="dropdown-menu submenu" role="menu">
							@foreach ($menu->child as $children)
							<li><a href="{{ $children->url }}">{{ $children->name }}</a>
							@endforeach
						</ul>
					</li>
					@endif

				@else
					<li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
				@endif

				@endforeach
			</ul>
		</div>
	</div>
</nav>