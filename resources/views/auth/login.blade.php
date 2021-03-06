@extends('frontend.layouts.master')

@section('title', 'Login')

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
                <div class="col-md-12">
                    <div class="holder" style="margin: 0;">
                        <div class="mt-side-widget">
                          <div class="row">
                            <div class="col-md-6">
                                <header>
                                    <h2 style="margin: 0 0 5px;">@lang('label.signin')</h2>
                                    <p>@lang('label.welcome_message')</p>
                                </header>

                                @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close" style="right: 0px !important">&times;</a>
                                  <strong>Error!</strong> {{ session()->get('error') }}
                                </div>
                                @endif

                                <form action="{{ route('login') }}" method="post">
                                  @csrf
                                    <fieldset>
                                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" placeholder="@lang('label.email_address')" class="input" name="email">
                                        @if ($errors->has('email'))
                                          <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                        @endif
                                      </div>

                                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input type="password" placeholder="@lang('label.password')" class="input" name="password">
                                        @if ($errors->has('password'))
                                          <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                        @endif
                                      </div>


                                      <div class="box">
                                        <span class="left"><input class="checkbox" type="checkbox" name="remember" id="check" {{ old('remember') ? 'checked' : '' }} ><label for="check">@lang('label.remember_me')</label></span>
                                        <a href="{{ route('password.request') }}" class="help">@lang('label.forgot_password')</a>
                                      </div>
                                      <button type="submit" class="btn-type1">@lang('label.login')</button>
                                    </fieldset>
                                </form>
                              </div>

                              <div class="col-md-6">
                                <header>
                                <h2 style="margin: 0 0 5px;">@lang('label.dont_have_account')</h2>
                                <p>@lang('label.register_here')</p>
                                </header>

                                <form action="{{ route('register') }}" method="post" id="form-register">
                                  @csrf
                                    <fieldset>

                                      <div class="form-group">
                                        <input type="text" placeholder="@lang('label.fullname')" class="input" name="name" required="required">
                                        <span class="help-block"></span>
                                      </div>


                                      <div class="form-group">
                                        <input type="text" placeholder="@lang('label.email_address')" class="input" name="email" required="required">
                                        <span class="help-block"></span>
                                      </div>

                                      <div class="form-group">
                                        <input type="password" placeholder="@lang('label.password')" class="input" name="password" required="required">
                                        <span class="help-block"></span>
                                      </div>

                                      <div class="form-group">
                                        <input type="password" placeholder="@lang('label.retype_password')" class="input" name="password_confirmation" required="required">
                                        <span class="help-block"></span>
                                      </div>

                                      <button type="submit" class="btn-type1">@lang('label.register')</button>
                                      <hr>
                                      <div class="text-center">
                                        <p style="margin-bottom: 20px">@lang('label.or') <br> @lang('label.login_by_social_network')</p>
                                        <fieldset class="text-center m-t-10">
                                          <a class="btn-type1" style="background-color: #d34836" href="{{ route('login.provider', 'google') }}"><i class="fa fa-google-plus" style="margin-right: 5px"></i> Google</a>
                                          <a class="btn-type1" style="background-color: #3B5998" href="{{ route('login.provider', 'facebook') }}"><i class="fa fa-facebook" style="margin-right: 5px"></i> Facebook</a>
                                        </fieldset>

                                      </div>

                                    </fieldset>
                                </form>
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

@push('js')
  <script src="{{ url('frontend/js/login.js') }}"></script>
@endpush