@extends('frontend.layouts.master_error')

@section('title', '401 Unauthorize')

@section('content')

<section class="mt-error-sec style3">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="error-holder pull-right">
          <h1 class="text-uppercase montserrat">@lang('label.403')</h1>
          <div class="txt">
            <p>@lang('label.403_desc')</p>
          </div>
          <a href="{{ route('home') }}" class="btn-back text-uppercase">@lang('label.back_to_home')</a>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <span class="error-code2 montserrat">401</span>
      </div>
    </div>
  </div>
</section>

@endsection