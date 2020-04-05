
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
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>

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
        {!! Form::model($client,array('route'=>array('clients.update',$client->id),'method'=>'PUT','role'=>'form','id'=>'formClients'))!!}
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
                                    <input type="text" class="form-control pickadate" placeholder="Date of Arrival" value="{{$client->date_arrival}}" name="date_arrival" id="date_arrival" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Camp</label>
                                <select class="select" name="camp_id" id="camp_id" data-placeholder="Choose an option...">
                                    @if($client->camp_id !="")
                                        <?php $camp=\App\Camp::find($client->camp_id);?>
                                        <option value="{{$client->camp_id}}">{{$camp->camp_name}}</option>
                                    @endif
                                    <option ></option>
                                    @foreach(\App\Camp::all() as $item)
                                        <option value="{{$item->id}}">{{$item->camp_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->first('camp_id') !="")
                                    <label id="address-error" class="validation-error-label" for="nationality">{{ $errors->first('camp_id') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Origin</label>
                                <select class="select" name="origin" id="origin" data-placeholder="Choose an option...">
                                    @if(is_object($client->fromOrigin) && $client->fromOrigin)
                                        <option value="{{$client->fromOrigin->id}}">{{$client->fromOrigin->origin_name}}</option>
                                    @endif
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
                                <input type="text" class="form-control" placeholder="Individual ID" name="client_number" id="client_number"
                                       value="{{$client->client_number}}">
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Unique ID</label>
                                <input type="text" class="form-control" placeholder="Unique ID" name="client_number" id="client_number"
                                       value="{{$client->client_number}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label"> Ration Card Number </label>
                                <input type="text" class="form-control" placeholder="Ration Card Number " name="ration_card_number" id="ration_card_number" value="{{$client->ration_card_number}}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="{{$client->full_name}}">
                                @if($errors->first('full_name') !="")
                                    <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('full_name') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Sex</label>
                                <select class="select" name="sex" id="sex" data-placeholder="Choose an option...">
                                    @if($client->sex!= "")
                                        <option value="{{$client->sex}}" selected>{{$client->sex}}</option>
                                    @endif
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
                                <input type="number" class="form-control" name="age" id="age" placeholder="Age" value="{{$client->age}}">
                                @if($errors->first('age') !="")
                                    <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('age') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label"> Present address (Zone, Cluster, Neibourhood etc)</label>
                                <input type="text" class="form-control" placeholder="Present address " name="present_address" id="present_address" value="{{$client->present_address}}">
                                @if($errors->first('address') !="")
                                    <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('address') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Marital Status</label>
                                <select class="select" name="marital_status" id="marital_status" data-placeholder="Choose an option...">
                                    @if($client->marital_status)
                                        <option value="{{$client->marital_status}}" selected>{{$client->marital_status}}</option>
                                    @endif
                                    <option></option>
                                    <option value="Child">Child</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widow">Widow</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Name of Spouse</label>
                                <input type="text" class="form-control" placeholder="Name of Spouse" name="spouse_name" id="spouse_name" readonly value="{{$client->spouse_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Care Giver (if is child)</label>
                        <input type="text" class="form-control" placeholder="Care Giver" name="care_giver" id="care_giver" value="{{$client->care_giver}}">

                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold" >Household Details </legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label"> Household Number</label>
                                <input type="text" class="form-control" placeholder="Household Number" name="household_number" id="household_number" value="{{$client->household_number}}">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Relation to the head of household</label>
                                <select class="select" name="hh_relation" id="hh_relation" data-placeholder="Choose an option...">
                                    @if($client->hh_relation != "")
                                        <option value="{{$client->hh_relation}}" selected>{{$client->hh_relation}}</option>
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

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Number of Males</label>
                                <input type="number" class="form-control" name="males_total" id="males_total" placeholder="Number of Males" value="{{$client->males_total}}">
                                @if($errors->first('males_total') !="")
                                    <label id="address-error" class="validation-error-label" for="address">{{ $errors->first('males_total') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Number of Females</label>
                                <input type="number" class="form-control" name="females_total" id="females_total" placeholder="Number of Females" value="{{$client->females_total}}">
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
                                @if(count(\App\ClientVulnerabilityCode::where('code_id','=',$item->id)->where('client_id','=',$client->id)->get())>0)
                                    <option value="{{$item->id}}" selected>{{$item->code}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->code}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                    @if($errors->first('vulnerability_code') !="")
                        <label id="address-error" class="validation-error-label" for="vulnerability_code">{{ $errors->first('vulnerability_code') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Assistance Received to date </label>
                            <input type="text" class="form-control" name="assistance_received" id="assistance_received" placeholder="Assistance Received to date (mention)..." value="{{$client->assistance_received}}">
                            @if($errors->first('assistance_received') !="")
                                <label id="address-error" class="validation-error-label" for="assistance_received">{{ $errors->first('assistance_received') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Problem Specification </label>
                            <input type="text" class="form-control" placeholder="Problem Specification" name="problem_specification" id="problem_specification" value="{{$client->problem_specification}}">
                            @if($errors->first('problem_specification') !="")
                                <label id="address-error" class="validation-error-label" for="problem_specification">{{ $errors->first('problem_specification') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Can we share your information with other partners? </label>
                            <select class="select" name="share_info" id="share_info" data-placeholder="Choose an option...">
                                @if($client->share_info != "")
                                    <option value="{{$client->share_info}}" selected>{{$client->share_info}}</option>
                                @endif
                                <option></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>


                            </select>


                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label">Client Status</label>
                    <select class="select" name="status" id="status" data-placeholder="Choose an option...">
                        @if($client->status)
                            <option value="{{$client->status}}" selected>{{$client->status}}</option>
                        @endif
                        <option></option>
                        <option value="Active">Active</option>
                        <option value="In Active">In Active</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger btn-block"  data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>
