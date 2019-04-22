@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Login')

@section('content')

<div class="bcrumbs">
  <div class="container">
      <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Login</li>
      </ul>
  </div>
</div>

<div class="space10"></div>

<div class="account-wrap">
  <div class="container">
      <div class="row">
          <div class="col-sm-6 col-md-6">
              <!-- HTML -->
              <div id="account-id">
                  <h4 class="account-title"><span class="fa fa-chevron-right"></span>@lang('label.signin')</h4> 
                  <div class="account-form">
                      @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" style="right: 0px !important">&times;</a>
                          <strong>Error!</strong> {{ session()->get('error') }}
                        </div>
                      @endif
                      <form class="form-login" action="{{ route('login') }}" method="post" id="form-login">
                        @csrf
                          <ul class="form-list row">
                              <li class="col-md-6 col-sm-12"> 
                                  <a href="{{ route('login.provider', 'facebook') }}" class="btn facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                              </li>
                              <li class="col-md-6 col-sm-12"> 
                                  <a href="{{ route('login.provider', 'google') }}" class="btn twitter"><i class="fa fa-google"></i>Sign in with Google</a>
                              </li>
                              <li class="col-md-12 col-sm-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label>@lang('label.email_address') <em>*</em></label>
                                  <input required="" type="email" class="input-text" name="email" value="{{ old('email') }}">
                                  <span class="help-block"></span>
                                  @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                      {{ $errors->first('email') }}
                                    </span>
                                  @endif
                              </li>
                              <li class="col-md-12 col-sm-12 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label>@lang('label.password') <em>*</em></label>
                                  <input required="" type="password" class="input-text" name="password" value="{{ old('password') }}">
                                  <span class="help-block"></span>
                                  @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                      {{ $errors->first('password') }}
                                    </span>
                                  @endif
                              </li> 
                              <li class="col-md-6 col-sm-12">                                                
                                  <input class="input-chkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
                                  <label>@lang('label.remember_me')</label>
                              </li>
                              <li class="col-md-6 col-sm-12 pwd text-right">
                                  <label> <a href="{{ route('password.request') }}"> @lang('label.forgot_password') </a> </label>                                               
                              </li>
                          </ul>
                          <div class="buttons-set">
                              <button class="btn-black" type="submit"><span>@lang('label.login')</span></button>
                          </div>
                      </form>
                  </div>                                    
              </div>
          </div>

          <div class="col-sm-6 col-md-6">
              <!-- HTML -->
              <div id="account-id2">
                  <h4 class="account-title"><span class="fa fa-chevron-right"></span>@lang('label.register')</h4>                                                                  
                  <div class="account-form">
                    <form class="form-login" action="{{ route('register') }}" method="post" id="form-register">
                      @csrf
                      <ul class="form-list row">

                        <li class="col-md-12 col-sm-12 form-group">
                          <label>@lang('label.fullname') <em>*</em></label>
                          <input type="text" class="input" name="name" required="required">
                          <span class="help-block"></span>
                        </li>

                        <li class="col-md-12 col-sm-12 form-group">
                            <label>@lang('label.email_address') <em>*</em></label>
                            <input required="" type="email" class="input-text" name="email" value="">
                            <span class="help-block"></span>
                        </li>

                        <li class="col-md-12 col-sm-12 form-group">
                          <label>@lang('label.password') <em>*</em></label>
                          <input type="password" minlength="6" placeholder="" class="input" name="password" required="required">
                          <span class="help-block"></span>
                        </li>

                        <li class="col-md-12 col-sm-12 form-group">
                          <label>@lang('label.retype_password') <em>*</em></label>
                          <input type="password" minlength="6" placeholder="" class="input" name="password_confirmation" required="required">
                          <span class="help-block"></span>
                        </li>

                      </ul>
                      <div class="buttons-set">
                          <button class="btn-black" type="submit"><span>@lang('label.register')</span></button>
                      </div>
                    </form>
                  </div>                                    
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

@push('js')
  <script src="{{ url('frontend/'.config('app.themes').'/js/pages/login.js') }}"></script>
@endpush