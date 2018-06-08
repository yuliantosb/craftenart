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
                  <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Order &nbsp; <span class="badge">2</span></a></li>
                    <li><a href="#">Testing</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Settings</a></li>
                  </ul>
                 
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">
                        <div class="col-md-10">

                            <div class="col-md-12">
                                <div class="pull-left">
                                	<h1>Joel Doe</h1>
                                	<p class="text-muted">joeldoe@gmail.com</p>
                                </div>

                                <div class="pull-right">
                                    <a href="#" class="btn btn-custom" data-toggle="tooltip" title="Edit Profile"><i class="fa fa-pencil"></i></a>
                                </div>
                            </div>

                        	<div class="row">
                        		<div class="col-md-6">
                        			<table class="table">
                        				<tr>
                        					<td><strong>Idendity Number</strong></td>
                        					<td>181817161511</td>
                        				</tr>

                        				<tr>
                        					<td><strong>Phone Number</strong></td>
                        					<td>089611081675</td>
                        				</tr>

                        				<tr>
                        					<td><strong>Place of Birth</strong></td>
                        					<td>Karawang</td>
                        				</tr>

                        				<tr>
                        					<td><strong>Date of Birth</strong></td>
                        					<td>July 13th 1995</td>
                        				</tr>

                        			</table>
                        		</div>

                        		<div class="col-md-6">
                        			<table class="table">
                        				<tr>
                        					<td><strong>Country</strong></td>
                        					<td>Indonesia</td>
                        				</tr>

                        				<tr>
                        					<td><strong>Province</strong></td>
                        					<td>Jawa Barat</td>
                        				</tr>

                        				<tr>
                        					<td><strong>City</strong></td>
                        					<td>Karawang</td>
                        				</tr>

                        				<tr>
                        					<td><strong>Address</strong></td>
                        					<td>
                        					Jl. Cariu - Loji Desa Cintasih RT 07 RW 04 No. 25 <br>
                        					Kec. Pangkalan
                        					<br>
                        					41362
                        					</td>
                        				</tr>

                        			</table>
                        		</div>

                        	</div>
                        </div>

                        <div class="col-md-2 text-center">
                        	<img src="{{ Gravatar::get('yulianto.saparudin@gmail.com') }}" class="img img-circle" style="width: 100px; display: inline-block;">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

@endsection