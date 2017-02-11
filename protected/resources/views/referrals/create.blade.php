<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/tinymce/js/tinymce/tinymce.min.js")}}"></script>
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
    $(function() {


        // Table setup
        // ------------------------------

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: '100px',
                targets: [ 5 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });


        // Single row selection
        var singleSelect = $('.datatable-selection-single').DataTable();
        $('.datatable-selection-single tbody').on('click', 'tr', function() {
            if ($(this).hasClass('success')) {
                $(this).removeClass('success');
            }
            else {
                singleSelect.$('tr.success').removeClass('success');
                $(this).addClass('success');
            }
        });


        // Multiple rows selection
        $('.datatable-selection-multiple').DataTable();
        $('.datatable-selection-multiple tbody').on('click', 'tr', function() {
            $(this).toggleClass('success');
        });


        // Individual column searching with text inputs
        $('.datatable-column-search-inputs tfoot td').not(':last-child').each(function () {
            var title = $('.datatable-column-search-inputs thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
        });

        var table = $('.datatable-column-search-inputs').DataTable({
            "scrollX": false,
            ajax: '{{url('getwaclientsjson')}}', //this url load JSON Client details to reduce loading time
            "fnDrawCallback": function (oSettings) {
            }
        });
        table.columns().every( function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                that.search(this.value).draw();
            });
        });


        // External table additions
        // ------------------------------

        // Add placeholder to the datatable filter option
        $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


        // Enable Select2 select for the length option
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });


        // Enable Select2 select for individual column searching
        $('.filter-select').select2();

    });

</script>
<script>
    $('.pickadate').pickadate();
    tinymce.init({ selector:'textarea' });
