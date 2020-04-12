@extends('layout.master')
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
@section('page_title')
    Data Exports
@stop
@section('page_heading_title')
    <h4><i class="fa fa-share"></i> <span class="text-semibold">System </span> Data Exports</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Backup And sharing</li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('clients')}}" class="btn btn-primary "><i class="fa fa-home"></i> <span>Home</span></a>
            <a  href="{{url('backup/export/advanced')}}" class="btn btn-primary"><i class="fa fa-share"></i> <span>Export Data</span></a>
            <a  href="{{url('backup/import/advanced')}}" class="btn btn-primary"><i class="fa fa-upload"></i> <span>Import Data</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class=" text-center text-uppercase"> DATA SYNCHRONIZATION EXPORT FROM LOCAL TO CENTRAL SYSTEM</h5>
            <div class="alert alert-info">
                This module is design for exporting data from local individual installed system to central system,Select the module to export
                such as Client module which will export all client registration data from local system, you can do the same to other modules. For exporting
                all data at per select All Modules
            </div>
        </div>

        <div class="panel-body">
            {!! Form::open(array('url'=>'backup/export/advanced','role'=>'form','id'=>'formImportItems','files'=>true)) !!}
            <div class="form-body">
                @if (session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                        <div class="form-group">
                            <label class="control-label text-bold"> Select Module to export</label>
                            <select class="select" name="module" id="module" data-placeholder="Choose an option...">
                                <option></option>
                                <option value="1">Clients</option>
                                <option value="2">Clients Assessments</option>
                                <option value="3">Clients Referrals</option>
                                <option value="4">NFIs Inventory</option>
                                <option value="5">Cash Distributions</option>
                                <option value="6">Progress Monitoring</option>
                                <option value="7">All Modules</option>
                            </select>
                            @if($errors->first('module') !="")
                                <label id="address-error" class="validation-error-label" for="module">{{ $errors->first('module') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-cogs"></i> Export Data </button>
                </div>

            </div>

            {!! Form::close() !!}
        </div>

    </div>
@stop
