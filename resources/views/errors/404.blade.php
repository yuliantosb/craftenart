@extends('frontend.layouts.master_error')

@section('title', '404 Not Found')

@section('content')

<section class="mt-error-sec style3">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="error-holder pull-right">
          <h1 class="text-uppercase montserrat">@lang('label.404')</h1>
          <div class="txt">
            <p class="text-muted">@lang('label.404_desc')</p>
          </div>
          <a href="{{ route('home') }}" class="btn-back text-uppercase">@lang('label.back_to_home')</a>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <span class="error-code2 montserrat">404</span>
      </div>
    </div>
  </div>
</section>

@endsection