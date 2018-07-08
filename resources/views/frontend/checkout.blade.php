@extends('frontend.layouts.master')

@section('title', 'Checkout')

@section('content')

 <main id="mt-main">
      
    @include('frontend.layouts.placeholder', [
      'placeholder_title' => 'Checkout',
      'placeholder_breadcumbs' => [
        [
          'name' => 'Home',
          'url' => '/'
        ],
        [
          'name' => 'Shopping Cart',
          'url' => '/cart'
        ],
        [
          'name' => 'Checkout',
          'url' => '/checkout'
        ]
      ]])

    <!-- Mt Process Section of the Page -->
    <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <!-- Process List of the Page -->
            <ul class="list-unstyled process-list">
              <li class="active">
                <span class="counter">01</span>
                <strong class="title">Shopping Cart</strong>
              </li>
              <li class="active">
                <span class="counter">02</span>
                <strong class="title">Check Out</strong>
              </li>
              <li>
                <span class="counter">03</span>
                <strong class="title">Order Complete</strong>
              </li>
            </ul>
            <!-- Process List of the Page end -->
          </div>
        </div>
      </div>
    </div><!-- Mt Process Section of the Page end -->
    <!-- Mt Detail Section of the Page -->

    <form action="{{ route('checkout.store') }}" class="bill-detail" method="post" id="form-checkout">

      <section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <h2>BILLING DETAILS</h2>
              <!-- Bill Detail of the Page -->
              	@csrf
              	<div id="loading" style="display: none;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
                <fieldset>
                  

                  <div class="row">
                  	<div class="col-sm-6">
  		                <div class="form-group">
  		                    <input type="text" class="form-control" placeholder="First Name *" name="first_name" value="{{ !is_null(session()->get('shipping.first_name')) ? session()->get('shipping.first_name') : auth()->user()->name }}" required="required">
  		                    <label class="help-block"></label>
  		              	</div>
  		            </div>
  		        
                  	<div class="col-sm-6">
  		                <div class="form-group">
  		                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ session()->get('shipping.last_name') }}">
  		                </div>
  		            </div>
  		        </div>

                  
                	<div class="row">
                  	<div class="col-sm-6">
  			      		<div class="form-group">
  		                    <input type="email" class="form-control" placeholder="Email Address *" name="email" value="{{ !is_null(session()->get('shipping.email')) ? session()->get('shipping.email') : auth()->user()->email }}" required="required">
  		                    <label class="help-block"></label>
  		              	</div>
  		            </div>
  		         
                  	<div class="col-sm-6">
  		          		<div class="form-group">
  		                    <input type="text" class="form-control" placeholder="Phone Number *" name="phone_number" value="{{ !is_null(session()->get('shipping.phone_number')) ? session()->get('shipping.phone_number') : auth()->user()->cust->phone_number }}" required="required">
  		                    <label class="help-block"></label>
  		              	</div>
  		            </div>
  		        </div>

                  <div class="form-group">
                    <select class="form-control select2" data-placeholder="Country *" name="country_id" required="required">
                    	<option value="id">Indonesia</option>
                    </select>
                    <label class="help-block"></label>
                  </div>

                  <div class="form-group">
                    <select class="form-control select2" data-placeholder="State or Province *" name="province_id" required="required">
                      @php ($province_id = !empty(auth()->user()->cust->province_id) ? auth()->user()->cust->province_id : session()->get('shipping.province_id'))
                      <option></option>
                      @foreach ($provinces as $province)
                      	<option value="{{ $province->province_id }}" {{ $province_id == $province->province_id ? 'selected=selected' : '' }}>{{ $province->province }}</option>
                      @endforeach
                    </select>
                    <label class="help-block"></label>
                  </div>

                  <div class="form-group">
                     <select class="form-control select2" data-placeholder="City *" name="city_id" required="required">
                      @php ($city_id = !empty(auth()->user()->cust->city_id) ? auth()->user()->cust->city_id : session()->get('shipping.city_id'))

                      @foreach ($cities as $city)
                        <option value="{{ $city->city_id }}" {{ $city_id == $city->city_id ? 'selected=selected' : '' }}>{{ $city->type.' '.$city->city_name }}</option>
                      @endforeach
                    </select>
                    <label class="help-block"></label>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Postcode / Zip *" name="zip" value="{{ !is_null(session()->get('shipping.zip')) ? session()->get('shipping.zip') : auth()->user()->cust->zip }}" required="required">
                    <label class="help-block"></label>
                  </div>


                  <div class="form-group">
                    <textarea class="form-control" placeholder="Address *" name="address" required="required">{{ !is_null(session()->get('shipping.address')) ? session()->get('shipping.address') : auth()->user()->cust->address }}</textarea>
                    <label class="help-block"></label>
                  </div>

                  <div class="form-group">
                  	<div id="shipping">
                      @if (!empty($costs))
                        @include('frontend.cart.partial', ['costs' => collect($costs), 'total_weight' => $weight])
                      @endif
                    </div>
                  </div>

                </fieldset>
             
              <!-- Bill Detail of the Page end -->
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="holder">
                <h2>YOUR ORDER</h2>
                <ul class="list-unstyled block">
                  <li>
                    <div class="txt-holder">
                      <div class="text-wrap pull-left">
                        <strong class="title">PRODUCTS</strong>
                        @foreach ($carts as $cart)
                        <span>{{ $cart->name }}       x{{ $cart->qty }}</span>
                        @endforeach
                      </div>
                      <div class="text-wrap txt text-right pull-right">
                        <strong class="title">TOTALS</strong>
                        @foreach ($carts as $cart)
                        <span>{{ Helper::currency($cart->price * $cart->qty) }}</span>
                        @endforeach
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
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
                      <strong class="title sub-title pull-left">SHIPPING</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['shipping_fee']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li style="border-bottom: none;">
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">ORDER TOTAL</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['total']) }}</span>
                      </div>
                    </div>
                  </li>
                </ul>
                <h2>PAYMENT METHODS</h2>
                <!-- Panel Group of the Page -->
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <!-- Panel Panel Default of the Page -->
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-bottom: 20px;" role="tab" id="headingOne">
                      <h4 class="panel-title">
