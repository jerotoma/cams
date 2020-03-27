

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
    $('.pickadate').pickadate();
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::model($code,array('route' => array('psncodes.update', $code->id), 'method' => 'PUT','role'=>'form','id'=>'formClients')) !!}
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">PSN Code Details</h5>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label>PSN Code:</label>
                    <input type="text" class="form-control" placeholder="PSN Code" name="code" id="code"
                           @if(old('code'))value="{{old('code')}}"@else value="{{$code->code}}" @endif>
                    @if($errors->first('code') !="")
                        <label id="code-error" class="validation-error-label" for="code">{{ $errors->first('code') }}</label>
                    @endif
                    @if(Session::has('code_error'))
                        <label id="code_error-error" class="validation-error-label" for="code_error">{{ Session::get('code_error') }}</label>
                    @endif
                </div>
                <div class="form-group ">
                    <label class="control-label">Category</label>
                    <select class="select withOthers" name="category_id" id="category_id" data-placeholder="Choose an option...">
                        @if(is_object(\App\PSNCodeCategory::find($code->category_id) ))
                            <option value="{{\App\PSNCodeCategory::find($code->category_id)->id}}" selected>{{\App\PSNCodeCategory::find($code->category_id)->code}}</option>
                            @endif
                        <option ></option>
                        @foreach(\App\PSNCodeCategory::all() as $item)
                            <option value="{{$item->id}}">{{$item->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="Descriptions" name="description" id="description" @if(old('description'))value="{{old('description')}}" @else value="{{$code->description}}"@endif>
                    @if($errors->first('description') !="")
                        <label id="description-error" class="validation-error-label" for="description">{{ $errors->first('description') }}</label>
                    @endif

                </div>
                <div class="form-group">
                    <label>Definition</label>
                    <textarea class="form-control" rows="5" placeholder="definition" name="definition" id="definition">@if(old('definition')){{old('definition')}}@else{{$code->definition}}@endif</textarea>
                    @if($errors->first('description') !="")
                        <label id="definition-error" class="validation-error-label" for="definition">{{ $errors->first('definition') }}</label>
                    @endif

                </div>
                <div class="form-group">
                    <label>Used in reporting</label>
                    <select class="select" name="for_reporting" id="for_reporting">
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
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

            code: "required",
            description: "required",
            definition: "required"
        },
        messages: {
            code: "Please category_name is required",
            description: "Please description is required",
            definition: "Please full name is required",

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
                            location.replace("{{url('psncodes')}}");
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
@section('contents')
    <!-- Vertical form options -->
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            <a  href="{{url('psncodes/create')}}" class="btn btn-info "><i class="fa fa-file-o"></i> <span>Add New</span></a>
            <a  href="{{url('psncodes')}}" class="btn btn-info "><i class="fa fa-list"></i> <span>List All</span></a>
            <a  href="{{url('psncodes')}}" class="btn btn-info "><i class="fa fa-search"></i> <span>Search</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- Basic layout-->

        <!-- /basic layout -->

        </div>


    </div>
    <!-- /vertical form options -->
@stop