@extends('frontend.layouts.master')

@section('title', 'Checkout')

@section('content')

 <main id="mt-main">
      
    @include('frontend.layouts.placeholder', [
      'placeholder_title' => 'Checkout',
      'placeholder_breadcumbs' => [
        [
          'name' => trans('label.home'),
          'url' => '/'
        ],
        [
          'name' => trans('label.shopping_cart'),
          'url' => '/cart'
        ],
        [
          'name' => trans('label.checkout'),
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
                <strong class="title">@lang('label.shopping_cart')</strong>
              </li>
              <li class="active">
                <span class="counter">02</span>
                <strong class="title">@lang('label.check_out')</strong>
              </li>
              <li>
                <span class="counter">03</span>
                <strong class="title">@lang('label.order_complete')</strong>
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
              <h2>@lang('label.billing_details')</h2>
              <!-- Bill Detail of the Page -->
              	@csrf
              	<div id="loading" style="display: none;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
                <fieldset>
                  

                  <div class="row">
                  	<div class="col-sm-6">
  		                <div class="form-group">
  		                    <input type="text" class="form-control" placeholder="@lang('label.first_name') *" name="first_name" value="{{ !is_null(session()->get('shipping.first_name')) ? session()->get('shipping.first_name') : auth()->user()->name }}" required="required">
  		                    <label class="help-block"></label>
  		              	</div>
  		            </div>
  		        
                  	<div class="col-sm-6">
  		                <div class="form-group">
  		                    <input type="text" class="form-control" placeholder="@lang('label.last_name')" name="last_name" value="{{ session()->get('shipping.last_name') }}">
  		                </div>
  		            </div>
  		        </div>

                  
                	<div class="row">
                  	<div class="col-sm-6">
  			      		<div class="form-group">
  		                    <input type="email" class="form-control" placeholder="@lang('label.email_address') *" name="email" value="{{ !is_null(session()->get('shipping.email')) ? session()->get('shipping.email') : auth()->user()->email }}" required="required">
  		                    <label class="help-block"></label>
  		              	</div>
  		            </div>
  		         
                  	<div class="col-sm-6">
  		          		<div class="form-group">
  		                    <input type="text" class="form-control" placeholder="@lang('label.phone_number') *" name="phone_number" value="{{ !is_null(session()->get('shipping.phone_number')) ? session()->get('shipping.phone_number') : auth()->user()->cust->phone_number }}" required="required">
  		                    <label class="help-block"></label>
  		              	</div>
  		            </div>
  		        </div>

                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="@lang('label.postcode_or_zip') *" name="zip" value="{{ !is_null(session()->get('shipping.zip')) ? session()->get('shipping.zip') : auth()->user()->cust->zip }}" required="required">
                    <label class="help-block"></label>
                  </div>


                  <div class="form-group">
                    <textarea class="form-control" placeholder="@lang('label.address') *" name="address" required="required">{{ !is_null(session()->get('shipping.address')) ? session()->get('shipping.address') : auth()->user()->cust->address }}</textarea>
                    <label class="help-block"></label>
                  </div>


                </fieldset>
                <hr>
                <h2>@lang('label.credit_card_details')</h2>

                <fieldset>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="@lang('label.card_number') *" name="card_number" value="" required="required">
                      <label class="help-block"></label>
                  </div>

                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="@lang('label.month_expired') *" name="month_expired" value="" required="required">
                          <label class="help-block"></label>
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="@lang('label.year_expired') *" name="year_expired" value="" required="required">
                          <label class="help-block"></label>
                        </div>
                        <div class="col-md-6">
                          <input type="password" class="form-control" placeholder="@lang('label.cvv') *" name="cvv" value="" required="required">
                          <label class="help-block"></label>
                        </div>
                    </div>
                  </div>
                 </fieldset>
             
              <!-- Bill Detail of the Page end -->
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="holder">
                <h2>@lang('label.your_order')</h2>
                <ul class="list-unstyled block">
                  <li>
                    <div class="txt-holder">
                      <div class="text-wrap pull-left">
                        <strong class="title">@lang('label.products')</strong>
                        @foreach ($carts as $cart)
                        <span>{{ $cart->name }}       x{{ $cart->qty }}</span>
                        @endforeach
                      </div>
                      <div class="text-wrap txt text-right pull-right">
                        <strong class="title">@lang('label.totals')</strong>
                        @foreach ($carts as $cart)
                        <span>{{ Helper::currency($cart->price * $cart->qty) }}</span>
                        @endforeach
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">@lang('label.cart_subtotal')</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['subtotal']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">@lang('label.discount')</strong>
                      <div class="txt pull-right">
                        <span>({{ Helper::currency($amount['discount']) }})</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">@lang('label.tax')</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['taxes']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">@lang('label.shipping')</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['shipping_fee']) }}</span>
                      </div>
                    </div>
                  </li>
                  <li style="border-bottom: none;">
                    <div class="txt-holder">
                      <strong class="title sub-title pull-left">@lang('label.order_total')</strong>
                      <div class="txt pull-right">
                        <span>{{ Helper::currency($amount['total']) }}</span>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="text-right" style="margin-top: 20px">
                  <button id="btn-shipping" class="mt-button mt-primary-button">@lang('label.pay') <i class="fa fa-check"></i></button>
                </div>
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