@extends('backend.layouts.master')

@section('title', 'Add new widget')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Add Widget</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.widget.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <form action="{{ route('admin.widget.store') }}" method="post" id="form-add-edit">
                    {{ csrf_field() }}

                        <hr>
                      
                        <div class="col-md-8">

                            <div class="form-group">
                                <label class="control-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Content</label>
                                <textarea class="form-control" name="content" placeholder="Content" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Type <span class="text-danger">*</span></label>
                                <input type="text" name="type" class="form-control" placeholder="Type" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Limit </label>
                                <input type="text" name="limit" class="form-control number" placeholder="Limit">
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
<script src="{{ url('backend/js/pages/widget-add-edit.js') }}"></script>
@endpush