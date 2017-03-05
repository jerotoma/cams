
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
    $('.pickadate').pickadate({

        // Escape any “rule” characters with an exclamation mark (!).
        format: 'yyyy-mm-dd',
    });
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::open(array('url'=>'cash/monitoring/provision','role'=>'form','id'=>'formCashProvision')) !!}
        <div class="panel panel-flat">
            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold"> Cash Distribution Details</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Provision Date:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate"  value="{{old('provision_date')}}" name="provision_date" id="provision_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">PSN HAI Registration Number</label>
                                <input type="text" class="form-control" name="hai_reg_number"  id="hai_reg_number" value="" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Cash Provided By</label>
                                <input type="text" class="form-control" name="provided_by"  id="provided_by" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Camp</label>
                        <select class="select" name="camp_id" id="camp_id" data-placeholder="Choose an option...">
                            <option ></option>
                            @foreach(\App\Camp::all() as $item)
                                <option value="{{$item->id}}">{{$item->camp_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Donor/Activity Details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Activity</label>
                                <select class="select" name="activity_id" id="activity_id" data-placeholder="Choose an option..." data-live-search="true" data-width="100%">
                                    <option ></option>
                                    @foreach(\App\BudgetActivity::all() as $activity)
                                                <option  value="{{$activity->id}}"> {{$activity->activity_name}} @if($activity->donor != "") - ({{$activity->donor}})@endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Amount</label>
                                <input type="text" class="form-control" name="amount"  id="amount" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label"> Comments: </label>
                        <textarea class="form-control"  name="comments" id="comments">{{old('comments')}}</textarea>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit Form </button>
                </div>

            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script>
    $("#formCashProvision").validate({
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
            provision_date: "required",
            provided_by: "required",
            amount: {
                required: true,
                number: true
            },
            camp_id:"required",
            hai_reg_number:"required",
            activity_id:"required",
        },
        messages: {
            provision_date: "Please field is required",
            provided_by: "Please field is required",
            hai_reg_number: "Please enter Registration",
            amount:{
                required:"Please amount is required",
                number:"Please enter valid amount",
            } ,
            camp_id:"Please please select camp",
            activity_id:"Please Please select Items",
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#formCashProvision').serializeArray();
            var formURL = $('#formCashProvision').attr("action");
            $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    dataType: 'json',
                    success:function(data)
                    {
                        $("#output").html(data.message);
                        setTimeout(function() {
                            location.replace('{{url('cash/monitoring/provision')}}');
                            $("#output").html("");
                        }, 2000);

                    },
                    error: function(jqXhr,status, response) {
                        if( jqXhr.status === 401 ) {
                            location.replace('{{url('login')}}');
                        }
                        if( jqXhr.status === 400 ) {
                            if(jqXhr.responseJSON.errors ==1){
                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p>';
                                errorsHtml +='<p>'+ jqXhr.responseJSON.message +'</p></div>';

                                $('#output').html(errorsHtml);
                            }
                            else {
                                var errors = jqXhr.responseJSON.errors;
                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                                $.each(errors, function (key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                });
                                errorsHtml += '</ul></di>';
                                $('#output').html(errorsHtml);
                            }
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