@extends('frontend.layouts.master')

@section('title', 'Payment')

@section('content')

<div class="mt-main">
	<section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        <div class="row">
        	<div class="col-md-12">
				<h1>Credit / Debit Card</h1>
				
			</div>
		</div>
	</div>
</div>

@endsection


@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" rel="stylesheet">
<link href="https://staging.doku.com/doku-js/assets/css/doku.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://staging.doku.com/doku-js/assets/js/doku.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
@endpush