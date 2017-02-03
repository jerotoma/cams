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
 <div class="container-fluid users-edit-user">
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
             @if (count($users) > 0)
                 @foreach ($users as $user)
                 <form id ="users-edit-user" action="{{url('users')}}/{{$user->id}}/update" method="POST" >
                   
                        <div class="form-group">
                                <label for="full_name">Full Name: </label>
                                <input type="text" name="full_name" value="{{$user->full_name}}" class="form-control" id="full_name">
                        </div>
                      <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" value="{{$user->phone}}" class="form-control" id="phone">
                      </div>
                      <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" value="{{$user->address}}" class="form-control" id="address">
                      </div>
                     <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email">
                      </div>
                     <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="{{$user->username}}" class="form-control" id="username">
                      </div>
                     <div class="row">
                          <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" value="{{$user->password }}" class="form-control" id="password">
                                  </div>
                          </div>
                          <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input type="password" name="confirm_password" value="{{$user->password}}" class="form-control" id="confirm_password">
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
                     <button type="submit" class="btn btn-success">Edit User</button>
                </form>
                  @endforeach
                 @endif
            </div>
     </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function(){
     
            $('#users-edit-user').on('submit',function(){
           
                $('.remove-alert-user').remove();
            
              var alert             = "<p class='remove-alert-user' style='color:#FF0000; font-size:11px font-family:Open sans;'>Please make sure this field is not empty</>";;
              var full_name         = $('#full_name'),
                  username          = $('#username'),
                  password          = $('#password'),
                  email             = $('#email'),
                  phone             = $('#phone'),
                  confirm_password  = $('#confirm_password'),
                  address           = $('#address'),
                  _token            = $('#csrf-token').val(),   
                  formURL           = $('#users-edit-user').attr("action");  

             var array               = [], i;
             var data                =  { 
                                             full_name  : full_name.val(),
                                             email      : email.val(),
                                             username   : username.val(),
                                             password   : password.val(), 
                                             phone      : phone.val(),
                                             address    : address.val(),
                                       };
         if(  full_name.val().length   === 0 &&
              username.val().length    === 0 && email.val().length             === 0 &&
              phone.val().length       === 0 && address.val().length           === 0 &&
              password.val().length    === 0 && confirm_password.val().length  === 0    ){
                 
                       array.push(full_name);
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
         
             
                      if(full_name.val().length   === 0){ array.push(full_name);}
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
                  
                    console.log( formURL );
                    $.ajax({ 
                            headers : {'X-CSRF-TOKEN': _token},
                            url     : formURL,
                            data    : data,
                            type    : 'POST',
                            datatype: 'JSON',
                            success:function(response){
                               if(response.success){
                                   //window.location.replace('{{url("/users")}}');
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
    
     $('#users-edit-user input').on('change',function(){
         $('.remove-alert-user').remove();
         
     });
    
    
    });
</script>

@stop
<!-- Add new user form -->