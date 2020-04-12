@extends('layout.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
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
    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')
    {!! Html::script("assets/highcharts/js/highcharts.js") !!}
    {!! Html::script("assets/highcharts/js/modules/exporting.js") !!}
    <script>
        $('.pickadate').pickadate({

            // Escape any “rule” characters with an exclamation mark (!).
            format: 'yyyy-mm-dd',
        });
        $(function() {


            // Table setup
            // ------------------------------

            // Setting datatable defaults
            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{
                    orderable: true,
                    width: '100px',
                    targets: [ 7 ]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function() {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                }
            });


            // Single row selection
            var singleSelect = $('.datatable-selection-single').DataTable();
            $('.datatable-selection-single tbody').on('click', 'tr', function() {
                if ($(this).hasClass('success')) {
                    $(this).removeClass('success');
                }
                else {
                    singleSelect.$('tr.success').removeClass('success');
                    $(this).addClass('success');
                }
            });


            // Multiple rows selection
            $('.datatable-selection-multiple').DataTable();
            $('.datatable-selection-multiple tbody').on('click', 'tr', function() {
                $(this).toggleClass('success');
            });


            // Individual column searching with text inputs
            $('.datatable-column-search-inputs tfoot td').not(':last-child').each(function () {
                var title = $('.datatable-column-search-inputs thead th').eq($(this).index()).text();
                $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
            });

            var table = $('.datatable-column-search-inputs').DataTable({
                "scrollX": true,
                "fnDrawCallback": function (oSettings) {
                    $(".showRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-eye font-blue-sharp"></i> Clients Details</span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("clients") ?>/"+id1);
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });
                    $(".editRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Update Client Details </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("clients") ?>/"+id1+"/edit");
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });
                    // Confirmation dialog
                    $('.deleteRecord').on('click', function() {
                        var id1 = $(this).parent().attr('id');
                        var btn=$(this).parent().parent().parent().parent().parent().parent();
                        bootbox.confirm("Are You Sure to delete record?", function(result) {
                            if(result){
                                $.ajax({
                                    url:"<?php echo url('clients') ?>/"+id1,
                                    type: 'post',
                                    data: {_method: 'delete', _token :"{{csrf_token()}}"},
                                    success:function(msg){
                                        btn.hide("slow").next("hr").hide("slow");
                                    }
                                });
                            }
                        });
                    });
                    // Confirmation dialog
                    $('.authorizeRecord').on('click', function() {
                        var id1 = $(this).parent().attr('id');
                        var btn=$(this).parent().parent().parent().parent().parent().parent();
                        bootbox.confirm("Are You Sure to athorize record?", function(result) {
                            if(result){
                                $.ajax({
                                    url:"<?php echo url('authorize') ?>/"+id1+"/clients",
                                    type: 'post',
                                    data: {_method: 'post', _token :"{{csrf_token()}}"},
                                    success:function(msg){

                                    }
                                });
                            }
                        });
                    });
                    // Confirmation dialog
                    $('.authorizeAllRecord').on('click', function() {
                        var id1 = $(this).parent().attr('id');
                        var btn=$(this).parent().parent().parent().parent().parent().parent();
                        bootbox.confirm("Are You Sure to athorize record?", function(result) {
                            if(result){
                                $.ajax({
                                    url:"<?php echo url('authorize/clients') ?>",
                                    type: 'post',
                                    data: {_method: 'post', _token :"{{csrf_token()}}"},
                                    success:function(msg){

                                    }
                                });
                            }
                        });
                    });
                }
            });
            table.columns().every( function () {
                var that = this;
                $('input', this.footer()).on('keyup change', function () {
                    that.search(this.value).draw();
                });
            });


            // External table additions
            // ------------------------------

            // Add placeholder to the datatable filter option
            $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });


            // Enable Select2 select for individual column searching
            $('.filter-select').select2();

        });


        $(".addRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" class="modal fade" role="dialog" data-backdrop="false">';
            modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i> Register New Client: Client Registration Details</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow-y','scroll');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("clients/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
                $('body').removeClass('modal-open');
                $('#specific-div').modal('hide');
                $('.modal-backdrop').remove();
            })

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
                export_type: "required",
                report_type: "required"

            },
            messages: {
                export_type: "Please this field is required",
                report_type: "Please this field is required"
            }
        });

        $('#ageGroup').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Items Distributions Age groups'
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
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            @if($request->camp_id =="All")
            series: [{
                name: 'Clients',
                colorByPoint: true,
                data: [<?php echo getHighChatItemsDistributionByAgeGroup($range);?>]
            }]
            @else
            series: [{
                name: 'Clients',
                colorByPoint: true,
                data: [<?php echo getHighChatItemsDistributionByAgeGroupByCamp($range,$request->camp_id);?>]
            }]
            @endif

        });
        $('#clientsNeeds').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Items distribution vs vulnerabilities'
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
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            @if($request->camp_id =="All")
            series: [{
                name: 'Clients',
                colorByPoint: true,
                data: [<?php echo getHighChatItemsDistributionByVulnerability($range);?>]
            }]
            @else
            series: [{
                name: 'Clients',
                colorByPoint: true,
                data: [<?php echo getHighChatItemsDistributionByVulnerabilityByCamp($range,$request->camp_id);?>]
            }]
            @endif
        });
    </script>

