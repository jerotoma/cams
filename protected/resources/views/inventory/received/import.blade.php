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
@section('scripts')
    <script>
        $("#formImportItems").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorElement:'div',
            rules: {
                inventory_file: "required"
            },
            messages: {
                inventory_file: "Please file is required"
            }
        });
    </script>
@stop
@section('page_title')
    Material Inventory
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Material Inventory</span> - Import Items</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('inventory')}}">Material Inventory</a></li>
        <li><a href="{{url('inventory-received')}}">Received Items</a></li>
        <li class="active">Import records</li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a href="#" class="addRecord btn "> <i class="fa fa-plus text-success"></i> Add Record</a>
            <a href="{{url('inventory-received')}}" class="btn "><i class="fa fa-list text-info"></i> List All Records</a>
            <a href="{{url('inventory')}}" class="btn " title="Go to Item inventory list"><i class="fa fa-reply text-danger"></i> Go to Inventory Items</a>
            <a href="{{url('excel/import/received/items')}}" class="btn " title="Import Received Items records"><i class="fa fa-upload text-blue"></i> Import</a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> <i class="fa fa-upload"></i> Import Received Items Records</h5>
        </div>

        <div class="panel-body">
            {!! Form::open(array('url'=>'excel/import/received/items','role'=>'form','id'=>'formImportItems','files'=>true)) !!}
            <div class="form-body">
                @if (session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Import from MS Excel <a href={{asset("assets/templates/item_received_import_template.xls")}}>Download template here</a> </label>
                    <input type="file" class="form-control" name="inventory_file" id="inventory_file">
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4 col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Import </button>
                    </div>

                </div>

            </div>

            {!! Form::close() !!}

        </div>

    </div>
@stop
