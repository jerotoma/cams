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
        $('#Cases').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Progress case management'
            },
            credits: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Cases',
                colorByPoint: true,
                data: [{
                    name: 'Open Case',
                    y: 56
                }, {
                    name: 'Assessment',
                    y: 200,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Case Planning',
                    y: 100
                }, {
                    name: 'Case Followup',
                    y: 300
                }, {
                    name: 'Case Closed',
                    y: 1940
                }]
            }]
        });
        $('#CasesPerStatus').highcharts({
            chart: {
                type: 'column'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Monthly Average Cases ',
                x: -20 //center
            },
            subtitle: {
                text: 'Number of cases per status for year {{date('Y')}}',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Cases'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'Case'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Open Case',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Assessment',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Case Planning',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'Case Followup',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }, {
                name: 'Case Closed',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]


        });
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
        $('#NFIsdistribution').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'NFIs Item Distributions May, 2015'
            },
            credits: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Items',
                colorByPoint: true,
                data: [ {
                    name: 'Open Case',
                    y: 29,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Assessment',
                    y: 1000
                }, {
                    name: 'Case Planning',
                    y: 300
                }, {
                    name: 'Case Followup',
                    y: 5000
                }, {
                    name: 'Case Closed',
                    y: 10564
                }]
            }]
        });
        $('#MothNFIsdistribution').highcharts({
            chart: {
                type: 'line'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Monthly Average Cases ',
                x: -20 //center
            },
            subtitle: {
                text: 'Number of cases per status for year {{date('Y')}}',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Cases'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'Case'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Open Case',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Assessment',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Case Planning',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'Case Followup',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }, {
                name: 'Case Closed',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]


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
                                    <div class="text-muted">{{count(\App\User::all())}}</div>
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
                                    <div class="text-muted">{{count(\App\ClientCase::all())}}</div>
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
                                    <div class="text-muted"> {{count(\App\Client::all())}}</div>
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
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="Cases"></div>
        </div>

        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="CasesPerStatus"></div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="clientRegistration"></div>
        </div>

        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="nfidistribution"></div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="MothNFIsdistribution"></div>
        </div>
        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="NFIsdistribution"></div>
        </div>

    </div>
@stop