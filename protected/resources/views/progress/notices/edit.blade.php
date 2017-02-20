<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/tinymce/js/tinymce/tinymce.min.js")}}"></script>
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
    tinymce.init({ selector:'textarea' });
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::model($notice, array('route' => array('notices.update', $notice->id), 'method' => 'PUT','role'=>'form','id'=>'formNotice')) !!}
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold"><h3 class="text-center text-bold">Note Details</h3></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Open Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate"  value="{{$notice->open_date}}" name="open_date" id="open_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Case Worker Name</label>
                                <input type="text" class="form-control" placeholder="case_worker_name" name="case_worker_name" id="case_worker_name" value="{{$notice->case_worker_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Subjective Information</label>
                        <textarea  class="form-control" name="subjective_information" id="subjective_information" ><?php echo $notice->subjective_information;?></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Objective Information</label>
                        <textarea  class="form-control" name="objective_information" id="objective_information" ><?php echo $notice->objective_information;?></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Analysis</label>
                        <textarea  class="form-control" name="analysis" id="analysis" ><?php echo $notice->analysis;?></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Planning</label>
                        <textarea  class="form-control" name="planning" id="planning" ><?php echo $notice->planning;?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Camp</label>
                                <select name="camp_id" id="camp_id" data-placeholder="Choose an option..." class="select withOthers">
                                    @if(is_object($notice->camp) && $notice->camp != null )
                                        <option value="{{$notice->camp->id}}" selected>{{$notice->camp->camp_name}}</option>
                                    @endif
                                    <option></option>
                                    @foreach(\App\Camp::all() as $camp)
                                        <option value="{{$camp->id}}">{{$camp->camp_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Status</label>
                                <select name="status" id="status" data-placeholder="Choose an option..." class="select withOthers">
                                    @if($notice->status !="" && $notice->status != null )
                                        <option value="{{$notice->status}}" selected>{{$notice->status}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Open Case">Open Case</option>
                                    <option value="Assessment">Assessment</option>
                                    <option value="Case Planning">Case Planning</option>
                                    <option value="Case Followup">Case Followup</option>
                                    <option value="Case Closed">Case Closed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update Form </button>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script>
    $(".withOthers").change(function () {
        var id1 =  $(this[this.selectedIndex]).val();
        var txt = $(this[this.selectedIndex]).text();
        var slt= $(this);
        if(id1 == "Other")
        {
            bootbox.prompt("Please specify the other", function(result) {
                if (result === null) {
                    bootbox.alert("Nothing entered");
                } else {
                    slt.append('<option value="'+ result +'" selected>'+ result +'</option>');

                }
            });

        }
    });

    $("#formNotice").validate({
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
            open_date: "required",
            subjective_information: "required",
            objective_information: "required",
            analysis: "required",
            planning: "required",
            case_worker_name: "required",
            status: "required"
        },
        messages: {
            open_date: "Please this field is required",
            subjective_information: "Please this field is required",
            objective_information: "Please field is required",
            analysis: "Please this field is required",
            planning: "Please this field is required",
            case_worker_name: "Please this field is required",
            status: "Please this field is required"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#formNotice').serializeArray();
            var formURL = $('#formNotice').attr("action");
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success: function(data){
                        swal({title: "Form Submitted successful!", text: data.message, type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                        setTimeout(function() {
                            location.replace("{{url('progressive/notices')}}");
                            $("#output").html("");
                        }, 2000);
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
                            $('#output').html(errorsHtml);
                        }
                        else
                        {
                            $('#output').html(jqXhr.message);
                        }

                    }
                });
        }
    });
</script>