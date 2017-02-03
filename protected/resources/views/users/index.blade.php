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
        </div>

        <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th>User No</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
             @foreach($users as $key => $user)
                <tr>
                <td>{{$count + $key }}</td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->address}}</td>
                <td class="text-center" id="{{$user->id}}">
                    <a href="{{url('users')}}/{{$user->id}}/view" class="viewRecord btn "><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                    <a href="{{url('users')}}/{{$user->id}}/edit" class="editRecord btn "><i class="fa fa-pencil text-success"></i> Edit</a>
                    <a href="{{url('users')}}/{{$user->id}}/delete"  class="deleteRecord btn" ><i class="fa fa-trash text-danger"></i> Delete</a>
                </td></td>
               </tr>
              @endforeach
            </tbody>

        </table>
    </div>
       
@endsection