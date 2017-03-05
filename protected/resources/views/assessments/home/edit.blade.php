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
    $('.pickadate').pickadate({

        // Escape any “rule” characters with an exclamation mark (!).
        format: 'yyyy-mm-dd',
    });
    tinymce.init({ selector:'textarea' });
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::model($assessment, array('route' => array('home.update', $assessment->id), 'method' => 'PUT','role'=>'form','id'=>'formClients')) !!}
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold">PSN Needs/Home assessment Details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Date of assessment</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date of assessment" value="{{$assessment->assessment_date}}" name="assessment_date" id="assessment_date"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">PSN Case code</label>
                                <input type="text" class="form-control" placeholder="" name="case_code" id="case_code"
                                       value="{{$assessment->case_code}}">
                            </div>
                        </div>
                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <?php $client=$assessment->client;?>
                    <legend class="text-bold">Profile Information of PSN: ( to add contact details of the PSN or caretaker)</legend>
                    <div class="form-group ">
                        <label class="control-label">Name of PSN</label>
                        <input type="text" class="form-control" placeholder="Name of PSN" name="psn_name" id="psn_name"
                               value="{{$client->full_name}}" readonly>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Origin</label>
                        <select class="form-control" name="nationality" id="nationality" data-placeholder="Choose an option..." readonly="">
                            @if(is_object($client->fromOrigin))
                                <option value="{{$client->fromOrigin->id}}" selected>{{$client->fromOrigin->origin_name}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Name of caregiver/Parent/household head(if different):</label>
                                <input type="text" class="form-control" placeholder="" name="care_giver" id="care_giver"
                                       value="{{$client->care_giver}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Address</label>
                                <input type="text" class="form-control" placeholder="" name="address" id="address"
                                       value="{{$client->present_address}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Camp Name</label>
                                <select class="form-control" name="camp_id" id="camp_id"  data-placeholder="Choose an option..." readonly="">
                                    @if(is_object($client->camp))
                                        <option value="{{$client->camp->id}}" selected>{{$client->camp->camp_name}}</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">District</label>
                                <select class="form-control" name="district" id="district" data-placeholder="Choose an option..." readonly="">
                                    @if(is_object($client->camp) && is_object($client->camp->district))
                                        <option value="{{$client->camp->district->id}}" selected>{{$client->camp->district->district_name}}</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Family size</label>
                                <input type="text" class="form-control" placeholder="" name="family_size" id="family_size"
                                       value="{{$client->household_number}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Ration card number (if any)</label>
                                <input type="text" class="form-control" placeholder="" name="case_code" id="case_code"
                                       value="{{$client->ration_card_number}}" readonly >
                            </div>
                        </div>
                    </div>


                    <div class="form-group ">
                        <label class="control-label">Link case code</label>
                        <input type="text" class="form-control" placeholder="" name="linked_case_code" id="linked_case_code"
                               value="">
                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Description of the individual special needs and the family situation</legend>
                    <div class="form-group ">
                        <textarea class="form-control" name="needs_description" id="needs_description">{{$assessment->needs_description}}</textarea>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Case workers Findings</legend>
                    <div class="form-group ">
                        <label class="control-label">Findings</label>
                        <textarea class="form-control" name="findings" id="findings">{{$assessment->findings}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Diagnosis</label>
                        <textarea class="form-control" name="diagnosis" id="diagnosis">{{$assessment->diagnosis}}</textarea>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Case worker’s recommendations and comments</legend>
                    <div class="form-group ">
                        <textarea class="form-control" name="recommendations" id="recommendations">{{$assessment->recommendations}}</textarea>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Final decision</legend>
                    <div class="form-group ">
                        <textarea class="form-control" name="final_decision" id="final_decision">{{$assessment->final_decision}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Name of Case Worker</label>
                        <input type="text" class="form-control" placeholder="" name="case_worker_name" id="case_worker_name"
                               value="{{$assessment->case_worker_name}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Name of Project Coordinator</label>
                        <input type="text" class="form-control" placeholder="" name="project_coordinator" id="project_coordinator"
                               value="{{$assessment->project_coordinator}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Organization </label>
                        <input type="text" class="form-control" placeholder="" name="organization" id="organization"
                               value="{{$assessment->organization}}">
                    </div>
                </fieldset>

                <div class="row" style="margin-top: 10px">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Update Form </button>
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

    $("#formClients").validate({
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
            case_code: "required",
            case_worker_name: "required",
            project_coordinator: "required",
            organization: "required",
            assessment_date: {
                required:true,
                date:true
            }
        },
        messages: {
            case_code: "Please this field is required",
            case_worker_name: "Please this field is required",
            project_coordinator: "Please this field is required",
            organization: "Please this field is required",
            assessment_date: {
                required:"Please this field is required",
                date:"Please enter valid date"
            }
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#formClients').serializeArray();
            var formURL = $('#formClients').attr("action");
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success: function(data){
                        swal({title: "Form Submitted successful!", text: data.message, type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                        setTimeout(function() {
                            location.replace("{{url('assessments/home')}}");
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
    $("#civil_status").change(function () {
        var id1 = this.value;
        if(id1 != "Married")
        {
            $("#spouse_name").removeAttr('value');
            $("#spouse_name").attr('value','');
            $("#spouse_name").attr('readonly','readonly');

        }else{$("#spouse_name").removeAttr('readonly');}
    });

    $("#region_id").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('fetch/districts') ?>/"+id1,function(data){
                $("#district_id").html(data);
            });
        }else{$("#district_id").html("<option value=''>----</option>");}
    });
</script>