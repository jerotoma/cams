@extends('layout.master')
@section('page_js')
    @include('layout.page_js')
@stop
@section('page_title')
    Client Settings
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Settings</span> - Clients</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('settings/clients')}}">Client Settings</a></li>
    </ul>
@stop
@section('contents')


@endsection