</script>

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::open(array('url'=>'referrals','role'=>'form','id'=>'formClients')) !!}
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold"><h3 class="text-center text-bold">Select client requesting referral</h3></legend>
                    <div class="form-group">
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <table class="table datatable-column-search-inputs table-bordered table-hover" id="tab_logic">
                                    <thead>
                                    <tr >
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            Client Number
                                        </th>
                                        <th class="text-center">
                                            Full Name
                                        </th>
                                        <th class="text-center">
                                            Gender
                                        </th>
                                        <th class="text-center">
                                            Nationality
                                        </th>
                                        <th class="text-center">
                                            Date of Arrival
                                        </th>
                                        <th class="text-center">
                                            Check client
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr >
                                        <td class="text-center">

                                        </td>
                                        <td class="text-center">
                                            Client Number
                                        </td>
                                        <td class="text-center">
                                            Full Name
                                        </td>
                                        <td class="text-center">
                                            Gender
                                        </td>
                                        <td class="text-center">
                                            Nationality
                                        </td>
                                        <td class="text-center">
                                            Date of Arrival
                                        </td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold"><h3 class="text-center text-bold">Referral Details</h3></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Progress Number</label>
                                <input type="text" class="form-control" placeholder="Progress Number" name="progress_number" id="progress_number"
                                       value="{{old('progress_number')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Case name</label>
                                <input type="text" class="form-control" placeholder="(Use a unique code for case name. Example LASTNAME Initials+date of birth e.g. LA08291976>)" id="case_name" name="case_name" value="{{old('case_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date" value="{{old('referral_date')}}" name="referral_date" id="referral_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Completed by</label>
                                <input type="text" class="form-control" name="completed_by" id="completed_by" placeholder="Completed by" value="{{old('completed_by')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Name of Client Concerned</label>
                        <input type="text" class="form-control"  placeholder="Name of Client Concerned" value="" >
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Location the referral originated</label>
                        <input type="text" class="form-control"  placeholder="Location the referral originated" value="" name="location" id="location">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Age (At the time of incident)</label>
                                <input type="number" class="form-control" placeholder="Age" name="age" id="age" value="{{old('age')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Birth date (At the time of incident)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date" value="{{old('birth_date')}}" name="birth_date" id="birth_date">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group ">
                        <label class="control-label">Disabilities</label>
                        <input type="text" class="form-control" placeholder="Disabilities" name="disabilities" id="disabilities" value="{{old('disabilities')}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Ethnic Background</label>
                        <input type="text" class="form-control" placeholder="Ethnic Background" name="ethnic_background" id="ethnic_background" value="{{old('ethnic_background')}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Contact</label>
                                <input type="text" class="form-control" placeholder="Contact" name="contact" id="contact" value="{{old('contact')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Telephone number</label>
                                <input type="text" class="form-control" placeholder="Telephone number" name="phone" id="phone" value="{{old('phone')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Name of Person Who Originated concern and contact details</label>
                                <input type="text" class="form-control" placeholder="Leave this empty if same as above" name="person_name_contact" id="person_name_contact" value="{{old('person_name_contact')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Relationship to client</label>
                                <input type="text" class="form-control" placeholder="" name="relationship" id="relationship" value="{{old('relationship')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Approached for assistance with plot/address</label>
                                <input type="text" class="form-control" placeholder="(Ex. F11/A01/001)" name="person_name_address" id="person_name_address" value="{{old('person_name_address')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Consent Obtained to Share Information</label>
                                <select name="consent" data-placeholder="Choose an option..." class="select withOthers">
                                    <option></option>
                                    <option value="Verbal">Verbal</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Parental Consent provided (if Client is Under 18 years of Age)</label>
                                <select name="parental_consent" data-placeholder="Choose an option..." class="select">
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Any Attachment included</label>
                                <select name="attachment" data-placeholder="Choose an option..." class="select">
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Initial Action Recommended or Taken</label>
                        <textarea  class="form-control" name="initial_action" id="initial_action"></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Timeframes agreed/proposed</label>
                        <input type="text"  class="form-control" name="time_frames" id="time_frames">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Additional Comments Regarding Concern [any information volunteered by client</label>
                        <textarea  class="form-control" name="additional_comments" id="additional_comments"></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Primary Concern</label>
                        <select name="primary_concern" data-placeholder="Choose an option..." class="select withOthers">
                            <option></option>
                            <option value="Health">Health</option>
                            <option value="Nutrition">Nutrition</option>
                            <option value="Psychosocial">Psychosocial</option>
                            <option value="Neglect">Neglect</option>
                            <option value="Physical Violence">Physical Violence</option>
                            <option value="SGBV">SGBV</option>
                            <option value="Basic Needs">Basic Needs</option>
                            <option value="Education">Education</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Referred details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Referred to</label>
                                <input type="text"  class="form-control" name="referred_to" id="referred_to" placeholder="(Complete name)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Position</label>
                                <input type="text"  class="form-control" name="referred_to_position" id="referred_to_position">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Organization/ Institution</label>
                        <input type="text"  class="form-control" name="organization" id="organization">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Telephone number</label>
                                <input type="text"  class="form-control" name="org_phone" id="org_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Email address</label>
                                <input type="text"  class="form-control" name="org_email" id="org_email">
                            </div>
                        </div>
                    </div>

                </fieldset>
                <div class="row">
                    <div class="col-md-8 col-sm-8 pull-left" id="output">

                    </div>
                    <div class="col-md-4 col-sm-4 pull-right text-right">
                        <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/validation/validate.min.js")}}"></script>
<script>
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
            organization: "required",
            progress_number: "required",
            referral_date: "required",
            completed_by: "required",
            age: {
                number: true
            },
            case_name: "required",
            referred_to: "required",
            referred_to_position: "required",
            org_phone: "required",
            org_email:{
                email:true,
            },
            location: "required",
            primary_concern: "required",
        },
        messages: {
            organization: "Please this field is required",
            progress_number: "Please this field is required",
            referral_date: "Please field is required",
            completed_by: "Please this field is required",
            age:{
                number:"Please enter valid age",
            } ,
            case_name: "Please this field is required",
            referred_to: "Please this field is required",
            referred_to_position: "Please this field is required",
            primary_concern: "Please this field is required",
            org_phone: "Please this field is required",
            org_email:{
                email:"Please enter valid data",
            },
            location: "Please this field is required"
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
                            location.replace("{{url('referrals')}}");
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
    $("#civil_status").change(function () {
        var id1 = this.value;
        if(id1 != "Married")
        {
            $("#spouse_name").removeAttr('value');
            $("#spouse_name").attr('value','');
            $("#spouse_name").attr('readonly','readonly');

        }else{$("#spouse_name").removeAttr('readonly');}
    });

    $("#region_id").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('fetch/districts') ?>/"+id1,function(data){
                $("#district_id").html(data);
            });
        }else{$("#district_id").html("<option value=''>----</option>");}
    });
</script>