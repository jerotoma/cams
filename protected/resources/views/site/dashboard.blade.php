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
                text: 'CBR Case status'
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
                    y: {{getHighChatCasesCountByStatus('Open Case')}}
                }, {
                    name: 'Assessment',
                    y: {{getHighChatCasesCountByStatus('Assessment')}},
                    sliced: true,
                    selected: true
                }, {
                    name: 'Case Planning',
                    y: {{getHighChatCasesCountByStatus('Case Planning')}}
                }, {
                    name: 'Case Followup',
                    y: {{getHighChatCasesCountByStatus('Case Followup')}}
                }, {
                    name: 'Case Closed',
                    y: {{getHighChatCasesCountByStatus('Case Closed')}}
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
                valueSuffix: ' Case(s)'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Open Case',
                data: [<?php echo getHighChatMonthlyCasesCountByStatus('Open Case',date('Y'));?>]
            }, {
                name: 'Assessment',
                data: [<?php echo getHighChatMonthlyCasesCountByStatus('Assessment',date('Y'));?>]
            }, {
                name: 'Case Planning',
                data: [<?php echo getHighChatMonthlyCasesCountByStatus('Case Planning',date('Y'));?>]
            }, {
                name: 'Case Followup',
                data: [<?php echo getHighChatMonthlyCasesCountByStatus('Case Followup',date('Y'));?>]
            }, {
                name: 'Case Closed',
                data: [<?php echo getHighChatMonthlyCasesCountByStatus('Case Closed',date('Y'));?>]
            }]


        });
        $('#clientRegistration').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Client Registration for year {{date("Y")}}'
            },
            subtitle: {
                text: 'Number of Registered Clients year {{date('Y')}}',
                x: -20
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
                '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
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

            series: [<?php echo getHighChatClientMonthlyCountByYear(date('Y'));?>]
        });
        $('#nfidistribution').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Client Registration Per Origin'
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
                name: 'Clients',
                colorByPoint: true,
                data: [<?php echo getHighChatClientMonthlyCountByNationality();?>]
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
                text: 'Monthly Average NFIs Items Distribution ',
                x: -20 //center
            },
            subtitle: {
                text: 'Number of Items per month for year {{date('Y')}}',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'NFIs Items'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' Items'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Items',
                data: [<?php echo getHighChatItemsDistributionByYear(date('Y'));?>]
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
        <div class="col-md-12">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="MothNFIsdistribution"></div>
        </div>


    </div>
@stop