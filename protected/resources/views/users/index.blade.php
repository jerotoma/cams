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
                "fnDrawCallback": function (oSettings) {
                    $(".viewRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-eye font-blue-sharp"></i> User Details</span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                         $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("users") ?>/"+id1);
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
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Update User Details </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                         $('body').css('overflow-y','scroll');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("users") ?>/"+id1+"/edit");
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
                                url:"<?php echo url('users') ?>/"+id1,
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
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i> Register New User</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
             $('body').css('overflow-y','scroll');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

    </script>
@stop
@section('main_navigation')
    @include('inc.main_navigation')
@stop
@section('page_title')
    Users Management
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Users Management </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('users')}}">Users list</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="#" class="addRecord btn btn-primary"><i class="fa fa-file-o "></i> <span>Register New User</span></a>
            <a  href="{{url('users')}}" class="btn btn-primary "><i class="fa fa-users "></i> <span>List All Users</span></a>
            <a  href="{{url('access/rights')}}" class="btn btn-primary "><i class="fa fa-user-secret "></i> <span>User Access Rights</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">

            <h5 class="panel-title text-center text-uppercase">List of All Users</h5>
        </div>

        <div class="panel-body">
            <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
             @foreach($users as $key => $user)
                <tr>
                <td>{{$count + $key }}</td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->designation}}</td>
                <td> @if($user->department_id != "" && count(\App\Department::find($user->department_id)) > 0 )
                        <option value="{{\App\Department::find($user->department_id)->id}}" selected>{{\App\Department::find($user->department_id)->department_name}}</option>
                    @endif</td>
                <td>@if(strtolower($user->status)=="active")<a href="#" class="label label-success">{{$user->status}}</a>
                    @else
                        <a href="#" class="label label-danger">{{$user->status}}</a>
                        @endif
                </td>
                <td class="text-center" id="{{$user->id}}">
                    <a href="#" class="viewRecord btn " title="View user"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                    <a href="#" class="editRecord btn "><i class="fa fa-pencil text-success"></i> </a>
                    @if($user->id ==\Auth::user()->id)
                    <a href="#"  class=" btn" title="Can't delete yourself"><i class="fa fa-trash text-danger"></i></a>
                        @else
                        <a href="#"  class="deleteRecord btn" title="delete user"><i class="fa fa-trash text-danger"></i> </a>
                    @endif
                </td></td>
               </tr>
              @endforeach
            </tbody>

            </table>
        </div>
    </div>

@endsection