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
        {!! Form::open(array('url'=>'assessments/home','role'=>'form','id'=>'formClients')) !!}
        <div class="panel panel-flat">


            <div class="panel-body">
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Select client to assess</legend>
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
                    <legend class="text-bold">PSN Needs/Home assessment Details</legend>
                    <div class="form-group ">
                        <label class="control-label">PSN Case code</label>
                        <input type="text" class="form-control" placeholder="" name="case_code" id="case_code"
                               value="">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Date of assessment</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate" placeholder="Date of assessment" value="" name="assessment_date" id="assessment_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Ration card number (if any)</label>
                                <input type="text" class="form-control" placeholder="" name="case_code" id="case_code"
                                       value="" readonly>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Profile Information of PSN: ( to add contact details of the PSN or caretaker)</legend>
                        <div class="form-group ">
                            <label class="control-label">Name of PSN</label>
                            <input type="text" class="form-control" placeholder="Name of PSN" name="psn_name" id="psn_name"
                                   value="" readonly>
                        </div>
                     <div class="form-group ">
                        <label class="control-label">Nationality</label>
                        <select class="select" name="nationality" id="nationality" data-placeholder="Choose an option..." readonly="">
                            <option></option>
                            @foreach(\App\Country::all() as $item)
                                <option value="{{$item->id}}">{{$item->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Name of caregiver/Parent/household head(if different):</label>
                                <input type="text" class="form-control" placeholder="" name="care_giver" id="care_giver"
                                       value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Address</label>
                                <input type="text" class="form-control" placeholder="" name="address" id="address"
                                       value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Camp Name</label>
                                <select class="select" name="camp_id" id="camp_id" data-placeholder="Choose an option..." readonly="">

                                    <option ></option>
                                    @foreach(\App\Camp::all() as $item)
                                        <option value="{{$item->id}}">{{$item->camp_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">District</label>
                                <input type="text" class="form-control" placeholder="" name="district" id="district"
                                       value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Family size</label>
                        <input type="text" class="form-control" placeholder="" name="family_size" id="family_size"
                               value="{{old('family_size')}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Any other PSN in the family</label>
                        <input type="text" class="form-control" placeholder="" name="family_psn" id="family_psn"
                               value="{{old('family_psn')}}">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Link case code</label>
                        <input type="text" class="form-control" placeholder="" name="linked_case_code" id="linked_case_code"
                               value="{{old('linked_case_code')}}">
                    </div>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Description of the individual special needs and the family situation</legend>
                    <div class="form-group ">
                     <textarea class="form-control" name="needs_description" id="needs_description"></textarea>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Case workers Findings</legend>
                    <div class="form-group ">
                        <label class="control-label">Findings</label>
                        <textarea class="form-control" name="findings" id="findings"></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Diagnosis</label>
                        <textarea class="form-control" name="diagnosis" id="diagnosis"></textarea>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Case worker’s recommendations and comments</legend>
                    <div class="form-group ">
                        <textarea class="form-control" name="recommendations" id="recommendations"></textarea>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="text-bold">Final decision</legend>
                    <div class="form-group ">
                        <textarea class="form-control" name="final_decision" id="final_decision"></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Name of Case Worker</label>
                        <input type="text" class="form-control" placeholder="" name="case_worker_name" id="case_worker_name"
                               value="">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Name of Project Coordinator</label>
                        <input type="text" class="form-control" placeholder="" name="project_coordinator" id="project_coordinator"
                               value="">
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Organization </label>
                        <input type="text" class="form-control" placeholder="" name="organization" id="organization"
                               value="">
                    </div>
                </fieldset>

                <div class="row" style="margin-top: 10px">
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
        errorElement:'div',
        rules: {
            case_code: "required",
            case_worker_name: "required",
            project_coordinator: "required",
            organization: "required",
            assessment_date: {
                required:true,
                date:true
            }
        },
        messages: {
            case_code: "Please this field is required",
            case_worker_name: "Please this field is required",
            project_coordinator: "Please this field is required",
            organization: "Please this field is required",
            assessment_date: {
                required:"Please this field is required",
                date:"Please enter valid date"
            }
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
                    success:function(data)
                    {
                        console.log(data);
                        //data: return data from server
                        $("#output").html(data);
                        setTimeout(function() {
                            location.replace('{{url('assessments/home')}}');
                            $("#output").html("");
                        }, 2000);
                    },
                    error: function(data)
                    {
                        console.log(data.responseJSON);
                        //in the responseJSON you get the form validation back.
                        $("#output").html("<h3><span class='text-danger'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

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