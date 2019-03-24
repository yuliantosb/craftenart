@extends('frontend.themes.'.config('app.themes').'.layouts.master')

@section('title', 'Profile')

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
                  @include('frontend.themes.'.config('app.themes').'.layouts.user_sidebar', ['active' => 'profile'])
                </div>

                <div class="col-sm-9 col-md-10">
                    <div class="row">
                        <div class="col-md-10">

                            <div class="col-md-12">

                                <div class="pull-left">
                                	<h3>{{ $user->name }}</h3>
                                	<p class="text-muted">{{ $user->email }}</p>
                                </div>

                                <div class="pull-right">
                                    <a href="{{ route('user.profile.edit') }}" class="btn btn-link text-success" data-toggle="tooltip" title="@lang('label.edit_profile')"><i class="fa fa-pencil"></i></a>
                                </div>
                            </div>

                        	<div class="row">
                        		<div class="col-md-6">
                        			<table class="table">
                        				<tr>
                        					<td><strong>@lang('label.identity_number')</strong></td>
                        					<td>{{ $user->cust->identity_number }}</td>
                        				</tr>

                        				<tr>
                        					<td><strong>@lang('label.phone_number')</strong></td>
                        					<td>{{ $user->cust->phone_number }}</td>
                        				</tr>

                        				<tr>
                        					<td><strong>@lang('label.place_of_birth')</strong></td>
                        					<td>{{ $user->cust->place_of_birth }}</td>
                        				</tr>

                        				<tr>
                        					<td><strong>@lang('label.date_of_birth')</strong></td>
                        					<td>{{ $user->cust->date_of_birth }}</td>
                        				</tr>

                        			</table>
                        		</div>

                        		<div class="col-md-6">
                        			<table class="table">
                        				<tr>
                        					<td><strong>@lang('label.country')</strong></td>
                        					<td>{{ RajaOngkir::getCountryAttr($user->cust->country_id) }}</td>
                        				</tr>

                        				<tr>
                        					<td><strong>@lang('label.state_or_province')</strong></td>
                        					<td>{{ !empty($user->cust->province_id) ? RajaOngkir::getProvinceAttr($user->cust->province_id) : '' }}</td >
                        				</tr>

                        				<tr>
                        					<td><strong>@lang('label.city')</strong></td>
                        					<td>{{ !empty($user->cust->city_id) ? RajaOngkir::getCityAttr($user->cust->city_id, $user->cust->province_id) : '' }}</td>
                        				</tr>

                        				<tr>
                        					<td><strong>@lang('label.address')</strong></td>
                        					<td>
                        					{!! nl2br($user->cust->address) !!}
                        					<br>
                        					{{ $user->cust->zip }}
                        					</td>
                        				</tr>

                        			</table>
                        		</div>

                        	</div>
                        </div>

                        <div class="col-md-2 text-center">
                            <input type="text" name="old_pic" value="{{ parse_url($user->cust->picture)['path'] }}" hidden="hidden">
                            <div class="change-btn-wrapper">
                                <button class="btn btn-primary btn-circle btn-xs" data-toggle="tooltip" title="@lang('label.change_avatar')" id="btn-browse">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                <div class="preview">
                                    <div class="template">
                                        <img data-dz-thumbnail class="img img-circle img-thumbnail" style="width: 100px; display: inline-block;">
                                    </div>
                                </div>

                                <img src="{{ $user->cust->picture }}" class="img img-circle img-thumbnail" id="img-profile" style="width: 100px; display: inline-block;">
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

@if (session()->has('message'))

<script type="text/javascript">
    show_notification('<b>Success</b>','success', "{{ session()->get('message') }}");
</script>

@endif

<script src="{{ url('frontend/js/profile.js') }}"></script>
@endpush