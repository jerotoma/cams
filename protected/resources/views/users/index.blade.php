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
            <h5 class="panel-title text-center">List of All Users</h5>
        </div>

        <div class="panel-body">
            <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th class="text-left info">User No</th>
                <th class="text-left info">Full Name</th>
                <th class="text-left info">Phone</th>
                <th class="text-left info">Email</th>
                <th class="text-left info">Address</th>
                <th class="text-center info">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
             @foreach($users as $key => $user)
                <tr id='user-row-{{$user->id}}'>
                <td class="text-left success">{{$count + $key }}</td>
                <td class="text-left success">{{$user->full_name}}</td>
                <td class="text-left success">{{$user->phone}}</td>
                <td class="text-left success">{{$user->email}}</td>
                <td class="text-left success">{{$user->address}}</td>
                <td class="text-center success" id="{{$user->id}}">
                    <a href="{{url('users')}}/{{$user->id}}/view" class="viewRecord btn "><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                    <a href="#" data-toggle="modal" data-target="#{{$user->id}}" class="btn "><i class="fa fa-pencil text-success"></i> Edit</a>
                    <a href="{{url('users')}}/{{$user->id}}/delete" id="delete-user-{{$user->id}}" class="deleteRecord btn" ><i class="fa fa-trash text-danger"></i> Delete</a>
                </td>
               </tr>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#delete-user-{{$user->id}}').on('click', function(){
                          var  url = "{{url('users')}}/{{$user->id}}/delete"; 
                          $.get(url, function(data, status){
                            if(status == 'success'){
                               $('#user-row-{{$user->id}}').remove(); 
                               console.log('This is the status '+status);
                            }
                           
                        });
                            // deleteRecord(url);
                         return false;   
                        });
                     
                    });

                </script>
                      <!-- Modal -->
                <div id="{{$user->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog ">

                        <!-- Modal content-->
                        <div class="modal-content ">
                          <div class="modal-header btn-success">
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
            </tbody>

            </table>
        </div>
    </div>
    <!-- Modal -->
    <div id="add-user-new" class="modal fade" role="dialog">
          <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header btn-success">
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