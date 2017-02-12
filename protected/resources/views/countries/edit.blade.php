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
    Countries
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Countries</span> - Add new country</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('countries')}}">Countries</a></li>
        <li class="active">Add New</li>
    </ul>
@stop
@section('contents')
    <!-- Vertical form options -->
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('countries/create')}}" class="btn btn-info "><i class="fa fa-file-o"></i> <span>Add New</span></a>
            <a  href="{{url('countries')}}" class="btn btn-info "><i class="fa fa-list"></i> <span>List All</span></a>
            <a  href="{{url('countries')}}" class="btn btn-info "><i class="fa fa-search"></i> <span>Search</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- Basic layout-->
            {!! Form::model($country, array('route' => array('countries.update', $country->id), 'method' => 'PUT','role'=>'form','id'=>'formCountry')) !!}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Country Details</h5>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label>Country Name:</label>
                        <input type="text" class="form-control" placeholder="Country Name" name="country_name" id="country_name"
                               @if(old('country_name') != "") value="{{old('country_name')}}" @else value="{{$country->country_name}}" @endif>
                        @if($errors->first('country_name') !="")
                            <label id="country_name-error" class="validation-error-label" for="country_name">{{ $errors->first('country_name') }}</label>
                        @endif
                        @if(Session::has('country_error'))
                            <label id="country_code-error" class="validation-error-label" for="country_code">{{ Session::get('country_error') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Country Code:</label>
                        <input type="text" class="form-control" placeholder="Country Code" name="country_code" id="country_code"
                               @if(old('country_code') != "") value="{{old('country_code')}}" @else value="{{$country->country_code}}" @endif>
                        @if($errors->first('country_code') !="")
                            <label id="country_code-error" class="validation-error-label" for="country_code">{{ $errors->first('country_code') }}</label>
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