@extends('frontend.layouts.master')

@section('title')
  Payment {{ session()->get('message')['status'] }} 
@endsection

@section('content')

<main id="mt-main">

   @include('frontend.layouts.placeholder', [
      'placeholder_title' => 'Payment',
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
        ],
        [
          'name' => trans('label.payment'),
          'url' => '/payment'
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
              <li class="active">
                <span class="counter">03</span>
                <strong class="title">@lang('label.order_complete')</strong>
              </li>
            </ul>
            <!-- Process List of the Page end -->
          </div>
        </div>
      </div>
    </div><!-- Mt Process Section of the Page end -->

    <section class="mt-detail-sec toppadding-zero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="holder" style="margin: 0;">
                        <div class="mt-side-widget">
                          <div class="row">
                            <div class="col-md-12">
                                <header>
                                    <div class="col-xs-1 text-center">
                                        @if (strtolower(session()->get('message')['status']) == 'finish') 
                                          <p class="text-success">
                                            <i class="fa fa-check-circle fa-3x"></i>
                                          </p>
                                        @elseif (strtolower(session()->get('message')['status']) == 'unfinish')
                                          <p class="text-warning">
                                            <i class="fa fa-exclamation-circle fa-3x"></i>
                                          </p>
                                        @else
                                          <p class="text-danger">
                                            <i class="fa fa-times-circle fa-3x"></i>
                                          </p>
                                        @endif
                                    </div>
                                    <div class="col-xs-11">
                                      <h2 style="margin: 0 0 5px;">Your Payment is {{ session()->get('message')['status'] }}!</h2>
                                      <p>
                                      {!! session()->get('message')['content'] !!}
                                      </p>
                                    </div>
                                </header>
                                
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection


  @push('js')
    <script type="text/javascript">
      window.dataLayer = window.dataLayer || []
      dataLayer.push({
         'transactionId': "{{ $order->number }}",
         'transactionAffiliation': "{{ config('app.name') }}",
         'transactionTotal': {{ Helper::getCurrency($order->total, 'usd') }},
         'transactionTax': {{ Helper::getCurrency($order->tax, 'usd') }},
         'transactionShipping': {{ Helper::getCurrency($order->shipping_fee, 'usd') }},
         'transactionProducts': {!! collect($order_details)->toJson() !!},
         'event' : 'transactionComplete'
      });
    </script>
  @endpush
