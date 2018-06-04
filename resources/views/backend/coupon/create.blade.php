@extends('backend.layouts.master')

@section('title', 'Add new coupon')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Add Coupon</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <form action="{{ route('admin.coupon.store') }}" method="post" id="form-add-edit">
                    {{ csrf_field() }}

                        <hr>
                      
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Coupon Code <span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control" placeholder="Code" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Valid Thru <span class="text-danger">*</span></label>
                                    <input type="text" name="valid_thru" class="form-control datepicker" placeholder="yyyy-mm-dd" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" class="form-control text-right autonumeric" placeholder="0" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Type<span class="text-danger">*</span></label>
                                    <select name="type" class="select2" data-placeholder="Select Type" style="width: 100%" required="required">
                                        <option></option>
                                        <option value="0">Fixed</option>
                                        <option value="1">Percentage</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Min Amount</label>
                                    <input type="text" name="min_amount" class="form-control text-right autonumeric" placeholder="0">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Max Amount</label>
                                    <input type="text" name="max_amount" class="form-control text-right autonumeric" placeholder="0">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <input id="is_single_use" type="checkbox" name="is_single_use" value="1">
                                                <label for="is_single_use">
                                                Is Single Use
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <input id="is_single_user" type="checkbox" name="is_single_user" value="1">
                                                <label for="is_single_user">
                                                Is Single User
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Include User</label>
                                    <select name="include_user[]" class="select2" data-placeholder="Select user" multiple="multiple" style="width: 100%" disabled="disabled">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <hr>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ url('backend/js/pages/coupon-add-edit.js') }}"></script>
@endpush