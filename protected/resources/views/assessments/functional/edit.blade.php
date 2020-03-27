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

    $('#prompt').on('click', function() {
        bootbox.prompt("Please enter your name", function(result) {
            if (result === null) {
                bootbox.alert("Prompt dismissed");
            } else {
                bootbox.alert("Hi <b>"+result+"</b>");
            }
        });
    });

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
</script>
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Vulnerability Individual Assessment</h6>

    </div>
    {!! Form::model($assessment, array('route' => array('vulnerability.update', $assessment->id), 'method' => 'PUT','role'=>'form','class'=>'form-ajax','id'=>'formClients')) !!}
    <fieldset class="step" id="ajax-step1">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">1</span>
            General Information - Assessment
            <small class="display-block">Tell us a bit about yourself</small>
        </h6>
        <div class="form-group">
            <label class="control-label">Assessors' names</label>
            <input type="text" class="form-control" placeholder="Assessors' names" name="q1_1" id="q1_1"
                   value="{{$assessment->q1_1}}">
        </div>
        <div class="form-group ">
            <label class="control-label">Code:</label>
            <input type="text" class="form-control" placeholder="Code: _ _ | _ _ | _ _ _" name="q1_2" id="q1_2"
                   value="{{$assessment->q1_2}}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Camp name</label>
                    <input type="text" class="form-control" placeholder="Camp name" name="q1_3" id="q1_3"
                           value="{{$assessment->q1_3}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label">District</label>
                    <input type="text" class="form-control" placeholder="District" name="q1_4" id="q1_4"
                           value="{{$assessment->q1_4}}">
                </div>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label">Date of interview</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                <input type="text" class="form-control pickadate" placeholder="Date of interview" value="{{$assessment->q1_5}}" name="q1_5" id="q1_5">
            </div>
        </div>
    </fieldset>

    <fieldset class="step" id="ajax-step2">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">2</span>
            Personal Info - Household profile
            <small class="display-block">Let us know about household</small>
        </h6>
        <div class="form-group">
            <label class="control-label">Name, Surname</label>
            <input type="text" class="form-control" placeholder="Name, Surname" name="q2_1" id="q2_1"
                   @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                   value="{{$assessment->householdProfile->q2_1}}"@endif>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label class="control-label">Relation to the head of household</label>
                    <select class="select" name="q2_2" id="q2_2"  data-placeholder="Choose an option...">
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            <option value="{{$assessment->householdProfile->q2_2}}" selected>{{$assessment->householdProfile->q2_2}}</option>
                        @endif
                        <option></option>
                        <option value="Head">Head</option>
                        <option value="Wiife/Husband">Wife/Husband</option>
                        <option value="Sister/Brother">Sister/Brother</option>
                        <option value="Son/Daughter">Son/Daughter</option>
                        <option value="Grandparent">Grandparent</option>
                        <option value="Not related">Not related</option>

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Sex</label>
                    <select class="select" name="q2_3" id="q2_3" data-placeholder="Choose an option...">
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            <option value="{{$assessment->householdProfile->q2_3}}" selected>{{$assessment->householdProfile->q2_3}}</option>
                        @endif
                        <option></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Age:</label>
                    <input type="text" name="q2_4" placeholder="Age" class="form-control" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                       value="{{$assessment->householdProfile->q2_4}}"  @endif>

                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Civil Status</label>
            <select class="select" name="q2_5" id="q2_5" data-placeholder="Choose an option...">
                @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    <option value="{{$assessment->householdProfile->q2_5}}" selected>{{$assessment->householdProfile->q2_5}}</option>
                @endif
                <option></option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widow">Widow</option>
            </select>

        </div>
        <div class="form-group">
            <label>Place of origin:</label>
            <input type="text" name="q2_6" placeholder="Place of origin:" class="form-control" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                value="{{$assessment->householdProfile->q2_6}}"@endif>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label class="control-label">Date of arrival</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        <input type="text" class="form-control pickadate" placeholder="Date of arriva" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                        value="{{$assessment->householdProfile->q2_7}}"@endif name="q2_7" id="q2_7">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Present address: </label>
                    <input type="text" name="q2_8" placeholder="Present address: " class="form-control" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    value="{{$assessment->householdProfile->q2_8}}"@endif>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>IDP Registered:</label>
                    <select name="q2_9" data-placeholder="Choose a option..." class="select">
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            <option value="{{$assessment->householdProfile->q2_9}}" selected>{{$assessment->householdProfile->q2_9}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        <option value="In process">In process</option>
                        <option value="Not applicable">Not applicable</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name of the head of household (if different): </label>
                    <input type="text" name="q2_10" placeholder="Name of the head of household (if different)" class="form-control"@if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    value="{{$assessment->householdProfile->q2_10}}"@endif>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> Age of head of household: </label>
                    <input type="text" name="q2_11" placeholder="Age of head of household" class="form-control" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    value="{{$assessment->householdProfile->q2_11}}"@endif>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>No. of children in the HH < 5Y</label>
                    <input type="text" name="q2_12" placeholder="No. of children in the HH < 5Y" class="form-control"@if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    value="{{$assessment->householdProfile->q2_12}}"@endif>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>No. of children between 6 and 18Y:</label>
                    <input type="text" name="q2_13" placeholder="No. of children between 6 and 18Y:" class="form-control" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    value="{{$assessment->householdProfile->q2_13}}"@endif>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Number of women:</label>
                    <input type="text" name="q2_14" placeholder="Number of women: _ _" class="form-control" @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                    value="{{$assessment->householdProfile->q2_14}}"@endif>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset class="step" id="ajax-step3">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">3</span>
            Economic situation
            <small class="display-block">Economic situation</small>
        </h6>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Past activity (before displacement):</label>
                    <select name="q3_1" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            <option value="{{$assessment->economicSituation->q3_1}}" selected>{{$assessment->economicSituation->q3_1}}</option>
                        @endif
                        <option></option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Carpenter">Carpenter</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Mines">Mines</option>
                        <option value="Public employee">Public employee</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Shop keeper">Shop keeper</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Midwife">Midwife</option>
                        <option value="Social Worker">Social Worker</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Present activity:</label>
                    <select name="q3_2" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            <option value="{{$assessment->economicSituation->q3_2}}" selected>{{$assessment->economicSituation->q3_2}}</option>
                        @endif
                        <option></option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Carpenter">Carpenter</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Mines">Mines</option>
                        <option value="Public employee">Public employee</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Shop keeper">Shop keeper</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Midwife">Midwife</option>
                        <option value="Social Worker">Social Worker</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Household's source of income at the present moment:</label>
            <input type="text" name="q3_3" placeholder="Household's source of income at the present moment" class="form-control"  @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                value="{{$assessment->economicSituation->q3_2}}"@endif>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Do you receive any assistance:</label>
                    <select name="q3_4" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            <option value="{{$assessment->economicSituation->q3_4}}" selected>{{$assessment->economicSituation->q3_4}}</option>
                        @endif
                        <option></option>
                        <option value="No">No</option>
                        <option value="Food">Food</option>
                        <option value="NFIs">NFIs</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>How many family members live with you:</label>
                    <input type="text" name="q3_5" placeholder="How many family members live with you: _ _" class="form-control" @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                       value="{{$assessment->economicSituation->q3_5}}"
                    @endif>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Do you share expenses with them</label>
                    <select name="q3_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            <option value="{{$assessment->economicSituation->q3_6}}" selected>{{$assessment->economicSituation->q3_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>How much do you spend per week: </label>
                    <input type="text" name="q3_7" placeholder="How much do you spend per week: " class="form-control"@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                       value="{{$assessment->economicSituation->q3_7}}"
                    @endif>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>How often do you buy food?</label>
                    <select name="q3_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            <option value="{{$assessment->economicSituation->q3_8}}" selected>{{$assessment->economicSituation->q3_8}}</option>
                        @endif
                        <option></option>
                        <option value="Once a week">Once a week</option>
                        <option value="Twice a week">Twice a week</option>
                        <option value="Depends">Depends</option>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="step" id="ajax-step4">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">4</span>
            Type of vulnerability (fast screening)
            <small class="display-block">Type of vulnerability</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Older people with impairment</label>
                    <select name="q4_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            <option value="{{$assessment->vulnerabilityType->q4_1}}" selected>{{$assessment->vulnerabilityType->q4_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Older people with temporary impairment</label>
                    <select name="q4_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            <option value="{{$assessment->vulnerabilityType->q4_2}}" selected>{{$assessment->vulnerabilityType->q4_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Older people with chronic conditions</label>
                    <select name="q4_3" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            <option value="{{$assessment->vulnerabilityType->q4_3}}" selected>{{$assessment->vulnerabilityType->q4_3}}</option>
                        @endif
                        <option></option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Hypertension">Hypertension</option>
                        <option value="Asthma">Asthma</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dependency:</label>
                    <select name="q4_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            <option value="{{$assessment->vulnerabilityType->q4_4}}" selected>{{$assessment->vulnerabilityType->q4_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Older people head of household</label>
                    <select name="q4_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            <option value="{{$assessment->vulnerabilityType->q4_5}}" selected>{{$assessment->vulnerabilityType->q4_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Household without any male presence</label>
                    <select name="q4_6" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            <option value="{{$assessment->vulnerabilityType->q4_6}}" selected>{{$assessment->vulnerabilityType->q4_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Separation from family members</label>
            <select name="q4_7" data-placeholder="Choose an option..." class="select">
                @if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                    <option value="{{$assessment->vulnerabilityType->q4_7}}" selected>{{$assessment->vulnerabilityType->q4_7}}</option>
                @endif
                <option></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

    </fieldset>
    <fieldset class="step" id="ajax-step5">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">5</span>
            Type of impairment
            <small class="display-block">Type of impairment</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Physical impairment</label>
                    <select name="q5_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_1}}" selected>{{$assessment->impairmentType->q5_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Hearing impairment</label>
                    <select name="q5_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_2}}" selected>{{$assessment->impairmentType->q5_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Speech impairment</label>
                    <select name="q5_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_3}}" selected>{{$assessment->impairmentType->q5_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Visual impairment:</label>
                    <select name="q5_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_4}}" selected>{{$assessment->impairmentType->q5_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mental Illness</label>
                    <select name="q5_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_5}}" selected>{{$assessment->impairmentType->q5_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Need of long term medical treatment</label>
                    <select name="q5_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_6}}" selected>{{$assessment->impairmentType->q5_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>What condition</label>
                    <select name="q5_7" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_7}}" selected>{{$assessment->impairmentType->q5_7}}</option>
                        @endif
                        <option></option>
                        <option value="Osteoarthritis">Osteoarthritis</option>
                        <option value="Respiratory condition">Respiratory condition</option>
                        <option value="Blood pressure">Blood pressure</option>
                        <option value="Gastric condition">Gastric condition</option>
                        <option value="Rheumatoid Arthritis">Rheumatoid Arthritis</option>
                        <option value="Heart condition">Heart condition</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Neurological disorder">Neurological disorder</option>
                        <option value="Multiple Sclerosis">Multiple Sclerosis</option>
                        <option value="Depression">Depression</option>
                        <option value="HIV/AIDS">HIV/AIDS</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Are drugs available</label>
                    <select name="q5_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            <option value="{{$assessment->impairmentType->q5_8}}" selected>{{$assessment->impairmentType->q5_8}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>What kind of medication</label>
                    <input type="text" name="q5_9" placeholder="What kind of medication" class="form-control"@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                        value="{{$assessment->impairmentType->q5_9}}"
                    @endif>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>For how long can you continue your treatment? </label>
                    <input type="text" name="q5_10" placeholder="For how long can you continue your treatment? " class="form-control"@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                       value="{{$assessment->impairmentType->q5_10}}"
                    @endif>
                </div>
            </div>
        </div>


    </fieldset>
    <fieldset class="step" id="ajax-step6">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">6</span>
            Nutrition
            <small class="display-block">Nutrition</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Screening:</label>
                    <select name="q6_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->nutrition) && $assessment->nutrition != null)
                            <option value="{{$assessment->nutrition->q6_1}}" selected>{{$assessment->nutrition->q6_1}}</option>
                        @endif
                        <option></option>
                        <option value="MUAC ≥210mm">MUAC ≥210mm</option>
                        <option value="MUAC <210mm">MUAC <210mm</option>
                        <option value="MUAC <185mm">MUAC <185mm</option>
                        <option value="Oedema">Oedema</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>How many meals per day</label>
                    <select name="q6_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->nutrition) && $assessment->nutrition != null)
                            <option value="{{$assessment->nutrition->q6_2}}" selected>{{$assessment->nutrition->q6_2}}</option>
                        @endif
                        <option></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="More than 3">More than 3</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label>Source of meal</label>
            <select name="q6_3" data-placeholder="Choose an option..." class="select withOthers">
                @if(is_object($assessment->nutrition) && $assessment->nutrition != null)
                    <option value="{{$assessment->nutrition->q6_3}}" selected>{{$assessment->nutrition->q6_3}}</option>
                @endif
                <option></option>
                <option value="Market">Market</option>
                <option value="Relief">Relief</option>
                <option value="Own production ">Own production </option>
                <option value="Relatives">Relatives</option>
                <option value="Other">Other</option>
            </select>
        </div>

    </fieldset>
    <fieldset class="step" id="ajax-step7">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">7</span>
            Independence and participation
            <small class="display-block">Independence and participation</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Are you independent in your daily activities</label>
                    <select name="q7_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_1}}" selected>{{$assessment->independenceParticipation->q7_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Bathing</label>
                    <select name="q7_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_2}}" selected>{{$assessment->independenceParticipation->q7_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Using toilets</label>
                    <select name="q7_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_3}}" selected>{{$assessment->independenceParticipation->q7_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dressing:</label>
                    <select name="q7_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_4}}" selected>{{$assessment->independenceParticipation->q7_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Eating:</label>
                    <select name="q7_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_5}}" selected>{{$assessment->independenceParticipation->q7_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cooking</label>
                    <select name="q7_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_6}}" selected>{{$assessment->independenceParticipation->q7_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cleaning:</label>
                    <select name="q7_7" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_7}}" selected>{{$assessment->independenceParticipation->q7_7}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Community activities</label>
                    <select name="q7_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            <option value="{{$assessment->independenceParticipation->q7_8}}" selected>{{$assessment->independenceParticipation->q7_8}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="step" id="ajax-step8">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">8</span>
            Psychosocial
            <small class="display-block">Psychosocial</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Changes in sleep pattern</label>
                    <select name="q8_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_1}}" selected>{{$assessment->psychosocial->q8_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Images about what happened</label>
                    <select name="q8_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_2}}" selected>{{$assessment->psychosocial->q8_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Feeling of being isolated</label>
                    <select name="q8_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_3}}" selected>{{$assessment->psychosocial->q8_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Changes in the appetite:</label>
                    <select name="q8_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_4}}" selected>{{$assessment->psychosocial->q8_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Changes in behaviour</label>
                    <select name="q8_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_5}}" selected>{{$assessment->psychosocial->q8_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Crying spells</label>
                    <select name="q8_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_6}}" selected>{{$assessment->psychosocial->q8_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Scared/fear</label>
                    <select name="q8_7" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_7}}" selected>{{$assessment->psychosocial->q8_7}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>How would you describe your relationship</label>
                    <select name="q8_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            <option value="{{$assessment->psychosocial->q8_8}}" selected>{{$assessment->psychosocial->q8_8}}</option>
                        @endif
                        <option></option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
            </div>
        </div>



    </fieldset>
    <fieldset class="step" id="ajax-step9">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">9</span>
            Protection
            <small class="display-block">Protection</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Isolation and dependency</label>
                    <select name="q9_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_1}}" selected>{{$assessment->protection->q9_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Family separation</label>
                    <select name="q9_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_2}}" selected>{{$assessment->protection->q9_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Neglect and deprivation</label>
                    <select name="q9_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_3}}" selected>{{$assessment->protection->q9_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Loss/no documentation:</label>
                    <select name="q9_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_4}}" selected>{{$assessment->protection->q9_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Discrimination</label>
                    <select name="q9_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_5}}" selected>{{$assessment->protection->q9_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Violence</label>
                    <select name="q9_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_6}}" selected>{{$assessment->protection->q9_6}}</option>
                        @endif
                        <option></option>
                        <option value="Physical violence">Physical violence</option>
                        <option value="Sexual Violence">Sexual Violence</option>
                        <option value="GBV">GBV</option>
                        <option value="Emotional Violence">Emotional Violence</option>
                        <option value="Psychological Violence">Psychological Violence</option>
                        <option value="Spiritual Violence">Spiritual Violence</option>
                        <option value="Verbal Abuse">Verbal Abuse</option>
                        <option value="Financial Abuse">Financial Abuse</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Threats and harassment</label>
                    <select name="q9_7" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_7}}" selected>{{$assessment->protection->q9_7}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Unsafe living condition</label>
                    <select name="q9_8" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->protection) && $assessment->protection != null)
                            <option value="{{$assessment->protection->q9_8}}" selected>{{$assessment->protection->q9_8}}</option>
                        @endif
                        <option></option>
                        <option value="Roof/Foundation or structural issues">Roof/Foundation or structural issues</option>
                        <option value="Lack of lockable door">Lack of lockable door</option>
                        <option value="Absence of heating system">Absence of heating system</option>
                        <option value="Evidence of rodents or animal damage">Evidence of rodents or animal damage</option>
                        <option value="Poor toilets conditions">Poor toilets conditions</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>

    </fieldset>
    <fieldset class="step" id="ajax-step10">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">10</span>
            NEEDS/ACTION
            <small class="display-block">Needs of items</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Assisting devices</label>
                    <select name="q10_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_1}}" selected>{{$assessment->itemsNeeds->q10_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Crutches:</label>
                    <select name="q10_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_2}}" selected>{{$assessment->itemsNeeds->q10_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Toilet chair</label>
                    <select name="q10_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_2}}" selected>{{$assessment->itemsNeeds->q10_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Urine flaks:</label>
                    <select name="q10_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_4}}" selected>{{$assessment->itemsNeeds->q10_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>White cane</label>
                    <select name="q10_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_5}}" selected>{{$assessment->itemsNeeds->q10_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Walking aids</label>
                    <select name="q10_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_6}}" selected>{{$assessment->itemsNeeds->q10_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Wheel chairs</label>
                    <select name="q10_7" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_7}}" selected>{{$assessment->itemsNeeds->q10_7}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Incontinent kit</label>
                    <select name="q10_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_8}}" selected>{{$assessment->itemsNeeds->q10_8}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Bedpan:</label>
                    <select name="q10_9" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_9}}" selected>{{$assessment->itemsNeeds->q10_9}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Needs for specific Items</label>
                    <select name="q10_10" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_10}}" selected>{{$assessment->itemsNeeds->q10_10}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mattresses:</label>
                    <select name="q10_11" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_11}}" selected>{{$assessment->itemsNeeds->q10_11}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Blanket:</label>
                    <select name="q10_12" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_12}}" selected>{{$assessment->itemsNeeds->q10_12}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stove:</label>
                    <select name="q10_13" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_13}}" selected>{{$assessment->itemsNeeds->q10_13}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Toileteries:</label>
                    <select name="q10_14" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_14}}" selected>{{$assessment->itemsNeeds->q10_14}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Diapers:</label>
                    <select name="q10_15" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_15}}" selected>{{$assessment->itemsNeeds->q10_15}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jarrican:</label>
                    <select name="q10_16" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_16}}" selected>{{$assessment->itemsNeeds->q10_16}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Clothing:</label>
                    <select name="q10_17" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_17}}" selected>{{$assessment->itemsNeeds->q10_17}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dignity kit men:</label>
                    <select name="q10_18" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_18}}" selected>{{$assessment->itemsNeeds->q10_18}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dignity kit women:</label>
                    <select name="q10_19" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_19}}" selected>{{$assessment->itemsNeeds->q10_19}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Underwear:</label>
                    <select name="q10_20" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_20}}" selected>{{$assessment->itemsNeeds->q10_20}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Needs for protection items:</label>
                    <select name="q10_21" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_21}}" selected>{{$assessment->itemsNeeds->q10_21}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Flashlight:</label>
                    <select name="q10_22" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_22}}" selected>{{$assessment->itemsNeeds->q10_22}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Whistle:</label>
                    <select name="q10_23" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_23}}" selected>{{$assessment->itemsNeeds->q10_23}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Radio:</label>
                    <select name="q10_24" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            <option value="{{$assessment->itemsNeeds->q10_24}}" selected>{{$assessment->itemsNeeds->q10_24}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>


    </fieldset>
    <fieldset class="step" id="ajax-step11">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">11</span>
            Referral
            <small class="display-block">Referral</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Needs for referral</label>
                    <select name="q11_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->referral) && $assessment->referral != null)
                            <option value="{{$assessment->referral->q11_1}}" selected>{{$assessment->referral->q11_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Health</label>
                    <select name="q11_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->referral) && $assessment->referral != null)
                            <option value="{{$assessment->referral->q11_2}}" selected>{{$assessment->referral->q11_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Psychosocial:</label>
                    <select name="q11_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->referral) && $assessment->referral != null)
                            <option value="{{$assessment->referral->q11_3}}" selected>{{$assessment->referral->q11_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Child protection:</label>
                    <select name="q11_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->referral) && $assessment->referral != null)
                            <option value="{{$assessment->referral->q11_4}}" selected>{{$assessment->referral->q11_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Shelter:</label>
                    <select name="q11_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->referral) && $assessment->referral != null)
                            <option value="{{$assessment->referral->q11_5}}" selected>{{$assessment->referral->q11_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>NFIs</label>
                    <select name="q11_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->referral) && $assessment->referral != null)
                            <option value="{{$assessment->referral->q11_6}}" selected>{{$assessment->referral->q11_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>

    </fieldset>
    <fieldset class="step" id="ajax-step12">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">12</span>
            Personal observation of vulnerability focal point/volunteer. Comments
            <small class="display-block">Personal observation of vulnerability focal point/volunteer. Comments</small>
        </h6>
        <div class="form-group">
            <label>Comments</label>
            <textarea class="form-control" rows="10" name="comments">{{$assessment->comments}}</textarea>
        </div>



    </fieldset>

    <div class="form-wizard-actions">

        <button class="btn btn-default" id="ajax-back" type="reset">Back</button>
        <button class="btn btn-info" id="ajax-next" type="submit">Next</button>
    </div>
    {!! Form::close() !!}

    <div id="ajax-data">

    </div>
</div>
<div class="row">
    <div class="col-md-4 btn-block col-sm-4 pull-right text-right">
        <button type="button" class="btn btn-danger "  data-dismiss="modal">Close</button>
    </div>

</div>
<script>
    $(function() {
        // AJAX form submit
        $(".form-ajax").formwizard({
            disableUIStyles: true,
            formPluginEnabled: true,
            disableInputFields: false,
            inDuration: 150,
            outDuration: 150,
            formOptions :{
                success: function(data){
                    swal({title: "Form Submitted successful!", text: "Vulnerability form is now saved! ", type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                    setTimeout(function() {
                        location.replace("{{url('assessments/vulnerability')}}");
                        $("#output").html("");
                    }, 2000);
                },
                dataType: 'json',
                resetForm: true
            }
        });
    });
</script>
<!-- /submit form with AJAX -->