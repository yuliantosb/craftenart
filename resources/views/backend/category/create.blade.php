@extends('backend.layouts.master')

@section('title', 'Add new category')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Add Category</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <form action="{{ route('admin.category.store') }}" method="post" id="form-add-edit">
                    {{ csrf_field() }}

                        <hr>
                      
                        <div class="col-md-8">

                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">EN</a></li>
                                <li role="presentation"><a href="#id" aria-controls="id" role="tab" data-toggle="tab">ID</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="en">
                                    <div style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="control-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en" class="form-control" placeholder="Category Name" required="required">
                                            <span class="help-block"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control tinymce" name="description_en" placeholder="Category Description" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="id">
                                    <div style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="control-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name_id" class="form-control" placeholder="Category Name" required="required">
                                            <span class="help-block"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control tinymce" name="description_id" placeholder="Category Description" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Feature Image</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Feature Image" readonly="readonly" name="feature_image" id="input-feature-image">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-open-media" type="button" data-type="feature-image">Browse</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Type <span class="text-danger">*</span></label>
                                <select name="type" class="select2" data-placeholder="Select Type" required="required">
                                    <option value="product">product</option>
                                    <option value="post">post</option>
                                    <option value="page">page</option>
                                </select>
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
@include('backend.media.list')

@push('js')
<script src="{{ url('backend/js/pages/media.js') }}"></script>
<script src="{{ url('backend/js/pages/category-add-edit.js') }}"></script>
@endpush