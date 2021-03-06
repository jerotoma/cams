@extends('layout.master')
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
                $('body').css('overflow-y','scroll');

                $("body").append(modaldis);
                $("#myModal").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load("<?php echo url("inventory/create") ?>");
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                });
            });
        });

    </script>
@stop
@section('page_title')
    Item Inventories
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">NFIs Inventory </span> </h4>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title text-bold ">List of All NFIs Item Inventory</h5>
                </div>
                <div class="panel-body">
                    <inventory-list-component></inventory-list-component>
                </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
@stop
