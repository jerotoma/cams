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
                clients_import: "required",
                camp_id: "required",
            },
            messages: {
                inventory_file: "Please file is required",
                camp_id: "Please Select camp"
            }
        });
    </script>
@stop
@section('page_title')
    Clients
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Clients</span> - Import</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('inventory')}}">Clients</a></li>
        <li class="active">Import Clients</li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-12 text-right">
                @permission('create')
                <a  href="#" class="addRecord btn btn-primary"><i class="fa fa-user-plus "></i> <span>Register New Client</span></a>
                @endpermission
                <a  href="{{url('clients')}}" class="btn btn-primary "><i class="fa fa-list "></i> <span>List All</span></a>
                <a  href="{{url('search/clients')}}" class="btn btn-primary"><i class="fa fa-search "></i> <span>Search</span></a>
                @permission('authorize')
                <a  href="#" class="authorizeAllRecord btn btn-danger"><i class="fa fa-check "></i> <span>Authorize All</span></a>
                @endpermission
                @permission('edit')
                <a  href="{{url('import/clients')}}" class="btn btn-primary"><i class="fa fa-upload"></i> <span>Import Clients</span></a>
                @endpermission
            </div>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-uppercase"> <i class="fa fa-upload"></i> Import Client Details</h5>
        </div>

        <div class="panel-body">
            {!! Form::open(array('url'=>'import/clients','role'=>'form','id'=>'formImportItems','files'=>true)) !!}
            <div class="form-body">
                @if(session('error'))
                    <div class="alert fade in alert-danger">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        {{session('error')}}
                    </div>
                @endif
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
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
                <div class="form-group">
                    <label>Import list of clients for registration, kindly use this template <a href={{asset("assets/templates/client_import_template.xls")}}>Download template here</a> </label>
                    <input type="file" class="form-control" name="clients_import" id="clients_import">
                    @if($errors->first('clients_import') !="")
                        <div id="client_number-error" class="validation-error-label">{{ $errors->first('clients_import') }}</div>
                    @endif
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
