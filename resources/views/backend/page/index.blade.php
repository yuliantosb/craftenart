@extends('backend.layouts.master')

@section('title', 'Page')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Page</h4>
                        <p class="category">Display all page list</p>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.page.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped" id="table-page">
                            <thead>
                                <tr>
                                	<th>Title</th>
    	                        	<th>Comments</th>
    	                        	<th>Author</th>
    	                        	<th>Categories</th>
    	                        	<th>Tags</th>
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

<script src="{{ url('backend/js/pages/page.js') }}"></script>
@endpush