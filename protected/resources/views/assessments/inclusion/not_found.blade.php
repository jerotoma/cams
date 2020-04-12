@extends('layout.master')
@section('page_css')
   @include('assessments.inclusion.inc.inclusion_css')
@stop
@section('page_js')
    @include('layout.page_js')
@stop
@section('page_title')
    Rehabilitation!
@stop
@section('page_heading_title')
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Assessments </span> - Inclusion Assessments</h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><a href="{{url('assessments/inclusion')}}"><i class="icon-grid position-left"></i>  Inclusion Assessments</a></li>
        <li class="active">Inclusion</li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
               <a class="btn  btn-lg" data-toggle="modal" data-target="#client_inclusion_assessment"><i class="fa fa-plus text-success" aria-hidden="true"></i> <span> Assess Client</span></a>
              <a  href="{{url('assessments/wheelchair')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All Assessments</span></a>
              <a  href="{{url('import/assessments/vulnerability')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Inclusion Assessments</h5>
        </div>
        <div class="panel-body">
           <?php echo $user_requested_resource; ?>
        </div>
    </div>
   <!-- Modal -->
<div id="client_inclusion_assessment" class="modal fade" role="dialog" data-backdrop="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-indigo">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Client Inclusion Assessment</h4>
      </div>
      <div class="modal-body">
            @include('assessments.inclusion.inc.inclusionassessment')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-indigo" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 @include('assessments.inclusion.inc.inclusion_js')
@stop
