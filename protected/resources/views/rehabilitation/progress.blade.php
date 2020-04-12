@extends('layout.master')
@section('page_js')
    @include('layout.page_js')
@stop
@section('page_heading_title')
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Rehabilitation Service </span> - Progress</h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><a href="{{url('rehabilitation/register')}}"><i class="icon-grid position-left"></i>  Rehabilitation</a></li>
        <li class="active">Progress</li>
    </ul>
@stop
@section('contents')
    <!-- Vertical form options -->
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('rehabilitation/register')}}" class="btn btn-success "><i class="fa fa-plus"></i> <span>Add New</span></a>
            <a  href="{{url('rehabilitation/export')}}" class="btn btn-success "><i class="fa fa-arrow-up"></i> <span>Export</span></a>
            <a  href="{{url('rehabilitation/import')}}" class="btn btn-success "><i class="fa fa-cloud-upload"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-center">Progress</h5>
        </div>
        <div class="panel-body">

        </div>
    </div>


@stop
