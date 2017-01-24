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
        $("#formClients").validate({
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
                client_number: "required",
                full_name: "required",
                sex: "required",
                age: "required",
                civil_status: "required",
                nationality: "required",
                date_arrival: "required",
                ration_card_number: "required",
                vulnerability_code:"required",
                camp_id:"required"
            },
            messages: {
                client_number: "Please client number is required",
                full_name: "Please full name is required",
                sex: "Please sex is required",
                age: "Please age is required",
                civil_status: "Please civil status is required",
                nationality: "Please origin is required",
                date_arrival: "Please arrival date is required",
                ration_card_number: "Please ration card number is required",
                vulnerability_code: "Please  vulnerability code is required",
                camp_id: "Please  Camp name is required"
            }
        });

        $("#region_id").change(function () {
            var id1 = this.value;
            if(id1 != "")
            {
                $.get("<?php echo url('fetch/districts') ?>/"+id1,function(data){
                    $("#district_id").html(data);
                });
            }else{$("#district_id").html("<option value=''>----</option>");}
        });

        $(".deleteRecord").click(function(){
            var id1 = $(this).parent().attr('id');
            $(".deleteModule").show("slow").parent().parent().find("span").remove();
            var btn = $(this).parent().parent();
            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".deleteRecord").show("slow");
                $(this).parent().parent().find("span").remove();
            });
            $("#yes").click(function(){
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                $.ajax({
                    url:"<?php echo url('camps') ?>/"+id1,
                    type: 'post',
                    data: {_method: 'delete', _token :"{{csrf_token()}}"},
                    success:function(msg){
                        btn.hide("slow").next("hr").hide("slow");
                    }
                });
            });
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
                        <li ><a href="{{url('clients/create')}}">Register New Client</a></li>
                        <li><a href="{{url('clients')}}">Search Client</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list-unordered"></i> <span>Client Assessments</span></a>
                    <ul>
                        <li ><a href="{{url('assessments/create')}}">Vulnerability assessment</a></li>
                        <li><a href="{{url('import/assessments')}}">Inclusion assessment</a></li>
                        <li><a href="{{url('export/assessments')}}">Wheelchair Assessment</a></li>
                        <li><a href="{{url('reports/assessments')}}">Assessments Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-stack"></i> <span>Client Referrals</span></a>
                    <ul>
                        <li ><a href="{{url('referrals/create')}}">Open Referral</a></li>
                        <li><a href="{{url('import/referrals')}}">Import Referral</a></li>
                        <li><a href="{{url('export/referrals')}}">Export Referral</a></li>
                        <li><a href="{{url('search/referrals')}}">Search Referral</a></li>
                        <li><a href="{{url('reports/referrals')}}">Referral Report</a></li>
                    </ul>
                </li>
                <!-- /main -->

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
    Client Registration
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Clients</span> - Register New Clients</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('regions')}}">Camps</a></li>
        <li class="active">Add New</li>
    </ul>
