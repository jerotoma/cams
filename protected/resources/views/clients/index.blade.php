@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')
    <script>
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
                ajax: '{{url('getclientsjson')}}',
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
                        $('body').css('overflow','hidden');

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
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("clients") ?>/"+id1+"/edit");
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });
                    $(".showVulnerability").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Client Vulnerability Assessments </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("client/assessments/vulnerability") ?>/"+id1+"");
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });
                    $(".showFunctional").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Client Inclusion Assessments </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("client/assessments/inclusion") ?>/"+id1+"");
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });
                    $(".showFunctional").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Client Functional Assessments </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("client/assessments/functional") ?>/"+id1+"");
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });
                    $(".showWheelchair").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Client Wheelchair Assessments </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("client/assessments/wheelchair") ?>/"+id1+"");
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    });

                    $(".deleteRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        $(".deleteModule").show("slow").parent().parent().find("span").remove();
                        var btn = $(this).parent().parent();
                        $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                        $("#no").click(function(){
                            $(this).parent().parent().find(".deleteRecord").show("slow");
                            $(this).parent().parent().find("span").remove();
                        });
                        $("#yes").click(function(){
                            $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                            $.ajax({
                                url:"<?php echo url('clients') ?>/"+id1,
                                type: 'post',
                                data: {_method: 'delete', _token :"{{csrf_token()}}"},
                                success:function(msg){
                                    btn.hide("slow").next("hr").hide("slow");
                                }
                            });
                        });
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


        $(".addRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
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
            $('body').css('overflow','hidden');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("clients/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

    </script>

@stop
@section('main_navigation')
    <div class="sidebar-category sidebar-category-visible">
        <div class="category-content no-padding">
            <ul class="navigation navigation-main navigation-accordion">
                <li class="active"><a href="{{url('home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                <!-- Main -->
                <li class="navigation-header">Registration desk<span></span> <i class="icon-menu" title="Main pages"></i></li>
                <li>
                    <a href="#"><i class="icon-users"></i>Clients <span></span></a>
                    <ul>
                        <li ><a href="{{url('clients')}}">List All Clients</a></li>
                        <li><a href="{{url('search/clients')}}">Search Clients</a></li>
                        <li><a href="{{url('import/clients')}}">Import Clients</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list-unordered"></i> <span>Client Assessments</span></a>
                    <ul>
                        <li ><a href="{{url('assessments/vulnerability')}}">Vulnerability assessment</a></li>
                        <li><a href="{{url('assessments/inclusion')}}">Inclusion assessment</a></li>
                        <li><a href="{{url('assessments/wheelchair')}}">Wheelchair Assessment</a></li>
                        <li><a href="{{url('assessments/home')}}">PSN Needs/Home Assessment </a></li>
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
                <li class="navigation-header"><span>Material Distribution</span> <i class="icon-menu" title="Material Distribution"></i></li>
                <li>
                    <a href="#"><i class="icon-popout"></i> <span>Material Distribution</span></a>
                    <ul>
                        <li><a href="{{url('inventory-received')}}">Item Distribution</a></li>
                        <li><a href="{{url('inventory-received')}}">Received Items</a></li>
                        <li><a href="{{url('inventory')}}">Items Inventory</a></li>
                        <li><a href="{{url('inventory-categories')}}">Items Categories</a></li>
                    </ul>
                </li>

                <!-- /forms -->
                <!-- Forms -->
                <li class="navigation-header"><span>Rehabilitation</span> <i class="icon-menu" title="Forms"></i></li>
                <li>
                    <a href="#"><i class="icon-grid"></i> <span>Rehabilitation Service</span></a>
                    <ul>
                        <li><a href="{{url('rehabilitation/register')}}">Open Register</a></li>
                        <li><a href="{{url('rehabilitation/progress')}}">Progress</a></li>
                        <li><a href="{{url('rehabilitation/register')}}">Search</a></li>
                        <li><a href="{{url('rehabilitation/Import')}}">Import</a></li>
                        <li><a href="{{url('rehabilitation/export')}}">Export</a></li>
                    </ul>
                </li>
                <!-- /forms -->
                <!-- Data visualization -->
                <li class="navigation-header"><span>Data visualization</span> <i class="icon-menu" title="Data visualization"></i></li>
                <li>
                    <a href="#"><i class="icon-graph"></i> <span>Clients Reports</span></a>
                    <ul>
                        <li><a href="{{url('reports/clients')}}">Registration</a></li>
                        <li><a href="{{url('reports/clients')}}">Assessments</a></li>
                        <li><a href="{{url('reports/clients')}}">Refferal</a></li>
                    </ul>
                </li>
                <!-- /data visualization -->
                <!-- Appearance -->
                <li class="navigation-header"><span>Settings</span> <i class="icon-menu" title="Settings"></i></li>
                <li>
                    <a href="#"><i class="icon-list"></i> <span>Countries</span></a>
                    <ul>
                        <li><a href="{{url('countries/create')}}">Add New Country</a></li>
                        <li><a href="{{url('countries')}}">List All Countries</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> <span>Regions</span></a>
                    <ul>
                        <li><a href="{{url('regions/create')}}">Add New Region</a></li>
                        <li><a href="{{url('regions')}}">List All Regions</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="icon-grid"></i> <span>Camps</span></a>
                    <ul>
                        <li><a href="{{url('camps/create')}}">Add New Camp</a></li>
                        <li><a href="{{url('camps')}}">List All camps</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>PSN Codes</span></a>
                    <ul>
                        <li><a href="{{url('psncodes/create')}}">Add New Code</a></li>
                        <li><a href="{{url('psncodes')}}">List All Codes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> <span>Departments</span></a>
                    <ul>
                        <li><a href="{{url('departments/create')}}">Add New Code</a></li>
                        <li><a href="{{url('departments')}}">List All Departments</a></li>
                    </ul>
                </li>
                <!-- /appearance -->

                <!-- Layout -->
                <li class="navigation-header"><span>Users Managements</span> <i class="icon-menu" title="Users Managements"></i></li>

                <li>
                    <a href="#"><i class="icon-users"></i> <span>Users</span></a>
                    <ul>
                        <li><a href="{{url('users')}}">Add New User</a></li>
                        <li><a href="{{url('users')}}">List All Users</a></li>
                        <li><a href="{{url('reports/users')}}">User Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-popout"></i> <span>Users Rights</span></a>
                    <ul>
                        <li><a href="{{url('access/rights/create')}}">Add New</a></li>
                        <li><a href="{{url('access/rights')}}">List All</a></li>
                    </ul>
                </li>
                <!-- /layout -->



                <!-- Extensions -->
                <li class="navigation-header"><span>Data Sharing</span> <i class="icon-menu" title="Data Sharing"></i></li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>Data import</span></a>
                    <ul>
                        <li><a href="{{url('backup/import')}}">Import</a></li>
                        <li><a href="{{url('backup/export')}}">Export</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-popout"></i> <span>Data Approval</span></a>
                    <ul>
                        <li><a href="{{url('approval/pending')}}">Pending</a></li>
                    </ul>
                </li>
                <!-- /extensions -->
            </ul>
        </div>
    </div>
@stop
@section('page_title')
    Clients
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Clients </span> </h4>
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
            <a  href="#" class="addRecord btn"><i class="fa fa-file-o text-success"></i> <span>Register New Client</span></a>
            <a  href="{{url('clients')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All</span></a>
            <a  href="{{url('clients')}}" class="btn "><i class="fa fa-search text-primary"></i> <span>Search</span></a>
            <a  href="{{url('import/clients')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Clients Search</h5>
        </div>

        <div class="panel-body">
        </div>

        <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th>Client No</th>
                <th>Full Name</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Origin</th>
                <th>Arrival Date</th>
                <th>Progress</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>

        </table>
    </div>
@stop