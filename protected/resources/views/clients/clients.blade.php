@extends('site.master')
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
                "scrollX": false,
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
                                        location.reload();
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
                                        location.reload();
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

    </script>

@stop
@section('main_navigation')
    <div class="sidebar-category sidebar-category-visible">
        <div class="category-content no-padding">
            <ul class="navigation navigation-main navigation-accordion">
                <li ><a href="{{url('home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                <!-- Main -->

                <li class="active">
                    <a href="#"><i class="icon-users"></i> <span>Clients</span></a>
                    <ul>
                        <li class="active"><a href="{{url('clients')}}">Clients Management</a></li>
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

                <!-- /appearance -->

                <!-- Layout -->
                <li class="navigation-header"><span>Users Managements</span> <i class="icon-menu" title="Users Managements"></i></li>
                <li>
                    <a href="#"><i class="icon-users"></i> <span>Users</span></a>
                    <ul>
                        <li><a href="{{url('users')}}">Manage Users</a></li>
                        <li><a href="{{url('departments')}}">Departments</a></li>
                        <li><a href="{{url('access/rights')}}">User Rights</a></li>
                        <li><a href="{{url('audit/logs')}}">User Logs</a></li>
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
    @include('clients.formsearch')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-bold text-center">Client Search Results</h5>
        </div>

        <div class="panel-body">
            <div class="row clearfix" style="margin-top: 20px">
                <div class="col-md-12 column">
                    <table class="table datatable-column-search-inputs table-bordered table-hover" id="tab_logic">
                        <thead>
                        <tr >
                            <th class="text-center">
                                SNO
                            </th>
                            <th class="text-center">
                                HAI Reg #
                            </th>
                            <th class="text-center">
                                Full Name
                            </th>
                            <th class="text-center">
                                Sex
                            </th>
                            <th class="text-center">
                                Age
                            </th>
                            <th class="text-center">
                                Rational Card
                            </th>
                            <th class="text-center">
                                Date of Arrival
                            </th>
                            <th class="text-center">
                                Camp
                            </th>
                            <th class="text-center">
                                Vulnerability Codes
                            </th>
                            <th class="text-center">
                                Auth Status
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $co=1;?>
                        @foreach($clients as $client)
                            <tr>
                                <td class="text-center">
                                    {{$co++}}
                                </td>
                                <td class="text-center">
                                    {{$client->hai_reg_number}}
                                </td>
                                <td class="text-center">
                                    {{$client->full_name}}
                                </td>
                                <td class="text-center">
                                    {{$client->sex}}
                                </td>
                                <td class="text-center">
                                    {{$client->age}}
                                </td>
                                <td class="text-center">
                                    {{$client->ration_card_number}}
                                </td>
                                <td class="text-center">
                                    {{$client->date_arrival}}
                                </td>
                                <td class="text-center">
                                    @if(is_object(\App\Client::find($client->id)->camp) && \App\Client::find($client->id)->camp != null)
                                    {{\App\Client::find($client->id)->camp->camp_name}}
                                        @endif
                                </td>
                                <td class="text-center">
                                    <?php $codes=""; ?>
                                @if(is_object(\App\Client::find($client->id)->vulnerabilityCodes) && count(\App\Client::find($client->id)->vulnerabilityCodes) >0)
                                    @foreach(\App\Client::find($client->id)->vulnerabilityCodes as $code)
                                        @if(is_object($code->code) && $code->code != null)
                                        <?php $codes .= $code->code->code ." -";?>
                                          @endif
                                        @endforeach
                                        @endif
                                       <?php $codes=substr($codes,0,strlen($codes)-1)?>
                                    {{$codes}}
                                </td>
                                <td class="text-center">
                                    {{$client->auth_status}}
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list text-center">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li id="{{$client->id}}"><a href="#" class="showRecord label "><i class="fa fa-eye "></i> Show </a></li>
                                                @if(strtolower($client->auth_status) =="pending")
                                                    @permission('authorize')
                                                <li id="{{$client->id}}"><a href="#" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                                                    @endpermission
                                                <li id="{{$client->id}}"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                                <li id="{{$client->id}}"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                                                @else
                                                    @role('admin')
                                                        <li id="{{$client->id}}"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                                        <li id="{{$client->id}}"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                                                    @endrole
                                                @endif
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr >
                            <td class="text-center">
                                SNO
                            </td>
                            <td class="text-center">
                                HAI Reg #
                            </td>
                            <td class="text-center">
                                Full Name
                            </td>
                            <td class="text-center">
                                Sex
                            </td>
                            <td class="text-center">
                                Age
                            </td>
                            <td class="text-center">
                                Rational Card
                            </td>
                            <td class="text-center">
                                Date of Arrival
                            </td>
                            <td class="text-center">
                                Camp
                            </td>
                            <td class="text-center">
                                Vulnerability Codes
                            </td>
                            <td class="text-center">
                                Auth Status
                            </td>
                            <td class="text-center">
                                Action
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>


    </div>
@stop