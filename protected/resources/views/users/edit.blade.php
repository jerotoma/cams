 <!-- @extends('site.master') This is extended in the dashboard.blade.php so no need to extend it again  -->

@section('main_navigation')
    @include('site.dashboard')
@stop

<!-- Add new user form -->
@section('contents')
         <style>
             .users-edit-user{
                 background-color:#FFF;
                 padding:20px;
             }
             .form-control{
                 background: #FFF;
                 padding: 15px;
                 border: 1px solid #4CAF50; 
             }
             .alert-dismissable .close, 
             .alert-dismissible .close {
                position: relative;
                 top: -2px;
                 right: -10px; 
                 color: inherit;
            }
         </style>
   <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('users')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>All User</span></a>
            <a  href="{{url('users/create')}}" class="btn " data-toggle="modal" data-target="#add-user-new"><i class="fa fa-plus-square-o text-primary" aria-hidden="true"></i> <span>Add New User</span></a>
            <a  href="{{url('user/report')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>User Report</span></a>
        </div>
    </div>
     <?php  $pagetype = 'not_modal' ?>
  <!--Include Create View -->
     @include('users.inc.edit')
    <!--/Include Create View -->
   
</div>
@stop
<!-- Add new user form -->