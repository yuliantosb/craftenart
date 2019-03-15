@extends('backend.layouts.master')

@section('title', 'Settings')

@section('content')
     <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="pull-left">
                        <h4 class="title">Setting</h4>
                        <p class="widget">Setting site</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>


                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">EN</a></li>
                            <li role="presentation"><a href="#id" aria-controls="id" role="tab" data-toggle="tab">ID</a></li>
                        </ul>

                      <!-- Tab panes -->
                        <div class="tab-content">
                            
                            <div role="tabpanel" class="tab-pane active" id="en">
                                <form action="{{ route('admin.settings.store') }}" method="post" id="form-add-edit" class="form-horizontal">
                                @csrf
                                    <div class="col-md-12" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Logo" readonly="readonly" name="logo[img]" value="{{ !empty($results_en['logo']->img) ? $results_en['logo']->img : '' }}" id="input-logo-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="logo-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 336x87px</small>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Favicon</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Favicon" readonly="readonly" name="favicon[img]" value="{{ !empty($results_en['favicon']->img) ? $results_en['favicon']->img : '' }}" id="input-favicon-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="favicon-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 16x16px</small>
                                            </div>
                                        </div>

                                            
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Loading Placeholder</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Loading Placeholder" readonly="readonly" name="loading[img]" value="{{ !empty($results_en['loading']->img) ?  $results_en['loading']->img : '' }}" id="input-loading-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="loading-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 98x98px</small>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Default Banner Placeholder</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Logo" readonly="readonly" name="default_placeholder[img]" value="{{ !empty($results_en['default_placeholder']->img) ? $results_en['default_placeholder']->img : '' }}" id="input-default-placeholder-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="default-placeholder-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 1920x205px</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Middle Heading</label>
                                            <div class="col-sm-10">
                                              <input name="mid[heading]" class="form-control" placeholder="Phone" value="{{ !empty($results_en['mid']->heading) ? $results_en['mid']->heading : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Middle Text</label>
                                            <div class="col-sm-10">
                                              <input name="mid[text]" class="form-control" placeholder="Phone" value="{{ !empty($results_en['mid']->text) ? $results_en['mid']->text : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-10">
                                              <input name="phone[text]" class="form-control" placeholder="Phone" value="{{ !empty($results_en['phone']->text) ? $results_en['phone']->text : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                              <input name="email[text]" class="form-control" placeholder="Email" value="{{ !empty($results_en['email']->text) ? $results_en['email']->text : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Footer Widget</label>
                                            <div class="col-sm-10">
                                                <br>
                                                <button class="btn btn-primary btn-sm" type="button" id="btn-add-row-footer-widget">
                                                    Add Row
                                                </button>
                                                <button class="btn btn-danger btn-sm" type="button" id="btn-remove-row-footer-widget">
                                                    Remove Row
                                                </button>

                                               <table class="table table-bordered m-t-10" id="table-footer-widget" style="margin-top: 20px">
                                                   <thead>
                                                       <tr>
                                                           <th>Title</th>
                                                           <th>Text Align</th>
                                                           <th>Widget</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                    @if (!empty($results_en['footer']))
                                                    @foreach ($results_en['footer'] as $footer)

                                                    <tr>
                                                        <td>
                                                            <input type="text" name="footer[title][]" class="form-control" placeholder="Title" value="{{ $footer->title }}"> 
                                                        </td>

                                                        <td>
                                                            <input type="text" name="footer[align][]" class="form-control" placeholder="Text Align" value="{{ $footer->align }}"> 
                                                        </td>

                                                        <td>
                                                            <select type="text" name="footer[widget_id][]" class="select2" data-placeholder="Select Widget" required="required">
                                                                @foreach ($widgets as $widget)
                                                                    <option value="{{ $widget->id }}" {{ $footer->widget_id == $widget->id ? 'selected=selected' : '' }}>{{ $widget->name }}</option>
                                                                @endforeach
                                                            </select> 
                                                        </td>

                                                    </tr>

                                                    @endforeach
                                                    @else
                                                       <tr id="no-data-footer-widget">
                                                           <td colspan="3" class="text-center">No Data</td>
                                                       </tr>
                                                    @endif
                                                   </tbody>
                                               </table>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Left Footer</label>
                                            <div class="col-sm-10">
                                              <textarea name="left_footer[text]" class="form-control" placeholder="Left Footer" rows="3">{{ !empty($results_en['left_footer']->text) ? $results_en['left_footer']->text : '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Right Footer</label>
                                            <div class="col-sm-10">
                                              <textarea name="right_footer[text]" class="form-control" placeholder="Left Footer" rows="3">{{ !empty($results_en['right_footer']->text) ? $results_en['right_footer']->text : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Banner</label>
                                            <br>
                                        
                                            <button class="btn btn-primary btn-sm" type="button" id="btn-add-row-banner">
                                                Add Row
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" id="btn-remove-row-banner">
                                                Remove Row
                                            </button>
                                            
                                            <table class="table table-bordered m-t-10" id="table-banner" style="margin-top: 20px">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Properties</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @if (!empty($results_en['banner']))
                                                    @php($i = 0)
                                                    @foreach ($results_en['banner'] as $banner)

                                                    <tr> 
                                                        <td style="vertical-align: top;"> 
                                                            <div class="input-group"> 
                                                                <input type="text" class="form-control" placeholder="Banner" readonly="readonly" name="banner[img][]" id="input-banner-img-{{ $i }} " value="{{ $banner->img }}"> 
                                                                <span class="input-group-btn"> 
                                                                    <button class="btn btn-default btn-bordered waves-light waves-light btn-open-media" type="button" data-type="banner-img-{{ $i }} ">Browse</button> 
                                                                </span> 
                                                            </div> 
                                                            <small class="text-primary">Resolution : 1714x564px</small> 
                                                        </td> 
                                                        <td>
                                                            <table class="table-bordered" style="width: 100%">
                                                                <tr>
                                                                    <td><strong>Text Align</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[align][]" value="{{ $banner->align }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Title</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[title][]" value="{{ $banner->title }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Header text</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[header][]" value="{{ $banner->header }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Sub header text</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[subheader][]" value="{{ $banner->subheader }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top"><strong>Content</strong></td>
                                                                    <td><textarea class="form-control" rows="5" name="banner[content][]">{{ $banner->content }}</textarea> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>URL</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[url][]" value="{{ $banner->url }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>URL text</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[url_text][]" value="{{ $banner->url_text }}"></td> 
                                                                </tr>
                                                            </table>
                                                            
                                                        </td> 
                                                        
                                                    </tr>
                                                    @php($i++)
                                                    @endforeach
                                                    @else
                                                    <tr id="no-data-banner">
                                                        <td colspan="2" class="text-center">No Data</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-right">
                                        <hr>
                                        <button class="btn btn-primary" type="submit" name="submit" value="en">
                                            Save Setting
                                        </button>
                                    </div>
                                </form>

                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="id">

                                <form action="{{ route('admin.settings.store') }}" method="post" id="form-add-edit" class="form-horizontal">
                                @csrf
                                    <div class="col-md-12" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Logo" readonly="readonly" name="logo[img]" value="{{ !empty($results_id['logo']->img) ? $results_id['logo']->img : '' }}" id="input-logo-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="logo-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 336x87px</small>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Favicon</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Favicon" readonly="readonly" name="favicon[img]" value="{{ !empty($results_id['favicon']->img) ? $results_id['favicon']->img : '' }}" id="input-favicon-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="favicon-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 16x16px</small>
                                            </div>
                                        </div>

                                            
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Loading Placeholder</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Loading Placeholder" readonly="readonly" name="loading[img]" value="{{ !empty($results_id['loading']->img) ? $results_id['loading']->img : '' }}" id="input-loading-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="loading-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 98x98px</small>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Default Banner Placeholder</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Logo" readonly="readonly" name="default_placeholder[img]" value="{{ !empty($results_id['default_placeholder']->img) ? $results_id['default_placeholder']->img : '' }}" id="input-default-placeholder-img">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-open-media" type="button" data-type="default-placeholder-img">Browse</button>
                                                    </span>
                                                </div><!-- /input-group -->
                                                <small class="text-primary">Resolution : 1920x205px</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Middle Heading</label>
                                            <div class="col-sm-10">
                                              <input name="mid[heading]" class="form-control" placeholder="Phone" value="{{ !empty($results_id['mid']->heading) ? $results_id['mid']->heading : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Middle Text</label>
                                            <div class="col-sm-10">
                                              <input name="mid[text]" class="form-control" placeholder="Phone" value="{{ !empty($results_id['mid']->text) ? $results_id['mid']->text : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-10">
                                              <input name="phone[text]" class="form-control" placeholder="Phone" value="{{ !empty($results_id['phone']->text) ? $results_id['phone']->text : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                              <input name="email[text]" class="form-control" placeholder="Email" value="{{ !empty($results_id['email']->text) ? $results_id['email']->text : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Footer Widget</label>
                                            <div class="col-sm-10">
                                                <br>
                                                <button class="btn btn-primary btn-sm" type="button" id="btn-add-row-footer-widget">
                                                    Add Row
                                                </button>
                                                <button class="btn btn-danger btn-sm" type="button" id="btn-remove-row-footer-widget">
                                                    Remove Row
                                                </button>

                                               <table class="table table-bordered m-t-10" id="table-footer-widget" style="margin-top: 20px">
                                                   <thead>
                                                       <tr>
                                                           <th>Title</th>
                                                           <th>Text Align</th>
                                                           <th>Widget</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                    @if (!empty($results_id['footer']))
                                                    @foreach ($results_id['footer'] as $footer)

                                                    <tr>
                                                        <td>
                                                            <input type="text" name="footer[title][]" class="form-control" placeholder="Title" value="{{ $footer->title }}"> 
                                                        </td>

                                                        <td>
                                                            <input type="text" name="footer[align][]" class="form-control" placeholder="Text Align" value="{{ $footer->align }}"> 
                                                        </td>

                                                        <td>
                                                            <select type="text" name="footer[widget_id][]" class="select2" data-placeholder="Select Widget" required="required">
                                                                @foreach ($widgets as $widget)
                                                                    <option value="{{ $widget->id }}" {{ $footer->widget_id == $widget->id ? 'selected=selected' : '' }}>{{ $widget->name }}</option>
                                                                @endforeach
                                                            </select> 
                                                        </td>

                                                    </tr>

                                                    @endforeach
                                                    @else
                                                       <tr id="no-data-footer-widget">
                                                           <td colspan="3" class="text-center">No Data</td>
                                                       </tr>
                                                    @endif
                                                   </tbody>
                                               </table>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Left Footer</label>
                                            <div class="col-sm-10">
                                              <textarea name="left_footer[text]" class="form-control" placeholder="Left Footer" rows="3">{{ !empty($results_id['left_footer']->text) ? $results_id['left_footer']->text : '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Right Footer</label>
                                            <div class="col-sm-10">
                                              <textarea name="right_footer[text]" class="form-control" placeholder="Left Footer" rows="3">{{ !empty($results_id['right_footer']->text) ? $results_id['right_footer']->text : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Banner</label>
                                            <br>
                                        
                                            <button class="btn btn-primary btn-sm" type="button" id="btn-add-row-banner">
                                                Add Row
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" id="btn-remove-row-banner">
                                                Remove Row
                                            </button>
                                            
                                            <table class="table table-bordered m-t-10" id="table-banner" style="margin-top: 20px">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Properties</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @if (!empty($results_id['banner']))
                                                    @php($i = 0)
                                                    @foreach ($results_id['banner'] as $banner)

                                                    <tr> 
                                                        <td style="vertical-align: top;"> 
                                                            <div class="input-group"> 
                                                                <input type="text" class="form-control" placeholder="Banner" readonly="readonly" name="banner[img][]" id="input-banner-img-{{ $i }} " value="{{ $banner->img }}"> 
                                                                <span class="input-group-btn"> 
                                                                    <button class="btn btn-default btn-bordered waves-light waves-light btn-open-media" type="button" data-type="banner-img-{{ $i }} ">Browse</button> 
                                                                </span> 
                                                            </div> 
                                                            <small class="text-primary">Resolution : 1714x564px</small> 
                                                        </td> 
                                                        <td>
                                                            <table class="table-bordered" style="width: 100%">
                                                                <tr>
                                                                    <td><strong>Text Align</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[align][]" value="{{ $banner->align }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Title</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[title][]" value="{{ $banner->title }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Header text</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[header][]" value="{{ $banner->header }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Sub header text</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[subheader][]" value="{{ $banner->subheader }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top"><strong>Content</strong></td>
                                                                    <td><textarea class="form-control" rows="5" name="banner[content][]">{{ $banner->content }}</textarea> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>URL</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[url][]" value="{{ $banner->url }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>URL text</strong></td>
                                                                    <td><input type="text" class="form-control" name="banner[url_text][]" value="{{ $banner->url_text }}"></td> 
                                                                </tr>
                                                            </table>
                                                            
                                                        </td> 
                                                        
                                                    </tr>
                                                    @php($i++)
                                                    @endforeach
                                                    @else
                                                    <tr id="no-data-banner">
                                                        <td colspan="2" class="text-center">No Data</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-right">
                                        <hr>
                                        <button class="btn btn-primary" type="submit" name="submit" value="id">
                                            Save Setting
                                        </button>
                                    </div>
                                </form>


                            </div>
                            

                        </div>

                        <div class="clearfix"></div>


                </div>
            </div>
        </div>
    </div>
                   

    
@endsection

@include('backend.media.list')

@push('js')

@if (session()->has('message')) 

<script type="text/javascript">
    show_notification('Success', 'success', `{{ session()->get('message') }}`);
</script>

@endif
<script src="{{ url('backend/js/pages/media.js') }}"></script>
<script src="{{ url('backend/js/pages/settings.js') }}"></script>
@endpush