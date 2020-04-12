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
            // Confirmation dialog
            $('.authorizeAllRecords').on('click', function() {
                var id1 = $(this).parent().attr('id');
                var btn=$(this).parent().parent().parent().parent().parent().parent();
                bootbox.confirm("Are You Sure to authorize All pending records?", function(result) {
                    if(result){
                        $.ajax({
                            url:"<?php echo url('authorize/items/distributions') ?>",
                            type: 'post',
                            data: {_method: 'post', _token :"{{csrf_token()}}"},
                            success:function(msg){
                                location.reload();
                            }
                        });
                    }
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
                $(".modal-body").load("<?php echo url("distributions/items/bulk") ?>");
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
                modaldis+= '<span id="myModalLabel" class="text-uppercase text-bold" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i>Single Client Items Distributions</span>';
                modaldis+= '</div>';
                modaldis+= '<div class="modal-body">';
                modaldis+= ' </div>';
                modaldis+= '</div>';
                modaldis+= '</div>';
                $('body').css('overflow-y','scroll');

                $("body").append(modaldis);
                $("#myModal").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load("<?php echo url("items/distributions/create") ?>");
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                })

            });
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
@section('page_title')
   NFIs Items Distribution
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">  NFIs Items Distribution </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('items/distributions')}}"> NFIs Items Distribution</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            @permission('create')
            <a href="#" class="addRecord btn btn-primary "> <i class="fa fa-plus text-success"></i>Items Distributions</a>
            @endpermission
            <a href="{{url('distributions/items/bulk')}}" class=" btn btn-primary " title="Item distributions for multiple clients"> <i class="fa fa-plus text-success"></i>Bulk Items Distributions</a>
            @permission('authorize')
            <a  href="#" class="authorizeAllRecords btn btn-danger"><i class="fa fa-check "></i> <span>Authorize All</span></a>
            @endpermission
            <a href="{{url('items/distributions')}}" class="btn btn-primary"><i class="fa fa-list text-info"></i> List All Records</a>
            <a href="{{url('inventory')}}" class="btn btn-primary " title="Go to Item inventory list"><i class="fa fa-reply text-danger"></i> Go to Inventory Items</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title text-bold"> List of All  NFIs Items Distribution</h5>
        </div>

        <div class="panel-body">
            <item-distribution-list-component></item-distribution-list-component>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@stop
