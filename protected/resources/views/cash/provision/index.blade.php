@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
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
                "fnDrawCallback": function (oSettings) {
                    $(".showRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-eye font-blue-sharp"></i> Cash Provision</span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                         $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("cash/monitoring/provision") ?>/"+id1);
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
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Update Cash Provision Details </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                         $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("cash/monitoring/provision") ?>/"+id1+"/edit");
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
                                    url:"<?php echo url('cash/monitoring/provision') ?>/"+id1,
                                    type: 'post',
                                    data: {_method: 'delete', _token :"{{csrf_token()}}"},
                                    success:function(msg){
                                        btn.hide("slow").next("hr").hide("slow");
                                    }
                                });
                            }
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
        $(".addBulkRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i>Bulk Items Distributions</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
             $('body').css('overflow-y','scroll');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("provision/cash//bulk") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

        $(".addRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="text-uppercase text-bold" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i> Cash Provision to Client </span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
             $('body').css('overflow-y','scroll');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("cash/monitoring/provision/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });
        function closePrint () {
            document.body.removeChild(this.__container__);
        }

        function setPrint () {
            this.contentWindow.__container__ = this;
            this.contentWindow.onbeforeunload = closePrint;
            this.contentWindow.onafterprint = closePrint;
            this.contentWindow.focus(); // Required for IE
            this.contentWindow.print();
        }

        function printPage (sURL) {
            var oHiddFrame = document.createElement("iframe");
            oHiddFrame.onload = setPrint;
            oHiddFrame.style.visibility = "hidden";
            oHiddFrame.style.position = "fixed";
            oHiddFrame.style.right = "0";
            oHiddFrame.style.bottom = "0";
            oHiddFrame.src = sURL;
            document.body.appendChild(oHiddFrame);
        }
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
                <li class="active">
                    <a href="#"><i class="fa fa-money"></i> <span>Cash Monitoring</span></a>
                    <ul>
                        <li><a href="{{url('cash/monitoring/provision')}}">Cash Provision</a></li>
                        <li class="active"><a href="{{url('cash/monitoring/budget')}}">Budget Register</a></li>
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
                <li class="navigation-header"><span>Data Sharing/Backup</span> <i class="icon-menu" title="Data Sharing"></i></li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>Data import</span></a>
                    <ul>
                        <li><a href="#">Import</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-puzzle4"></i> <span>Data Export</span></a>
                    <ul>
                        <li><a href="#">Export</a></li>
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
                        <li><a href="{{url('audit/los')}}">User Logs</a></li>
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
   Cash Provision
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">   Cash Provision</span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('items/distributions')}}">  Cash Provision</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a href="#" class="addRecord btn btn-primary "> <i class="fa fa-plus text-success"></i>Provide Cash</a>
            <a href="{{url('bulk/cash/monitoring/provision')}}" class=" btn btn-primary " title="Item distributions for multiple clients"> <i class="fa fa-plus text-success"></i>Bulk Cash Provision</a>
            <a href="{{url('cash/monitoring/provision')}}" class="btn btn-primary"><i class="fa fa-list text-info"></i> List All Records</a>
            <a href="{{url('post/cash/monitoring')}}" class="btn btn-primary"><i class="fa fa-list text-danger"></i> Post Cash monitoring</a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title text-uppercase text-bold text-center"> List of All Cash Provision Records</h5>
        </div>

        <div class="panel-body">
        </div>
        <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th> SNO </th>
                <th> Date </th>
                <th> Provided By</th>
                <th> Comments </th>
                <th> Provision Details </th>
                <th class="text-center"> Action </th>
            </tr>
            </thead>
            <tbody>
            <?php $count=1;?>
            @if(count($provisions)>0)
                @foreach($provisions as $provision)
                    <tr class="odd gradeX">
                        <td>
                            {{$count++}}
                        </td>
                        <td>
                            {{$provision->provision_date}}
                        </td>
                        <td>
                            {{$provision->provided_by}}
                        </td>
                        <td>
                            {{$provision->comments}}
                        </td>
                        <td id="{{$provision->id}}">
                            <a href="#" class="showRecord label label-success"> <i class="fa fa-eye"></i> View </a>
                            <a href="#" class=" label label-info" onclick="printPage('{{url('print/cash/monitoring/provision')}}/{{$provision->id}}');"> <i class="fa fa-print"></i> Print </a>
                            <a href="{{url('download/pdf/cash/monitoring/provision')}}/{{$provision->id}}" class="label label-primary"> <i class="fa fa-file-pdf-o"></i> Download </a>
                        </td>
                        <td class="text-center" id="{{$provision->id}}">
                            <ul class="icons-list text-center">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li id="{{$provision->id}}"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                        <li id="{{$provision->id}}"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif


            </tbody>
            <tfoot>
            <tr>
                <td> SNO </td>
                <td> Date </td>
                <td> Provided By</td>
                <td> Comments </td>
                <td> Provision Details </td>
                <td class="text-center"> Action </td>
            </tr>
            </tfoot>
        </table>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@stop
