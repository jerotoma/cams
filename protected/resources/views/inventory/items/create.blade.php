<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/wizards/form_wizard/form.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/core/libraries/jasny_bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>

<script type="text/javascript" src="{{asset("assets/js/pages/wizard_form.js")}}"></script>

<script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
<script>
    $('.pickadate').pickadate();
</script>
<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::open(array('url'=>'inventory','role'=>'form','id'=>'formItems')) !!}
        <div class="form-body">
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" class="form-control" name="item_name" id="item_name">
            </div>
            <div class="form-group">
                <label> Description</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
               <select name="category_id" class="select withOthers" id="category_id" data-placeholder="Choose an option..." >
                   <option></option>
                   @foreach(\App\ItemsCategories::all() as $cat)
                       <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                       @endforeach
                   <option value="newCat">New Category</option>
               </select>
            </div>
           <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <div class="form-group">
                        <label>Unit</label>
                            <input type="text" class="form-control" name="unit" id="unit" placeholder="Item Unit e.g PIC, BOX">
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="select" id="status" data-placeholder="Choose an option...">
                            <option></option>
                            <option value="Available">Available</option>
                            <option value="Available">Not available</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="remarks" id="remarks">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add new Item </button>
                </div>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script>
    $(".withOthers").change(function () {
        var id1 =  $(this[this.selectedIndex]).val();
        var txt = $(this[this.selectedIndex]).text();
        var slt= $(this);
        if(id1 == "newCat")
        {
            bootbox.dialog({
                    title: "Add New category.",
                    message: "<div class='portlet light bordered'>"+
                    "<div class='portlet-body form'>"+
                    " <form method='POST' action='onflycategory' id='formInventoryCategories'>"+
                    "<div class='form-body'><input name='_token' type='hidden' value='{{csrf_token()}}'>"+
                    "<div class='form-group'>"+
                    "<label>Category Name</label>"+
                    "<input type='text' class='form-control' name='category_name' id='category_name'>"+
                    "</div>"+
                    "<div class='form-group'>"+
                    "<label> Description</label>"+
                    "<textarea class='form-control' name='description' id='description'></textarea>"+
                    "</div>"+
                    "<div class='form-group'>"+
                    "<label>Status</label>"+
                    "<select name='status' class='form-control' id='status'>"+
                    "<option value=''></option>"+
                    "<option value='Available'>Available</option>"+
                    " <option value='Available'>Not available</option>"+
                    " </select>"+
                    "</div>"+
                    "</div>"+
                    "</form>"+
                    "</div>"+
                    "</div>",
                    buttons: {
                        success: {
                            label: "Save",
                            className: "btn-success",
                            callback: function () {
                                var postData = $('#formInventoryCategories').serializeArray();
                                var formURL = $('#formInventoryCategories').attr("action");
                                $.ajax(
                                    {
                                        url : formURL,
                                        type: "POST",
                                        data : postData,
                                        dataType: 'json',
                                        success:function(data)
                                        {
                                            slt.append('<option value="'+ data.id +'" selected>'+ data.category_name +'</option>');
                                        },
                                        error: function(jqXhr,status, response) {

                                        }
                                    });
                            }
                        }
                    }
                }
            );

        }
    });

    $("#formItems").validate({
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
            item_name: "required",
            status: "required",
            unit: "required",
            quantity: "required"
        },
        messages: {
            item_name: "Please enter item name",
            unit: "Please enter item unit",
            status: "Please select status",
            quantity: "Please enter quantity"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#formItems').serializeArray();
            var formURL = $('#formItems').attr("action");
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
                                location.replace('{{url('inventory')}}');
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