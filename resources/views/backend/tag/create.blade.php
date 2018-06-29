@extends('backend.layouts.master')

@section('title', 'Add new tag')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Add Tag</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.tag.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <form action="{{ route('admin.tag.store') }}" method="post" id="form-add-edit">
                    {{ csrf_field() }}

                        <hr>
                      
                        <div class="col-md-8">

                            <div class="form-group">
                                <label class="control-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Tag Name" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control tinymce" name="description" placeholder="Tag Description" rows="10"></textarea>
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
<script src="{{ url('backend/js/pages/tag-add-edit.js') }}"></script>
@endpush