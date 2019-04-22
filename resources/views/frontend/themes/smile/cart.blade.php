@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Cart')

@section('content')

<style>
  body {
    overflow-x: hidden;
  }
</style>

  <div class="bcrumbs">
      <div class="container">
          <ul>
              <li><a href="#">Home</a></li>
              <li>Shopping Cart</li>
          </ul>
      </div>
  </div>

  <div class="space10"></div>

  <div class="shop-single shopping-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <table class="cart-table">
            <tbody>
              <tr>
                <th colspan="2">@lang('label.product')</th>
                <th>@lang('label.price')</th>
                <th>@lang('label.quantity')</th>
                <th>@lang('label.total')</th>
              </tr>

              @if (!empty($carts))

              @foreach ($carts as $cart)
              <tr id="row-{{ $cart->getHash() }}">
                  <td><img src="{{ url('uploads/thumbs/'.$cart->thumbnail) }}" class="img-responsive" alt="{{ $cart->name }}"></td>
                  <td>
                      <h4><a href="#">{{ $cart->name }}</a></h4>
                      <ul class="unstyled">
                      @foreach ($cart->attributes as $attribute)
                        <li>{{ $attribute['name'] }} : {{ $attribute['value'] }} </li>
                      @endforeach
                      </ul>

                  </td>
                  <td>
                      <div class="item-price">{{ Helper::currency($cart->price) }}</div>
                  </td>
                  <td>
                      <input type="text" name="id[]" value="{{ $cart->getHash() }}" hidden="hidden">
                      <select data-id="{{ $cart->getHash() }}" placeholder="1" name="qty[]" class="selectBoxIt">
                          <option value="1" {{ $cart->qty == 1 ? 'selected=selected' : '' }}>1</option>
                          <option value="2" {{ $cart->qty == 2 ? 'selected=selected' : '' }}>2</option>
                          <option value="3" {{ $cart->qty == 3 ? 'selected=selected' : '' }}>3</option>
                          <option value="4" {{ $cart->qty == 4 ? 'selected=selected' : '' }}>4</option>
                          <option value="5" {{ $cart->qty == 5 ? 'selected=selected' : '' }}>5</option>
                      </select>
                  </td>
                  <td>
                      <div class="item-price"><span id="total-{{ $cart->getHash() }}">{{ Helper::currency($cart->price * $cart->qty) }}</span><button type="button" class="btn btn-sm btn-link text-danger" name="delete" value="{{ $cart->getHash() }}"><i class="fa fa-close"></i></button></a></div>
                  </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td  colspan="5" class="text-center">@lang('label.your_cart_is_currently_empty')</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
        <div class="col-md-4">
          @if (!empty($carts))
            <div class="space20"></div>
            <div class="clearfix">
              <div class="pull-left"><h3>Shipping Info</h3></div>
              <div class="pull-right"><button type="button" id="btn-change-address" class="btn btn-sm btn-link text-primary"><i class="fa fa-pencil"></i></button></div>
            </div>
              <small>Shipping to</small>
              @if (!empty($address))
                  <p id="address-placeholder">{{ $address->address }}<br> {{ RajaOngkir::getCityAttr($address->city_id, $address->province_id) }}, {{ RajaOngkir::getProvinceAttr($address->province_id) }}, {{ $address->postal_code }}</p>
                  <div class="clearfix space20"></div>
                  <p id="title-shipping">Select Courier</p>
                  <div id="shipping-courier">
                  @if (!empty($costs))
                    @include('frontend.themes.'.config('app.themes').'.cart.partial', ['costs' => collect($costs), 'total_weight' => $weight])
                  @endif
                  </div>
              @else
              <div>
                <p class="text-danger" id="empty-address"><strong> You're not set your address yet, please add it first!</strong></p>
                <p id="address-placeholder"></p>
                <div class="clearfix space20"></div>
                <p id="title-shipping" style="display:none">Select Courier</p>
                <div id="shipping-courier">
                </div>
              </div>
              @endif
            <div class="totals">
              <table id="shopping-cart-totals-table">
                  <tbody>
                      <tr>
                          <td style="" class="a-right" colspan="1">
                              @lang('label.subtotal') &nbsp;
                          </td>
                          <td style="" class="a-right">
                              <span id="subtotal">{{ Helper::currency($amount['subtotal']) }}</span>
                          </td>
                      </tr>
                      <tr>
                          <td style="" class="a-right" colspan="1">
                            @lang('label.discount') &nbsp;
                          </td>
                          <td style="" class="a-right">
                            <span id="discount">({{ Helper::currency($amount['discount']) }})</span>
                          </td>
                      </tr>

                      <tr>
                          <td style="" class="a-right" colspan="1">
                            @lang('label.tax') &nbsp;
                          </td>
                          <td style="" class="a-right">
                            <span id="tax">{{ Helper::currency($amount['taxes']) }}</span>
                          </td>
                      </tr>

                      <tr>
                          <td style="" class="a-right" colspan="1">
                          @lang('label.shipping_fee') &nbsp;
                          </td>
                          <td style="" class="a-right">
                            <span id="shipping_fee">{{ Helper::currency($amount['shipping_fee']) }}</span>
                          </td>
                      </tr>

                      <tr>
                          <th style="" class="a-right" colspan="1">
                          @lang('label.cart_total') &nbsp;
                          </th>
                          <th style="" class="a-right">
                            <span id="total">{{ Helper::currency($amount['total']) }}</span>
                          </th>
                      </tr>

                  </tbody>
              </table>
              <ul class="checkout-types">
                  <li class="space10">
                    <a href="{{ route('checkout.index') }}" id="btn-checkout" class="btn-color {!! !session()->has('shipping') ? 'disabled" title="You must select the courier first' : '' !!}">Proceed to checkout</a>
                  </li>
              </ul>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix space50"></div>
  
    <div class="modal fade" id="modal-edit-address" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Address</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="pull-left">Add new address</div>
              <div class="pull-right"><button data-toggle="collapse" data-target="#addaddress" type="button" class="btn btn-sm btn-link text-success"><i class="fa fa-plus"></i></button></div>
            </div>
            <form id="form-add-address">
            <div class="col-sm-12">
              <div id="addaddress" class="collapse">
                <hr>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label class="control-label">Province <span class="text-danger">*</span></label>
                      <select required="required" name="province_id" class="select2 select2-front" data-placeholder="Select province">
                        <option></option>
                        @foreach ($provinces as $province)
                          <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                        @endforeach
                      </select>
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                      <label class="control-label">City <span class="text-danger">*</span></label>
                      <select required="required" name="city_id" class="select2 select2-front" data-placeholder="Select city">
                        <option></option>
                      </select>
                      <span class="help-block"></span>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Postal Code / Zip Code <span class="text-danger">*</span></label>
                      <input required="required" name="postal_code" class="form-control custom-input" placeholder="Zip/Postal Code">
                      <span class="help-block"></span>
                  </div>
                    <div class="form-group">
                      <label class="control-label">Address <span class="text-danger">*</span></label>
                      <textarea required="required" name="address" rows="5" class="form-control custom-input" placeholder="Complete address"></textarea>
                      <span class="help-block"></span>
                    </div>
                    <div class="form-group text-right">
                      <button class="btn-color" type="button" id="btn-add-new-address">Add address</button>
                    </div>
                  </div>
                </div>
                <div class="space30"></div>
              </div>
            </div>
            </form>
            <div class="col-sm-12">
              <table class="table table-hover">
                <tbody id="table-addresses">
                  @if (auth()->user()->addresses->count() > 0)
                  @foreach (auth()->user()->addresses as $address)
                  <tr>
                    <td>
                      <input type="radio" name="address" value="{{ $address->id }}">
                    </td>
                    <td>
                      {{ $address->address.', '.RajaOngkir::getCityAttr($address->city_id, $address->province_id).' '.RajaOngkir::getProvinceAttr($address->province_id) }}
                    </td>
                    <td>
                      <button class="btn btn-sm btn-link text-danger" type="button" onclick="onDelete({{ $address->id }})"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="2" class="text-center">No address yet</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="button-change-address" class="btn-color" data-dismiss="modal">Select</button>
        </div>
      </div>
    </div>
  </div>
  

@endsection

@push('js')
<script src="{{ url('frontend/'.config('app.themes').'/js/pages/cart.js') }}"></script>
@endpush