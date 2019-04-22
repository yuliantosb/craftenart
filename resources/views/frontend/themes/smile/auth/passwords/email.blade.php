@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Reset Password')

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
                        <h2 style="margin: 0 0 5px;">@lang('label.reset_your_password')</h2>
                        <p>@lang('label.type_email_to_send_a_password_link')</p>
                      </header>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                      <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <fieldset>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input required="required" type="email" placeholder="@lang('label.email_address')" class="input" name="email">

                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif

                            </div>

                            <button type="submit" class="btn-type1">@lang('label.send_password_link')</button>

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

