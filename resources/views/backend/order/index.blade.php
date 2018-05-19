@extends('backend.layouts.master')

@section('title', 'Order')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Order</h4>
                        <p class="order">Display all order list</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped" id="table-order">
                            <thead>
                                <tr>
                                	<th>Full Name</th>
                                    <th>Order Number</th>
                                    <th>Transaction Type</th>
    	                        	<th>Total</th>
                                    <th>Status</th>
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

<script src="{{ url('backend/js/pages/order.js') }}"></script>
@endpush