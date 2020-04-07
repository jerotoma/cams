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
            <div class="panel panel-flat">
                <div class="panel-heading">
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-users"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">Users</div>
                                    <div class="text-muted">{{$usersCount}}</div>
                                </li>
                            </ul>

                            <div class="col-md-10 col-md-offset-1">
                                <div class="content-group" id="new-visitors"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">Cases</div>
                                    <div class="text-muted">{{$clientCasesCount}}</div>
                                </li>
                            </ul>

                            <div class="col-md-10 col-md-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">PSN</div>
                                    <div class="text-muted"> {{$clientsCount}}</div>
                                </li>
                            </ul>

                            <div class="col-md-10 col-md-offset-1">
                                <div class="content-group" id="total-online"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar5  position-left text-slate"></i>{{count(\App\ClientReferral::all())}}</h5>
                                <span class="text-muted text-size-small">Referrals</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar52 bg-indigo position-left text-slate"></i> {{count(\App\ItemsDisbursement::all())}}</h5>
                                <span class="text-muted text-size-small">NFI Distribution</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> {{count(\App\VulnerabilityAssessment::all())}}</h5>
                                <span class="text-muted text-size-small">Assessed Clients</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-content">
                    <chart-stat-component></chart-stat-component>
                </div>
            </div>
        </div>
    </div>
@stop
