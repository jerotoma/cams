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
                    <legend class="text-bold"><h3 class="text-left text-bold">Referring agency </h3></legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Agency / Org: </label>
                                <input type="text" class="form-control" placeholder="Agency / Org: " name="ref_org" id="ref_org"
                                       value="{{old('ref_org')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Contact (if known): </label>
                                <input type="text" class="form-control" placeholder="contact" id="ref_contact" name="ref_contact" value="{{old('ref_contact')}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" id="ref_phone" name="ref_phone" value="{{old('ref_phone')}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Email: </label>
                                <input type="text" class="form-control" placeholder="Email " name="ref_email" id="ref_email"
                                       value="{{old('ref_email')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Location: </label>
                                <input type="text" class="form-control" placeholder="Location" id="ref_location" name="ref_location" value="{{old('ref_location')}}">
                            </div>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="text-bold"><h3 class="text-left text-bold">Receiving Agency </h3></legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Agency / Org: </label>
                                    <input type="text" class="form-control" placeholder="Agency / Org: " name="rec_org" id="rec_org"
                                           value="{{old('rec_org')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Contact (if known): </label>
                                    <input type="text" class="form-control" placeholder="contact" id="rec_contact" name="rec_contact" value="{{old('rec_contact')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone" id="rec_phone" name="rec_phone" value="{{old('rec_phone')}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Email: </label>
                                    <input type="text" class="form-control" placeholder="Email " name="rec_email" id="rec_email"
                                           value="{{old('rec_email')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Location: </label>
                                    <input type="text" class="form-control" placeholder="Location" id="rec_location" name="rec_location" value="{{old('rec_location')}}">
                                </div>
                            </div>

                        </div>

                    </fieldset>

             <fieldset class="scheduler-border">
                        <legend class="text-bold"><h3 class="text-left text-bold">Client Information </h3></legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Name: </label>
                                    <input type="text" class="form-control" placeholder="Name: " name="client_name" id="client_name"
                                           value="{{old('client_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Address: </label>
                                    <input type="text" class="form-control" placeholder="Address" id="client_address" name="client_address" value="{{old('client_address')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone" id="client_phone" name="client_phone" value="{{old('client_phone')}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Age: </label>
                                    <input type="text" class="form-control" placeholder="Age " name="" id="client_age"
                                           value="{{old('client_age')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Sex: </label>
                                    <input type="text" class="form-control" placeholder="Sex" id="client_sex" name="client_sex" value="{{old('client_sex')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Nationality: </label>
                                    <input type="text" class="form-control" placeholder="Nationality" id="client_nationality" name="client_nationality" value="{{old('client_nationality')}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Language: </label>
                                    <input type="text" class="form-control" placeholder="Language " name="client_language" id="client_language"
                                           value="{{old('client_language')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">ID Numbers: </label>
                                    <input type="text" class="form-control" placeholder="ID Numbers:" id="client_number" name="client_number" value="{{old('client_number')}}">
                                </div>
                            </div>
                        </div>

              </fieldset>



               <fieldset class="scheduler-border">
                        <legend class="text-bold"><h3 class="text-left text-bold">If Client Is a Minor (under 18 years) </h3></legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Name of primary caregiver:: </label>
                                    <input type="text" class="form-control" placeholder="Name of primary caregiver:: " name="caregiver_name" id="caregiver_name"
                                           value="{{old('caregiver_name')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Relationship to child: </label>
                                    <input type="text" class="form-control" placeholder="Relationship to child:" id="child_relationship" name="child_relationship" value="{{old('child_relationship')}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Contact information for caregiver:</label>
                                    <input type="text" class="form-control" placeholder="Contact information" id="caregiver_contact" name="caregiver_contact" value="{{old('caregiver_contact')}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Caregiver is informed of referral?: </label>
                                    <select name="inform_caregiver" data-placeholder="Choose an option..." class="select">
                                        <option></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label">Is child separated or unaccompanied? </label>
                                    <select name="child_separated" data-placeholder="Choose an option..." class="select">
                                        <option></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>


                        </div>



               </fieldset>




                    <fieldset class="scheduler-border">
                        <legend class="text-bold"><h3 class="text-left text-bold">Background Information/Reason for Referral:
                                (problem description, duration, frequency, etc.) and Services Already Provided
                            </h3></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Has the client been informed of the referral?   </label>
                                    <textarea  class="form-control" name="clientinfo_referral" id="clientinfo_referral"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Has the client been referred to any other organizations?   </label>
                                    <textarea  class="form-control" name="referal_other_org" id="referal_other_org"></textarea>
                                </div>
                            </div>



                        </div>

                    </fieldset>

                    <fieldset class="scheduler-border">
                        <legend class="text-bold"><h3 class="text-left text-bold">Services Requested   </h3></legend>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">

                                        <option value="mental_services">Mental Health Services </option>

                                    <label class="control-label">Has the client been informed of the referral?   </label>
                                      <textarea  class="form-control" name="clientinfo_referral" id="clientinfo_referral"></textarea>
                                    </div>
                                    <select name="service_request"  multiple="multiple" class="select" >

                                        <option value="protection_services">Protection Support/ Services </option>
                                        <option value="shelter">Shelter</option>
                                        <option value="psychological">Psychological Interventions </option>
                                        <option value="community_centre">Community Centre/ Social Services </option>
                                        <option value="material_assesment">Material Assistance</option>
                                        <option value="physical_health">Physical Health Care </option>
                                        <option value="family_tracing">Family Tracing Services </option>
                                        <option value="nutrition">Nutrition</option>
                                        <option value="physical_rehabilation">Physical Rehabilitation</option>
                                        <option value="legal_assesment">Legal Assistance </option>
                                        <option value="financial_assistance">Financial Assistance   </option>
                                        <option value="education">Education </option>
                                        <option value="psychocial_activities">Psychosocial Activities </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Has the client been referred to any other organizations?   </label>
                                    <textarea  class="form-control" name="referal_other_org" id="referal_other_org"></textarea>
                                </div>
                            </div>



                        </div>






                    </fieldset>






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
            ref_org: "required",
            rec_org: "required",

            client_age: {
                number: true
            },
            client_sex: "required",
            client_language: "required",
            client_number: "required",



        },
        messages: {
            ref_org: "Please this field is required",
            rec_org: "Please this field is required",
            client_language: "Please field is required",

            client_age:{
                number:"Please enter valid age",
            } ,


            },

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