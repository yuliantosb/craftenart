<!-- mt bottom bar start here -->
<div class="mt-bottom-bar">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<!-- mt logo start here -->
				<div class="mt-logo" style="margin: 0px"><a href="#"><img src="{{ url('frontend/images/mt-logo.png') }}" alt="craftenart" style="width: 180px"></a></div>
				<!-- mt icon list start here -->
				<ul class="mt-icon-list">
					<li class="hidden-lg hidden-md">
						<a href="#" class="bar-opener mobile-toggle">
							<span class="bar"></span>
							<span class="bar small"></span>
							<span class="bar"></span>
						</a>
					</li>
					<li><a href="#" class="icon-magnifier"></a></li>

					<li class="drop">
						<a href="#" class="cart-opener">
							<span class="icon-handbag"></span>
							<span class="num">{{ count(LaraCart::getItems()) }}</span>
						</a>
						<!-- mt drop start here -->
						<div class="mt-drop">
							<!-- mt drop sub start here -->
							<div class="mt-drop-sub">
								<!-- mt side widget start here -->
								<div class="mt-side-widget">
									@if (count(LaraCart::getItems()) > 0)

									@foreach (LaraCart::getItems() as $item)
									<!-- cart row start here -->
									<div class="cart-row">
										<a href="#" class="img"><img src="{{ url('uploads/thumbs/'.$item->thumbnail) }}" alt="image" class="img-responsive"></a>
										<div class="mt-h">
											<span class="mt-h-title"><a href="#">{{ $item->name }}</a></span>
											<span class="price">{{ Helper::currency($item->price) }}</span>
											<span class="mt-h-title">Qty: {{ $item->qty }}</span>
										</div>

										<form action="{{ route('cart.destroy', $item->getHash()) }}" method="post" style="display: none;" id="destroy-{{ $item->getHash() }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
										</form>

										<a href="javascript:void(0)" onclick="document.getElementById('destroy-{{ $item->getHash() }}').submit()" class="close fa fa-times"></a>
									</div><!-- cart row end here -->
									@endforeach
									
									<!-- cart row total start here -->
									<div class="cart-row-total">
										<span class="mt-total">Sub Total</span>
										<span class="mt-total-txt">{{ Helper::currency(LaraCart::subTotal($format = false, $withDiscount = true)) }}</span>
									</div>

									<!-- cart row total start here -->
									<div class="cart-row-total">
										<span class="mt-total">Discount</span>
										<span class="mt-total-txt">{{ Helper::currency(LaraCart::totalDiscount($formatted = false)) }}</span>
									</div>

									<!-- cart row total start here -->
									<div class="cart-row-total">
										<span class="mt-total">Tax</span>
										<span class="mt-total-txt">{{ Helper::currency(LaraCart::taxTotal($formatted = false)) }}</span>
									</div>

									<!-- cart row total start here -->
									<div class="cart-row-total">
										<span class="mt-total">Total</span>
										<span class="mt-total-txt">{{ Helper::currency(LaraCart::total($formatted = false, $withDiscount = true)) }}</span>
									</div>
									<!-- cart row total end here -->
									<div class="cart-btn-row">
										<a href="#" class="btn-type2">VIEW CART</a>
										<a href="#" class="btn-type3">CHECKOUT</a>
									</div>
									@else
									<div class="cart-row text-center">
										<strong>Your cart is currently empty</strong>
									</div>
									@endif
								</div><!-- mt side widget end here -->
							</div>
							<!-- mt drop sub end here -->
						</div><!-- mt drop end here -->
						<span class="mt-mdropover"></span>
					</li>
					<li>
						<a href="#" class="bar-opener side-opener">
							<span class="bar"></span>
							<span class="bar small"></span>
							<span class="bar"></span>
						</a>
					</li>
				</ul><!-- mt icon list end here -->
				<!-- navigation start here -->
				<nav id="nav">
					@include('frontend.layouts.nav')
				</nav>
				<!-- mt icon list end here -->
			</div>
		</div>
	</div>
</div>
<!-- mt bottom bar end here -->
<span class="mt-side-over"></span>