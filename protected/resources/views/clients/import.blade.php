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
@section('main_navigation')
    <div class="sidebar-category sidebar-category-visible">
        <div class="category-content no-padding">
            <ul class="navigation navigation-main navigation-accordion">
                <li class="active"><a href="{{url('home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                <!-- Main -->
                <li class="navigation-header">Registration desk<span></span> <i class="icon-menu" title="Main pages"></i></li>
                <li>
                    <a href="#"><i class="icon-users"></i>Clients <span></span></a>
                    <ul>
                        <li ><a href="{{url('clients')}}">List All Clients</a></li>
                        <li><a href="{{url('search/clients')}}">Search Clients</a></li>
                        <li><a href="{{url('import/clients')}}">Import Clients</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list-unordered"></i> <span>Client Assessments</span></a>
                    <ul>
                        <li ><a href="{{url('assessments/vulnerability')}}">Vulnerability assessment</a></li>
                        <li><a href="{{url('assessments/inclusion')}}">Inclusion assessment</a></li>
                        <li><a href="{{url('assessments/wheelchair')}}">Wheelchair Assessment</a></li>
                        <li><a href="{{url('assessments/home')}}">PSN Needs/Home Assessment </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-stack"></i> <span>Client Referrals</span></a>
                    <ul>
                        <li ><a href="{{url('referrals')}}">Referrals</a></li>
                    </ul>
                </li>
                <!-- /main -->
                <!-- Forms -->
                <li class="navigation-header"><span>Material Distribution</span> <i class="icon-menu" title="Material Distribution"></i></li>
                <li>
                    <a href="#"><i class="icon-popout"></i> <span>Material Distribution</span></a>
                    <ul>
                        <li><a href="{{url('inventory-received')}}">Item Distribution</a></li>
                        <li><a href="{{url('inventory-received')}}">Received Items</a></li>
                        <li><a href="{{url('inventory')}}">Items Inventory</a></li>
                        <li><a href="{{url('inventory-categories')}}">Items Categories</a></li>
                    </ul>
                </li>

                <!-- /forms -->
                <!-- Forms -->
                <li class="navigation-header"><span>Rehabilitation</span> <i class="icon-menu" title="Forms"></i></li>
                <li>
                    <a href="#"><i class="icon-grid"></i> <span>Rehabilitation Service</span></a>
                    <ul>
                        <li><a href="{{url('rehabilitation/register')}}">Open Register</a></li>
                        <li><a href="{{url('rehabilitation/progress')}}">Progress</a></li>
                        <li><a href="{{url('rehabilitation/register')}}">Search</a></li>
                        <li><a href="{{url('rehabilitation/Import')}}">Import</a></li>
                        <li><a href="{{url('rehabilitation/export')}}">Export</a></li>
                    </ul>
                </li>
                <!-- /forms -->
                <!-- Data visualization -->
                <li class="navigation-header"><span>Data visualization</span> <i class="icon-menu" title="Data visualization"></i></li>
                <li>
                    <a href="#"><i class="icon-graph"></i> <span>Clients Reports</span></a>
                    <ul>
                        <li><a href="{{url('reports/clients')}}">Registration</a></li>
                        <li><a href="{{url('reports/clients')}}">Assessments</a></li>
                        <li><a href="{{url('reports/clients')}}">Refferal</a></li>
                    </ul>
                </li>
                <!-- /data visualization -->
                <!-- Appearance -->
                <li class="navigation-header"><span>Settings</span> <i class="icon-menu" title="Settings"></i></li>
                <li>
                    <a href="#"><i class="icon-list"></i> <span>Countries</span></a>
                    <ul>
                        <li><a href="{{url('countries/create')}}">Add New Country</a></li>
                        <li><a href="{{url('countries')}}">List All Countries</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> <span>Regions</span></a>
                    <ul>
                        <li><a href="{{url('regions/create')}}">Add New Region</a></li>
                        <li><a href="{{url('regions')}}">List All Regions</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="icon-grid"></i> <span>Camps</span></a>
                    <ul>
                        <li><a href="{{url('camps/create')}}">Add New Camp</a></li>
                        <li><a href="{{url('camps')}}">List All camps</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>PSN Codes</span></a>
                    <ul>
                        <li><a href="{{url('psncodes/create')}}">Add New Code</a></li>
                        <li><a href="{{url('psncodes')}}">List All Codes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> <span>Departments</span></a>
                    <ul>
                        <li><a href="{{url('departments/create')}}">Add New Code</a></li>
                        <li><a href="{{url('departments')}}">List All Departments</a></li>
                    </ul>
                </li>
                <!-- /appearance -->

                <!-- Layout -->
                <li class="navigation-header"><span>Users Managements</span> <i class="icon-menu" title="Users Managements"></i></li>

                <li>
                    <a href="#"><i class="icon-users"></i> <span>Users</span></a>
                    <ul>
                        <li><a href="{{url('users')}}">Add New User</a></li>
                        <li><a href="{{url('users')}}">List All Users</a></li>
                        <li><a href="{{url('reports/users')}}">User Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-popout"></i> <span>Users Rights</span></a>
                    <ul>
                        <li><a href="{{url('access/rights/create')}}">Add New</a></li>
                        <li><a href="{{url('access/rights')}}">List All</a></li>
                    </ul>
                </li>
                <!-- /layout -->



                <!-- Extensions -->
                <li class="navigation-header"><span>Data Sharing</span> <i class="icon-menu" title="Data Sharing"></i></li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>Data import</span></a>
                    <ul>
                        <li><a href="{{url('backup/import')}}">Import</a></li>
                        <li><a href="{{url('backup/export')}}">Export</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-popout"></i> <span>Data Approval</span></a>
                    <ul>
                        <li><a href="{{url('approval/pending')}}">Pending</a></li>
                    </ul>
                </li>
                <!-- /extensions -->
            </ul>
        </div>
    </div>
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
        <div class="col-md-12 text-right">
            <a  href="#" class="addRecord btn"><i class="fa fa-file-o text-success"></i> <span>Register New Client</span></a>
            <a  href="{{url('clients')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All</span></a>
            <a  href="{{url('clients')}}" class="btn "><i class="fa fa-search text-primary"></i> <span>Search</span></a>
            <a  href="{{url('import/clients')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-uppercase"> <i class="fa fa-upload"></i> Import Client Details</h5>
        </div>

        <div class="panel-body">
            {!! Form::open(array('url'=>'import/clients','role'=>'form','id'=>'formImportItems','files'=>true)) !!}
            <div class="form-body">
                @if(Session::has('error'))
                    <div class="alert fade in alert-danger">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        {{Session::get('error')}}
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
                    <input TYPE="file" class="form-control" name="inventory_file" id="inventory_file">
                    @if($errors->first('inventory_file') !="")
                        <div id="client_number-error" class="validation-error-label">{{ $errors->first('inventory_file') }}</div>
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