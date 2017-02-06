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
            <a  href="{{url('assessments/vulnerability')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All</span></a>
            <a  href="{{url('import/assessments/vulnerability')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h2 class="panel-title text-center">WheelChair Assessment</h2>
        </div>
        <div class="panel-body">
            @include('assessments.wheelchair.inc.assessmentinterview')
        </div>
    </div>
   <script>
   $(document).ready(function() {
    
    var navListItems = $('ul.setup-panel li a'),
        allWells     = $('.setup-content');

        allWells.hide();

    navListItems.click(function(e){
       
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item   = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
      });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    });
    
    $('#activate-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    });
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    });
});


        // Add , Dlelete row dynamically

         $(document).ready(function(){
              var i=1;
             $("#add_row").click(function(){
              $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='sur"+i+"' type='text' placeholder='Surname'  class='form-control input-md'></td><td><input  name='email"+i+"' type='text' placeholder='Email'  class='form-control input-md'></td>");

              $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
              i++; 
          });
             $("#delete_row").click(function(){
                 if(i>1){
                 $("#addr"+(i-1)).html('');
                 i--;
                 }
             });

        });
   </script>
@stop