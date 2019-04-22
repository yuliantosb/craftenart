@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Dashboard')

@section('content')

<main id="mt-main">
	<section class="mt-about-sec" style="padding-bottom: 0;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="txt">
            
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-detail-sec toppadding-zero">

        <div class="container">
            <div class="row">

                <div class="col-sm-3 col-md-2 sidebar">
                  @include('frontend.layouts.user_sidebar', ['active' => 'dashboard'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">
                        <div class="col-md-3">

                            <div class="card">
                                <img src="{{ $user->cust->picture }}" class="img img-responsive">
                                <div class="container-card">
                                    <h1>{{ $user->name }}</h1>
                                    <p class="bio">{{ $user->cust->bio }}</p>
                                    <div class="social-media">
                                        <ul>

                                            @if (!empty($user->cust->facebook_url))
                                            <li>
                                                <a href="{{ $user->cust->facebook_url }}"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            @endif
                                            @if (!empty($user->cust->twitter_url))
                                            <li>
                                                <a href="{{ $user->cust->twitter_url }}"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            @endif
                                            @if (!empty($user->cust->instagram_url))
                                            <li>
                                                <a href="{{ $user->cust->instagram_url }}"><i class="fa fa-instagram"></i></a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-9">
                           <div class="row">
                                <div class="col-md-6">
                                    <h2>@lang('label.recent_order')</h2>
                                    <hr>
                                    <div class="recent-order">

                                        @if (count($orders) > 0)
                                            
                                            @foreach ($orders as $order)
                                                <a href="#" class="wrapper">
                                                    <span class="order-badge {{ $order->status_transaction['label'] }}">{{ $order->status_transaction['status'] }}</span>
                                                    <span class="text-muted">#{{ $order->number }}</span>
                                                </a>
                                            @endforeach
                                            
                                            <div class="text-right">
                                                <a href="{{ route('user.order.index') }}"><strong><i class="fa fa-angle-right"></i>&nbsp;@lang('label.see_all')</strong></a>
                                            </div>

                                        @else
                                            <p class="text-muted">
                                                <i class="fa fa-times"></i>
                                                @lang('label.no_orders_yet')
                                            </p>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <h2>@lang('label.latest_review')</h2>
                                    <hr>

                                    @if (count($reviews) > 0)

                                    @foreach ($reviews as $review)

                                        <div class="review-wrapper">
                                            <img src="{{ url('uploads/thumbs/'.$review->product->picture) }}">
                                            <div class="review-text">
                                                <p class="review-title">{{ $review->product->name }}</p>
                                                <div class="product-comment">
                                                   {!! Helper::getRate($review->rate, ['class' => 'mt-star']) !!}
                                                </div>
                                                <p class="review-content">{{ substr($review->content, 0, 25) }} ...</p>
                                            </div>
                                        </div>

                                    @endforeach

                                    <div class="text-right">
                                      <a href="{{ route('user.review.index') }}"><strong><i class="fa fa-angle-right"></i>&nbsp;@lang('label.see_all')</strong></a>
                                    </div>

                                    @else
                                    <p class="text-muted">
                                        <i class="fa fa-times"></i>
                                        @lang('label.no_reviews_yet')
                                    </p>
                                    @endif
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