@stop
@section('contents')
    <!-- Vertical form options -->
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('clients/create')}}" class="btn btn-info "><i class="fa fa-file-o"></i> <span>Register New Clients</span></a>
            <a  href="{{url('clients')}}" class="btn btn-info "><i class="fa fa-list"></i> <span>List All</span></a>
            <a  href="{{url('clients')}}" class="btn btn-info "><i class="fa fa-search"></i> <span>Search</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- Basic layout-->
            {!! Form::open(array('url'=>'clients','role'=>'form','id'=>'formClients')) !!}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Client Registration Details</h5>
                    </div>

                    <div class="panel-body">
                        <fieldset class="scheduler-border">
                            <legend class="text-bold">Personal Details</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Client Number</label>
                                        <input type="text" class="form-control" placeholder="Client Number" name="client_number" id="client_number"
                                               value="{{old('client_number')}}">
                                        @if($errors->first('client_number') !="")
                                            <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('client_number') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Full Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="{{old('full_name')}}">
                                        @if($errors->first('full_name') !="")
                                            <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('full_name') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Sex</label>
                                        <select class="select" name="sex" id="sex">
                                            @if(old('sex') != "")
                                                <option value="{{old('sex')}}" selected>{{old('sex')}}</option>
                                                @endif
                                            <option value="">Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @if($errors->first('sex') !="")
                                            <label id="sex-error" class="validation-error-label" for="sex">{{ $errors->first('sex') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Age</label>
                                        <input type="number" class="form-control" name="age" id="age" placeholder="Age" value="{{old('age')}}">
                                        @if($errors->first('age') !="")
                                            <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('age') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Civil Status</label>
                                        <select class="select" name="civil_status" id="civil_status">
                                            @if(old('civil_status'))
                                                <option value="{{old('civil_status')}}" selected>{{old('civil_status')}}</option>
                                                @endif
                                            <option value="">Civil Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                                        @if($errors->first('civil_status') !="")
                                            <label id="civil_status-error" class="validation-error-label" for="address">{{ $errors->first('civil_status') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Name of Spouse</label>
                                        <input type="text" class="form-control" placeholder="Name of Spouse" name="spouse_name" id="spouse_name" readonly value="{{old('spouse_name')}}">
                                        @if($errors->first('spouse_name') !="")
                                            <label id="address-error" class="validation-error-label" for="spouse_name">{{ $errors->first('spouse_name') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-material">
                                <label class="control-label">Care Giver</label>
                                <input type="text" class="form-control" placeholder="Care Giver" name="care_giver" id="care_giver" value="{{old('care_giver')}}">
                                @if($errors->first('care_giver') !="")
                                    <label id="address-error" class="validation-error-label" for="care_giver">{{ $errors->first('care_giver') }}</label>
                                @endif
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="text-bold" >Household Size </legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Number of Males</label>
                                        <input type="number" class="form-control" name="males_total" id="males_total" placeholder="Number of Males" value="{{old('males_total')}}">
                                        @if($errors->first('males_total') !="")
                                            <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('males_total') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-material">
                                        <label class="control-label">Number of Females</label>
                                        <input type="number" class="form-control" name="females_total" id="females_total" placeholder="Number of Females" value="{{old('females_total')}}">
                                        @if($errors->first('females_total') !="")
                                            <label id="address-error" class="validation-error-label" for="females_total">{{ $errors->first('females_total') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-group-material">
                                    <label class="control-label">Date of Arrival</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" class="form-control pickadate-selectors" value="{{old('date_arrival')}}" name="date_arrival" id="date_arrival">
                                    </div>
                                    @if($errors->first('date_arrival') !="")
                                        <label id="address-error" class="validation-error-label" for="nationality">{{ $errors->first('date_arrival') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-material">
                                    <label class="control-label">Camp</label>
                                    <select class="select" name="camp_id" id="camp_id">
                                        @if(old('camp_id') !="")
                                            <?php $camp=\App\Camp::find(old('camp_id'));?>
                                            <option value="{{old('camp_id')}}">{{$camp->camp_name}}</option>
                                        @endif
                                        <option value="">Camp</option>
                                        @foreach(\App\Camp::all() as $item)
                                            <option value="{{$item->id}}">{{$item->camp_name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('camp_id') !="")
                                        <label id="address-error" class="validation-error-label" for="nationality">{{ $errors->first('camp_id') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-material">
                                    <label class="control-label">Origin</label>
                                    <select class="select" name="nationality" id="nationality">
                                        @if(old('nationality') !="")
                                            <?php $contry=\App\Country::find(old('nationality'));?>
                                            <option value="{{old('nationality')}}">{{$contry->country_name}}</option>
                                            @endif
                                        <option value="">Origin</option>
                                         @foreach(\App\Country::all() as $item)
                                             <option value="{{$item->id}}">{{$item->country_name}}</option>
                                             @endforeach
                                    </select>
                                    @if($errors->first('nationality') !="")
                                        <label id="address-error" class="validation-error-label" for="nationality">{{ $errors->first('nationality') }}</label>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group form-group-material">
                            <label class="control-label"> Present address (Zone, Cluster, Neibourhood etc)</label>
                            <input type="text" class="form-control" placeholder="Present address (Zone, Cluster, Neibourhood etc)" name="address" id="address" value="{{old('address')}}">
                            @if($errors->first('address') !="")
                                <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('address') }}</label>
                            @endif
                        </div>
                        <div class="form-group form-group-material">
                            <label class="control-label"> Household Number</label>
                            <input type="number" class="form-control" placeholder="Household Number" name="household_number" id="household_number" value="{{old('household_number')}}">
                            @if($errors->first('household_number') !="")
                                <label id="address-error" class="validation-error-label" for="household_number">{{ $errors->first('household_number') }}</label>
                            @endif
                        </div>
                        <div class="form-group form-group-material">
                            <label class="control-label"> Ration Card Number </label>
                            <input type="text" class="form-control" placeholder="Ration Card Number " name="ration_card_number" id="ration_card_number" value="{{old('ration_card_number')}}">
                            @if($errors->first('ration_card_number') !="")
                                <label id="address-error" class="validation-error-label" for="ration_card_number">{{ $errors->first('ration_card_number') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Vulnerability Code</label>
                            <select multiple="multiple" class="select" name="vulnerability_code[]" id="vulnerability_code">
                                <optgroup label="Vulnerability Code">
                                    @foreach(\App\PSNCode::all() as $item)
                                    <option value="{{$item->id}}">{{$item->code}}</option>
                                        @endforeach
                                </optgroup>
                            </select>
                            @if($errors->first('vulnerability_code') !="")
                                <label id="address-error" class="validation-error-label" for="vulnerability_code">{{ $errors->first('vulnerability_code') }}</label>
                            @endif
                        </div>
                        <div class="form-group form-group-material">
                            <label class="control-label"> Assistance Received to date </label>
                            <input type="text" class="form-control" name="assistance_received" id="assistance_received" placeholder="Assistance Received to date (mention)..." value="{{old('assistance_received')}}">
                            @if($errors->first('assistance_received') !="")
                                <label id="address-error" class="validation-error-label" for="assistance_received">{{ $errors->first('assistance_received') }}</label>
                            @endif
                        </div>
                        <div class="form-group form-group-material">
                            <label class="control-label"> Problem Specification </label>
                            <input type="text" class="form-control" placeholder="Problem Specification" name="problem_specification" id="assistance_received" value="{{old('problem_specification')}}">
                            @if($errors->first('problem_specification') !="")
                                <label id="address-error" class="validation-error-label" for="problem_specification">{{ $errors->first('problem_specification') }}</label>
                            @endif
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- /basic layout -->

        </div>


    </div>
    <!-- /vertical form options -->
@stop