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
        {!! Form::model($referral, array('route' => array('referrals.update', $referral->id), 'method' => 'PUT','role'=>'form','id'=>'formClients')) !!}
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Client Details</legend>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Client No</th>
                            <th>Full Name</th>
                            <th>Sex</th>
                            <th>Age</th>
                            <th>Origin</th>
                            <th>Arrival Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>@if(is_object($referral->client) && $referral->client != null){{$referral->client->client_number}}@endif</td>
                            <td>@if(is_object($referral->client) && $referral->client != null){{$referral->client->full_name}}@endif</td>
                            <td>@if(is_object($referral->client) && $referral->client != null){{$referral->client->sex}}@endif</td>
                            <td>@if(is_object($referral->client) && $referral->client != null){{$referral->client->age}}@endif</td>
                            <td>@if(is_object($referral->client) && is_object($referral->client->nationality) && $referral->client->nationality != null )
                                    {{$referral->client->nationality->country_name}}
                                @endif</td>
                            <td>@if(is_object($referral->client) && $referral->client != null){{date('d M Y',strtotime($referral->client->date_arrival))}}@endif</td>

                        </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Referral Details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Progress Number</label>
                                <input type="text" class="form-control" placeholder="Progress Number" name="progress_number" id="progress_number"
                                       value="{{$referral->progress_number}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Case name</label>
                                <input type="text" class="form-control" placeholder="(Use a unique code for case name. Example LASTNAME Initials+date of birth e.g. LA08291976>)"
                                       id="case_name" name="case_name" value="{{$referral->case_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date" value="{{$referral->referral_date}}" name="referral_date" id="referral_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Completed by</label>
                                <input type="text" class="form-control" name="completed_by" id="completed_by" placeholder="Completed by" value="{{$referral->completed_by}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Name of Client Concerned</label>
                        <input type="text" class="form-control"  placeholder="Name of Client Concerned" @if(is_object($referral->client) && $referral->client != null)value="{{$referral->client->full_name}}"@endif readonly>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Location the referral originated</label>
                        <input type="text" class="form-control"  placeholder="Location the referral originated" value="{{$referral->location}}" name="location" id="location"
                        >
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Age</label>
                                <input type="number" class="form-control" placeholder="Age" name="age" id="age" value="{{$referral->age}}">
                                <span class="label label-block label-danger">(At the time of incident)</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Birth date</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date" value="{{$referral->birth_date}}" name="birth_date" id="birth_date">
                                </div>
                                <span class="label label-block label-danger">(At the time of incident)</span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group ">
                        <label class="control-label">Disabilities</label>
                        <input type="text" class="form-control" placeholder="Disabilities" name="disabilities" id="disabilities" value="{{$referral->disabilities}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Ethnic Background</label>
                        <input type="text" class="form-control" placeholder="Ethnic Background" name="ethnic_background" id="ethnic_background"
                               value="{{$referral->ethnic_background}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Contact</label>
                                <input type="text" class="form-control" placeholder="Contact" name="contact" id="contact"
                                       value="{{$referral->contact}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Telephone number</label>
                                <input type="text" class="form-control" placeholder="Telephone number" name="phone" id="phone"
                                       value="{{$referral->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Name of Person Who Originated concern and contact details</label>
                                <input type="text" class="form-control" placeholder="Leave this empty if same as above"
                                       name="person_name_contact" id="person_name_contact" value="{{$referral->person_name_contact}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Relationship to client</label>
                                <input type="text" class="form-control" placeholder="" name="relationship" id="relationship"
                                       value="{{$referral->relationship}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Approached for assistance with plot/address</label>
                                <input type="text" class="form-control" placeholder="(Ex. F11/A01/001)"
                                       name="person_name_address" id="person_name_address" value="{{$referral->person_name_address}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Consent Obtained to Share Information</label>
                                <select name="consent" data-placeholder="Choose an option..." class="select withOthers">
                                    @if($referral->consent !="")
                                        <option value="{{$referral->consent}}" selected>{{$referral->consent}}</option>
                                        @endif
                                    <option></option>
                                    <option value="Verbal">Verbal</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Parental Consent provided </label>
                                <select name="parental_consent" data-placeholder="Choose an option..." class="select">
                                    @if($referral->consent !="")
                                        <option value="{{$referral->parental_consent}}" selected>{{$referral->parental_consent}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <span class="label label-block label-danger">if Client is Under 18 years of Age</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Any Attachment included</label>
                                <select name="attachment" data-placeholder="Choose an option..." class="select">
                                    @if($referral->consent !="")
                                        <option value="{{$referral->attachment}}" selected>{{$referral->attachment}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Initial Action Recommended or Taken</label>
                        <textarea  class="form-control" name="initial_action" id="initial_action">{{$referral->initial_action}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Timeframes agreed/proposed</label>
                        <input type="text"  class="form-control" name="time_frames" id="time_frames" value="{{$referral->time_frames}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Additional Comments Regarding Concern [any information volunteered by client</label>
                        <textarea  class="form-control" name="additional_comments" id="additional_comments">{{$referral->additional_comments}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Primary Concern</label>
                        <select name="primary_concern" data-placeholder="Choose an option..." class="select withOthers">
                            @if($referral->consent !="")
                                <option value="{{$referral->primary_concern}}" selected>{{$referral->primary_concern}}</option>
                            @endif
                            <option></option>
                            <option value="Health">Health</option>
                            <option value="Nutrition">Nutrition</option>
                            <option value="Psychosocial">Psychosocial</option>
                            <option value="Neglect">Neglect</option>
                            <option value="Physical Violence">Physical Violence</option>
                            <option value="SGBV">SGBV</option>
                            <option value="Basic Needs">Basic Needs</option>
                            <option value="Education">Education</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Referred details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Referred to</label>
                                <input type="text"  class="form-control" name="referred_to" id="referred_to" placeholder="(Complete name)"
                                value="{{$referral->referred_to}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Position</label>
                                <input type="text"  class="form-control" name="referred_to_position" id="referred_to_position"
                                       value="{{$referral->referred_to_position}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Organization/ Institution</label>
                        <input type="text"  class="form-control" name="organization" id="organization"
                               value="{{$referral->organization}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Telephone number</label>
                                <input type="text"  class="form-control" name="org_phone" id="org_phone"  value="{{$referral->org_phone}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Email address</label>
                                <input type="email"  class="form-control" name="org_email" id="org_email" value="{{$referral->org_email}}">
                            </div>
                        </div>
                    </div>

                </fieldset>
                <div class="row">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
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
            organization: "required",
            referral_date: "required",
            completed_by: "required",
            age: {
                required: true,
                number: true
            },
            case_name: "required",
            referred_to: "required",
            referred_to_position: "required",
            org_phone: "required",
            org_email:{
                email:true,
            },
            location: "required"
        },
        messages: {
            organization: "Please this field is required",
            referral_date: "Please field is required",
            completed_by: "Please this field is required",
            age:{
                required:"Please this field is required",
                number:"Please enter valid data",
            } ,
            case_name: "Please this field is required",
            referred_to: "Please this field is required",
            referred_to_position: "Please this field is required",
            org_phone: "Please this field is required",
            org_email:{
                email:"Please enter valid data",
            },
            location: "Please this field is required"
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
                    success:function(data)
                    {
                        console.log(data);
                        //data: return data from server
                        $("#output").html(data);
                        setTimeout(function() {
                            location.replace('{{url('referrals')}}');
                            $("#output").html("");
                        }, 2000);
                    },
                    error: function(data)
                    {
                        console.log(data.responseJSON);
                        //in the responseJSON you get the form validation back.
                        $("#output").html("<h3><span class='text-danger'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

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