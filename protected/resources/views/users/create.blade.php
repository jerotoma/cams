 <!-- @extends('site.master') This is extended in the dashboard.blade.php so no need to extend it again  -->

@section('main_navigation')
    @include('site.dashboard')
@stop

<!-- Add new user form -->
@section('specific-column')
  <div class="col-md-6 col-md-offset-3">
@stop
@section('contents')
         
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('users')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>All User</span></a>
            <a  href="{{url('user/report')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>User Report</span></a>
        </div>
    </div>
    <!--Include Create View -->
     @include('users.inc.create')
    <!--/Include Create View -->
   

</div>
@stop
<!-- Add new user form -->