@stop
@section('page_title')
    Clients
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Clients Managements </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('clients')}}">Clients list</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            @permission('create')
            <a  href="#" class="addRecord btn btn-primary"><i class="fa fa-user-plus "></i> <span>Register New Client</span></a>
            @endpermission
            <a  href="{{url('clients')}}" class="btn btn-primary "><i class="fa fa-list "></i> <span>List All</span></a>
            <a  href="{{url('search/clients')}}" class="btn btn-primary"><i class="fa fa-search "></i> <span>Search</span></a>
            @permission('authorize')
            <a  href="#" class="authorizeAllRecord btn btn-danger"><i class="fa fa-check "></i> <span>Authorize All</span></a>
            @endpermission
            @permission('edit')
            <a  href="{{url('import/clients')}}" class="btn btn-primary"><i class="fa fa-upload"></i> <span>Import Clients</span></a>
            @endpermission
        </div>
    </div>
    @include('reports.nfis.searchform')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-bold text-center">Items Distribution Report as of {{$request->start_date}} - {{$request->end_date}} </h5>
        </div>

        <div class="panel-body">
            <div class="row clearfix" style="margin-top: 20px">
                <div class="col-md-12 column">
                       @if($request->camp_id =="All")
                            @if($request->items =="All")
                                @foreach(\App\ItemsInventory::all() as $item)
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                                    <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                                </tr>
                                <tr style="background-color: #ccc">
                                    <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                                </tr>
                                <tr>
                                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                </tr>
                                <tr>
                                    <td  valign="top">0-17</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('A','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Female',$range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('A','Female',$range,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('A',$range,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('A',$range,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top">18-49</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('B','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Female',$range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('B','Female',$range,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('B',$range,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('B',$range,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top">50-59</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('C','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Female',$range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('C','Female',$range,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('C',$range,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('C',$range,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top">60 and &gt;</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('D','Male',$range,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Female',$range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('D','Female',$range,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('D',$range,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('D',$range,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top" ><strong>Total:</strong></td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Male',$range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Male',$range,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Female',$range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Female',$range,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAll($range,$item->id)}} </td>
                                </tr>
                                <tr>
                                    <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                                    <td  colspan="5" valign="top" style="background-color: #ccc">Nduta Mtendeni</td>
                                </tr>
                            </table>
                                @endforeach
                            @else
                            <?php $item =\App\ItemsInventory::findorfail($request->items);?>
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                                        <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                                    </tr>
                                    <tr style="background-color: #ccc">
                                        <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                                    </tr>
                                    <tr>
                                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                    </tr>
                                    <tr>
                                        <td  valign="top">0-17</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('A','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Female',$range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('A','Female',$range,$item->id)}} </td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('A',$range,$item->id)}} </td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('A',$range,$item->id)}}</td>
                                    </tr>
                                    <tr>
                                        <td  valign="top">18-49</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('B','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Female',$range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('B','Female',$range,$item->id)}} </td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('B',$range,$item->id)}} </td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('B',$range,$item->id)}}</td>
                                    </tr>
                                    <tr>
                                        <td  valign="top">50-59</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('C','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Female',$range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('C','Female',$range,$item->id)}} </td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('C',$range,$item->id)}} </td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('C',$range,$item->id)}}</td>
                                    </tr>
                                    <tr>
                                        <td  valign="top">60 and &gt;</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('D','Male',$range,$item->id)}}</td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Female',$range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('D','Female',$range,$item->id)}} </td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('D',$range,$item->id)}} </td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('D',$range,$item->id)}}</td>
                                    </tr>
                                    <tr>
                                        <td  valign="top" ><strong>Total:</strong></td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Male',$range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Male',$range,$item->id)}} </td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Female',$range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Female',$range,$item->id)}} </td>
                                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}}</td>
                                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAll($range,$item->id)}} </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                                        <td  colspan="5" valign="top" style="background-color: #ccc">Nduta Mtendeni</td>
                                    </tr>
                                </table>
                            @endif
                        @else
                        <?php $camp=\App\Camp::find($request->camp_id);?>
                            @if($request->items =="All")
                                @foreach(\App\ItemsInventory::all() as $item)
                                  <table class="table table-bordered table-hover">
                                      <tr>
                                          <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                                          <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                                      </tr>
                                <tr style="background-color: #ccc">
                                    <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                                </tr>
                                <tr>
                                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                </tr>
                                <tr>
                                    <td  valign="top">0-17</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Female',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Female',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('A',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('A',$range,$camp->id,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top">18-49</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Female',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Female',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('B',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('B',$range,$camp->id,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top">50-59</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Female',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Female',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('C',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('C',$range,$camp->id,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top">60 and &gt;</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Female',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Female',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('D',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('D',$range,$camp->id,$item->id)}}</td>
                                </tr>
                                <tr>
                                    <td  valign="top" ><strong>Total:</strong></td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Male',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Male',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Female',$range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Female',$range,$camp->id,$item->id)}} </td>
                                    <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAllByCamp($range,$camp->id,$item->id)}}</td>
                                    <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAllByCamp($range,$camp->id,$item->id)}} </td>
                                </tr>
                                <tr>
                                    <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                                    <td  colspan="5" valign="top" style="background-color: #ccc">{{$camp->camp_name}}</td>
                                </tr>
                            </table>
                                @endforeach
                            @else
                                <?php $item =\App\ItemsInventory::findorfail($request->items);?>
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                                            <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                                        </tr>
                                        <tr style="background-color: #ccc">
                                            <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                                        </tr>
                                        <tr>
                                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                                        </tr>
                                        <tr>
                                            <td  valign="top">0-17</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Female',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Female',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('A',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('A',$range,$camp->id,$item->id)}}</td>
                                        </tr>
                                        <tr>
                                            <td  valign="top">18-49</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Female',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Female',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('B',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('B',$range,$camp->id,$item->id)}}</td>
                                        </tr>
                                        <tr>
                                            <td  valign="top">50-59</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Female',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Female',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('C',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('C',$range,$camp->id,$item->id)}}</td>
                                        </tr>
                                        <tr>
                                            <td  valign="top">60 and &gt;</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Female',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Female',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('D',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('D',$range,$camp->id,$item->id)}}</td>
                                        </tr>
                                        <tr>
                                            <td  valign="top" ><strong>Total:</strong></td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Male',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Male',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Female',$range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Female',$range,$camp->id,$item->id)}} </td>
                                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAllByCamp($range,$camp->id,$item->id)}}</td>
                                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAllByCamp($range,$camp->id,$item->id)}} </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                                            <td  colspan="5" valign="top" style="background-color: #ccc">{{$camp->camp_name}}</td>
                                        </tr>
                                    </table>
                            @endif
                    @endif
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div style="min-width: 410px; height: 500px; margin: 0 auto" id="ageGroup"></div>
            </div>
            <div class="col-md-6">
                <div style="min-width: 410px; height: 500px; margin: 0 auto" id="clientsNeeds"></div>
            </div>
        </div>
    </div>
@stop
