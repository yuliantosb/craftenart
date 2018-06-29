@extends('backend.layouts.master')

@section('title', 'Category')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Category</h4>
                        <p class="category">Display all category list</p>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>

                    <div class="col-md-6 pull-right form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Filter by type</label>
                            <div class="col-sm-8">
                                <select name="type" class="select2" data-placeholder="Select Type">
                                    <option value="all">all</option>
                                    <option value="product">product</option>
                                    <option value="post">post</option>
                                    <option value="page">page</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped" id="table-category">
                            <thead>
                                <tr>
                                	<th style="width: 150px">Name</th>
    	                        	<th>Description</th>
                                    <th style="width: 150px">Type</th>
                            	</tr>
                        	</thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- Modal for question -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-delete-confirm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Really?</h4>
            </div>
            <div class="modal-body">Selected data will be destroyed, are you sure?</div>
            <div class="modal-footer">
                <button type="submit" id="btn-confirm" class="btn btn-danger btn-bordered waves-effect waves-light">Delete</button>
                <button type="button" class="btn btn-default btn-bordered waves-effect waves-light" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@push('js')

@if (session()->has('message')) 

<script type="text/javascript">
    show_notification('Success', 'success', `{{ session()->get('message') }}`);
</script>

@endif

<script src="{{ url('backend/js/pages/category.js') }}"></script>
@endpush