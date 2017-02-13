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
                    url:"<?php echo url('camps') ?>/"+id1,
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
    Camps
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Camps</span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('regions')}}">Camps</a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('camps/create')}}" class="btn btn-info "><i class="fa fa-file-o"></i> <span>Add New</span></a>
            <a  href="{{url('camps')}}" class="btn btn-info "><i class="fa fa-list"></i> <span>List All</span></a>
            <a  href="{{url('camps')}}" class="btn btn-info "><i class="fa fa-search"></i> <span>Search</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Camps</h5>
        </div>

        <div class="panel-body">
        </div>

        <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Camp Name</th>
                <th>Reg #</th>
                <th>Description</th>
                <th>Address</th>
                <th>Tel</th>
                <th>District</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;?>
            @foreach($camps as $camp)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$camp->camp_name}}</td>
                <td>{{$camp->reg_no}}</td>
                <td>{{$camp->description}}</td>
                <td>{{$camp->address}}</td>
                <td>{{$camp->tel}}</td>
                <td>@if(is_object($camp->district) && $camp->district != null ){{$camp->district->district_name}}@endif</td>
                <td>@if(strtolower($camp->status) =="working")<span class="label label-success">{{$camp->status}}</span> @else <span class="label label-danger">{{$camp->status}}</span>@endif</td>
                <td class="text-center" id="{{$camp->id}}">
                    <a href="{{url('camps')}}/{{$camp->id}}/edit" class="editRecord btn "><i class="fa fa-pencil text-success"></i> Edit</a>
                    <a href="#" class="deleteRecord btn" ><i class="fa fa-trash text-danger"></i> Delete</a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop