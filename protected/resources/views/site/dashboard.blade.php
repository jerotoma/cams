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
@section('scripts')
    {!! Html::script("assets/highcharts/js/highcharts.js") !!}
    {!! Html::script("assets/highcharts/js/modules/exporting.js") !!}
    <script>

        $('#clientRegistration').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Client Registration per month for year {{date("Y")}}'
            },
            credits: {
                enabled: false
            },

            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of clients'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            <?php
                $series1="";

                    $series1 .="{ ";
                    $series1 .=" name: 'Clients',";

                    $MonthCount="";
                    $monthData="";
                    for($i=1; $i<= 12; $i++)
                    {
                        $MonthCount.=count(\App\Client::where(\DB::raw('Month(date_arrival)'),'=',$i)->where(\DB::raw('Year(date_arrival)'),'=',date('Y'))->get()).",";
                    }
                    $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
                    $series1 .=" data:[".$monthData."]";
                    $series1 .="  },";


                $seriesdata1=substr($series1,0,strlen($series1)-1);

                ?>

            series: [<?php echo $seriesdata1;?>]
        });
        $('#nfidistribution').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Number of NFI distributed per month for year {{date("Y")}}'
            },
            credits: {
                enabled: false
            },

            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Items'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            <?php
                $series1="";

                $series1 .="{ ";
                $series1 .=" name: 'Items',";

                $MonthCount="";
                $monthData="";
                for($i=1; $i<= 12; $i++)
                {
                    $MonthCount.=count(\App\Client::where(\DB::raw('Month(date_arrival)'),'=',$i)->where(\DB::raw('Year(date_arrival)'),'=',date('Y'))->get()).",";
                }
                $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
                $series1 .=" data:[".$monthData."]";
                $series1 .="  },";


                $seriesdata1=substr($series1,0,strlen($series1)-1);

                ?>

            series: [<?php echo $seriesdata1;?>]
        });
    </script>
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
                                    <div class="text-muted">{{count(\App\Client::all())}}</div>
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
                                    <div class="text-muted">{{count(\App\Client::where('sex','=','Female')->get())}}</div>
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
                                    <div class="text-muted"> {{count(\App\Client::where('sex','=','Male')->get())}}</div>
                                </li>
                            </ul>

                            <div class="col-md-10 col-md-offset-1">
                                <div class="content-group" id="total-online"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar5  position-left text-slate"></i>{{count(\App\Referral::all())}}</h5>
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
        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="clientRegistration"></div>
        </div>

        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="nfidistribution"></div>
        </div>
    </div>
@stop