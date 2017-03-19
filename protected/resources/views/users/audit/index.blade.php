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


            // Basic datatable
            $('.datatable-basic').DataTable({
                "scrollX": false,
                "fnDrawCallback": function (oSettings) {
                    $(".viewRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-eye font-blue-sharp"></i> Logs Details</span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("audit/logs") ?>/"+id1);
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });

                }
            });


            // Alternative pagination
            $('.datatable-pagination').DataTable({
                pagingType: "simple",
                language: {
                    paginate: {'next': 'Next &rarr;', 'previous': '&larr; Prev'}
                }
            });


            // Datatable with saving state
            $('.datatable-save-state').DataTable({
                stateSave: true
            });


            // Scrollable datatable
            $('.datatable-scroll-y').DataTable({
                autoWidth: true,
                scrollY: 300
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

        });
        // AJAX sourced data
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
                start_date: "required",
                end_date: "required"
            },
            messages: {
                end_date: "Please report type is required",
                start_date: "Please Export type is required"

            }
        });

    </script>
@stop
@section('main_navigation')
    <div class="sidebar-category sidebar-category-visible">
        <div class="category-content no-padding">
            <ul class="navigation navigation-main navigation-accordion">
                <li ><a href="{{url('home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                <!-- Main -->

                <li>
                    <a href="#"><i class="icon-users"></i> <span>Clients</span></a>
                    <ul>
                        <li ><a href="{{url('clients')}}">Clients Management</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list-unordered"></i> <span>Client Assessments</span></a>
                    <ul>
                        <li ><a href="{{url('assessments/vulnerability')}}">Vulnerability assessment</a></li>
                        <li><a href="{{url('assessments/home')}}">Home Assessment </a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-stack"></i> <span>Client Referrals</span></a>
                    <ul>
                        <li ><a href="{{url('referrals')}}">Referrals</a></li>
                    </ul>
                </li>
                <!-- /main -->
                <!-- Forms -->
                @permission('inventory')

                <li>
                    <a href="#"><i class="icon-popout"></i> <span>NFIs Inventory</span></a>
                    <ul>
                        <li><a href="{{url('items/distributions')}}">Item Distribution</a></li>
                        <li><a href="{{url('inventory-received')}}">Received Items</a></li>
                        <li><a href="{{url('inventory')}}">Items Inventory</a></li>
                        <li><a href="{{url('inventory-categories')}}">Items Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-money"></i> <span>Cash Monitoring</span></a>
                    <ul>
                        <li><a href="{{url('cash/monitoring/provision')}}">Cash Distributions</a></li>
                        <li><a href="{{url('cash/monitoring/budget')}}">Budget Register</a></li>
                        <li><a href="{{url('post/cash/monitoring')}}">Cash Post Distribution Monitoring</a></li>
                    </ul>
                </li>
                @endpermission
            <!-- /forms -->
                <!-- Forms -->

                <li>
                    <a href="#"><i class="icon-grid"></i> <span>Progress Monitoring</span></a>
                    <ul>
                        <li><a href="{{url('cases')}}">Case Management</a></li>
                        <li><a href="{{url('progressive/notices')}}">Progressive Note</a></li>
                    </ul>
                </li>
                @permission('backup')
            <!-- Backup Restore-->
                
                <li>
                    <a href="#"><i class="fa fa-upload "></i> <span>Data import</span></a>
                    <ul>
                        <li><a href="{{url('backup/import/advanced')}}">Import data</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-download"></i> <span>Data Export</span></a>
                    <ul>
                        <li><a href="{{url('backup/export/advanced')}}">Export data</a></li>
                    </ul>
                </li>
                <!-- End Backup Restore-->
                @endpermission
                @permission('reports')
            <!-- Data visualization -->

                <li>
                    <a href="#"><i class="icon-graph"></i> <span> Reports</span></a>
                    <ul>
                        <li><a href="{{url('reports/clients')}}">Client Reports</a></li>
                        <li ><a href="{{url('reports/assessments')}}">Assessments Reports</a></li>
                        <li><a href="{{url('reports/referrals')}}">Referrals Reports</a></li>
                        <li><a href="{{url('reports/nfis')}}">NFIs Reports</a></li>
                    <li><a href="{{url('reports/case/management')}}">Case Management Reports</a></li>
                </ul>
                </li>
                <!-- /data visualization -->
                @endpermission

            <!-- Settings -->
                @role('admin')

                <li>
                    <a href="#"><i class="icon-list"></i> <span>Locations</span></a>
                    <ul>
                        <li><a href="{{url('countries')}}">Countries</a></li>
                        <li><a href="{{url('regions')}}">Regions</a></li>
                        <li><a href="{{url('districts')}}">Districts</a></li>
                        <li><a href="{{url('camps')}}">Camps</a></li>
                        <li><a href="{{url('origins')}}">Origins</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>Vulnerability Codes</span></a>
                    <ul>
                        <li><a href="{{url('psncodes')}}">Codes</a></li>
                        <li><a href="{{url('psncodes-categories')}}">Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('setting/client/needs')}}"><i class="icon-puzzle4"></i> <span>Client Needs Setting</span></a>
                </li>

                <!-- /appearance -->

                <!-- Layout -->
                <li class="navigation-header"><span>Users Managements</span> <i class="icon-menu" title="Users Managements"></i></li>
                <li class="active">
                    <a href="#"><i class="icon-users"></i> <span>Users</span></a>
                    <ul>
                        <li><a href="{{url('users')}}">Manage Users</a></li>
                        <li><a href="{{url('departments')}}">Departments</a></li>
                        <li><a href="{{url('access/rights')}}">User Rights</a></li>
                        <li class="active"><a href="{{url('audit/logs')}}">User Logs</a></li>
                    </ul>
                </li>
                <li class="navigation-header"><span></span> <i class="icon-menu" title="Users Managements"></i></li>
                <!-- /Settings -->
                @endrole
            </ul>
        </div>
    </div>
