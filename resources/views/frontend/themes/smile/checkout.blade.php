@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Checkout')

@section('content')


<!-- BREADCRUMBS -->
<div class="bcrumbs">
  <div class="container">
      <ul>
          <li><a href="#">Home</a></li>
          <li>Checkout</li>
      </ul>
  </div>
</div>

<div class="space10"></div>

<!-- MAIN CONTENT -->
<div class="shop-single">
  <div class="container">
      <div class="row">

          <div class="col-md-12 col-sm-12">
              <div class="redirect-login">
                  <i class="fa fa-edit"></i> &nbsp; &nbsp; <span> Have a coupon? </span>
                  &nbsp; &nbsp;<a class="showlogin"  data-toggle="modal" href="#coupon-code">Click here to enter your code</a>
              </div>
          </div>

        <form action="{{ route('checkout.store') }}" method="post">
          @csrf
          <div class="col-md-7 col-sm-6">
              <!-- HTML -->
              <div>
                  <h4 class="account-title"><span class="fa fa-chevron-right"></span>Checkout</h4>
                  <div class="account-form">
                    <h5>Billing / Ship Address</h5>
                    <p>{{ $address->address }}<br> {{ RajaOngkir::getCityAttr($address->city_id, $address->province_id) }}, {{ RajaOngkir::getProvinceAttr($address->province_id) }}, {{ $address->postal_code }}</p>
                    <div class="space30"></div>
                    <h5>Payment Method</h5>

                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h6>
                            <span data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor:pointer">
                            Credit or Debit Card</span>
                          </h6>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <div class="form-group">
                              <label class="control-label">Card Number</label>
                              <div class="input-group">
                                <input name="card_number" type="text" class="form-control custom-input" placeholder="Your card number" style="letter-spacing: 1.5px;">
                                <span class="input-group-addon" style='border-radius: 0px; border: none;'>
                                    <img style="width:20px" id="card-image">
                                </span>
                              </div>
                              <span class="text-danger"><em id="error-card"></em></span>
                            </div>

                            <div class="row">
                              <div class="col-sm-8">
                                <div class="form-group">
                                  <label class="control-label">Expiration Date</label>
                                  <input type="text" class="form-control custom-input" name="expiration_date" placeholder="MM/YY">
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label">CCV</label>
                                  <input name="card_cvv" type="password" class="form-control custom-input" placeholder="***">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h6>
                            <span data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor:pointer">
                            Virtual Account</span>
                          </h6>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                          <div class="panel-body">Coming soon</div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h6>
                            <span data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor:pointer">
                            Convenience Store</span>
                          </h6>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                          <div class="panel-body">Coming Soon</div>
                        </div>
                      </div>
                    </div>

                    <button class="btn-black" type="submit">Place Order</button>
                  </div>
                  <div class="clearfix"></div>   
              </div>
          </div>
        </form>
          <div class="col-md-5 col-sm-6">
              <div class="side-widget space50">
                  <h3> <span> Your order </span></h3>
                  <div>
                      <table class="cart-table"> 
                          <thead>
                            @foreach ($carts as $cart)
                            <tr>
                              <td>
                                <h6>{{ $cart->name }}</h6>
                                <ul class="unstyled" style="font-size: .7em;">
                                @foreach ($cart->attributes as $attribute)
                                  <li>{{ $attribute['name'] }} : {{ $attribute['value'] }} </li>
                                @endforeach
                                </ul>
                              </td>
                              <td class="text-right">
                                {{ Helper::currency($cart->price) }} (x{{ $cart->qty }})
                              </td>
                            </tr>
                            @endforeach
                            <tr>
                              <td class="text-right"> @lang('label.subtotal')</td>
                              <td class="text-right">{{ Helper::currency($amount['subtotal']) }}</td>
                            </tr>
                            <tr>
                              <td class="text-right"> @lang('label.tax')</td>
                              <td class="text-right">{{ Helper::currency($amount['taxes']) }}</td>
                            </tr>
                            <tr>
                              <td class="text-right"> @lang('label.shipping_fee')</td>
                              <td class="text-right">{{ Helper::currency($amount['shipping_fee']) }}</td>
                            </tr>
                            <tr>
                              <td class="text-right"> @lang('label.discount')</td>
                              <td class="text-right" id="discount">({{ Helper::currency($amount['discount']) }})</td>
                            </tr>
                            <tr>
                              <td class="text-right"> @lang('label.total')</td>
                              <td class="text-right" id="total">{{ Helper::currency($amount['total']) }}</td>
                            </tr>
                          </thead>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="clearfix space20"></div>



<div class="modal fade" id="coupon-code" tabindex="-1" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">                   
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12 col-md-12">
                      <form class="shipping-info-wrap" id="discount-coupon-form">
                          <div class="discount">
                              <h2>Discount Codes</h2>
                              @if (!empty(LaraCart::getCoupons()))
                                @foreach (LaraCart::getCoupons() as $coupon)
                                <div class="coupon-fee" id="coupon-applied">
                                  <span class="coupon-badge">{{ $coupon->code }}
                                    <br><small class="text-center">({{ strpos($coupon->displayValue(), '%') ? $coupon->displayValue() : Helper::currency($coupon->displayValue(false, false, false)) }})</small>
                                  </span>
                                  <p class="text-primary text-center">{{ $coupon->description }}</p>
                                  <button class="btn btn-fixed btn-sm btn-circle btn-danger" type="button" data-id="{{ $coupon->code }}" id="btn-remove-coupon">
                                    <i class="fa fa-times"></i>
                                  </button>
                                </div>
                                @endforeach
                              @else                              
                                <div id="coupon-applied"></div>
                              @endif
                          </div>

                          <div class="form-list" id="form-coupon" {!! !empty(LaraCart::getCoupons()) ? 'style="display:none"' : '' !!}>
                            <label for="coupon_code">Enter your coupon code if you have one.</label>
                            <input type="hidden" value="0" id="remove-coupone" name="remove">
                            <div class="input-box">
                                <input value="" name="coupon_code" id="coupon_code" class="input-text">
                                <span class="text-danger" id="coupon-block"></span>
                            </div>
                            <div class="buttons-set">
                                <button class="btn-black" id="btn-check" title="Apply Coupon" type="button"><span><span>Apply Coupon</span></span></button>
                            </div>
                          </div>

                          

                      </form>
                  </div>                            
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

@push('css')
<link href="{{ url('backend/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<script src="{{ url('backend/plugins/moment/moment.js') }}"></script>
<script src="{{ url('backend/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ url('frontend/'.config('app.themes').'/js/pages/checkout.js') }}"></script>
@endpush