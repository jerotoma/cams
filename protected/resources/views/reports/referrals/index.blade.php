@extends('site.master')
@section('page_js')
    @include('inc.page_js')
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jasny_bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_multiselect.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_select.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/selectboxit.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tagsinput.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tokenfield.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/touchspin.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/maxlength.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/formatter.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/moment/moment.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/form_floating_labels.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>

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
        $('.pickadate').pickadate({

            // Escape any “rule” characters with an exclamation mark (!).
            format: 'yyyy-mm-dd',
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

        $("#formClientReport").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                    else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            errorElement:'div',
            rules: {
                report_type: "required"
            },
            messages: {
                report_type: "Please report type is required"

            }
        });
    </script>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('clients')}}" class="btn btn-primary "><i class="fa fa-list "></i> <span>List All</span></a>
            <a  href="{{url('clients')}}" class="btn btn-primary"><i class="fa fa-search "></i> <span>Search</span></a>
            <a  href="{{url('import/clients')}}" class="btn btn-primary"><i class="fa fa-upload"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    {!! Form::open(array('url'=>'generate/reports/clients','role'=>'form','id'=>'formClientReport')) !!}
                    <div class="panel panel-flat">


                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="text-bold">Client Registration Report</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control pickadate"  value="{{old('start_date')}}" name="start_date" id="start_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control pickadate" value="{{old('end_date')}}" name="end_date" id="end_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group ">
                                            <label class="control-label">All Dates</label>
                                            <input type="checkbox" class="form-control" value="alldated" name="all_dates">

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>Camp</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="camp_id" id="camp_id">
                                                <optgroup label="Camp Name">
                                                    <option value="All">All</option>
                                                    @foreach(\App\Camp::all() as $item)
                                                        <option value="{{$item->id}}">{{$item->camp_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>Specific Needs?</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="specific_needs" id="specific_needs" data-placeholder="Choose an option...">
                                                <optgroup label="Specific Needs">
                                                    <option></option>
                                                    <option value="All">All</option>
                                                    @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
                                                        <option value="{{$code->id}}">{{$code->description}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>What type of report type do you need?</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="report_type" id="report_type" data-placeholder="Choose an option...">
                                                <optgroup label="Report Type">
                                                    <option></option>
                                                    <option value="Registration by Category">Registration by Category</option>
                                                    <option value="Population Planning Groups" >Population Planning Groups</option>
                                                    <option value="Specific needs provided" >Specific needs provided</option>
                                                    <option value="All Registration Details" >All Registration Details</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-cog"></i> Generate Report </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
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
                        @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as  $cod)
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

@stop