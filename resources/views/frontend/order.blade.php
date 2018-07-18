@extends('frontend.layouts.master')

@section('title', 'Order')

@section('content')

<main id="mt-main">

    <section class="mt-detail-sec toppadding-zero">

        <div class="container faq-section mt-about-sec">
            <div class="row">

                <div class="col-sm-3 col-md-2 sidebar">
                  @include('frontend.layouts.user_sidebar', ['active' => 'order'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach ($orders as $order)
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $order->id }}" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                    <div class="clearfix">
                                        <div class="pull-left">#{{ $order->number }}</div>
                                        <div class="pull-right"><span class="order-badge {{ $order->status_transaction['label'] }}">{{ $order->status_transaction['status'] }}</span></div>
                                    </div>
                                  </a>
                                </h4>
                              </div>
                              <div id="{{ $order->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <table class="table table-primary">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.payment_date')</th>
                                                    <th>@lang('label.payment_type')</th>
                                                    <th>@lang('label.status')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>{{ Carbon\Carbon::parse($order->payment_date)->format('F jS, Y') }}</th>
                                                    <th>{{ $order->payment_type }}</th>
                                                    <th>{{ $order->transaction_status_detail }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h2>@lang('label.order_details')</h2>
                                        <hr>
                                        <table class="table table-primary">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.product_name')</th>
                                                    <th class="text-right">@lang('label.price')</th>
                                                    <th class="text-center">@lang('label.qty')</th>
                                                    <th class="text-right">@lang('label.subtotal')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->details as $details)
                                                <tr>
                                                    <th>{{ $details->product->name }}</th>
                                                    <th class="text-right">{{ Helper::currency($details->price) }}</th>
                                                    <th class="text-center">{{ $details->qty }}</th>
                                                    <th class="text-right">{{ Helper::currency($details->price * $details->qty) }}</th>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <th colspan="3" class="text-right">@lang('label.subtotal')</th>
                                                    <th class="text-right">{{ Helper::currency($order->subtotal) }}</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">@lang('label.tax')</th>
                                                    <th class="text-right">{{ Helper::currency($order->tax) }}</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">@lang('label.discount')</th>
                                                    <th class="text-right">({{ Helper::currency($order->discount) }})</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">@lang('label.shipping_fee')</th>
                                                    <th class="text-right">{{ Helper::currency($order->ship->cost) }}</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">@lang('label.total')</th>
                                                    <th class="text-right">
                                                        {{-- Helper::currency($order->total) --}}
                                                        {{ Helper::currency(($order->subtotal + $order->tax + $order->ship->cost ) - $order->discount ) }}
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <h2>@lang('label.shipping_details')</h2>
                                        <hr>

                                        <table class="table table-primary table-top">
                                            <thead>
                                                @if (!empty($order->ship->receipt_number))
                                                <tr>
                                                    <th><strong>@lang('label.receipt_number')</strong></th>
                                                    <th>{{ $order->ship->receipt_number }}</th>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <th><strong>@lang('label.shipping_to')</strong></th>
                                                    <th>{{ $order->ship->first_name.' '.$order->ship->last_name }}</th>
                                                </tr>
                                                <tr>
                                                    <th><strong>@lang('label.shipping_phone_number')</strong></th>
                                                    <th>
                                                        {{ $order->ship->phone_number }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><strong>@lang('label.shipping_address')</strong></th>
                                                    <th>
                                                        {!! nl2br($order->ship->address) !!}
                                                        <br>
                                                        {{ RajaOngkir::getCityAttr($order->ship->city_id, $order->ship->province_id) }}
                                                        <br>
                                                        {{ RajaOngkir::getProvinceAttr($order->ship->province_id) }}
                                                        <br>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><strong>@lang('label.courier_details')</strong></th>
                                                    <th>
                                                        {{ strtoupper($order->ship->courier_id) }}
                                                        <br>
                                                        {{ $order->ship->service_name }} ({{ $order->ship->service_description }})
                                                        <br>
                                                        {{ $order->ship->estimate_delivery }} (@lang('label.days'))
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                              </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="text-center">
                            {{ $orders->links('vendor.pagination.custom') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection