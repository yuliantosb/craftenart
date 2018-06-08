@extends('frontend.layouts.master')

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
                        <div class="col-md-12 mb20">
                            <h2>My Order</h2>
                            <table class="table table-primary table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-right">Order Total</th>
                                        <th>Transaction Status</th>
                                        <th>Fraud Status</th>
                                        <th>Payment Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($orders) > 0)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><a href="#" class="text-primary">{{ $order->number }}</a></td>
                                                <td class="text-right">{{ Helper::currency($order->total) }}</td>
                                                <td>{{ $order->transaction_status }}</td>
                                                <td>{{ $order->fraud_status }}</td>
                                                <td>{{ $order->payment_type }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No Order yet</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 mb20">
                            <h2>My Review</h2>
                            <table class="table table-primary table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rate</th>
                                        <th>Review</th>
                                        <th>Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($reviews) > 0)
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>{{ $review->rate }}</td>
                                                <td>{{ $review->content }}</td>
                                                <td>{{ $review->product->name }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-center">No Review yet</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 mb20">
                            <h2>My Wishlist</h2>
                            <table class="table table-primary table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">No Wishlist yet</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection