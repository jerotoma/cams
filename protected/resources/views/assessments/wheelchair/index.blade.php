@extends('site.master')
@section('page_js')
    @include('inc.page_js')
@stop
@section('main_navigation')
     @include('inc.main_navigation')
@stop
@section('page_title')
    Rehabilitation!
@stop
@section('page_heading_title')
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Assessments </span> - Intermediate Wheelchair Assessment Form</h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><a href="{{url('assessments/inclusion')}}"><i class="icon-grid position-left"></i> WheelChair Assessments</a></li>
        <li class="active">Wheel Chair</li>
    </ul>
@stop
@section('contents')
    <style>
        .list-group-item-heading,
        .list-group-item-text{
          font-size: 12px; 
          font-weight: 700;
        }
        .move-it-right-20px{
            margin-left: 20px;
        }
        label{
            font-weight:400 !important;
        }
    </style>
   
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('clients-va')}}" class=" btn"><i class="fa fa-search text-success"></i> <span>Search Client</span></a>
            <a class="btn  btn-lg" data-toggle="modal" data-target="#client_wheelchair_assessment"><i class="fa fa-plus text-success" aria-hidden="true"></i> <span> Assess Client</span></span></a>
<a  href="{{url('assessments/wheelchair')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All</span></a>
            <a  href="{{url('import/assessments/vulnerability')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
            
		</div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h2 class="panel-title text-center">Completed WheelChair Assessment</h2>
        </div>
        <div class="panel-body">
          @include('assessments.wheelchair.inc.list_all')
		</div>
    </div>
  
<!-- Modal -->
<div id="client_wheelchair_assessment" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-indigo">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Client Wheelchair Assessment</h4>
      </div>
      <div class="modal-body">
        @include('assessments.wheelchair.inc.wheelchairassessment')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  @include('assessments.wheelchair.inc.wheelchair_js')

@stop