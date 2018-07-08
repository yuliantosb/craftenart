@extends('frontend.layouts.master_error')

@section('title', '401 Unauthorize')

@section('content')

<section class="mt-error-sec style3">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="error-holder pull-right">
          <h1 class="text-uppercase montserrat">UNAUTHORIZE!</h1>
          <div class="txt">
            <p>Whoops..!! Hold on dude, you are not supposed to here, are you trying to explore beyond your limit, give it up now!</p>
          </div>
          <a href="{{ route('home') }}" class="btn-back text-uppercase">BACK TO HOME</a>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <span class="error-code2 montserrat">401</span>
      </div>
    </div>
  </div>
</section>

@endsection