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
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    {!! Form::open(array('url'=>'generate/reports/clients','role'=>'form','id'=>'formClientReport')) !!}
                    <div class="panel panel-flat">


                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="text-bold">Client Registration Reports</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Arrival Date: Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control pickadate"  value="{{old('start_date')}}" name="start_date" id="start_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control pickadate" value="{{old('end_date')}}" name="end_date" id="end_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">HAI Reg No</label>
                                            <input type="text" class="form-control" name="hai_reg_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">Unique ID</label>
                                            <input type="text" class="form-control" name="unique_id">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Sex</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="sex" id="sex">
                                                <optgroup label="Sex">
                                                    <option value="All">All</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Specific Needs?</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="specific_needs" id="specific_needs" data-placeholder="Choose an option...">
                                                <optgroup label="Specific Needs">
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
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label"> Ration Card Number </label>
                                            <input type="text" class="form-control" placeholder="Ration Card Number " name="ration_card_number" id="ration_card_number" value="{{old('ration_card_number')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Age Group</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="age_score" id="age_score">
                                                <optgroup label="Group">
                                                    <option></option>
                                                    <option value="A">0 - 17</option>
                                                    <option value="B">17 - 50</option>
                                                    <option value="C">50 - 60</option>
                                                    <option value="D">60 ></option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label"> Present address (Zone, Cluster, Neibourhood etc)</label>
                                            <input type="text" class="form-control" placeholder="Present address " name="present_address" id="present_address" value="{{old('address')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <label>What type of report type do you need?</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="report_type" id="report_type" data-placeholder="Choose an option...">
                                                <optgroup label="Report Type">
                                                    <option></option>
                                                    <option value="1">Registration by Category</option>
                                                    <option value="2" >Population Planning Groups</option>
                                                    <option value="3" >Specific needs provided</option>
                                                    <option value="4" >All Registration Details</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Export Type</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="export_type" id="export_type" data-placeholder="Choose an option...">
                                                <optgroup label="Export Type">
                                                    <option></option>
                                                    <option value="1" >Preview</option>
                                                    <option value="2">Export to MS Excel</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-cogs"></i> Generate report </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8" id="output">

                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-bold text-center">Client Registration details</h5>
        </div>

        <div class="panel-body">
            <div class="row clearfix" style="margin-top: 20px">
                <div class="col-md-12 column">
                    <?php
                    $end_time ="";
                    $start_time="";
                    $range="";
                    if($request->start_date != ""){
                        $start_time = date("Y-m-d", strtotime($request->start_date));
                    }
                    if($request->end_date != ""){
                        $end_time = date("Y-m-d", strtotime($request->end_date));
                    }
                    if($start_time != "" && $end_time !=""){
                        $range = [$start_time, $end_time];
                    }
                    ?>
                    @if($request->specific_needs =="All")
                        @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
                            @if($request->camp_id=="All")
                                @foreach(\App\Camp::all() as $camp)
                                        <div class="row clearfix" style="margin-top: 20px">
                                            <div class="col-md-10 col-md-offset-1">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                                            <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                                            <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                                            <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                                            <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center">in numbers</td>
                                            <td style="text-align: center">in %</td>
                                            <td style="text-align: center">in numbers</td>
                                            <td style="text-align: center">in %</td>
                                            <td style="text-align: center">in numbers</td>
                                            <td style="text-align: center">in %</td>
                                        </tr>
                                        <tr>
                                            <td>0-17</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                        </tr>
                                        <tr>
                                            <td>18-49</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                        </tr>
                                        <tr>
                                            <td>50-59</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                        </tr>
                                        <tr>
                                            <td>60 and ></td>
                                            <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                            <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                        </tr>
                                        <tr>
                                            <td style=";background-color: #ccc">Total</td>
                                            <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                            <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                            <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                            <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                            <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                            <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Major locations:</td>
                                            <td colspan="4">{{$camp->camp_name}}</td>
                                        </tr>
                                    </table>
                                            </div>
                                        </div>
                                @endforeach
                            @else
                                <?php $camp=\App\Camp::find($request->camp_id);?>
                                    <div class="row clearfix" style="margin-top: 20px">
                                        <div class="col-md-10 col-md-offset-1">
                                            <table class="table table-bordered table-hover">
                                                <tr>
                                                    <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                                                    <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                                                    <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                                                    <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                                                    <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">in numbers</td>
                                                    <td style="text-align: center">in %</td>
                                                    <td style="text-align: center">in numbers</td>
                                                    <td style="text-align: center">in %</td>
                                                    <td style="text-align: center">in numbers</td>
                                                    <td style="text-align: center">in %</td>
                                                </tr>
                                                <tr>
                                                    <td>0-17</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>18-49</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>50-59</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>60 and ></td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td style=";background-color: #ccc">Total</td>
                                                    <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">Major locations:</td>
                                                    <td colspan="4">{{$camp->camp_name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    @else
                        <?php $code=\App\PSNCode::find($request->specific_needs);?>
                        @if($request->camp_id=="All")
                            @foreach(\App\Camp::all() as $camp)
                                    <div class="row clearfix" style="margin-top: 20px">
                                        <div class="col-md-10 col-md-offset-1">
                                            <table class="table table-bordered table-hover">
                                                <tr>
                                                    <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                                                    <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                                                    <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                                                    <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                                                    <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">in numbers</td>
                                                    <td style="text-align: center">in %</td>
                                                    <td style="text-align: center">in numbers</td>
                                                    <td style="text-align: center">in %</td>
                                                    <td style="text-align: center">in numbers</td>
                                                    <td style="text-align: center">in %</td>
                                                </tr>
                                                <tr>
                                                    <td>0-17</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>18-49</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>50-59</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>60 and ></td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td style=";background-color: #ccc">Total</td>
                                                    <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                                    <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">Major locations:</td>
                                                    <td colspan="4">{{$camp->camp_name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                            @endforeach
                        @else
                            <?php $camp=\App\Camp::find($request->camp_id);?>
                                <div class="row clearfix" style="margin-top: 20px">
                                    <div class="col-md-10 col-md-offset-1">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                                                <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                                                <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                                                <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                                                <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center">in numbers</td>
                                                <td style="text-align: center">in %</td>
                                                <td style="text-align: center">in numbers</td>
                                                <td style="text-align: center">in %</td>
                                                <td style="text-align: center">in numbers</td>
                                                <td style="text-align: center">in %</td>
                                            </tr>
                                            <tr>
                                                <td>0-17</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                                            </tr>
                                            <tr>
                                                <td>18-49</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                                            </tr>
                                            <tr>
                                                <td>50-59</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                                            </tr>
                                            <tr>
                                                <td>60 and ></td>
                                                <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                                            </tr>
                                            <tr>
                                                <td style=";background-color: #ccc">Total</td>
                                                <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                                <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                                                <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                                <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                                                <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                                <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Major locations:</td>
                                                <td colspan="4">{{$camp->camp_name}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>


    </div>
@stop
