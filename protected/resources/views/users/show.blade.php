<!-- @extends('site.master') This is extended in the dashboard.blade.php so no need to extend it again  -->

@section('main_navigation')
    @include('site.dashboard')
@endsection

<!-- Add new user form -->
@section('contents')
       <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="#" class="addRecord btn"><i class="fa fa-file-o text-success"></i> <span>Register New Client</span></a>
            <a  href="{{url('clients')}}" class="btn  "><i class="fa fa-list text-info"></i> <span>List All</span></a>
            <a  href="{{url('clients')}}" class="btn "><i class="fa fa-search text-primary"></i> <span>Search</span></a>
            <a  href="{{url('import/clients')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>Import</span></a>
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
                    <a href="{{url('users')}}/{{$user->id}}/edit" class="editRecord btn "><i class="fa fa-pencil text-success"></i> Edit</a>
                    <a href="{{url('users')}}/{{$user->id}}/delete"  class="deleteRecord btn" ><i class="fa fa-trash text-danger"></i> Delete</a>
                </td>
            </tr>
           @endforeach
         </table>
		@else
			<p>No view at this moment</p>
		@endif
        </div>
   
       
    </div>
       
@endsection