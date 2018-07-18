@extends('backend.layouts.master')

@section('title', 'Add new page')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Add Page</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.page.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <form action="{{ route('admin.page.store') }}" method="post" id="form-add-edit">
                    {{ csrf_field() }}

                        <hr>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">EN</a></li>
                                        <li role="presentation"><a href="#id" aria-controls="id" role="tab" data-toggle="tab">ID</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        
                                        <div role="tabpanel" class="tab-pane active" id="en">
                                            <div style="margin-top: 20px">
                                                <div class="form-group">
                                                    <label class="control-label">Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="title_en" class="form-control" placeholder="Title" required="required">
                                                    <span class="help-block"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Content</label>
                                                    <textarea class="form-control tinymce" name="content_en" placeholder="Content" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="id">
                                            <div style="margin-top: 20px">
                                                <div class="form-group">
                                                    <label class="control-label">Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="title_id" class="form-control" placeholder="Title" required="required">
                                                    <span class="help-block"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Content</label>
                                                    <textarea class="form-control tinymce" name="content_id" placeholder="Content" rows="10"></textarea>
                                                </div>
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
                                    <span class="help-block"></span>
                                </div>


                                <div class="form-group">
                                    <label class="control-label">Categories </label>
                                    <select name="categories[]" class="form-control select2" data-tags="true" multiple="multiple" data-placeholder="Select or type categories">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tags </label>
                                    <select name="tags[]" class="form-control select2" data-tags="true" multiple="multiple" data-placeholder="Select or type tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Widget</label>
                                    <select name="widget_id" class="form-control select2" data-placeholder="Select widget" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($widgets as $widget)
                                            <option value="{{ $widget->id }}">{{ $widget->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                            </div>

                            <div class="col-md-12 text-right">
                                <hr>
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

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
<script src="{{ url('backend/js/pages/page-add-edit.js') }}"></script>
@endpush