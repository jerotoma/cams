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
    @include('reports.assessments.searchform')
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
                  @if($request->camp_id=="All")
                          <table class="table table-bordered" >
                              <thead>
                              <tr>
                                  <th style="text-align:center; background-color: #cccccc" colspan="10">Detailed Assessments by Category for Nduta & Mtendeni ({{$start_time. " to ". $end_time}} )</th>
                              </tr>
                              <tr>
                                  <th rowspan="2"  >Specific Needs</th>
                                  <th colspan="2" style="text-align:center; background-color: #cccccc">0-17 Yrs</th>
                                  <th colspan="2" style="text-align:center; background-color: #cccccc">18-49 Yrs</th>
                                  <th colspan="2" style="text-align:center; background-color: #cccccc">50-59yrs</th>
                                  <th colspan="2" style="text-align:center; background-color: #cccccc">60 and ></th>
                                  <th style="text-align:center; background-color: #cccccc"></th>
                              </tr>
                              <tr>
                                  <th  style="text-align:center; background-color: #cccccc">F</th>
                                  <th  style="text-align:center; background-color: #cccccc">M</th>
                                  <th  style="text-align:center; background-color: #cccccc">F</th>
                                  <th  style="text-align:center; background-color: #cccccc">M</th>
                                  <th  style="text-align:center; background-color: #cccccc">F</th>
                                  <th  style="text-align:center; background-color: #cccccc">M</th>
                                  <th  style="text-align:center; background-color: #cccccc">F</th>
                                  <th  style="text-align:center; background-color: #cccccc">M</th>
                                  <th style="text-align:center; background-color: #cccccc">Total</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              $t1=$t2=$t3=$t4=$t5=$t6=$t7=$t8=$t9=0
                              ?>
                              @foreach(\App\Need::all() as $need)
                                  <tr>
                                      <td>{{$need->need_name}}</td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Female','A',$range)}}<?php $t1 = $t1 + getClientAssessmentNeedsAll($need->id,'Female','A',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Male','A',$range)}}<?php $t2 = $t2 + getClientAssessmentNeedsAll($need->id,'Male','A',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Female','B',$range)}}<?php $t3 = $t3 + getClientAssessmentNeedsAll($need->id,'Female','B',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Male','B',$range)}}<?php $t4 = $t4 + getClientAssessmentNeedsAll($need->id,'Male','B',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Female','C',$range)}}<?php $t5 = $t5 + getClientAssessmentNeedsAll($need->id,'Female','C',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Male','C',$range)}}<?php $t6 = $t6 +getClientAssessmentNeedsAll($need->id,'Male','C',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Female','D',$range)}}<?php $t7 = $t7 + getClientAssessmentNeedsAll($need->id,'Female','D',$range);?></td>
                                      <td>{{getClientAssessmentNeedsAll($need->id,'Male','D',$range)}}<?php $t8 = $t8 + getClientAssessmentNeedsAll($need->id,'Male','D',$range);?></td>
                                      <td>{{getClientAssessmentNeedsTotalAll($need->id,$range)}}<?php $t9 = $t9 + getClientAssessmentNeedsTotalAll($need->id,$range);?></td>
                                  </tr>
                              @endforeach
                              <tr>
                                  <th>Total</th>
                                  <td>{{$t1}}</td>
                                  <td>{{$t2}}</td>
                                  <td>{{$t3}}</td>
                                  <td>{{$t4}}</td>
                                  <td>{{$t5}}</td>
                                  <td>{{$t6}}</td>
                                  <td>{{$t7}}</td>
                                  <td>{{$t8}}</td>
                                  <td>{{$t9}}</td>
                              </tr>
                              </tbody>
                              <tfoot></tfoot>
                          </table>
                  @else
                      <?php $camp=\App\Camp::find($request->camp_id);?>
                          <table class="table table-bordered" >
                          <thead>
                          <tr>
                              <th style="text-align:center; background-color: #cccccc" colspan="10">Detailed Registration by Category for {{$camp->camp_name}} ({{$start_time. " to ". $end_time}} )</th>
                          </tr>
                          <tr>
                              <th rowspan="2"  >Specific Needs </th>
                              <th colspan="2" style="text-align:center; background-color: #cccccc">0-17 Yrs</th>
                              <th colspan="2" style="text-align:center; background-color: #cccccc">18-49 Yrs</th>
                              <th colspan="2" style="text-align:center; background-color: #cccccc">50-59yrs</th>
                              <th colspan="2" style="text-align:center; background-color: #cccccc">60 and ></th>
                              <th style="text-align:center; background-color: #cccccc"></th>
                          </tr>
                          <tr>
                              <th  style="text-align:center; background-color: #cccccc">F</th>
                              <th  style="text-align:center; background-color: #cccccc">M</th>
                              <th  style="text-align:center; background-color: #cccccc">F</th>
                              <th  style="text-align:center; background-color: #cccccc">M</th>
                              <th  style="text-align:center; background-color: #cccccc">F</th>
                              <th  style="text-align:center; background-color: #cccccc">M</th>
                              <th  style="text-align:center; background-color: #cccccc">F</th>
                              <th  style="text-align:center; background-color: #cccccc">M</th>
                              <th style="text-align:center; background-color: #cccccc">Total</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                          $t1=$t2=$t3=$t4=$t5=$t6=$t7=$t8=$t9=0
                          ?>
                          @foreach(\App\Need::all() as $need)
                              <tr>
                                  <td>{{$need->need_name}}</td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','A',$camp->id,$range)}}<?php $t1 = $t1 + getClientAssessmentNeedsAllByCamp($need->id,'Female','A',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','A',$camp->id,$range)}}<?php $t2 = $t2 + getClientAssessmentNeedsAllByCamp($need->id,'Male','A',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','B',$camp->id,$range)}}<?php $t3 = $t3 + getClientAssessmentNeedsAllByCamp($need->id,'Female','B',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','B',$camp->id,$range)}}<?php $t4 = $t4 + getClientAssessmentNeedsAllByCamp($need->id,'Male','B',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','C',$camp->id,$range)}}<?php $t5 = $t5 + getClientAssessmentNeedsAllByCamp($need->id,'Female','C',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','C',$camp->id,$range)}}<?php $t6 = $t6 +getClientAssessmentNeedsAllByCamp($need->id,'Male','C',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','D',$camp->id,$range)}}<?php $t7 = $t7 + getClientAssessmentNeedsAllByCamp($need->id,'Female','D',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','D',$camp->id,$range)}}<?php $t8 = $t8 + getClientAssessmentNeedsAllByCamp($need->id,'Male','D',$camp->id,$range);?></td>
                                  <td>{{getClientAssessmentNeedsAllByCampTotal($need->id,$range,$camp->id)}}<?php $t9 = $t9 + getClientAssessmentNeedsAllByCampTotal($need->id,$range,$camp->id);?></td>
                              </tr>
                          @endforeach
                          <tr>
                              <th>Total</th>
                              <td>{{$t1}}</td>
                              <td>{{$t2}}</td>
                              <td>{{$t3}}</td>
                              <td>{{$t4}}</td>
                              <td>{{$t5}}</td>
                              <td>{{$t6}}</td>
                              <td>{{$t7}}</td>
                              <td>{{$t8}}</td>
                              <td>{{$t9}}</td>
                          </tr>
                          </tbody>
                          <tfoot></tfoot>
                      </table>
                  @endif
              </div>

            </div>
        </div>


    </div>
@stop
