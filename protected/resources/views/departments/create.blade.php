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

            <!-- Basic layout-->
            {!! Form::open(array('url'=>'departments','role'=>'form','id'=>'formDepartments')) !!}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Department Details</h5>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label>Department Name:</label>
                            <input type="text" class="form-control" placeholder="Department Name" name="department_name" id="department_name" value="{{old('department_name')}}">
                            @if($errors->first('department_name') !="")
                                <label id="department_name-error" class="validation-error-label" for="department_name">{{ $errors->first('department_name') }}</label>
                            @endif
                            @if(Session::has('department_error'))
                                <label id="country_code-error" class="validation-error-label" for="country_code">{{ Session::get('department_error') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" placeholder="Descriptions" name="description" id="description">{{old('description')}}</textarea>
                            @if($errors->first('description') !="")
                                <label id="description-error" class="validation-error-label" for="description">{{ $errors->first('description') }}</label>
                            @endif

                        </div>
                        <div class="form-group">
                            <label>Parent Department:</label>
                            <select class="select" name="parent_id" id="parent_id" data-placeholder="Choose an option...">
                                <option value="0"></option>
                                @if(old('parent_id') !="")
                                    <?php $depart=\App\Department::find(old('parent_id'));?>
                                    <option value="{{$depart->id}}">{{$depart->region_name}}</option>
                                @endif
                                @foreach(\App\Department::orderBy('department_name','ASC')->get() as $item)
                                    <option value="{{$item->id}}">{{$item->department_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->first('parent_id') !="")
                                <label id="parent_id_name-error" class="validation-error-label" for="region_id">{{ $errors->first('parent_id') }}</label>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 pull-left" id="output">

                            </div>
                            <div class="col-md-4 col-sm-4 pull-right text-right">
                                <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                        </div>

                    </div>
                </div>
            {!! Form::close() !!}
            <!-- /basic layout -->
        <script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
        <script>


            $("#formDepartments").validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-error-label',
                successClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorElement:'div',
                rules: {
                    department_name: "required"
                },
                messages: {
                    department_name: "Please this field is required"

                },
                submitHandler: function(form) {
                    $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
                    var postData = $('#formDepartments').serializeArray();
                    var formURL = $('#formDepartments').attr("action");
                    $.ajax(
                        {
                            url : formURL,
                            type: "POST",
                            data : postData,
                            success:function(data)
                            {
                                console.log(data);
                                //data: return data from server
                                $("#output").html(data);
                                setTimeout(function() {
                                    location.replace('{{url('departments')}}');
                                    $("#output").html("");
                                }, 2000);
                            },
                            error: function(data)
                            {
                                console.log(data);
                               // $("#output").html(data);
                                //in the responseJSON you get the form validation back.
                                $("#output").html("<h3><span class='text-danger'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

                            }
                        });
                }
            });
        </script>

        </div>
</div>