@stop
@section('page_title')
    System Audit Logs
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">System Audit Logs </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('users')}}">Users list</a></li>
        <li><a href="#">System Audit Logs</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('audit/logs')}}" class="btn btn-primary "><i class="fa fa-list "></i> <span>View Logs</span></a>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    {!! Form::open(array('url'=>'audit/logs','role'=>'form','id'=>'formClientReport')) !!}
                    <div class="panel panel-flat">


                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="text-bold">Filter Logs</legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control pickadate"  @if($request != "")  value="{{$request->start_date}}" @else value="{{old('start_date')}}"@endif name="start_date" id="start_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" class="form-control pickadate" @if($request != "")  value="{{$request->end_date}}" @else value="{{old('end_date')}}" @endif name="end_date" id="end_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Export Type</label>
                                            <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="export_type" id="export_type" data-placeholder="Choose an option...">
                                                <optgroup label="Export Type">
                                                    <option value="1" >Preview</option>
                                                    <option value="2">Export to MS Excel</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-md-offset-3 col-sm-offset-3">
                                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-cog"></i> Generate Report </button>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <button type="reset" class="btn btn-block btn-success"><i class="fa fa-refresh"></i> Reset </button>
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

            <h5 class="panel-title text-center text-uppercase">List of All Users Activities @if($request != "" ) from {{$request->start_date}} to {{$request->end_date}} @endif</h5>
        </div>

        <div class="panel-body">

            <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Module</th>
                <th>Username</th>
                <th>Activity</th>
                <th>Related Page</th>
                <th>Related Data</th>
                <th>IP Address</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
             @foreach($logs as $log)
                <tr>
                <td>{{$count}}</td>
                <td>{{$log->activity_date}}</td>
                <td>{{$log->module}}</td>
                 <td>{{$log->username}}</td>
                <td>{{$log->activity}}</td>
                <td>{{$log->page}}</td>
                <td id="{{$log->id}}"><a href="#"  class="viewRecord btn " title="View Logs"> More details....</a></td>
                  <td>{{$log->ip_address}}</td>
               </tr>
              @endforeach
            </tbody>

            </table>
        </div>
    </div>

@endsection