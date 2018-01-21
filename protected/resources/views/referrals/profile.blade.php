<fieldset class="scheduler-border">
    <legend class="text-bold">Client Information</legend>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label">Name: </label>
                <input type="text" class="form-control" placeholder="Name: " name="cl_name" id="cl_name"
                       value="{{$client->full_name}}" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label">Address: </label>
                <input type="text" class="form-control" placeholder="Address" id="cl_address" name="cl_address" value="{{$client->present_address}}" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label">Phone</label>
                <input type="text" class="form-control" placeholder="Phone" id="cl_phone" name="cl_phone" value="">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label">Age: </label>
                <input type="text" class="form-control" placeholder="Age " name="cl_age" id="cl_age"
                       value="{{$client->age}}" readonly >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label">Sex: </label>
                <input type="text" class="form-control" placeholder="Sex" id="cl_sex" name="cl_sex" value="{{$client->sex}}" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                <label class="control-label">Nationality: </label>
                <input type="text" class="form-control" placeholder="Nationality" id="cl_nationality" name="cl_nationality" value="">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group ">
                <label class="control-label">Language: </label>
                <input type="text" class="form-control" placeholder="Language " name="cl_language" id="cl_language"
                       value="{{old('cl_language')}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                <label class="control-label">ID Numbers: </label>
                <input type="text" class="form-control" placeholder="ID Numbers:" id="cl_id_number" name="cl_id_number" value="{{old('cl_id_number')}}">
            </div>
        </div>
    </div>

</fieldset>