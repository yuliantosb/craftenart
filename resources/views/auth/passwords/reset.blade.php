@extends('frontend.layouts.master')

@section('title', 'Change Password')

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
              <div class="col-xs-12 col-sm-8 col-sm-push-2">
                <div class="holder" style="margin: 0;">
                    <div class="mt-side-widget">
                      <header>
                        <h2 style="margin: 0 0 5px;">Change your password</h2>
                        <p>Type new password to change</p>
                      </header>
                      <form method="POST" action="{{ route('password.request') }}">
                        @csrf
                        <fieldset>
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" placeholder="Email address" class="input" name="email" required="required">

                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" placeholder="New password" class="input" name="password" required="required">

                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input type="password" placeholder="Re-Type new password" class="input" name="password_confirmation" required="required">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif

                            </div>

                            <button type="submit" class="btn-type1">Change Password</button>

                        </fieldset>
                      </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</main>

@endsection