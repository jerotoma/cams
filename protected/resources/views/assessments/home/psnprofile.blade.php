<fieldset class="scheduler-border">
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
                <input type="text" class="form-control" placeholder="" name="ration_card_number" id="ration_card_number"
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