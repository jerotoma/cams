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


</script>
<script>
    $('.pickadate').pickadate({

        // Escape any “rule” characters with an exclamation mark (!).
        format: 'yyyy-mm-dd',
    });
    tinymce.init({ selector:'texteditor' });
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::model($referral,array('route' => array('referrals.update', $referral->id), 'method' => 'PUT','role'=>'form','id'=>'formClients')) !!}
        <div class="panel panel-flat">

            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Referral Details </legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Date of Referral</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date of Referral" value="{{$referral->referral_date}}" name="referral_date" id="referral_date">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Referral Type</label>
                            <select name="referral_type" data-placeholder="Choose an option..." class="select">
                                @if($referral->referral_type !="")
                                    <option value="{{$referral->referral_type}}">{{$referral->referral_type}}</option>
                                    @endif
                                <option></option>
                                <option value="Routine">Routine</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>

                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Referring agency </legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Agency / Org: </label>
                                <input type="text" class="form-control" placeholder="Agency / Org: " name="ref_organisation" id="ref_organisation"
                                       @if(is_object($referral->referringAgency))value="{{$referral->referringAgency->ref_organisation}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Contact (if known): </label>
                                <input type="text" class="form-control" placeholder="contact" id="ref_contact" name="ref_contact"
                                       @if(is_object($referral->referringAgency)) value="{{$referral->referringAgency->ref_contact}}" @endif >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" id="ref_phone" name="ref_phone"
                                       @if(is_object($referral->referringAgency)) value="{{$referral->referringAgency->ref_phone}}" @endif>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Email: </label>
                                <input type="text" class="form-control" placeholder="Email " name="ref_email" id="ref_email"
                                       @if(is_object($referral->referringAgency)) value="{{$referral->referringAgency->ref_location}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Location: </label>
                                <input type="text" class="form-control" placeholder="Location" id="ref_location" name="ref_location"
                                       @if(is_object($referral->referringAgency)) value="{{$referral->referringAgency->ref_location}}" @endif>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Receiving Agency</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Agency / Org: </label>
                                <input type="text" class="form-control" placeholder="Agency / Org: " name="rec_org" id="rec_org"
                                       @if(is_object($referral->receivingAgency)) value="{{$referral->receivingAgency->rec_email}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Contact (if known): </label>
                                <input type="text" class="form-control" placeholder="contact" id="rec_contact" name="rec_contact"
                                       @if(is_object($referral->receivingAgency)) value="{{$referral->receivingAgency->rec_email}}" @endif>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" id="rec_phone" name="rec_phone"
                                       @if(is_object($referral->receivingAgency)) value="{{$referral->receivingAgency->rec_email}}" @endif>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Email: </label>
                                <input type="text" class="form-control" placeholder="Email " name="ref_email" id="ref_email"
                                       @if(is_object($referral->receivingAgency)) value="{{$referral->receivingAgency->rec_email}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Location: </label>
                                <input type="text" class="form-control" placeholder="Location" id="rec_location" name="rec_location" value="{{old('rec_location')}}">
                            </div>
                        </div>

                    </div>

                </fieldset>
                <fieldset class="scheduler-border">

                    <legend class="text-bold">Client Information</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Name: </label>
                                <input type="text" class="form-control" placeholder="Name: " name="cl_name" id="cl_name"
                                       value="{{$referral->clientInformation->cl_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Address: </label>
                                <input type="text" class="form-control" placeholder="Address" id="cl_address" name="cl_address" value="{{$referral->clientInformation->cl_address}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" id="cl_phone" name="cl_phone"
                                       value="{{$referral->clientInformation->cl_phone}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Age: </label>
                                <input type="text" class="form-control" placeholder="Age " name="" id="cl_age"
                                       value="{{$referral->clientInformation->cl_age}}" readonly >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Sex: </label>
                                <input type="text" class="form-control" placeholder="Sex" id="cl_sex" name="cl_sex" value="{{$referral->clientInformation->cl_sex}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Nationality: </label>
                                <input type="text" class="form-control" placeholder="Nationality" id="cl_nationality" name="cl_nationality"
                                       value="{{$referral->clientInformation->cl_nationality}}" >
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Language: </label>
                                <input type="text" class="form-control" placeholder="Language " name="cl_language" id="cl_language"
                                       value="{{$referral->clientInformation->cl_language}}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">ID Numbers: </label>
                                <input type="text" class="form-control" placeholder="ID Numbers:" id="cl_id_number" name="cl_id_number" value="{{$referral->clientInformation->cl_id_number}}">
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="text-bold">If Client Is a Minor (under 18 years)</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Name of primary caregiver:: </label>
                                <input type="text" class="form-control" placeholder="Name of primary caregiver:: " name="cl_care_giver" id="cl_care_giver"
                                       @if(is_object($referral->clientInformation)) value="{{$referral->clientInformation->cl_language}}" @endif >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Relationship to child: </label>
                                <input type="text" class="form-control" placeholder="Relationship to child:" id="cl_care_giver_relationship" name="cl_care_giver_relationship"
                                       @if(is_object($referral->clientInformation)) value="{{$referral->clientInformation->cl_care_giver_relationship}}" @endif>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Contact information for caregiver:</label>
                                <input type="text" class="form-control" placeholder="Contact information" id="cl_care_giver_contact" name="cl_care_giver_contact"
                                       @if(is_object($referral->clientInformation)) value="{{$referral->clientInformation->cl_care_giver_contact}}" @endif>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Caregiver is informed of referral?: </label>
                                <select name="cl_care_giver_informed" data-placeholder="Choose an option..." class="select">
                                    @if(is_object($referral->clientInformation))
                                        <option>  {{$referral->clientInformation->cl_care_giver_informed}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Is child separated or unaccompanied? </label>
                                <select name="cl_child_separated" data-placeholder="Choose an option..." class="select">
                                    @if(is_object($referral->clientInformation))
                                        <option> {{$referral->clientInformation->cl_child_separated}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="text-bold">Background Information/Reason for Referral:
                        (problem description, duration, frequency, etc.) and Services Already Provided
                    </legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Has the client been informed of the referral?? </label>
                                <select name="client_referral_info" data-placeholder="Choose an option..." class="select">
                                    @if(is_object($referral->referralReason))
                                        <option> {{$referral->referralReason->client_referral_info}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <label class="control-label"> If yes Explain here?   </label>
                                <textarea  class="form-control" name="client_referral_info_text" id="client_referral_info_text">@if(is_object($referral->referralReason)){{$referral->referralReason->client_referral_info}}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Has the client been referred to any other organisazation ? </label>
                                <select name="client_referral_status" data-placeholder="Choose an option..." class="select">
                                    @if(is_object($referral->referralReason))
                                        <option> {{$referral->referralReason->client_referral_status}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <label class="control-label">If yes Explain here?   </label>
                                <textarea  class="form-control" name="referal_other_org" id="referal_other_org">@if(is_object($referral->referralReason)){{$referral->referralReason->client_referral_status}}</option>@endif</textarea>
                            </div>
                        </div>

                    </div>

                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="text-bold">Services Requested </legend>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Mental Health Services">
                                Mental Health Services
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Protection Support/ Services" >
                                Protection Support/ Services
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Shelter" >
                                Shelter
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Psychological Interventions" >
                                Shelter
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" >
                                Psychological Interventions
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Community Centre/ Social Services" >
                                Community Centre/ Social Services
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="aterial Assistance">
                                Material Assistance
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Physical Health Care" >
                                Physical Health Care
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Family Tracing Services">
                                Family Tracing Services
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Nutrition">
                                Nutrition
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Physical Rehabilitation">
                                Physical Rehabilitation
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Legal Assistance">
                                Legal Assistance
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Financial Assistance">
                                Financial Assistance
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]" value="Education">
                                Education
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Psychosocial Activities">
                                Psychosocial Activities
                            </label>
                        </div>
                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Explain any request Service  </legend>
                    <textarea  class="form-control" name="comments" id="comments"> @if(is_object($referral->referralServiceRequested)){{$referral->referralServiceRequested->client_referral_status}}@endif</textarea>
                </fieldset>

                <div class="row" style="margin-top: 10px">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit Form </button>
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
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }

            else {
                error.insertAfter(element);
            }
        },
        errorElement: 'div',
        rules: {
            client_id: "required",
            referral_type: "required",

            client_age: {
                number: true
            },
            referral_date: "required",
            rec_organisation: "required",
            rec_contact: "required",
            client_referral_info: "required",
            ref_organisation: "required",
            ref_contact: "required",

        },
        messages: {
            client_id: "Please this field is required",
            referral_type: "Please this field is required",
            referral_date: "Please field is required",
            rec_organisation: "Please this field is required",
            rec_contact: "Please this field is required",
            client_referral_info: "Please field is required",
            ref_contact: "Please field is required",
            client_age: {
                number: "Please enter valid age",
            },

        }, submitHandler: function (form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#formClients').serializeArray();
            var formURL = $('#formClients').attr("action");
            $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data) {
                        swal({
                            title: "Form Submitted successful!",
                            text: data.message,
                            type: "success",
                            timer: 2000,
                            confirmButtonColor: "#43ABDB"
                        })
                        setTimeout(function () {
                            location.replace("{{url('clients')}}");
                            $("#output").html("");
                        }, 2000);
                    },
                    error: function (jqXhr, status, response) {
                        console.log(jqXhr);
                        if (jqXhr.status === 401) {
                            location.replace('{{url('login')}}');
                        }
                        if (jqXhr.status === 400) {
                            var errors = jqXhr.responseJSON.errors;
                            errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></di>';
                            $('#output').html(errorsHtml);
                        }
                        else {
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