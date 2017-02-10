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
                    <legend class="text-bold"><h3 class="text-center text-bold">Select client to register case</h3></legend>
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
                    <legend class="text-bold"><h3 class="text-center text-bold">Case Details</h3></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Open Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control pickadate"  value="{{old('open_date')}}" name="open_date" id="open_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Case Type</label>
                                <input type="text" class="form-control" name="case_type" id="case_type"  value="{{old('case_type')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Descriptions</label>
                        <textarea  class="form-control" name="descriptions" id="descriptions" ></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Initial Action</label>
                        <textarea  class="form-control" name="initial_action" id="initial_action" ></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Feedback</label>
                        <textarea  class="form-control" name="feedback" id="feedback" ></textarea>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Planning</label>
                        <textarea  class="form-control" name="feedback" id="feedback" ></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Camp</label>
                                <select name="camp_id" id="camp_id" data-placeholder="Choose an option..." class="select withOthers">
                                    <option></option>
                                    @foreach(\App\Camp::all() as $camp)
                                        <option value="{{$camp->id}}">{{$camp->camp_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label">Status</label>
                                <select name="status" id="status" data-placeholder="Choose an option..." class="select withOthers">
                                    <option></option>
                                    <option value="Open Case">Open Case</option>
                                    <option value="Assessment">Assessment</option>
                                    <option value="Case Planning">Case Planning</option>
                                    <option value="Case Followup">Case Followup</option>
                                    <option value="Case Closed">Case Closed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">Case Worker Name</label>
                        <input type="number" class="form-control" placeholder="case_worker_name" name="case_worker_name" id="case_worker_name" value="{{old('case_worker_name')}}">
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
</script>