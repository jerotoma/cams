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
                columnDefs: [{
                    orderable: false,
                    width: '100px',
                    targets: [ 5 ]
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
               // ajax: '{{url('getwaclientsjson')}}this url load JSON Client details to reduce loading time
                "fnDrawCallback": function (oSettings) {
                    $(".viewRecord").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modaldis+= '<div class="modal-content">';
                        modaldis+= '<div class="modal-header bg-indigo">';
                        modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-eye font-blue-sharp"></i> Item Details</span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("inventory") ?>/"+id1);
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
                        modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Update Item Details </span>';
                        modaldis+= '</div>';
                        modaldis+= '<div class="modal-body">';
                        modaldis+= ' </div>';
                        modaldis+= '</div>';
                        modaldis+= '</div>';
                        $('body').css('overflow','hidden');

                        $("body").append(modaldis);
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("inventory") ?>/"+id1+"/edit");
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
                                    url:"<?php echo url('inventory') ?>/"+id1,
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
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i>Add new Item</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("inventory/create") ?>");
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
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i>Add new Item</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("inventory/create") ?>");
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
    Item Inventory
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Material Inventory </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('clients')}}">Inventories</a></li>
    </ul>
@stop
@section('contents')
                <div class="row" style="margin-bottom: 5px">
                <div class="col-md-12 text-right">
                    <a href="#" class="addRecord btn btn-primary "> <i class="fa fa-plus text-success"></i> Add New Item</a>
                    <a href="{{url('inventory')}}" class="btn btn-primary"><i class="fa fa-server text-info"></i> Item list</a>
                    <a href="{{url('inventory-categories')}}" class="btn btn-primary"><i class="fa fa-forward text-danger"></i> Inventory Categories</a>
                    <a href="{{url('inventory-import')}}" class=" btn btn-primary"><i class="fa fa-upload text-primary"></i> Import Items</a>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-uppercase text-bold text-center">List of All NFIs Item Inventory</h5>
                </div>

                <div class="panel-body">
                    <table class="table datatable-column-search-inputs table-bordered table-hover" >
                        <thead>
                        <tr >
                            <th class="text-center">
                                #
                            </th>
                            <th class="text-center">
                                Item Name
                            </th>
                            <th class="text-center">
                                Descriptions
                            </th>
                            <th class="text-center">
                                Category
                            </th>
                            <th class="text-center">
                                Quantity
                            </th>
                            <th class="text-center">
                                Status
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count=1;?>
                        @if(count($items)>0)
                            @foreach($items as $item)
                                <tr>
                                    <td> {{$count++}} </td>
                                    <td>
                                        {{$item->item_name	}}
                                    </td>
                                    <td>
                                        {{$item->description}}
                                    </td>
                                    <td>
                                        @if(is_object($item->category) && $item->category != null && $item->category !="")
                                            {{$item->category->category_name}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>@if(strtolower($item->status) )
                                            <span class="label label-success">{{$item->status}}</span>
                                        @else
                                            <span class="label label-danger">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list text-center">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li id="{{$item->id}}"><a href="#" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                                    <li id="{{$item->id}}"><a href="#" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                        </tbody>
                        <tfoot>
                        <tr >
                            <td class="text-center">
                                #
                            </td>
                            <td class="text-center">
                                Item Name
                            </td>
                            <td class="text-center">
                                Descriptions
                            </td>
                            <td class="text-center">
                                Category
                            </td>
                            <td class="text-center">
                                Quantity
                            </td>
                            <td class="text-center">
                                Status
                            </td>
                            <td class="text-center">

                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
@stop