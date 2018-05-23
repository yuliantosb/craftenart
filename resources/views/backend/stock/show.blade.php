@extends('backend.layouts.master')

@section('title', 'Stock Details')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Stock Details</h4>
                        <p class="stock">Display all stock details list</p>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button" id="btn-add">Add Stock</button>
                        <a class="btn btn-default" href="{{ route('admin.stock.index') }}">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <h3 class="text-primary">Current Stock : <span id="current-stock">{{ $stock->amount }}</span></h3>
                    <hr>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped" id="table-stock-details">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                	<th>Last Amount</th>
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
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add Stock</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form-add">
                            <input type="text" name="stock_id" value="{{ $stock->id }}" hidden="hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Curren Stock</label>
                                        <input type="text" name="current_amount" value="{{ $stock->amount }}" class="form-control" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Stock Update <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" placeholder="0" class="form-control" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Reason</label>
                                <textarea class="form-control" placeholder="Reason stock updated" name="description"></textarea>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-save" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{ url('backend/js/pages/stock-show.js') }}"></script>
@endpush