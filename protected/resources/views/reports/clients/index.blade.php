@extends('site.master')
@section('page_js')
    @include('inc.page_js')

@stop
@section('main_navigation')
    @include('inc.main_navigation')
@stop
@section('page_title')
    Clients Reports!
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Reports</span> - Clients</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Clients Reports</li>
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
                pointFormat: '<tr><th style="color:{series.color};padding:0">{series.name}: </th>' +
                '<th style="padding:0"><b>{point.y:.0f} </b></th></tr>',
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
        $('#clientsNeeds').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Clients registered & their vulnerabilities'
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
                data: [<?php echo getHighChatClientByCodes();?>]
            }]
        });
    </script>
@stop
@section('contents')
    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="clientsNeeds"></div>
        </div>
        <div class="col-md-6">
            <div style="min-width: 310px; height: 400px; margin: 0 auto" id="clientRegistration"></div>
        </div>

    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body" style="overflow-x: scroll">
                 <h6 class="text-center text-bold">Summary of Active PSN cases assessed/registered by HelpAge as of {{date('jS F Y')}}</h6>
                    <table class="table table-bordered">
                        <thead>
                           <tr>
                               <th rowspan="3" class="text-center">No</th>
                               <th rowspan="3" class="text-center" >Specific Needs</th>
                               <th colspan="9" class="text-center">Active case registered </th>
                               <th colspan="9" class="text-center">Pending for Assessment/Screening Cases</th>
                               <th colspan="9" class="text-center">PSN provided with services</th>
                               <th colspan="9" class="text-center">Receiving Feedback for referred cases</th>
                           </tr>
                           <tr>
                               <th colspan="3" class="text-center">0-17 years old</th>
                               <th colspan="3" class="text-center">18-49 years old</th>
                               <th colspan="3" class="text-center">50 years or older</th>
                               <th colspan="3" class="text-center">0-17 years old</th>
                               <th colspan="3" class="text-center">18-49 years old</th>
                               <th colspan="3" class="text-center">50 years or older</th>
                               <th colspan="3" class="text-center">0-17 years old</th>
                               <th colspan="3" class="text-center">18-49 years old</th>
                               <th colspan="3" class="text-center">50 years or older</th>
                               <th colspan="3" class="text-center">0-17 years old</th>
                               <th colspan="3" class="text-center">18-49 years old</th>
                               <th colspan="3" class="text-center">50 years or older</th>
                           </tr>
                           <tr>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                               <th>M</th>
                               <th>F</th>
                               <th>Total</th>
                           </tr>
                           <?php $cou=1;?>
                         @foreach(\App\PSNCode::all() as  $cod)
                         <tr>
                             <td>{{$cou++}}</td>
                             <td>{{$cod->description}}</td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                         </tr>
                             @endforeach

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    {!! Form::open(array('url'=>'clients','role'=>'form','id'=>'formClients')) !!}
                    <div class="panel panel-flat">


                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="text-bold">Generate Client Report</legend>

                            </fieldset>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
@stop