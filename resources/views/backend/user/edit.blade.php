@extends('backend.layouts.master')
@section('title')
	Edit User
@endsection
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <div class="pull-left">
                    <h4 class="title">Edit User</h4>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

	        <div class="col-md-12">
				<form method="post" action="{{ route('admin.user.update', $user->id) }}" id="form-add-edit">
				@csrf
				{{ method_field('put') }}
					<input type="text" name="id" value="{{ $user->id }}" hidden="hidden">
					<div class="row">

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">ID Number</label>
										<input type="text" name="identity_number" value="{{ $user->cust->identity_number }}" class="form-control" placeholder="eg: Identity Card Number">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Fullname <span class="text-danger">*</span></label>
										<input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="eg: John Doe" required="required">
										<span class="help-block"></span>
									</div>
								</div>

							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Photo</label>
								<div class="input-group">
                                    <input type="text" class="form-control" placeholder="Feature Image" readonly="readonly" name="feature_image" id="input-feature-image">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-open-media" type="button" data-type="feature-image">Browse</button>
                                    </span>
                                </div>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email <span class="text-danger">*</span></label>
								<input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="name@example.com" required="required">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Phone Number</label>
								<input type="text" name="phone_no" value="{{ $user->cust->phone_number }}" class="form-control number" placeholder="eg: 08xxxx">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Password</label>
										<input type="password" name="password" class="form-control" placeholder="*******" minlength="6">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Re-type Password</label>
										<input type="password" name="retype_password" class="form-control" placeholder="*******">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<small class="text-primary"><em>*) Leave password blank if you don't want to change password</em></small>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Role <span class="text-danger">*</span></label>
	              				<select name="role_id[]" class="form-control select2" data-placeholder="Select Role" required="required" multiple="multiple">
	              					<option></option>
	              					@foreach ($roles as $role)
	              					<option value="{{ $role->id }}"  {{ in_array($role->id, $user->roles()->pluck('id')->toArray()) ? 'selected=selected' : '' }}>{{ $role->display_name }}</option>
	              					@endforeach
	              				</select>
	              				<span class="help-block"></span>
							</div>
						</div>


					</div>


					<div class="row">
						<div class="col-md-12">
							<hr>
						</div>

						<div class="col-md-6">
							<h6>General Information</h6>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Country</label>
										<select name="country_id" class="select2 form-control" data-placeholder="Select Country">
											<option value="id">Indonesia</option>
										</select>
									</div>

									<div class="form-group">
										<label>State / Province</label>
										<select name="province_id" class="select2 form-control" data-placeholder="Select Province">
											<option></option>
											@foreach ($provinces as $province)
											<option value="{{ $province->province_id }}"  {{ $province->province_id == $user->cust->province_id ? 'selected=selected' : '' }}>{{ $province->province }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label>City</label>
										<select name="city_id" class="select2 form-control" data-placeholder="Select City">
											@if (!empty($user->cust->city_id))
											<option></option>
											@foreach ($cities as $city)
											<option value="{{ $city->city_id }}" {{ $city->city_id == $user->cust->city_id ? 'selected=selected' : '' }}>{{ $city->type.' '.$city->city_name }}</option>
											@endforeach
											@else
											<option></option>
											@endif
										</select>
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Place of Birth</label>
										<input type="text" name="place_of_birth" value="{{ $user->cust->place_of_birth }}" class="form-control" placeholder="eg: North Carolina">
									</div>

									<div class="form-group">
										<label>Date of Birth</label>
										<input type="text" name="date_of_birth" value="{{ $user->cust->date_of_birth }}" class="form-control" placeholder="yyyy-mm-dd">
									</div>

									<div class="form-group">
										<label>Gender</label>
										<select name="sex" class="select2 form-control" data-placeholder="Select Gender">
											<option value="Male" {{ $user->cust->gender == 'Male' ? 'selected=selected' : '' }}>Male</option>
											<option value="Female" {{ $user->cust->gender == 'Female' ? 'selected=selected' : '' }}>Female</option>
											<option value="Unspecified" {{ $user->cust->gender == 'Unspecified' ? 'selected=selected' : '' }}>Unspecified</option>
										</select>
									</div>

								</div>

							</div>
						</div>

						<div class="col-md-6">
							<h6>Additional Information</h6>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Zip / Postal Code</label>
												<input type="text" name="zip" value="{{ $user->cust->zip }}" class="form-control" placeholder="Zip / Postal Code">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label class="control-label">Address</label>
											<textarea class="form-control" placeholder="Street No. Street Name &#10;Building or Region Name" rows="5">{{ $user->cust->address }}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

				<!-- /col-xs-8 -->

				<div class="col-xs-12">
					
						
					<hr>
					<div class="pull-right">
						<button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
						<button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Save Changes</button>
					</div>
					

				</div>

				<!-- /col-xs-12 -->

			</div>

		</form>
			
	</div>
</div>

@endsection

@include('backend.media.list')

@push('js')
	
<script src="{{ url('backend/js/pages/media.js') }}"></script>
<script src="{{ url('backend/js/pages/user-add-edit.js') }}"></script>
@endpush