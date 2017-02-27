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

{!! Form::open(array('url'=>'account/settings/access','role'=>'form','id'=>'adminPassChange')) !!}
<fieldset class="scheduler-border" style="margin-top: 10px;">
    <legend class="scheduler-border" style="color:#005DAD">Login Details</legend>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username " name="username" placeholder="Enter Username" required @if(old('username') !="")value="{{old('username')}}" @else value="{{$user->username}}" @endif readonly>
    </div>
    <div class="form-group">
        <label for="username">Old Password</label>
        <input type="password" class="form-control" id="old_userpass " name="old_userpass" placeholder="Enter Old Password">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="userpass">Password</label>
                <input type="password" class="form-control"  id="userpass" name="userpass" placeholder="Enter Password" required>
            </div>
            <div class="col-md-6">
                <label for="passconfirmation">Confirm Password</label>
                <input type="password" class="form-control"  id="passconfirmation" name="passconfirmation" placeholder="Confirm Password" required>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-8 col-sm-8 pull-left" id="outputPassword">

        </div>
        <div class="col-md-4 col-sm-4 pull-right text-right">
            <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Submit Form </button>
        </div>

    </div>
</fieldset>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script>
    $("#adminPassChange").validate({
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
        rules: {
            old_userpass: "required",
            userpass: {
                required: true,
                minlength: 5
            },
            passconfirmation: {
                required: true,
                minlength: 5,
                equalTo: "#userpass"
            }
        },
        messages: {
            old_userpass: "Please enter old password",
            userpass: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            passconfirmation: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            }
        },
        submitHandler: function(form) {
            $("#outputPassword").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#adminPassChange').serializeArray();
            var formURL = $('#adminPassChange').attr("action");
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success: function(data){
                        if(data.errors ==1){
                            $("#outputPassword").html(data.message);
                        }else {
                            swal({
                                title: "Password Change!",
                                text: data.message,
                                type: "success",
                                timer: 2000,
                                confirmButtonColor: "#43ABDB"
                            })
                            setTimeout(function () {
                                $("#outputPassword").html("");
                                location.replace("{{url('account/profile')}}");
                            }, 2000);

                        }
                    },
                    error: function(jqXhr,status, response) {
                        console.log(jqXhr);
                        if( jqXhr.status === 401 ) {
                            location.replace('{{url('login')}}');
                        }
                        if( jqXhr.status === 400 ) {
                            var errors = jqXhr.responseJSON.errors;
                            errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></di>';
                            $('#outputPassword').html(errorsHtml);
                        }
                        else
                        {
                            $('#outputPassword').html(jqXhr.message);
                        }

                    }
                });
        }
    });
</script>