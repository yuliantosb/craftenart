@extends('backend.layouts.master')

@section('title', 'Add new product')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Add Product</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <form action="{{ route('admin.product.store') }}" method="post" id="form-add-edit">
                    {{ csrf_field() }}

                        <hr>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="control-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Product Name" required="required">
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea class="form-control tinymce" name="description" placeholder="Product Description" rows="10"></textarea>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 20px">

                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col-md-12">
                                                    <div class="pull-left">
                                                        <p>Galleries</p>    
                                                    </div>
                                                    
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-primary btn-sm" id="btn-add-row-galleries">Add Row</button>
                                                        <button type="button" class="btn btn-danger btn-sm" id="btn-remove-row-galleries">Remove Row</button>
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                            <table class="table table-primary table-bordered" id="table-galleries">
                                                <thead>
                                                    <tr>
                                                        <th>Image Path</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="empty-row-galleries">
                                                        <td class="text-center">No Data</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col-md-12">
                                                    <div class="pull-left">
                                                        <p>Attributes</p>    
                                                    </div>
                                                    
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-primary btn-sm" id="btn-add-row-attributes">Add Row</button>
                                                        <button type="button" class="btn btn-danger btn-sm" id="btn-remove-row-attributes">Remove Row</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-primary table-bordered" id="table-attributes">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th style="width: 350px">Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="empty-row-attributes">
                                                        <td colspan="2" class="text-center">No Data</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label class="control-label">Feature Image <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Feature Image" readonly="readonly" name="feature_image" id="input-feature-image" required="required">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-open-media" type="button" data-type="feature-image">Browse</button>
                                        </span>
                                    </div>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">SKU</label>
                                    <input type="text" name="sku" class="form-control" placeholder="SKU">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Stock <span class="text-danger">*</span></label>
                                    <input type="text" name="stock" class="form-control number" placeholder="0" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Weight (gr) <span class="text-danger">*</span></label>
                                    <input type="text" name="weight" placeholder="0.0" class="form-control autonumeric" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" name="price" class="form-control autonumeric text-right" placeholder="0.0" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Discount</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" name="discount" class="form-control autonumeric text-right" placeholder="0.0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Categories <span class="text-danger">*</span></label>
                                    <select name="categories[]" class="form-control select2" data-tags="true" multiple="multiple" data-placeholder="Select or type categories" required="required">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tags <span class="text-danger">*</span></label>
                                    <select name="tags[]" class="form-control select2" data-tags="true" multiple="multiple" data-placeholder="Select or type tags" required="required">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
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
<script src="{{ url('backend/js/pages/product-add-edit.js') }}"></script>
@endpush