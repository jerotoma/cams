<!-- @extends('site.master') This is extended in the dashboard.blade.php so no need to extend it again  -->

@section('main_navigation')
    @include('site.dashboard')
@endsection

<!-- Add new user form -->
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('users')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>All User</span></a>
            <a  href="#" class="btn " data-toggle="modal" data-target="#add-user-new"><i class="fa fa-plus-square-o text-primary" aria-hidden="true"></i> <span>Add New User</span></a>
           <a  href="{{url('user/report')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>User Report</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">User Search</h5>
        </div>

        <div class="panel-body">
			@if(sizeof($users) > 0 )
			 <table class="table datatable-basic table-hover">
           <?php $count = 1; ?>
			
             @foreach($users as $key => $user)  
            <tr>
                <th class="text-left success">User No</th><td class="text-left success">{{$count + $key }}</td>
			</tr>
            <tr>
                <th class="text-left success">Full Name</th><td class="text-left success">{{$user->full_name}}</td>
			</tr>
            <tr>
                <th class="text-left success">Phone </th><td class="text-left success">{{$user->phone }}</td>
			</tr>
            <tr>
                <th class="text-left success">Email</th><td class="text-left success">{{$user->email }}</td>
			</tr>
            <tr>
                <th class="text-left success">Address</th><td class="text-left success">{{$user->address}}</td>
			</tr>
            <tr>
                <th class="text-left success">Password</th><td class="text-left success">Hidden</td>
			</tr>
            <tr>
                <th class="text-left success">Status</th><td class="text-left success">{{$user->status }}</td>
			</tr>
            <tr>
                <th class="text-left success">Last Success Login</th><td class="text-left success">{{$user->last_success_login }}</td>
			</tr>
            <tr>
                <th class="text-left success">Date Created</th><td class="text-left success">{{$user->created_at }}</td>
			</tr>
            <tr>         
				<th class="text-left success">Action</th>
				 <td class="text-center success" id="{{$user->id}}">
                    <a href="{{url('users')}}" class="viewRecord btn "><i class="fa fa-eye" aria-hidden="true"></i> All users</a>
                   <a href="#" data-toggle="modal" data-target="#{{$user->id}}" class="editRecord btn "><i class="fa fa-pencil text-success"></i> Edit</a>
                    <a href="{{url('users')}}/{{$user->id}}/delete"  class="deleteRecord btn" ><i class="fa fa-trash text-danger"></i> Delete</a>
                </td>
            </tr>
                         <!-- Modal -->
                <div id="{{$user->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog ">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><h1 class="text-center">Edit User</h1></h4>
                          </div>
                          <?php $user_id = $user->id; ?>
                           
                          <div class="modal-body">
                            @section('specific-column')
                              <div class="col-md-12">
                            @stop
                            <!--Include Create View -->
                             @include('users.inc.edit')
                            <!--/Include Create View -->
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                </div>
           @endforeach
         </table>
		@else
			<p>No view at this moment</p>
		@endif
        </div>
     </div>
    <!-- Modal -->
    <div id="add-user-new" class="modal fade" role="dialog">
          <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><h1 class="text-center">Add New User</h1></h4>
              </div>
              <div class="modal-body">
                @section('specific-column')
                  <div class="col-md-12">
                @stop
                <!--Include Create View -->
                 @include('users.inc.create')
                <!--/Include Create View -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>  
    </div>   
@endsection