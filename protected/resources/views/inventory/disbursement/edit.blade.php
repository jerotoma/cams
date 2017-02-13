<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
<script>
    // Basic options
    $('.pickadate').pickadate();
</script>
<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::model($item, array('route' => array('inventory-received.update', $item->id), 'method' => 'PUT','role'=>'form','id'=>'formItemsReceived','files'=>true)) !!}
        <div class="form-body">
            <fieldset class="scheduler-border">
                <legend class="text-bold">GOODS RECEIVED NOTE</legend>
                <div class="form-group ">
                    <label class="control-label"> Reference No: </label>
                    <input type="text" class="form-control"  name="reference_number" id="reference_number" value="{{$item->reference_number}}" >
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Date Received:</label>

                            <input type="text" class="form-control"  value="{{$item->date_received}}" name="date_received" id="date_received" >

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Donor Ref</label>
                            <input type="text" class="form-control" name="donor_ref"  id="donor_ref" value="{{$item->donor_ref}}"  >

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Project:</label>
                            <input type="text" class="form-control" name="project"  id="project" value="{{$item->project}}" >

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Received From/Supplier: </label>
                            <input type="text" class="form-control" name="received_from" id="received_from" value="{{$item->received_from}}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> HAI Receiving Officer: </label>
                            <input type="text" class="form-control"  name="receiving_officer" id="receiving_officer" value="{{$item->receiving_officer}}" >

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Onward Delivery to: </label>
                            <input type="text" class="form-control"  name="onward_delivery" id="onward_delivery" value="{{$item->onward_delivery}}" >
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="scheduler-border">
                <legend class="text-bold">ITEMS</legend>
                <div class="form-group">
                    <label>Use this template for importing Items <a href={{asset("assets/templates/received_items_templates.xls")}}>Download template here</a> </label>
                    <input TYPE="file" class="form-control" name="items_file" id="items_file">
                </div>
            </fieldset>
            <div class="form-group ">
                <label class="control-label"> Comments: </label>
                <textarea class="form-control"  name="comments" id="comments" >{{$item->comments}}</textarea>
            </div>
            </fieldset>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                </div>

            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script>

    $("#formItemsReceived").validate({
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
            reference_number: "required",
            date_received: "required",
            received_from: "required",
            donor_ref: "required",
            receiving_officer: "required",
            project: "required",
            items_file:"required"
        },
        messages: {
            reference_number: "Please field is required",
            date_received: "Please field is required",
            received_from: "Please field is required",
            donor_ref: "Please field is required",
            receiving_officer: "Please field is required",
            project: "Please field is required",
            items_file: "Please field is required"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var formURL = $('#formItemsReceived').attr("action");
            var formData = new FormData(form);
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success:function(data)
                    {
                        $("#output").html(data.message);
                        setTimeout(function() {
                            location.replace('{{url('inventory-received')}}');
                            $("#output").html("");
                        }, 2000);

                    },
                    error: function(jqXhr,status, response) {
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
                            $('#output').html("");
                        }

                    }
                });
        }
    });
</script>