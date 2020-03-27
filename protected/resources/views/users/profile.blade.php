@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
    <script>
        $(".editRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Change My Password</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow-y','scroll');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("account/settings/access") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

        $("#formUsersProfile").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                    else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            errorElement:'div',
            rules: {
                full_name: "required",
                phone: "required",
                username: "required",
                status: "required",
                role_id: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 8
                },
                confirm: {
                    minlength: 8,
                    equalTo : "#password"
                }
            },
            messages: {
                full_name: "Please this field is required",
                phone: "Please field is required",
                username: "Please this field is required",
                role_id: "Please this field is required",
                status: "Please this field is required",
                email:{
                    required:"Please this field is required",
                    email:"Please enter valid email",
                },
                password:{
                    minlength:"Password must have 8 characters",
                },
                confirm:{
                    minlength:"Password must have 8 characters",
                    equalTo :"Password don't match",
                }
            },
            submitHandler: function(form) {
                $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
                var postData = $('#formUsersProfile').serializeArray();
                var formURL = $('#formUsersProfile').attr("action");
                $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        dataType: "json",
                        success:function(data)
                        {
                            console.log(data);
                            //data: return data from server
                            $("#output").html(data.message);
                            setTimeout(function() {
                                location.replace('{{url('users')}}');
                                $("#output").html("");
                            }, 2000);
                        },
                        error: function(jqXhr,status, response) {
                            if( jqXhr.status === 400 ) {
                                var errors = jqXhr.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                                $.each(errors, function (key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                });
                                errorsHtml += '</ul></di>';
                                $('#output').html(errorsHtml);
                            }
                            else
                            {
                                $('#output').html("");
                            }

                        }
                    });
            }
        });
    </script>
@stop
@section('main_navigation')
    @include('inc.main_navigation')
@stop
@section('page_title')
    My Account Profile
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">My Account Profile </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="#">Account/profile</a></li>
    </ul>
@stop
@section('contents')
    <!-- User profile -->
    <div class="row">
        <div class="col-md-9">
            <div class="tabbable">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="activity">

                        <!-- Timeline -->
                        <div class="timeline timeline-left content-group">
                            <div class="timeline-container">

                                <!-- Sales stats -->
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <a href="#"><img src="{{asset("assets/images/placeholder.jpg")}}" alt=""></a>
                                    </div>

                                    <div class="panel panel-flat timeline-content">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Profile Details</h6>
                                            <div class="heading-elements">
                                                <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated {{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime($user->updated_at)) /3600)}} hours ago</span>

                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            {!! Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT','role'=>'form','id'=>'formUsersProfile')) !!}
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
                                                                           value="{{$user->email}}" readonly>
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
                                                                    <label class="control-label">Role</label>
                                                                    <select class="form-control" name="role_id" id="role_id" data-placeholder="Choose an option..." readonly>
                                                                        @if(count(\App\RoleUser::where('user_id','=',$user->id)->get()) > 0 )
                                                                            <option value="{{\App\RoleUser::where('user_id','=',$user->id)->get()->first()->role_id}}" selected>{{\App\RoleUser::where('user_id','=',$user->id)->get()->first()->role->display_name}}</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label">Department</label>
                                                            <select class="form-control" name="department_id" id="department_id" data-placeholder="Choose an option...">
                                                                @if($user->department_id != "" && count(\App\Department::find($user->department_id)) > 0 )
                                                                    <option value="{{\App\Department::find($user->department_id)->id}}" selected>{{\App\Department::find($user->department_id)->department_name}}</option>
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
                                                                    <label class="control-label">Status</label>
                                                                    <select class="form-control" name="status" id="status" data-placeholder="Choose an option..." readonly="">
                                                                        @if($user->status !="")
                                                                            <option value="{{$user->status}}">{{$user->status}}</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group ">
                                                                    <label class="control-label">Locked</label>
                                                                    <select class="form-control" name="locked" id="locked" data-placeholder="Choose an option..." readonly="">
                                                                        @if($user->locked !="" && $user->locked ==1 )
                                                                            <option value="{{$user->locked}}">Yes</option>
                                                                        @elseif($user->locked ==0)
                                                                            <option value="{{$user->locked}}">No</option>
                                                                        @endif

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-8 pull-left" id="output">

                                                        </div>
                                                        <div class="col-md-4 col-sm-4 pull-right text-right">
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update  Personal Details </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                                <!-- /sales stats -->

                                <!-- Video posts -->
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <img src="{{asset("assets/images/placeholder.jpg")}}" alt="">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-flat timeline-content">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Latest Activities</h6>
                                                </div>

                                                <div class="panel-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /video posts -->

                            </div>
                        </div>
                        <!-- /timeline -->

                    </div>


                    <div class="tab-pane fade" id="schedule">

                        <!-- Available hours -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Available hours</h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="chart-container">
                                    <div class="chart has-fixed-height" id="plans"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->


                    </div>


                    <div class="tab-pane fade" id="settings">


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">

            <!-- User thumbnail -->
            <div class="thumbnail">
                <div class="thumb thumb-rounded thumb-slide">
                    <img src="{{asset("assets/images/user_icon.png")}}" alt="">
                    <div class="caption">
										<span>
											<a href="#" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
											<a href="#" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
										</span>
                    </div>
                </div>

                <div class="caption text-center">
                    <h6 class="text-semibold no-margin">{{\Auth::user()->full_name}} <small class="display-block">{{\Auth::user()->designation}}</small></h6>
                </div>
            </div>
            <!-- /user thumbnail -->


            <!-- Navigation -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Navigation</h6>
                    <div class="heading-elements">
                        <a href="#" class="heading-text">See all &rarr;</a>
                    </div>
                </div>

                <div class="list-group no-border no-padding-top">
                    <a href="{{url('account/profile')}}" class="list-group-item"><i class="icon-user"></i> My profile</a>
                    <a href="#" class=" editRecord list-group-item"><i class="icon-cash3"></i> Change Password</a>
                    <a href="#" class="list-group-item"><i class="icon-tree7"></i>Pending Items <span class="badge bg-danger pull-right">29</span></a>
                    <div class="list-group-divider"></div>
                    <a href="#" class="list-group-item"><i class="icon-calendar3"></i> Events <span class="badge bg-teal-400 pull-right">48</span></a>
                    <a href="#" class="list-group-item"><i class="icon-cog3"></i> Account settings</a>
                </div>
            </div>
            <!-- /navigation -->

        </div>
    </div>
    <!-- /user profile -->
@endsection