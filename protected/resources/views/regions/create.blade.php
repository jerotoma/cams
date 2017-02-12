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
    @include('inc.main_navigation')
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
            {!! Form::open(array('url'=>'regions','role'=>'form','id'=>'formCountries')) !!}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Regions Details</h5>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label>Country Name:</label>
                            <select class="select" name="country_id" id="country_id">
                                @if(old('country_id') !="")
                                    <?php $country=\App\Country::find(old('country_id'));?>
                                     <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @else
                                    <option value="">--Select--</option>
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
                            <input type="text" class="form-control" placeholder="Region Name" name="region_name" id="region_name" value="{{old('region_name')}}">
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