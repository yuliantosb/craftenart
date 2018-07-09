@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-wallet"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Total income this month</p>
                                    {{ Helper::currency($order->sum('total')) }}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('admin.order.index') }}"><i class="ti-angle-right"></i> See all orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Total users right now</p>
                                    {{ count($users) }}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('admin.user.index') }}"><i class="ti-angle-right"></i> See all users</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>New Order</p>
                                    {{ count($orders) }}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('admin.order.index') }}"><i class="ti-angle-right"></i> See all orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="col-md-8">
                            <h4 class="title">Most using payment</h4>
                            <p class="category">Payment method most used</p>
                        </div>
                        <div class="col-md-4">
                            <select name="year" class="select2">
                                @for ($i = $years['sub']->format('Y'); $i <= $years['add']->format('Y'); $i++)
                                <option value="{{ $i }}" {{ Carbon\Carbon::now()->format('Y') == $i ? 'selected=selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="content">
                        <!-- <div id="loading" class="loading"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div> -->
                        <div id="chart-payment" class="ct-chart"></div>

                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <div class="chart-legend">
                                    <ul>
                                        <li><i class="fa fa-circle" style="color: #00b894"></i>Paypal</li>
                                        <li><i class="fa fa-circle" style="color: #00cec9"></i>Credit Card</li>
                                        <li><i class="fa fa-circle" style="color: #0984e3"></i>BCA Klik Pay</li>
                                        <li><i class="fa fa-circle" style="color: #6c5ce7"></i>Klik BCA</li>
                                        <li><i class="fa fa-circle" style="color: #fdcb6e"></i>BRI E-Pay</li>
                                        <li><i class="fa fa-circle" style="color: #e17055"></i>CIMB Clicks</li>
                                        <li><i class="fa fa-circle" style="color: #d63031"></i>Mandiri Click Pay</li>
                                        <li><i class="fa fa-circle" style="color: #e84393"></i>Telkomsel Cash</li>
                                        <li><i class="fa fa-circle" style="color: #f1c40f"></i>XL Tunai</li>
                                        <li><i class="fa fa-circle" style="color: #e67e22"></i>Mandiri Bill</li>
                                        <li><i class="fa fa-circle" style="color: #e74c3c"></i>Indosat Dompetku</li>
                                        <li><i class="fa fa-circle" style="color: #f39c12"></i>Mandiri e-cash</li>
                                        <li><i class="fa fa-circle" style="color: #d35400"></i>Indomaret</li>
                                        <li><i class="fa fa-circle" style="color: #c0392b"></i>Gift Card Indonesia</li>
                                        <li><i class="fa fa-circle" style="color: #16a085"></i>Danamon Online</li>
                                        <li><i class="fa fa-circle" style="color: #2980b9"></i>Bank Transfer</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">5 Top Sell</h4>
                        <p class="category">5 porducts top sell</p>
                    </div>
                    <div class="content">
                        <div id="chart-top-product" class="ct-chart ct-perfect-fourth"></div>

                        <div class="footer">

                            <hr>
                            <div class="stats">
                                <a href="#"><i class="fa fa-angle-right"></i> Go to product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Run out stock</h4>
                        <p class="category">Product with less stock</p>
                    </div>
                    <div class="content">
                        <div class="ct-chart ct-perfect-fourth" style="overflow-y: scroll;">
                            <table class="table table-primary" class="table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product Name</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $stock)
                                        <tr {{ $stock->amount < 1 ? ' class=alert-danger' : '' }}>
                                            <td><img src="{{ url('uploads/thumbs/'.$stock->product->picture) }}" style="width: 50px" class="img img-circle"></td>
                                            <td>{{ $stock->product->name }}</td>
                                            <th>{{ $stock->amount }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="footer">

                            <hr>
                            <div class="stats">
                                <a href="#"><i class="fa fa-angle-right"></i> Go to stock</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-8">
                            <h4 class="title">Order status</h4>
                            <p class="category">Display order status</p>
                        </div>
                        <div class="col-md-4">
                            <select name="year_order_status" class="select2">
                                @for ($i = $years['sub']->format('Y'); $i <= $years['add']->format('Y'); $i++)
                                <option value="{{ $i }}" {{ Carbon\Carbon::now()->format('Y') == $i ? 'selected=selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="content">
                        <div id="chart-order-status" class="ct-chart ct-perfect-fourth"></div>

                        <div class="footer">

                            <hr>
                            <div class="stats">
                                <a href="#"><i class="fa fa-angle-right"></i> Go to order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">New Review</h4>
                        <p class="category">Review need approval</p>
                    </div>
                    <div class="content">
                        <div class="ct-chart ct-perfect-fourth" style="overflow-y: scroll;">
                            <table class="table table-primary" class="table-responsive table-review">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($reviews) > 0)

                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td><img src="{{ url('uploads/thumbs/'.$review->product->picture) }}" style="width: 50px" class="img img-circle"></td>
                                                <td>{{ $review->user->name }}</td>
                                                <th style="width: 100px !important">{!! Helper::getRate($review->rate) !!}</th>
                                                <th>{{ substr($review->content, 0, 10) }} ...</th>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No new review yet</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="footer">

                            <hr>
                            <div class="stats">
                                <a href="#"><i class="fa fa-angle-right"></i> Go to review</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
@endsection

@push('js')
<script src="{{ url('backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ url('backend/plugins/morris/morris.min.js') }}"></script>
<script src="{{ url('backend/js/pages/dashboard.js') }}"></script>
@endpush