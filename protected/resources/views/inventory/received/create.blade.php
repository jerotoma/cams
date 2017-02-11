
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
        {!! Form::open(array('url'=>'inventory-received','role'=>'form','id'=>'formItemsReceived','files'=>true)) !!}
        <div class="form-body">
            <fieldset class="scheduler-border">
                <legend class="text-bold">GOODS RECEIVED NOTE</legend>
                <div class="form-group ">
                    <label class="control-label"> Reference No: </label>
                    <input type="text" class="form-control"  name="reference_number" id="reference_number" value="{{old('reference_number')}}">
                    @if($errors->first('reference_number') !="")
                        <label id="address-error" class="validation-error-label" for="reference_number">{{ $errors->first('reference_number') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Date Received:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" class="form-control pickadate"  value="{{old('date_received')}}" name="date_received" id="date_received">
                            </div>
                            @if($errors->first('date_arrival') !="")
                                <label id="address-error" class="validation-error-label" for="nationality">{{ $errors->first('date_arrival') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Donor Ref</label>
                            <input type="text" class="form-control" name="donor_ref"  id="donor_ref" value="" >
                            @if($errors->first('donor_ref') !="")
                                <label id="address-error" class="validation-error-label" for="donor_ref">{{ $errors->first('donor_ref') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Project:</label>
                            <input type="text" class="form-control" name="project"  id="project" value="" >
                            @if($errors->first('project') !="")
                                <label id="address-error" class="validation-error-label" for="project">{{ $errors->first('project') }}</label>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Received From/Supplier: </label>
                            <input type="text" class="form-control" name="received_from" id="received_from" value="{{old('received_from')}}">
                            @if($errors->first('received_from') !="")
                                <label id="address-error" class="validation-error-label" for="received_from">{{ $errors->first('received_from') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> HAI Receiving Officer: </label>
                            <input type="text" class="form-control"  name="receiving_officer" id="receiving_officer" value="{{old('receiving_officer')}}">
                            @if($errors->first('receiving_officer') !="")
                                <label id="address-error" class="validation-error-label" for="receiving_officer">{{ $errors->first('receiving_officer') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Onward Delivery to: </label>
                            <input type="text" class="form-control"  name="onward_delivery" id="onward_delivery" value="{{old('onward_delivery')}}">
                            @if($errors->first('onward_delivery') !="")
                                <label id="address-error" class="validation-error-label" for="onward_delivery">{{ $errors->first('onward_delivery') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="scheduler-border">
                <legend class="text-bold">ITEMS</legend>
                <div class="form-group">
                    <label>Use this template for importing Items <a href={{asset("assets/templates/item_import_template.xls")}}>Download template here</a> </label>
                    <input type="file" class="form-control" name="items_file" id="items_file">
                </div>
            </fieldset>
                <div class="form-group ">
                    <label class="control-label"> Comments: </label>
                    <textarea class="form-control"  name="comments" id="comments">{{old('comments')}}</textarea>
                    @if($errors->first('comments') !="")
                        <label id="address-error" class="validation-error-label" for="comments">{{ $errors->first('comments') }}</label>
                    @endif
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
            items_file: "Please Upload file is required"
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