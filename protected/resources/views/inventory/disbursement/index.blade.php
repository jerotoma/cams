@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/datatables_basic.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')
    <script>
        $(".addRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i> Add Inventory Category</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("inventory-categories/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

        $(".editRecord").click(function(){
            var id1 = $(this).parent().attr('id');
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Update item details</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("inventory-categories") ?>/"+id1+"/edit");
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
                    url:"<?php echo url('inventory-categories') ?>/"+id1,
                    type: 'post',
                    data: {_method: 'delete', _token :"{{csrf_token()}}"},
                    success:function(msg){
                        btn.hide("slow").next("hr").hide("slow");
                    }
                });
            });
        });
    </script>
@stop
@section('main_navigation')
    @include('inc.main_navigation')
@stop
@section('page_title')
    Inventory Categories
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Material Inventory Categories</span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('inventory')}}">Inventories</a></li>
        <li><a href="{{url('inventory/categories')}}">Categories</a></li>
    </ul>
@stop
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Material support disbursements</span>
                    </div>
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-8 pull-right">
                                <div class="btn-group pull-right">
                                    <a href="{{url('inventory/disbursement/beneficiaries')}}" class=" btn blue-madison"> <i class="fa fa-search"></i> Search Beneficiaries</a>
                                    <a href="{{url('inventory/disbursement')}}" class="btn blue-madison"><i class="fa fa-server"></i> List All Records</a>
                                    <a href="{{url('inventory/disbursement/import')}}" class="btn blue-madison"><i class="fa fa-download"></i> Import data</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th> SNO </th>
                            <th> Progress number </th>
                            <th> Full Name </th>
                            <th> Address</th>
                            <th> Item/materials </th>
                            <th> Quantity  </th>
                            <th> Donor type </th>
                            <th> Date</th>
                            <th> </th>
                            <th class="text-center"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count=1;?>
                        @if(count($disbursements)>0)
                            @foreach($disbursements as $disbursement)
                                <tr class="odd gradeX">
                                    <td> {{$count++}} </td>
                                    <td>
                                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null )
                                        {{$disbursement->beneficiary->progress_number}}
                                            @endif
                                    </td>
                                    <td>
                                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null )
                                            {{$disbursement->beneficiary->full_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null )
                                            {{$disbursement->beneficiary->address}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(is_object($disbursement->item) && $disbursement->item != null )
                                            {{$disbursement->item->item_name}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$disbursement->quantity}}
                                    </td>
                                    <td>
                                        {{$disbursement->donor_type}}
                                    </td>
                                    <td>
                                        {{$disbursement->distributed_date}}
                                    </td>
                                    <td class="text-center" id="{{$disbursement->id}}">
                                        <a href="#" class="showRecord "> <i class="fa fa-eye"></i> </a>
                                        <a href="#" class="  "> <i class="fa fa-print green " onclick="printPage('{{url('inventory/disbursement/print')}}/{{$disbursement->id}}');" ></i> </a>
                                        <a href="{{url('inventory/disbursement/pdf')}}/{{$disbursement->id}}" class=" " title="Download"> <i class="fa fa-download text-danger "></i> </a>
                                    </td>
                                    <td class="text-center" id="{{$disbursement->id}}">
                                        <a href="#"  class="editRecord btn"> <i class="fa fa-edit"></i> </a>
                                        <a href="#" class="deleteRecord btn"> <i class="fa fa-trash text-danger"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@stop