@extends('backend.layouts.master')

@section('title', 'User')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">User</h4>
                        <p class="category">Display all user list</p>
                    </div>

                    <div class="pull-right">
                        <a class="btn btn-success btn-bordered waves-effect waves-light" href="{{ route('admin.user.create') }}">
                            <i class="mdi mdi-add"></i> Add User
                        </a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Search ..." name="keyword">
                                    <i class="fa fa-search form-control-feedback l-h-34"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row m-t-20" style="position: relative">
                        <div class="loading" style="display:none"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div> 
                        @if (count($users) > 0)
                            <section class="users">
                                @include('backend.user.partial')
                            </section>
                        @else
                            <center><h3>No result found</h3></center>
                        @endif
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

<script src="{{ url('backend/js/pages/user.js') }}"></script>
@endpush