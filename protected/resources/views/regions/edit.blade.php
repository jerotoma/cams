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
    Regions
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Regions</span> - Add new Region</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('regions')}}">Regions</a></li>
        <li class="active">Add New</li>
    </ul>
@stop
@section('contents')
    <!-- Vertical form options -->
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('regions/create')}}" class="btn btn-info "><i class="fa fa-file-o"></i> <span>Add New</span></a>
            <a  href="{{url('regions')}}" class="btn btn-info "><i class="fa fa-list"></i> <span>List All</span></a>
            <a  href="{{url('regions')}}" class="btn btn-info "><i class="fa fa-search"></i> <span>Search</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- Basic layout-->
            {!! Form::model($region, array('route' => array('regions.update', $region->id), 'method' => 'PUT','role'=>'form','id'=>'formRegion')) !!}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Regions Details</h5>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label>Country Name:</label>
                        <select class="form-control" name="country_id" id="country_id">
                            @if(old('country_id') !="")
                                <?php $country=\App\Country::find(old('country_id'));?>
                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                            @else
                                @if(is_object($region->country) && $region->country != null )
                                <option value="{{$region->country->id}}" selected>{{$region->country->country_name}}</option>
                                    @else
                                    <option value="">--Select--</option>
                                    @endif
                            @endif
                            @foreach(\App\Country::orderBy('country_name','ASC')->get() as $item)
                                <option value="{{$item->id}}">{{$item->country_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('country_id') !="")
                            <label id="country_name-error" class="validation-error-label" for="country_id">{{ $errors->first('country_id') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Regions Name:</label>
                        <input type="text" class="form-control" placeholder="Region Name" name="region_name" id="region_name"
                               @if(old('region_name') !="") value="{{old('region_name')}}" @else  value="{{$region->region_name}}" @endif>
                        @if($errors->first('region_name') !="")
                            <label id="region_name-error" class="validation-error-label" for="region_name">{{ $errors->first('region_name') }}</label>
                        @endif
                        @if(Session::has('region_error'))
                            <label id="country_code-error" class="validation-error-label" for="country_code">{{ Session::get('region_error') }}</label>
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