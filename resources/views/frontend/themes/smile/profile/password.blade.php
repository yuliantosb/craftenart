@extends('frontend.themes.'.config('app.themes').'.layouts.master')

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

                <div class="col-sm-3 col-md-2 sidebar">
                  @include('frontend.layouts.user_sidebar', ['active' => 'change_passwd'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <h2>Change Password</h2>
                    <hr>
                    <form class="bill-detail" style="width: 100% !important" id="form-change-password" action="{{ route('user.password.change') }}" method="post">
                    @csrf

                        <div class="form-group">
                            <input type="Password" name="old_password" placeholder="@lang('label.old_password') *" class="form-control" required="required">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <input type="Password" name="new_password" placeholder="@lang('label.new_password') *" class="form-control" required="required" minlength="6">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <input type="Password" name="retype_password" placeholder="@lang('label.retype_password') *" class="form-control" required="required" minlength="6">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-custom-primary" type="submit">@lang('label.change_password')</button>
                            <button class="btn btn-custom-secondary" type="reset">@lang('label.reset')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection

@push('js')

<script src="{{ url('frontend/js/profile-change-passwd.js') }}"></script>
@endpush