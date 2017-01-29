
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

<script type="text/javascript" src="{{asset("assets/js/pages/form_floating_labels.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
<script>
    $('.pickadate').pickadate();
</script>
<div class="portlet light bordered">
    <div class="portlet-body form">
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Personal Details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Client Number</label>
                                <input type="text" class="form-control" placeholder="Client Number" name="client_number" id="client_number"
                                       value="{{$client->client_number}}" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="{{$client->full_name}}" readonly>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Sex</label>
                                <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="{{$client->sex}}" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Age</label>
                                <input type="number" class="form-control" name="age" id="age" placeholder="Age" value="{{$client->age}}" readonly>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Civil Status</label>
                                <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="{{$client->civil_status}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Name of Spouse</label>
                                <input type="text" class="form-control" placeholder="Name of Spouse" name="spouse_name" id="spouse_name" readonly value="{{$client->spouse_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-material">
                        <label class="control-label">Care Giver</label>
                        <input type="text" class="form-control" placeholder="Care Giver" name="care_giver" id="care_giver" value="{{$client->care_giver}}" readonly>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold" >Household Size </legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Number of Males</label>
                                <input type="number" class="form-control" name="males_total" id="males_total" placeholder="Number of Males" value="{{$client->males_total}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-material">
                                <label class="control-label">Number of Females</label>
                                <input type="number" class="form-control" name="females_total" id="females_total" placeholder="Number of Females" value="{{$client->females_total}}" readonly>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-group-material">
                            <label class="control-label">Date of Arrival</label>
                            <div class="input-group">
                                <input type="text" class="form-control pickadate" placeholder="Date of Arrival" value="{{$client->date_arrival}}" name="date_arrival" id="date_arrival" readonly>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-material">
                            <label class="control-label">Camp</label>

                                @if($client->camp_id !="")
                                    <?php $camp=\App\Camp::find($client->camp_id);?>
                              <input type="text" class="form-control pickadate" placeholder="Camp" value="{{$camp->camp_name}}" name="date_arrival" id="date_arrival" readonly>
                            @else
                                <input type="text" class="form-control pickadate" placeholder="Camp" value="" name="date_arrival" id="date_arrival" readonly>
                            @endif


                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-material">
                            <label class="control-label">Origin</label>

                            @if(is_object($client->nationality) && $client->nationality)

                                <input type="text" class="form-control pickadate" placeholder="Origin" value="{{$client->nationality->country_name}}" name="date_arrival" id="date_arrival" readonly>
                            @else
                                <input type="text" class="form-control pickadate" placeholder="Origin" value="" name="date_arrival" id="date_arrival" readonly>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="form-group form-group-material">
                    <label class="control-label"> Present address (Zone, Cluster, Neibourhood etc)</label>
                    <input type="text" class="form-control" placeholder="Present address (Zone, Cluster, Neibourhood etc)" name="address" id="address" readonly value="{{$client->address}}">

                </div>
                <div class="form-group form-group-material">
                    <label class="control-label"> Household Number</label>
                    <input type="text" class="form-control" placeholder="Household Number" name="household_number" id="household_number" value="{{$client->household_number}}" readonly>
                </div>
                <div class="form-group form-group-material">
                    <label class="control-label"> Ration Card Number </label>
                    <input type="text" class="form-control" placeholder="Ration Card Number " name="ration_card_number" id="ration_card_number" value="{{$client->ration_card_number}}" readonly>
                </div>
                <div class="form-group form-group-material">
                    <label>Vulnerability Code</label>
                    @if(count(\App\ClientVulnerabilityCode::where('client_id','=',$client->id)->get())>0)
                        <?php
                        $code="";
                        foreach (\App\ClientVulnerabilityCode::where('client_id','=',$client->id)->get() as $codes)
                            {
                                $code .=$codes->code->code.",";
                            }
                        $code=substr($code,0,strlen($code)-1);
                        ?>

                        <input type="text" class="form-control pickadate" placeholder="Vulnerability Code" value="{{$code}}" name="date_arrival" id="date_arrival" readonly>
                    @else
                        <input type="text" class="form-control pickadate" placeholder="Vulnerability Code" value="" name="date_arrival" id="date_arrival" readonly>
                    @endif
                </div>
                <div class="form-group form-group-material">
                    <label class="control-label"> Assistance Received to date </label>
                    <input type="text" class="form-control" name="assistance_received" id="assistance_received" placeholder="Assistance Received to date (mention)..." value="{{$client->assistance_received}}" readonly>

                </div>
                <div class="form-group form-group-material">
                    <label class="control-label"> Problem Specification </label>
                    <input type="text" class="form-control" placeholder="Problem Specification" name="problem_specification" id="assistance_received" value="{{$client->problem_specification}}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger btn-block"  data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>