@extends('frontend.layouts.master')

@section('title', '404 Not Found')

@section('content')

<section class="mt-error-sec dark style3">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="error-holder pull-right">
          <h1 class="text-uppercase montserrat">NOT FOUND!</h1>
          <div class="txt">
            <p class="text-muted">The page you are looking for was moved, <br>removed, renamed or might never existed.</p>
          </div>
          <a href="{{ route('home') }}" class="btn-back text-uppercase">BACK TO HOME</a>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <span class="error-code2 montserrat">404</span>
      </div>
    </div>
  </div>
</section>

@endsection