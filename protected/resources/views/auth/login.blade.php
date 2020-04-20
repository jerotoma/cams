<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Case management Database for Person with special needs| Login</title>

    <!-- Global stylesheets -->
    <link href="{{asset("assets/css/googlefonts.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/icons/icomoon/styles.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/icons/fontawesome/styles.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/core.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/components.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/colors.css")}}" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset("assets/images/favicon.ico")}}" />
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset("assets/js/plugins/loaders/pace.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/loaders/blockui.min.js")}}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/pages/login_validation.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
    <!-- /theme JS files -->
</head>
<body class="login-container">
<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo text-center" style="padding-top: 10px">
        <a  href="#" style="color: #FFFFFF; font-size: 20px;font-weight: bold; text-transform: uppercase; margin-top: 10px;">
		 Case Management Database for Person with Specific Needs </a>
</div>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content">
                <!-- Advanced login -->
                {!! Form::open(array('url'=>'login','class'=>'form-validate','id'=>'form-validate')) !!}
                    <div class="login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning-400 text-warning-400"><i class="icon-user"></i></div>
                            <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert fade in alert-danger">
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Username" required="required" autocomplete="off">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
						<div class="form-group login-options">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="styled">
                                        Remember
                                    </label>
                                </div>
                            <!--
                                <div class="col-sm-6 text-right">
                                    <a href="{{url('password/recover')}}">Forgot password?</a>
                                </div>
								-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pull-left" id="output"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Login <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
               {!! Form::close() !!}
                <!-- /advanced login -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->
<!-- Footer -->
<div class=" navbar-fixed-bottom hidden-sm hidden-xs hidden-xs-down hidden-sm-down hidden-md-down">
    <div class="row hidden-sm hidden-xs hidden-xs-down hidden-sm-down hidden-md-down" style="margin-bottom: 10px; margin-left: 10px">
        <div class="col-md-2 pull-right" style="padding-right: 10px">
            <fieldset class="scheduler-border">
                <legend class="text-bold"><h6>Sponsored By</h6></legend>
                <div class="row">
                    <div class="col-md-6 text-center"><img src="{{asset('assets/images/bprn_logo.png')}}"  style="width: 100px; height: 100px; border-radius: 10px"/><p class="text-center ">BPRM</p></div>
                    <div class="col-md-6 text-center"><img src="{{asset('assets/images/unhcr.png')}}" style="width: 100px; height: 100px; border-radius: 10px"/><p class="text-center ">UNHCR</p></div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-1 pull-left">
            <fieldset class="scheduler-border">
                <legend class="text-bold"><h6 class="text-left">Developed For</h6></legend>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="{{asset('assets/images/helpage.png')}}" style="width: 100px; height: 100px; border-radius: 10px"/>
                        <p class="text-center">HELPAGE International</p>
                   </div>
                </div>
            </fieldset>
        </div>
    </div>

</div>
<!-- /footer -->
<script>
    $(function(){
        $("#formLogin").validate({
            rules: {
                username: "required",
                password: "required"
            },
            messages: {
                username: "Enter your username",
                password: "Enter your password"
            }
        });
        $('#form-validate').on('submit', function(e){
            e.preventDefault();
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Logging you in please wait...</span><h3>");
            var formURL = $('#form-validate').attr("action");
            $.ajax({
                url : formURL,
                type: "POST",
                data : new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    if (data.success) {
                        window.location.assign("{{url('/home')}}");
                    } else {
                       $('#output').html('<div class="alert alert-danger"><p class="text-bold">' + data.message + '</p></div>');
                    }
                },
                error: function(jqXhr,status, response) {
                    if( jqXhr.status === 401 ) {
                        let message = jqXhr.message ? jqXhr.message : jqXhr.errors;
                        $('#output').html(message);
                    }
                    if( jqXhr.status === 400 ) {
                       var errors = jqXhr.responseJSON.errors;
                        errorsHtml = '<div class="alert alert-danger"><p class="text-bold">Please resolve the following errors</p><ul>';
                        $.each(errors, function (key, value) {
                            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';
                        $('#output').html(errorsHtml);
                    } else if (jqXhr.status === 422) {
                        let message = jqXhr.responseJSON.message ? jqXhr.responseJSON.message : jqXhr.errors;
                        $('#output').html('<div class="alert alert-danger"><p class="text-bold">' + message + '</p></div>');
                    } else {
                        let message = jqXhr.message ? jqXhr.message : jqXhr.errors;
                        $('#output').html('<div class="alert alert-danger"><p class="text-bold">' + message + '</p></div>');
                    }
                }
            });
        });
    });
</script>
</body>
</html>
