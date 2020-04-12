@extends('layout.master')
@section('page_js')
    @include('layout.page_js')
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
@section('page_title')
    Clients Reports!
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Reports</span> - NFIs and Cash Distribution</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">NFIs & Cash Distribution Reports</li>
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

        $('#monthlyNfisDistributions').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly NFIS distribution for year {{date("Y")}}'
            },
            subtitle: {
                text: 'Item distribution as of year {{date('Y')}}',
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
                    text: 'Number of Items'
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

            series: [<?php echo getHighItemsDistributionsMonthlyCountByYear(date('Y'));?>]
        });
        $('#monthlyCashProvisions').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Cash Distribution for year {{date("Y")}}'
            },
            subtitle: {
                text: 'Cash Distribution as of year {{date('Y')}}',
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
                    text: 'Amounts in TZS'
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

            series: [<?php echo getHighCashProvisionsMonthlyCountByYear(date('Y'));?>]
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
                report_type: "required",
                export_type: "required"
            },
            messages: {
                report_type: "Please report type is required",
                export_type: "Please Export type is required"

            }
        });
    </script>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('clients')}}" class="btn btn-primary"><i class="fa fa-search "></i> <span>Go to Clients</span></a>
            <a  href="{{url('reports/nfis')}}" class="btn btn-primary "><i class="fa fa-list "></i> <span>NFIs and Cash Distribution Reports</span></a>

        </div>
    </div>
    @include('reports.nfis.searchform')
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div style="min-width: 310px; height: 500px; margin: 0 auto" id="monthlyNfisDistributions"></div>
        </div>

    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div style="min-width: 310px; height: 500px; margin: 0 auto" id="monthlyCashProvisions"></div>
        </div>

    </div>

@stop
