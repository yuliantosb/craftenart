@extends('frontend.layouts.master')

@section('title')
  Payment {{ $status }} 
@endsection

@section('content')

<main id="mt-main">

    <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(&quot;http://placehold.it/1920x205&quot;); visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center">
            <h1>ORDER COMPLETE</h1>
            <!-- Breadcrumbs of the Page -->
            <nav class="breadcrumbs">
              <ul class="list-unstyled">
                <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                <li><a href="product-detail.html">Products <i class="fa fa-angle-right"></i></a></li>
                <li>Chairs</li>
              </ul>
            </nav><!-- Breadcrumbs of the Page end -->
          </div>
        </div>
      </div>
    </section>


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
              <li class="active">
                <span class="counter">03</span>
                <strong class="title">Order Complete</strong>
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
                                        @if ($type == 'Finish') 
                                          <p class="text-success">
                                            <i class="fa fa-check-circle fa-3x"></i>
                                          </p>
                                        @elseif ($type == 'Unfinish')
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
                                      <h2 style="margin: 0 0 5px;">Your Payment is {{ $type }}!</h2>
                                      <p>
                                      {{ $message }}
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