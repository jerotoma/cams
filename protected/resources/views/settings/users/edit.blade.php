<script type="text/javascript" src="{{asset("assets/js/core/libraries/jasny_bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_multiselect.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/bootstrap_select.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/selectboxit.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tagsinput.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/tags/tokenfield.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/touchspin.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/maxlength.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/inputs/formatter.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/moment/moment.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/pages/form_floating_labels.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
<script>
    $('.pickadate').pickadate({
        // Escape any “rule” characters with an exclamation mark (!).
        format: 'yyyy-mm-dd',
    });
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Edit User Settings</h5>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url'=> url('/settings/users/update'),'role'=>'form','id'=>'user-settings-form')) !!}
                        <div class="form-group">
                            <label>Do you want to keep Sidebar Navigation Closed when page loads</label>
                            <select name="keep_sidebar_open_or_close_onload"  data-placeholder="Choose an option..." class="select">
                                <option></option>
                                <option value="Yes" {{isSidebarOpen() ? 'selected' : ''}}>Yes</option>
                                <option value="No" {{!isSidebarOpen() ? 'selected' : ''}} >No</option>
                            </select>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-8 col-sm-8 pull-left" id="output"></div>
                            <div class="col-md-4 col-sm-4 pull-right text-right">
                                <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                                <button id="submitEditUserSetting"  type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit Form </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){

            $('#user-settings-form').on('submit', function(e) {
                e.preventDefault();
                $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
                var postData = $('#user-settings-form').serializeArray();
                var formURL = $('#user-settings-form').attr("action");
                $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success: function(data){
                            swal({title: "Form Submitted successful!", text: data.message, type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                            setTimeout(function() {
                                location.replace("{{url('/settings/users')}}");
                                $("#output").html("");
                            }, 2000);
                        },
                        error: function(jqXhr,status, response) {
                            console.log(jqXhr);
                            if( jqXhr.status === 401 ) {
                                location.replace('{{url('login')}}');
                            }
                            if( jqXhr.status === 400 ) {
                                if(jqXhr.responseJSON.errors ==1)
                                {
                                    errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p>';
                                    errorsHtml += '<h5 class="text-danger">'+jqXhr.responseJSON.message + '</h5>'
                                    $('#output').html(errorsHtml);
                                }else {
                                    var errors = jqXhr.responseJSON.errors;
                                    errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                                    $.each(errors, function (key, value) {
                                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                    });
                                    errorsHtml += '</ul></di>';
                                    $('#output').html(errorsHtml);
                                }
                            }
                            else
                            {
                                $('#output').html(jqXhr.message);
                            }

                        }
                    });
            });
        });
    </script>
