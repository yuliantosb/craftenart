@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Checkout Complete')

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

<div class="shop-single">
    <div class="container">
        <div class="row">
            @if (session()->get('checkout')['status'] == 'success')
            <div class="col-md-12 text-center">
                
                    <h4>Your order is Success!</h4>
                    <span class="circle-badge alert-success"><i class="fa fa-check"></i></span>
                    <p>{{ session()->get('checkout')['message'] }}</p>
                    <div class="space100"></div>
            </div>
            <div class="col-md-6">
                    <h4 class="account-title"><span class="fa fa-chevron-right"></span>Shipping Details</h4>
                    <div class="space30"></div>
                    <table class="table">
                    <tbody>
                        <tr>
                            <th>Shipping To</th>
                            <td>{{ session()->get('checkout')['order']->ship->full_name }}</td>
                            <th>Shipping Phone Number</th>
                            <td>{{ session()->get('checkout')['order']->ship->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Address</th>
                            <td>{!! nl2br(session()->get('checkout')['order']->ship->address) !!}, 
                                {{ RajaOngkir::getCityAttr(session()->get('checkout')['order']->ship->city_id, session()->get('checkout')['order']->ship->province_id) }} 
                                {{ RajaOngkir::getProvinceAttr(session()->get('checkout')['order']->ship->province_id) }}, {{ session()->get('checkout')['order']->ship->zip }}
                            </td>
                            <th>Courier Details </th>
                            <td>{{ session()->get('checkout')['order']->ship->courier_id }}<br> {{ session()->get('checkout')['order']->ship->service_name }} ({{ session()->get('checkout')['order']->ship->service_description }}) <br>
                            {{ session()->get('checkout')['order']->ship->estimate_delivery }} (Days)</td>
                        </tr>
                    </table>
                </div>
            
            <div class="col-md-6">
                <h4 class="account-title"><span class="fa fa-chevron-right"></span>Order Details</h4>
                <p class="text-primary text-right"><strong>Order # : {{ session()->get('checkout')['order']->number }}</strong></p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td><strong>Bank Name</strong></td>
                            <td>{{ session()->get('checkout')['order']->bank_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Payment Type</strong></td>
                            <td>{{ session()->get('checkout')['order']->payment_type }}</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                        <tbody>
                            @foreach (session()->get('checkout')['order']->details as $order_details)
                            <tr>
                                <td>
                                    {{ $order_details->product->name }}
                                    @if (!empty($order_details->attributes))
                                    <ul style="font-size: .5em">
                                        @foreach ($order_details->attributes as $attr)
                                        <li>{{ $attr->name }} : {{ $attr->value }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </td>
                                <td class="text-right">{{ Helper::currency($order_details->price) }} (x{{ $order_details->qty }})</td>
                                <td class="text-right">{{ Helper::currency($order_details->price * $order_details->qty) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="2">Subtotal</th>
                                <th class="text-right">{{ Helper::currency(session()->get('checkout')['order']->subtotal) }} </th>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="2">Tax</th>
                                <th class="text-right">{{ Helper::currency(session()->get('checkout')['order']->tax) }} </th>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="2">Discount</th>
                                <th class="text-right">({{ Helper::currency(session()->get('checkout')['order']->discount) }}) </th>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="2">Shipping Fee</th>
                                <th class="text-right">{{ Helper::currency(session()->get('checkout')['order']->ship->cost) }} </th>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="2">Total</th>
                                <th class="text-right">{{ Helper::currency((session()->get('checkout')['order']->subtotal + session()->get('checkout')['order']->tax + session()->get('checkout')['order']->ship->cost ) - session()->get('checkout')['order']->discount ) }} </th>
                            </tr>
                        </tbody>
                    </thead>
                </table>
            </div>
            @else

            <div class="col-md-12 text-center">
                
                    <h4>Your order is Failed!</h4>
                    <span class="circle-badge alert-danger"><i class="fa fa-times"></i></span>
                    <p>{{ session()->get('checkout')['message'] }}</p>
                    <div class="space100"></div>
            </div>

            @endif

            <div class="col-md-12 text-center">
                <div class="space50"></div>
                <a class="btn-black" href="{{ url('/') }}">Back to Home</a>
            </div>
        </div>
    </div>
</div>

<div class="space100"></div>

@endsection
