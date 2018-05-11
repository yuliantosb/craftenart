@extends('frontend.layouts.master')

@section('title', 'Cart')

@section('content')

  <main id="mt-main">
    <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(&quot;http://placehold.it/1920x205&quot;); visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<h1>SHOPPING CART</h1>
					<!-- Breadcrumbs of the Page -->
					<nav class="breadcrumbs">
						<ul class="list-unstyled">
							<li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
							<li><a href="product-detail.html">Products <i class="fa fa-angle-right"></i></a></li>
							<li>Chairs</li>
						</ul>
					</nav><!-- Breadcrumbs of the Page end -->
				</div>
			</div>
		</div>
	</section>
    <!-- Mt Process Section of the Page -->
    <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <ul class="list-unstyled process-list">
              <li class="active">
                <span class="counter">01</span>
                <strong class="title">Shopping Cart</strong>
              </li>
              <li>
                <span class="counter">02</span>
                <strong class="title">Check Out</strong>
              </li>
              <li>
                <span class="counter">03</span>
                <strong class="title">Order Complete</strong>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div><!-- Mt Process Section of the Page end -->
    <!-- Mt Product Table of the Page -->
    <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row border">
          <div class="col-xs-12 col-sm-6">
            <strong class="title">PRODUCT</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">PRICE</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">QUANTITY</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="title">TOTAL</strong>
          </div>
        </div>

        @if (count($carts) > 0)

        <form id="form-cart" method="post" action="{{ route('cart.bulk_update') }}">
        @csrf
        @method('PUT')

        @foreach ($carts as $cart)

        <div class="row border">
          <div class="col-xs-12 col-sm-2">
            <div class="img-holder">
              <img src="{{ url('uploads/thumbs/'.$cart->thumbnail) }}" alt="{{ $cart->name }}">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <strong class="product-name">{{ $cart->name }}</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="price">{{ Helper::currency($cart->price) }}</strong>
          </div>
          <div class="col-xs-12 col-sm-2">
            <input type="text" name="id[]" value="{{ $cart->getHash() }}" hidden="hidden">
            <input type="number" placeholder="1" name="qty[]" value="{{ $cart->qty }}" class="mt-number mt-cart" min="1">
          </div>
          <div class="col-xs-12 col-sm-2">
            <strong class="price">{{ Helper::currency($cart->price * $cart->qty) }}</strong>
            <button class="mt-link" name="delete" value="{{ $cart->getHash() }}"><i class="fa fa-close"></i></button></a>
          </div>
        </div>

        @endforeach

        </form>

        <div class="row">
          <div class="col-xs-12">
            <form action="#" class="coupon-form">
              <fieldset>
                <div class="mt-holder">
                  <input type="text" class="form-control" placeholder="Your Coupon Code">
                  <button type="submit" class="mt-button">APPLY</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div><!-- Mt Product Table of the Page end -->
    <!-- Mt Detail Section of the Page -->

    <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-7">
              	<div id="loading" style="display: none;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
                <h2>CALCULATE SHIPPING</h2>
                <br>

                <p>
                @php(session()->get('shipping'))
                </p>


                <form action="{{ route('cart.shipping') }}" method="post">
                	@csrf
                  <fieldset>
                    <div class="form-group">
                      <select class="form-control select2" data-placeholder="Country" name="country_id">
                        <option value="id">Indonesia</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <select class="form-control select2" data-placeholder="State or Province" name="province_id">
                        <option></option>
                        @foreach ($provinces as $province)
                        	<option value="{{ $province->province_id }}" {{ session()->get('shipping.province_id') == $province->province_id ? 'selected=selected' : '' }}>{{ $province->province }}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <select class="form-control select2" data-placeholder="City" name="city_id">
                        @foreach ($cities as $city)
                          <option value="{{ $city->city_id }}" {{ session()->get('shipping.city_id') == $city->city_id ? 'selected=selected' : '' }}>{{ $city->type.' '.$city->city_name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                    	<div id="shipping">
                        @if (!empty($costs) && session()->has('shipping'))
                          @include('frontend.cart.partial', ['costs' => collect($costs), 'total_weight' => $weight])
                        @endif
                      </div>
                    </div>

                    <div class="form-group">
                      <button class="mt-button mt-secondary-button" id="btn-shipping" type="submit" {{ !session()->has('shipping') ? 'disabled=disabled' : '' }}>UPDATE TOTAL <i class="fa fa-refresh"></i></button>
                    </div>

                  </fieldset>
                </form>
              </div>
              <div class="col-xs-12 col-sm-5">
                <h2>CART TOTAL</h2>
                <ul class="list-unstyled block cart">
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">SUBTOTAL</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['subtotal']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">DISCOUNT</strong>
                      <div class="txt pull-right">
                        <span>({{ Helper::currency($amount['discount']) }})</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">TAX</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['taxes']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">SHIPPING FEE</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['shipping_fee']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li style="border-bottom: none;">
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">CART TOTAL</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['total']) }}</span>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="text-right">
	              <button type="button" class="mt-button mt-primary-button" onclick="document.getElementById('form-cart').submit()">UPDATE CART</button>
					      <a href="{{ route('checkout.index') }}" class="mt-button mt-secondary-button">CHECKOUT</a>
				</div>
              </div>
            </div>
          </div>
    </section>


        @else

        <div class="row border">
          <div class="col-xs-12 col-sm-12 text-center">
          	<strong class="product-name">Your cart is currently empty</strong>
          	<br>
          	<br>
          	<br>
          </div>
        </div>
    </div>

    <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row text-right">
        	<div class="col-xs-12">
				<a href="{{ url('/') }}" class="mt-button mt-primary-button">BACK TO HOME</a>
			</div>
        </div>
      </div>
    </section>

        @endif

    <!-- Mt Detail Section of the Page end -->
  </main><!-- Main of the Page end here -->

@endsection

@push('js')
<script src="{{ url('frontend/js/cart.js') }}"></script>
@endpush