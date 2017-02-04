 <!-- @extends('site.master') This is extended in the dashboard.blade.php so no need to extend it again  -->

@section('main_navigation')
    @include('site.dashboard')
@stop

<!-- Add new user form -->
@section('contents')
         <style>
             .add-new-user{
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
            <a  href="{{url('users/create')}}" class="btn "><i class="fa fa-plus-square-o text-primary" aria-hidden="true"></i> <span>Add New User</span></a>
            <a  href="{{url('user/report')}}" class="btn "><i class="fa fa-upload text-danger"></i> <span>User Report</span></a>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">User Search</h5>
        </div>

        <div class="panel-body">
	      <div class="row">
             <div class="col-md-6 col-md-offset-3">
                 <h1 class="text-center">Add New User</h1>
                   @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                         </div>
                    @endif
                
                 <form id = "users-add-user" action="{{url('users/store')}}" method="POST" >
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
                      <div class="row">
                          
                          <div class="col-md-12">
                            <div class="alertuser">
                            
                              </div>
                          </div>
                     </div>
                     <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                     <button type="submit" class="btn btn-success">Add User</button>
                </form>

            </div>
     </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function(){
     
            $('#users-add-user').on('submit',function(){
            $('.remove-alert-user').remove();
            
              var alert             = "<p class='remove-alert-user' style='color:#FF0000; font-size:11px font-family:Open sans;'>Please make sure this field is not empty</p>";;
              var first_name        = $('#first_name'),
                  last_name         = $('#last_name'),
                  username          = $('#username'),
                  password          = $('#password'),
                  email             = $('#email'),
                  phone             = $('#phone'),
                  confirm_password  = $('#confirm_password'),
                  address           = $('#address'),
                  _token            = $('#csrf-token').val(),   
                  formURL           = $('#users-add-user').attr("action");  

            var array               = [], i;
            var data                =  { 
                                             first_name : first_name.val(),
                                             last_name  : last_name.val(),
                                             email      : email.val(),
                                             username   : username.val(),
                                             password   : password.val(), 
                                             phone      : phone.val(),
                                             address    : address.val(),
                                       };
         if(  first_name.val().length  === 0 && last_name.val().length         === 0 &&
              username.val().length    === 0 && email.val().length             === 0 &&
              phone.val().length       === 0 && address.val().length           === 0 &&
              password.val().length    === 0 && confirm_password.val().length  === 0    ){
                 
                       array.push(first_name);
                       array.push(last_name);
                       array.push(username);
                       array.push(phone);
                       array.push(password);
                       array.push(confirm_password);
                       array.push(address);
                       array.push(email);

                      for(i=0; i < array.length;  i++ ){

                          array[i].after(alert);

                      } 
          return false;   
         }else{
         
             
                      if(first_name.val().length  === 0){ array.push(first_name);}
                      if(last_name.val().length   === 0){ array.push(last_name);}
                      if(username.val().length    === 0){ array.push(username);}
                      if(phone.val().length       === 0){ array.push(phone);}
                      if(password.val().length    === 0){ array.push(password);}
                      if(confirm_password.val().length    === 0){ array.push(confirm_password);}
                      if(address.val().length     === 0){ array.push(address);} 
                      if(email.val().length       === 0){ array.push(email);}

                     if(array.length != 0 ){

                      for(i=0; i < array.length;  i++ ){

                          array[i].after(alert);

                      }   
          return false;  
          
          }else{
              $.ajax({ 
                    headers : {'X-CSRF-TOKEN': _token},
                    url     : formURL,
                    data    : data,
                    type    : 'POST',
                    datatype: 'JSON',
                    success:function(response){
                       if(response.success){
                           window.location.replace('{{url("/users")}}');
                       }
                    },
                    error:function(xhr){
                      var msg = '<ul>';
                    if (xhr.status == 422){
                        $.each(xhr.responseJSON, function (key, value) {
                               msg += '<li>';
                               msg += value;
                               msg +='</li>'; 
                           
                        });
                        msg += '</ul>';
                      $('.alertuser').html(alertUser(msg));
                     }
                    }
               });
              
              }
             
             }
            return false;
        });
        
     function alertUser(error){
            var msg = '<div class="alert alert-danger remove-alert-user alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '+error+'</div>';
        
        return msg;
        }
    
     $('#users-add-user input').on('change',function(){
         $('.remove-alert-user').remove();
         
     });
    
    
    });
</script>
</div>
@stop
<!-- Add new user form -->