@extends('frontend.layouts.master')

@section('title', 'Testing')

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
                  @include('frontend.layouts.user_sidebar', ['active' => 'testing'])
                </div>

                <div class="col-sm-9 col-md-10">
                  <div class="row">
                    <div class="col-md-12">
                      <h2>Paypal</h2>
                      <hr>
                      <table class="table table-primary">
                        <thead>
                          <tr>
                            <th>Email</th>
                            <th>Password</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>razaq.hakim@yahoo.co.id</td>
                            <td>razaq123</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12">
                      <h2>Midtrans</h2>
                      <hr>
                      <table class="table table-primary">
                        <thead>
                        <tr>
                        <th>
                        Status
                        </th>
                        <th>
                        Visa
                        </th>
                        <th>
                        Master
                        </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td>
                        Accept Transaction
                        <ul class="list-style">
                        <li>
                        Full Authentication (3DS)
                        </li>
                        <li>
                        Attempted Authentication (3DS)
                        </li>
                        <li>
                        Normal Transaction
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        4811 1111 1111 1114
                        </li>
                        <li>
                        4411 1111 1111 1118
                        </li>
                        <li>
                        4011 1111 1111 1112
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        5810 1111 1111 1112
                        </li>
                        <li>
                        5410 1111 1111 1116
                        </li>
                        <li>
                        5010 1111 1111 1110
                        </li>
                        </ul>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        Challenge Transaction
                        <ul class="list-style">
                        <li>
                        Full Authentication (3DS)
                        </li>
                        <li>
                        Attempted Authentication (3DS)
                        </li>
                        <li>
                        Normal Transaction
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        None
                        <sup>(1)</sup>
                        </li>
                        <li>
                        4511 1111 1111 1117
                        </li>
                        <li>
                        4111 1111 1111 1111
                        </li>
                        </ul>
                        <br>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        None
                        <sup>(1)</sup>
                        </li>
                        <li>
                        5510 1111 1111 1115
                        </li>
                        <li>
                        5110 1111 1111 1119
                        </li>
                        </ul>
                        <br>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        Deny by Bank Transaction
                        <ul class="list-style">
                        <li>
                        Full Authentication (3DS)
                        </li>
                        <li>
                        Attempted Authentication (3DS)
                        </li>
                        <li>
                        Normal Transaction
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        4911 1111 1111 1113
                        </li>
                        <li>
                        4711 1111 1111 1115
                        </li>
                        <li>
                        4311 1111 1111 1119
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        5910 1111 1111 1111
                        </li>
                        <li>
                        5710 1111 1111 1113
                        </li>
                        <li>
                        5310 1111 1111 1117
                        </li>
                        </ul>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        Deny by Bank FDS Transaction
                        <ul class="list-style">
                        <li>
                        Full Authentication (3DS)
                        </li>
                        <li>
                        Attempted Authentication (3DS)
                        </li>
                        <li>
                        Normal Transaction
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        None
                        <sup>(1)</sup>
                        </li>
                        <li>
                        4611 1111 1111 1116
                        </li>
                        <li>
                        4211 1111 1111 1110
                        </li>
                        </ul>
                        </td>
                        <td>
                        <br>
                        <ul>
                        <li>
                        None
                        <sup>(1)</sup>
                        </li>
                        <li>
                        5610 1111 1111 1114
                        </li>
                        <li>
                        5210 1111 1111 1118
                        </li>
                        </ul>
                        </td>
                        </tr>
                        </tbody>
                        </table>

                        <div class="text-right">
                          <h2><a href="http://docs.midtrans.com/en/reference/test.html" target="_blank">More Testing here</a></h2>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <h2>Coupon</h2>
                        <hr>
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th>Coupon Code</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>EXPIREDCOUPON</td>
                                    <td>Coupon Expired</td>
                                </tr>
                                <tr>
                                    <td>FREE5USD</td>
                                    <td>Free $5</td>
                                </tr>
                                <tr>
                                    <td>FREE10%</td>
                                    <td>Free 10%</td>
                                </tr>
                                <tr>
                                    <td>MAXAMOUNT5</td>
                                    <td>Max amount $5</td>
                                </tr>
                                <tr>
                                    <td>MINAMOUNT20</td>
                                    <td>Min amount $20</td>
                                </tr>
                                <tr>
                                    <td>SINGLECOUPON</td>
                                    <td>Coupon can only applied once</td>
                                </tr>
                                <tr>
                                    <td>SPECIALUSERONLY</td>
                                    <td>Coupon only apply to special user</td>
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