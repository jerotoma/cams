@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jasny_bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_multiselect.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_select.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/selectboxit.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tagsinput.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tokenfield.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/touchspin.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/maxlength.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/formatter.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/moment/moment.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/daterangepicker.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/anytime.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.time.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/legacy.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/wysihtml5.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/toolbar.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/parsers.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/jgrowl.min.js")}}"></script>

    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/form_floating_labels.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/picker_date.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/editor_wysihtml5.js")}}"></script>

    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')

    <script>
        $('.pickadate').pickadate({

            // Escape any “rule” characters with an exclamation mark (!).
            format: 'yyyy-mm-dd',
        });
        $("#category_id").change(function () {
            var id1 = this.value;
            if(id1 != "")
            {
                $.get("<?php echo url('fetchitemsbycategoryid') ?>/"+id1,function(data){
                    $("#item_id").html(data);
                });
            }else{$("#item_id").html("<option value=''>----</option>");}
        });
        $("#formItemsReceived").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                    else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            errorElement:'div',
            rules: {
                disbursements_date: "required",
                disbursements_by: "required",
                items_distribution_file:"required",
                camp_id:"required",
                category_id:"required",
                item_id:"required",
                import_type:"required",
            },
            messages: {
                disbursements_date: "Please field is required",
                disbursements_by: "Please field is required",
                items_distribution_file: "Please upload file",
                category_id:"Please please select camp",
                camp_id:"Please please select camp",
                item_id:"Please Please select Items",
                import_type:"Please Please select Items",
            }
        });
    </script>
@stop
@section('main_navigation')
    @include('inc.main_navigation')
@stop
@section('page_title')
    NFIs Items Distribution
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">  NFIs Items Distribution </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('items/distributions')}}"> NFIs Items Distribution</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a href="#" class="addRecord btn btn-primary "> <i class="fa fa-plus text-success"></i>Items Distributions</a>
            <a href="{{url('distributions/items/bulk')}}" class=" btn btn-primary " title="Item distributions for multiple clients"> <i class="fa fa-plus text-success"></i>Bulk Items Distributions</a>
            <a href="{{url('items/distributions')}}" class="btn btn-primary"><i class="fa fa-list text-info"></i> List All Records</a>
            <a href="{{url('inventory')}}" class="btn btn-primary " title="Go to Item inventory list"><i class="fa fa-reply text-danger"></i> Go to Inventory Items</a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-uppercase"> <i class="fa fa-upload"></i> Import NFIs Distribution</h5>
        </div>

        <div class="panel-body">
        {!! Form::open(array('url'=>'distributions/items/bulk','role'=>'form','id'=>'formItemsReceived','files'=>true)) !!}
        <div class="panel panel-flat">
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert fade in alert-danger">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        {{Session::get('error')}}
                    </div>
                @endif
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
            <fieldset class="scheduler-border">
                <legend class="text-bold"> NFIs Items Distribution</legend>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Distribution Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" class="form-control pickadate"  value="{{old('disbursements_date')}}" name="disbursements_date" id="disbursements_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label">Items Distributed By</label>
                            <input type="text" class="form-control" name="disbursements_by"  id="disbursements_by" value="" >
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label">Camp</label>
                    <select class="select" name="camp_id" id="camp_id" data-placeholder="Choose an option...">
                        <option ></option>
                        @foreach(\App\Camp::all() as $item)
                            <option value="{{$item->id}}">{{$item->camp_name}}</option>
                        @endforeach
                    </select>
                    @if($errors->first('camp_id') !="")
                        <label id="address-error" class="validation-error-label" for="nationality">{{ $errors->first('camp_id') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label">Item Category</label>
                            <select class="select" name="category_id" id="category_id" data-placeholder="Choose an option...">
                                <option ></option>
                                @foreach(\App\ItemsCategories::all() as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label">Item</label>
                            <select class="select" name="item_id" id="item_id" data-placeholder="Choose an option...">
                                <option ></option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="scheduler-border">
                <legend class="text-bold">PSN CLIENTS ITEMS DISTRIBUTION LIST</legend>
                <div class="row">
                    <div class="col-md-6">
                         <h3 class="help-inline text-bold text-danger">If you have generated the list from old excel use this template <a href={{asset("assets/templates/bulk_item_distribution_old_template.xls")}}>Download template here</a> </h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="help-inline text-bold text-danger">If you have generated the list from new system use this template   <a href={{asset("assets/templates/bulk_item_distribution_new_template.xls")}}>Download template here</a> </h3>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label">Data description</label>
                            <input type="file" class="form-control" name="items_distribution_file" id="items_distribution_file">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Data Import description</label>
                        <select class="select" name="import_type" id="import_type" data-placeholder="Choose an option...">
                            <option value=""></option>
                            <option value="1">New data- Exported from system</option>
                            <option value="2">Old data- Migrating from old data</option>
                        </select>
                    </div>
                </div>
            </fieldset>
                <div class="form-group ">
                    <label class="control-label"> Comments: </label>
                    <textarea class="form-control"  name="comments" id="comments">{{old('comments')}}</textarea>
                </div>
            </fieldset>
        </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Submit Form </button>
                </div>

            </div>
        </div>

        {!! Form::close() !!}

    </div>

    </div>
@stop
