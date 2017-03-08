<div class="row" style="margin-top: 20px">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                {!! Form::open(array('url'=>'advanced/search/clients','role'=>'form','id'=>'formAdvancedClientsSearch')) !!}
                <div class="panel panel-flat">


                    <div class="panel-body">
                        <fieldset class="scheduler-border">
                            <legend class="text-bold">Client Advance Search</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Arrival: Start Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control pickadate"  value="{{old('start_date')}}" name="start_date" id="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Arrival: End Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control pickadate" value="{{old('end_date')}}" name="end_date" id="end_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">HAI Reg No</label>
                                        <input type="text" class="form-control" name="hai_reg_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">Unique ID</label>
                                        <input type="text" class="form-control" name="unique_id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">Full Name</label>
                                        <input type="text" class="form-control" name="full_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Sex</label>
                                        <select  class="select" data-live-search="true" data-width="100%" name="sex" id="sex">
                                            <optgroup label="Sex">
                                                <option value="All">All</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Camp</label>
                                        <select  class="select" data-live-search="true" data-width="100%" name="camp_id" id="camp_id">
                                            <optgroup label="Camp Name">
                                                <option value="All">All</option>
                                                @foreach(\App\Camp::all() as $item)
                                                    <option value="{{$item->id}}">{{$item->camp_name}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Specific Needs?</label>
                                        <select  class="select" data-live-search="true" data-width="100%" name="specific_needs" id="specific_needs" data-placeholder="Choose an option...">
                                            <optgroup label="Specific Needs">
                                                <option value="All">All</option>
                                                @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
                                                    <option value="{{$code->id}}">{{$code->description}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label"> Ration Card Number </label>
                                        <input type="text" class="form-control" placeholder="Ration Card Number " name="ration_card_number" id="ration_card_number" value="{{old('ration_card_number')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Age Group</label>
                                        <select  class="select" data-live-search="true" data-width="100%" name="age_score" id="age_score">
                                            <optgroup label="Group">
                                                <option></option>
                                                <option value="A">0 - 17</option>
                                                <option value="B">17 - 50</option>
                                                <option value="C">50 - 60</option>
                                                <option value="D">60 ></option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label"> Present address (Zone, Cluster, Neibourhood etc)</label>
                                        <input type="text" class="form-control" placeholder="Present address " name="present_address" id="present_address" value="{{old('address')}}">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i> Search Client </button>
                            </div>
                            <div class="col-md-2 col-sm-2 ">
                                <button type="reset" class="btn btn-block btn-default"><i class="fa fa-refresh"></i> Reset </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8" id="output_advanced_search">

                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <script>
                    $("#formAdvancedClientsSearch").validate({
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
                            start_dategg: "required",
                            end_dategg:"required"
                        },
                        messages: {
                            start_dategg: "Please this field is required",
                            end_dategg: "Please  Camp name is required"
                        },
                        submitHandler: function(form) {
                            $("#output_advanced_search").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Processing please wait...</span><h3>");
                            var postData = $('#formAdvancedClientsSearch').serializeArray();
                            var formURL = $('#formAdvancedClientsSearch').attr("action");
                            $.ajax(
                                {
                                    url : formURL,
                                    type: "POST",
                                    dataType: 'json',
                                    data : postData,
                                    success: function(data){
                                        loadDataTable(data);
                                        $('#output_advanced_search').html("");
                                    },
                                    error: function(jqXhr,status, response) {

                                        if( jqXhr.status === 401 ) {
                                            location.replace('{{url('login')}}');
                                        }
                                        if( jqXhr.status === 400 ) {
                                            if(jqXhr.responseJSON.errors ==1){
                                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p>';
                                                errorsHtml +='<p> '+ jqXhr.responseJSON.message +'</p></div>';
                                                $('#output_advanced_search').html(errorsHtml);
                                            }
                                            else {
                                                var errors = jqXhr.responseJSON.errors;
                                                errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                                                $.each(errors, function (key, value) {
                                                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                                });
                                                errorsHtml += '</ul></di>';
                                                $('#output_advanced_search').html(errorsHtml);
                                            }
                                        }
                                        else
                                        {
                                            $('#output_advanced_search').html(jqXhr.message);
                                        }

                                    }
                                });
                        }
                    });
                    function loadDataTable(dataset){
                        $(document).ready(function() {
                            $('.datatable-column-search-inputs-select-client').dataTable().fnDestroy();
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
                            $('.datatable-column-search-inputs-select-client tfoot td').not(':last-child').each(function () {
                                var title = $('.datatable-column-search-inputs-select-client thead th').eq($(this).index()).text();
                                $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
                            });
                             // Javascript sourced data
                            var table = $('.datatable-column-search-inputs-select-client').DataTable({
                                "scrollX": false,
                                data: dataset,
                                columnDefs: []
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

                        } );
                    }
                </script>
            </div>
        </div>
    </div>


</div>
