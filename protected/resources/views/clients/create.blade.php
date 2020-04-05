
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
{!! Form::open(array('url'=>'clients','role'=>'form','id'=>'formClients')) !!}
<div class="panel panel-flat">


    <div class="panel-body">
        <fieldset class="scheduler-border">
            <legend class="text-bold">Personal Details</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Date of Arrival</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" class="form-control pickadate" placeholder="Date of Arrival" value="{{old('date_arrival')}}" name="date_arrival" id="date_arrival">
                        </div>
                        @if($errors->first('date_arrival') !="")
                            <label id="date_arrival-error" class="validation-error-label" for="nationality">{{ $errors->first('date_arrival') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Camp</label>
                        <select class="select" name="camp_id" id="camp_id" data-placeholder="Choose an option...">
                            <option ></option>
                            @foreach(\App\Camp::all() as $item)
                                <option value="{{$item->id}}">{{$item->camp_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('camp_id') !="")
                            <label id="camp_id-error" class="validation-error-label" for="nationality">{{ $errors->first('camp_id') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Origin</label>
                        <select class="select" name="origin" id="origin" data-placeholder="Choose an option...">
                            <option></option>
                            @foreach(\App\Origin::all() as $item)
                                <option value="{{$item->id}}">{{$item->origin_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
	<div class="row">
                   <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Individual ID</label>
                        <input type="text" class="form-control"  name="individual_id" id="individual_id"
                               value="{{old('individual_id')}}">
                    </div>
                </div>
	</div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Unique ID</label>
                        <input type="text" class="form-control"  name="client_number" id="client_number"
                               value="{{old('client_number')}}">
                    </div>
                </div>
                <div class="col-md-4">
                <div class="form-group ">
                    <label class="control-label"> Ration Card Number </label>
                    <input type="text" class="form-control" placeholder="Ration Card Number " name="ration_card_number" id="ration_card_number" value="{{old('ration_card_number')}}">
                    @if($errors->first('ration_card_number') !="")
                        <label id="ration_card_number-error" class="validation-error-label" for="ration_card_number">{{ $errors->first('ration_card_number') }}</label>
                    @endif
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="{{old('full_name')}}">
                        @if($errors->first('full_name') !="")
                            <label id="full_name-error" class="validation-error-label" for="address">{{ $errors->first('full_name') }}</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Sex</label>
                        <select class="select" name="sex" id="sex" data-placeholder="Choose an option...">
                            <option></option>
                            <option value="">Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="control-label">Age</label>
                        <input type="number" class="form-control" name="age" id="age" placeholder="Age" value="{{old('age')}}">
                        @if($errors->first('age') !="")
                            <label id="age-error" class="validation-error-label" for="age">{{ $errors->first('age') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                <div class="form-group ">
                    <label class="control-label" for="present_address"> Present address (Zone, Cluster, Neibourhood etc)</label>
                    <input type="text" class="form-control" placeholder="Present address " name="present_address" id="present_address" value="{{old('address')}}">
                    @if($errors->first('address') !="")
                        <label id="address-error" class="validation-error-label" for="present_address">{{ $errors->first('address') }}</label>
                    @endif
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label" for="marital_status" >Marital Status</label>
                        <select class="select" name="marital_status" id="marital_status" data-placeholder="Choose an option...">
                            <option></option>
                            <option value="Child">Child</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widow">Widow</option>
                        </select>
                        @if($errors->first('civil_status') !="")
                            <label id="civil_status-error" class="validation-error-label" for="marital_status">{{ $errors->first('civil_status') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label" for="spouse_name">Name of Spouse</label>
                        <input type="text" class="form-control" placeholder="Name of Spouse" name="spouse_name" id="spouse_name" readonly value="{{old('spouse_name')}}">
                        @if($errors->first('spouse_name') !="")
                            <label id="spouse_name-error" class="validation-error-label" for="spouse_name">{{ $errors->first('spouse_name') }}</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label">Care Giver</label>
                <input type="text" class="form-control" placeholder="Care Giver" name="care_giver" id="care_giver" value="{{old('care_giver')}}">
                @if($errors->first('care_giver') !="")
                    <label id="care_giver" class="validation-error-label" for="care_giver">{{ $errors->first('care_giver') }}</label>
                @endif
            </div>
        </fieldset>
        <fieldset class="scheduler-border">
            <legend class="text-bold" >Household Details </legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label" for="household_number"> Household Number</label>
                        <input type="text" class="form-control" placeholder="Household Number" name="household_number" id="household_number" value="{{old('household_number')}}">
                        @if($errors->first('household_number') !="")
                            <label id="household_number-error" class="validation-error-label" for="household_number">{{ $errors->first('household_number') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label">Relation to the head of household</label>
                        <select class="select" name="hh_relation" id="hh_relation" data-placeholder="Choose an option...">
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

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label">Number of Males</label>
                        <input type="number" class="form-control" name="males_total" id="males_total" placeholder="Number of Males" value="{{old('males_total')}}">
                        @if($errors->first('males_total') !="")
                            <label id="males_total-error" class="validation-error-label" for="address">{{ $errors->first('males_total') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label">Number of Females</label>
                        <input type="number" class="form-control" name="females_total" id="females_total" placeholder="Number of Females" value="{{old('females_total')}}">
                        @if($errors->first('females_total') !="")
                            <label id="address-error" class="validation-error-label" for="females_total">{{ $errors->first('females_total') }}</label>
                        @endif
                    </div>
                </div>



            </div>
        </fieldset>

        <div class="form-group ">
            <label>Vulnerability Code</label>
            <select multiple="multiple" class="bootstrap-select" data-live-search="true" data-width="100%" name="vulnerability_code[]" id="vulnerability_code">
                <optgroup label="Vulnerability Code">
                    @foreach(\App\PSNCode::all() as $item)
                        <option value="{{$item->id}}">{{$item->code}}</option>
                    @endforeach
                </optgroup>
            </select>
            @if($errors->first('vulnerability_code') !="")
                <label id="vulnerability_code-error" class="validation-error-label" for="vulnerability_code">{{ $errors->first('vulnerability_code') }}</label>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label class="control-label"> Assistance Received to date </label>
                    <input type="text" class="form-control" name="assistance_received" id="assistance_received" placeholder="Assistance Received to date (mention)..." value="{{old('assistance_received')}}">
                    @if($errors->first('assistance_received') !="")
                        <label id="assistance_received-error" class="validation-error-label" for="assistance_received">{{ $errors->first('assistance_received') }}</label>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label class="control-label"> Problem Specification </label>
                    <input type="text" class="form-control" placeholder="Problem Specification" name="problem_specification" id="problem_specification" value="{{old('problem_specification')}}">
                    @if($errors->first('problem_specification') !="")
                        <label id="problem_specification-error" class="validation-error-label" for="problem_specification">{{ $errors->first('problem_specification') }}</label>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label"> Can we share your informations with other partners? </label>
                <select class="select" name="share_info" id="share_info" data-placeholder="Choose an option...">
                    <option></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>


                </select>


            </div>
        </div>
        </div>

        <div class="row">
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
            marital_status: "required",
            share_info: "required",
            hh_relation: "required",
            full_name: "required",
            sex: "required",
            age: {
                required: true,
                number: true
            },
            females_total:{
                number: true
            },
            males_total:{
                number: true
            },
            civil_status: "required",
            origin: "required",
            date_arrival: "required",
            ration_card_number: "required",
            vulnerability_code:"required",
            camp_id:"required"
        },
        messages: {
            marital_status: "Please this field is required",
            share_info: "Please this field is required",
            hh_relation: "Please Relation to the head of household is required",
            full_name: "Please full name is required",
            sex: "Please sex is required",
            age:{
                required:"Please age is required",
                number:"Please enter valid age",
            } ,
            females_total:{
                number:"Please enter valid age",
            } ,
            males_total:{
                number:"Please enter valid age",
            } ,
            civil_status: "Please civil status is required",
            origin: "Please origin is required",
            date_arrival: "Please arrival date is required",
            ration_card_number: "Please ration card number is required",
            vulnerability_code: "Please  vulnerability code is required",
            camp_id: "Please  Camp name is required"
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
                            location.replace("{{url('clients')}}");
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
    $("#marital_status").change(function () {
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
