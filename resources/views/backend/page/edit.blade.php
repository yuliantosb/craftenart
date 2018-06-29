@extends('backend.layouts.master')

@section('title', 'Edit page')

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
                    <form action="{{ route('admin.page.update', $article->id) }}" method="post" id="form-add-edit">
                    @csrf
                    @method('put')

                        <hr>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="control-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ $article->title }}" class="form-control" placeholder="Title" required="required">
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Content</label>
                                        <textarea class="form-control tinymce" name="content" placeholder="Content" rows="10">{!! $article->content !!}</textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label class="control-label">Feature Image</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Feature Image" readonly="readonly" name="feature_image" id="input-feature-image" value="{{ $article->feature_image }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-open-media" type="button" data-type="feature-image">Browse</button>
                                        </span>
                                    </div>
                                    <span class="help-block"></span>
                                </div>


                                <div class="form-group">
                                    <label class="control-label">Categories</label>
                                    <select name="categories[]" class="form-control select2" data-tags="true" multiple="multiple" data-placeholder="Select or type categories">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}" {{ in_array($category->name, $article->categories->pluck('name')->toArray()) ? 'selected=selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tags </label>
                                    <select name="tags[]" class="form-control select2" data-tags="true" multiple="multiple" data-placeholder="Select or type tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->name }}" {{ in_array($tag->name, $article->tags->pluck('name')->toArray()) ? 'selected=selected' : '' }}>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Widget</label>
                                    <select name="widget_id" class="form-control select2" data-placeholder="Select widget" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($widgets as $widget)
                                            <option value="{{ $widget->id }}" {{ $widget->id == $article->widget_id ? 'selected=selected' : '' }}>{{ $widget->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                            </div>

                            <div class="col-md-12 text-right">
                                <hr>
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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