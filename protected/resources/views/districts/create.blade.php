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
            {!! Form::open(array('url'=>'districts','role'=>'form','id'=>'formDistricts')) !!}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">District Details</h5>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label>Region Name:</label>
                            <select class="select" name="region_id" id="region_id">
                                @if(old('region_id') !="")
                                    <?php $region=\App\Region::find(old('region_id'));?>
                                     <option value="{{$region->id}}">{{$region->region_name}}</option>
                                    @else
                                    <option value="">--Select--</option>
                                    @endif
                                @foreach(\App\Region::orderBy('region_name','ASC')->get() as $item)
                                     <option value="{{$item->id}}">{{$item->region_name}}</option>
                                    @endforeach
                            </select>
                            @if($errors->first('region_id') !="")
                                <label id="region_id_name-error" class="validation-error-label" for="region_id">{{ $errors->first('region_id') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>District Name:</label>
                            <input type="text" class="form-control" placeholder="District Name" name="district_name" id="district_name" value="{{old('district_name')}}">
                        </div>

                        <div class="row" style="margin-top: 10px">
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
        $("#formDistricts").validate({
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
                region_id: "required",
                district_name: "required",
            },
            messages: {
                region_id: "Please this field is required",
                district_name: "Please this field is required",
            },
            submitHandler: function(form) {
                $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
                var postData = $('#formDistricts').serializeArray();
                var formURL = $('#formDistricts').attr("action");
                $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success: function(data){
                            swal({title: "Form Submitted successful!", text: data.message, type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                            setTimeout(function() {
                                location.replace("{{url('districts')}}");
                                $("#output").html("");
                            }, 2000);
                        },
                        error: function(jqXhr,status, response) {
                            console.log(jqXhr);
                            if( jqXhr.status === 401 ) {
                                location.replace('{{url('login')}}');
                            }
                            if( jqXhr.status === 400 ) {
                                if(jqXhr.responseJSON.errors ==1)
                                {
                                    errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p>';
                                    errorsHtml += '<h5 class="text-danger">'+jqXhr.responseJSON.message + '</h5>'
                                    $('#output').html(errorsHtml);
                                }else {
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
                                $('#output').html(jqXhr.message);
                            }

                        }
                    });
            }
        });
    </script>