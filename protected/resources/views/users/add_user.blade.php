 <!-- @extends('site.master') This is extended in the dashboard.blade.php so no need to extend it again  -->

@section('main_navigation')
    @include('site.dashboard')
@stop

<!-- Add new user form -->
@section('contents')
 <div class="container-fluid">
         <style>
             .form-control{
                 background: #FFF;
                 padding: 15px;
                 border: 1px solid #4CAF50; 
             }
         </style>
        <div class="row">
             <div class="col-md-6 col-md-offset-3">
                 <h1 class="text-center">Add New User</h1>
                 <form id = "users-add-user" action="{{route('users/store')}}" method="POST" >
                     {{ csrf_field() }}
                      <div class="row">
                          <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="first_name">First Name: </label>
                                    <input type="text" name="first_name" class="form-control" id="first_name">
                                  </div>
                          </div>
                          <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name">
                                 </div> 
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" class="form-control" id="phone">
                      </div>
                      <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" class="form-control" id="address">
                      </div>
                     <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" class="form-control" id="email">
                      </div>
                     <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" id="username">
                      </div>
                     <div class="row">
                          <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                  </div>
                          </div>
                          <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                  </div> 
                          </div>
                     </div>
                     <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                     <button type="submit" class="btn btn-success">Add User</button>
                </form>

            </div>
     </div>
</div>
<script>
    $(document).ready(function(){
     
        $('#users-add-user').on('submit',function(){
            
        var   first_name        = $('#first_name').val(),
              last_name         = $('#last_name').val(),
              username          = $('#username').val(),
              password          = $('#password').val(),
              email             = $('#email').val(),
              phone             = $('#phone').val(),
              confirm_password  = $('#confirm_password').val(),
              address           = $('#address').val(),
              _token            = $('#csrf-token').val(),   
              formURL           = $('#users-add-user').attr("action");  
            
           
            var data =  { 
                             first_name : first_name,
                             last_name  : last_name,
                             email      : email,
                             username   : username,
                             password   : password, 
                             phone      : phone,
                             address    : address,
                       };
          console.log(data);
          $.ajax({ 
                    headers : {'X-CSRF-TOKEN': _token},
                    url     : formURL,
                    data    : data,
                    type    : 'POST',
                    datatype: 'JSON',
                    success:function(response){
                        console.log(response);
                    },
                    erreor:function(xhr){
                        
                    }
               });
            return false;
        });
        
        
    
    
    
    
    });


</script>

@stop
<!-- Add new user form -->