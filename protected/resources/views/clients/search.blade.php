@extends('site.master')
@section('page_js')
    @include('inc.page_js')
@stop
@section('main_navigation')
     @include('inc.main_navigation')
@stop
@section('page_title')
   Search!
@stop
@section('page_heading_title')
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Client</span> - Search</h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">search</li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="#" class="addRecord btn"><i class="fa fa-file-o text-success"></i> <span>Register New Client</span></a>
            <a  href="{{url('clients')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All</span></a>
            <a  href="{{url('search/clients')}}" class="btn "><i class="fa fa-search text-primary"></i> <span>Search</span></a>
            <a  href="{{url('import/clients')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-center"> Search</h5>
        </div>

        <div class="panel-body">
            
        </div>

    </div>
@stop