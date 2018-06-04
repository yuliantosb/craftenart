@extends('backend.layouts.master')
@section('title')
Menu
@endsection
@section('content')

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <div class="pull-left">
                    <h4 class="title">Menu</h4>
                    <p class="coupon">Display all menu list</p>
                </div>
            </div>

            <div class="col-md-12 mt10">
                <div class="row">
                    <hr>
                    <div class="col-md-4">
                        <div class="panel-content">
                            <form id="form-add">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">URL</h3>
                                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Menu Name" class="form-control">
                                            <br>
                                            <input type="text" name="url" placeholder="http://..." class="form-control">
                                            <br>
                                            <div class="checkbox">
                                                <input id="is_mega" type="checkbox" name="is_mega" value="1">
                                                <label for="is_mega">
                                                Is Mega Menu?
                                                </label>
                                            </div>
                                            <hr>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary btn-add" data-type="url">Add to menu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Widget (only for mega menu)</h3>
                                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <div class="panel-body">
                                        <input type="text" name="widget_name" placeholder="Widget Name" class="form-control">
                                        <br>
                                        <select name="widget_id" class="select2" data-placeholder="Select Widget">
                                            <option></option>
                                            @foreach ($widgets as $widget)
                                            <option value="{{ $widget->id }}">{{ $widget->name }}</option>
                                            @endforeach
                                        </select>
                                        <hr>
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-primary btn-add" data-type="widget">Add to menu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-8" style="overflow: hidden; min-height: 900px">
                        <div class="panel-content" id="menu-content">
                            
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- Modal for question -->
<!-- <form id="form-edit">
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Edit Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Menu Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Menu URL <span class="text-danger">*</span></label>
                            <input type="text" name="url" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Parent <span class="text-danger">*</span></label>
                            <select name="parent_id" class="form-control select2" required="required">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Order# <span class="text-danger">*</span></label>
                            <input type="text" name="order_number" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-save" class="btn btn-primary btn-sm">Save Changes</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
 -->
@push('js')

<script src="{{ url('backend/js/pages/menu.js') }}"></script>

@endpush