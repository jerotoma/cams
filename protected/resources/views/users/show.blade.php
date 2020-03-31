<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/wizards/form_wizard/form.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/core/libraries/jasny_bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>

<script type="text/javascript" src="{{asset("assets/js/pages/wizard_form.js")}}"></script>


<script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
<script>
    $('.pickadate').pickadate();
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT','role'=>'form','id'=>'formUsers')) !!}
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold">User Details</legend>
                    <div class="form-group ">
                        <label class="control-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" name="full_name" id="full_name"
                               value="{{$user->full_name}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Designation</label>
                        <input type="text" class="form-control" placeholder="Designation" name="designation" id="designation"
                               value="{{$user->designation}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                                       value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="phone" name="phone" id="phone"
                                       value="{{$user->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control" placeholder="Username" name="username" id="username"
                                       value="{{$user->username}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                            <label class="control-label">Role {{dd($user)}}</label>
                                <select class="select" name="role_id" id="role_id" data-placeholder="Choose an option...">
                                    @if($user->role != null )
                                        <option value="{{$user->role->id}}" selected>{{$user->role->name}}</option>
                                    @endif
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Department</label>
                        <select class="select" name="department_id" id="department_id" data-placeholder="Choose an option...">
                            @if($user->department != null )
                                <option value="{{$user->department->id}}" selected>{{$user->department->department_name}}</option>
                            @endif
                            <option></option>
                            @foreach(\App\Department::all() as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control" placeholder="password" name="password" id="password"
                                       value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="confirm" name="confirm" id="confirm"
                                       value="">
                            </div>
                        </div>
                    </div>

                </fieldset>
                <div class="row">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