<!--                         <a role="button" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> -->
                          MIDRTANS
                          <!-- <span class="check"><i class="fa fa-check"></i></span> -->
                          <div class="wrapper-payment" style="float: right;">
                            <label class="container-radio" for="midtrans">
                              <input type="radio" name="payment_method" value="midtrans" checked="checked" id="midtrans" data-toggle="collapse" data-target="#collapseOne" style="display: none;">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        <!-- </a> -->
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <p>Use payment gateway Midtrans to pay, with many Payment channel, payment gateway list such as : 
                          Credit Card, 
                          BCA Klik Pay, 
                          Klik BCA, 
                          E-pay Mandiri, 
                          CIMB Clicks, 
                          Mandiri Click Pay, 
                          Telkomsel Cash, 
                          XL Tunai, 
                          Mandiri Bill, 
                          Indosat Dompetku, 
                          Mandiri e-cash, 
                          Indomaret, 
                          Gift Card Indonesia, 
                          Danamon Online, and
                          Bank Transfer.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- Panel Panel Default of the Page end -->
                  <!-- Panel Panel Default of the Page -->
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-bottom: 20px;" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <!-- <a class="collapsed" role="button" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> -->
                          Paypal
                          <div class="wrapper-payment" style="float: right;">
                            <label class="container-radio" for="paypal">
                              <input type="radio" name="payment_method" value="paypal" id="paypal" data-toggle="collapse" data-target="#collapseTwo" style="display: none;">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        <!-- </a> -->
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        <p>Using Paypal page to make a payment</p>
                      </div>
                    </div>
                  </div>
                  <!-- Panel Panel Default of the Page end -->
                  <!-- Panel Panel Default of the Page -->
                  <!-- <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Others
                          <span class="check"><i class="fa fa-check"></i></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                        <p>Others payment included Debit/Credit Payment, Internet Banking, Virtual Account, and pay using local store</p>
                      </div>
                    </div>
                  </div> -->
                  <!-- Panel Panel Default of the Page end -->
                </div>
                <!-- Panel Group of the Page end -->
              </div>
              <div class="text-right" style="margin-top: 20px">
              	<button id="btn-shipping" class="mt-button mt-primary-button" {{ !session()->has('shipping') ? 'disabled=disabled' : '' }} >PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
              </div>
            </div>
          </div>
        </div>
      </section>    
    <!-- Mt Detail Section of the Page end -->

    </form>
</main><!-- Main of the Page end here -->

@endsection

@push('js')
<script src="{{ url('frontend/js/cart.js') }}"></script>
<script src="{{ url('frontend/js/checkout.js') }}"></script>
@endpush