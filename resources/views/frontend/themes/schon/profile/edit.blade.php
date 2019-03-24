@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Edit Profile')

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
                  @include('frontend.layouts.user_sidebar', ['active' => 'profile'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">

                        <form class="bill-detail" style="width: 100% !important" method="post" action="{{ route('user.profile.update') }}">
                        
                        @csrf
                        @method('PUT')

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.name')</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="eg: John Doe">
                                </div>

                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.identity_number')</label>
                                    <input type="text" class="form-control" name="identity_number" value="{{ $user->cust->identity_number }}" placeholder="ID Number / Passport / etc">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="cotrol-label">@lang('label.gender')</label>
                                            <input type="text" class="form-control" name="sex" value="{{ $user->cust->sex }}" placeholder="Gender">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="cotrol-label">@lang('label.phone_number')</label>
                                            <input type="text" class="form-control number" name="phone_number" value="{{ $user->cust->phone_number }}" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.place_of_birth')</label>
                                    <input type="text" class="form-control" name="place_of_birth" value="{{ $user->cust->place_of_birth }}" placeholder="eg: Jakarta">
                                </div>

                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.date_of_birth')</label>
                                    <input type="text" class="form-control datepicker" name="date_of_birth" value="{{ $user->cust->date_of_birth }}" placeholder="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.country')</label>
                                    <select name="country_id" class="form-control select2">
                                        <option value="id">Indonesia</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.state_or_province')</label>
                                    <select class="form-control select2" data-placeholder="State or Province *" name="province_id">
                                      <option></option>
                                      @foreach ($provinces as $province)
                                        <option value="{{ $province->province_id }}" {{ $user->cust->province_id == $province->province_id ? 'selected=selected' : '' }}>{{ $province->province }}</option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.city')</label>
                                    <select class="form-control select2" data-placeholder="City *" name="city_id">
                                        @if (!empty($user->cust->city_id))
                                          @foreach ($cities as $city)
                                            <option value="{{ $city->city_id }}" {{ !empty($user->cust->city_id) && $user->cust->city_id == $city->city_id ? 'selected=selected' : '' }}>{{ $city->type.' '.$city->city_name }}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.address')</label>
                                    <textarea class="form-control" placeholder="Address" name="address" rows="3">{{ $user->cust->address }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="cotrol-label">@lang('label.postcode_or_zip')</label>
                                    <input type="text" class="form-control" name="zip" value="{{ $user->cust->zip }}" placeholder="Zip / Postal Code">
                                </div>

                            </div>

                            <div class="text-right col-md-12">
                                <hr>

                                <button class="btn btn-custom-secondary" type="reset">@lang('label.reset')</button>
                                <button class="btn btn-custom-primary" type="submit">@lang('label.save_changes')</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection

@push('js')

<script src="{{ url('frontend/js/profile-edit.js') }}"></script>
@endpush