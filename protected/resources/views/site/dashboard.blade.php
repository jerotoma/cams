@extends('site.master')
@section('page_js')
    @include('inc.page_js')
@stop
@section('main_navigation')
     @include('inc.main_navigation')
@stop
@section('page_title')
    welcome!
@stop
@section('page_heading_title')
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ul>
@stop
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <counter-stat-component></counter-stat-component>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <chart-stat-component></chart-stat-component>
        </div>
    </div>
@stop
