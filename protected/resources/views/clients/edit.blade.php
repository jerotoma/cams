@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_multiselect.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/touchspin.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/switch.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/switchery.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>

    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/form_validation.js")}}"></script>

    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')
    <script>
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
    Camps
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Camps</span> - Add new District</h4>
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
            <a  href="{{url('camps/create')}}" class="btn btn-info "><i class="fa fa-file-o"></i> <span>Add New</span></a>
            <a  href="{{url('camps')}}" class="btn btn-info "><i class="fa fa-list"></i> <span>List All</span></a>
            <a  href="{{url('camps')}}" class="btn btn-info "><i class="fa fa-search"></i> <span>Search</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- Basic layout-->
            {!! Form::model($camp, array('route' => array('camps.update', $camp->id), 'method' => 'PUT','role'=>'form','id'=>'formCamp')) !!}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Camp Details</h5>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label>Camp Name:</label>
                        <input type="text" class="form-control" placeholder="Camp Name" name="camp_name" id="camp_name"
                               @if(old('camp_name'))value="{{old('camp_name')}}" @else value="{{$camp->camp_name}}" @endif>
                        @if($errors->first('camp_name') !="")
                            <label id="camp_name-error" class="validation-error-label" for="region_name">{{ $errors->first('camp_name') }}</label>
                        @endif
                        @if(Session::has('camp_error'))
                            <label id="country_code-error" class="validation-error-label" for="country_code">{{ Session::get('camp_error') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" placeholder="Description" name="description" id="description">@if(old('description')){{old('description')}}@else{{$camp->description}}@endif</textarea>
                        @if($errors->first('description') !="")
                            <label id="description-error" class="validation-error-label" for="description">{{ $errors->first('description') }}</label>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Address" name="address" id="address"
                                       @if(old('address'))value="{{old('address')}}" @else value="{{$camp->address}}" @endif>
                                @if($errors->first('address') !="")
                                    <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('address') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tel:</label>
                                <input type="text" class="form-control" placeholder="Tel" name="tel" id="tel"
                                       @if(old('tel'))value="{{old('tel')}}" @else value="{{$camp->tel}}" @endif>
                                @if($errors->first('tel') !="")
                                    <label id="tel-error" class="validation-error-label" for="tel">{{ $errors->first('tel') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Region Name:</label>
                                <select class="select" name="region_id" id="region_id">
                                    @if(old('region_id') !="")
                                        <?php $region=\App\Region::find(old('region_id'));?>
                                        <option value="{{$region->id}}" selected>{{$region->region_name}}</option>
                                    @else
                                        @if(is_object($camp->region) && $camp->region != null )
                                        <option value="{{$camp->region->id}}" selected>{{$camp->region->region_name}}</option>
                                            @else
                                            <option value="">--Select--</option>
                                            @endif
                                    @endif
                                    @foreach(\App\Region::orderBy('region_name','ASC')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->region_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->first('region_id') !="")
                                    <label id="region_id_name-error" class="validation-error-label" for="region_id">{{ $errors->first('region_id') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District Name:</label>
                                <select class="select" name="district_id" id="district_id">
                                    @if(old('district_id') !="")
                                        <?php $district=\App\District::find(old('district_id'));?>
                                        <option value="{{$district->id}}" selected>{{$district->district_name}}</option>
                                    @else
                                        @if(is_object($camp->district) && $camp->district != null )
                                            <option value="{{$camp->district->id}}" selected>{{$camp->district->district_name}}</option>
                                        @else
                                            <option value="">--Select--</option>
                                        @endif
                                    @endif
                                </select>
                                @if($errors->first('district_id') !="")
                                    <label id="district_id_name-error" class="validation-error-label" for="region_id">{{ $errors->first('district_id') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <select class="select" name="status" id="status">
                            @if(old('status') !="")
                                <option value="{{old('status')}}">{{old('status')}}</option>
                            @else
                                <option value="{{$camp->status}}" selected>{{$camp->status}}</option>
                            @endif
                                <option value="">--Select--</option>
                            <option value="Working">Working</option>
                            <option value="Closed">Closed</option>
                        </select>
                        @if($errors->first('status') !="")
                            <label id="status-error" class="validation-error-label" for="status">{{ $errors->first('status') }}</label>
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