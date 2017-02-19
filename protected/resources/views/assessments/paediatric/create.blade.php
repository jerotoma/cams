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
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/pages/wizard_form.js")}}"></script>
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
    $('.pickadate').pickadate({

        // Escape any “rule” characters with an exclamation mark (!).
        format: 'yyyy-mm-dd',
    });
    tinymce.init({ selector:"textarea.editable" });
    $(".withOthers").change(function () {
        var id1 =  $(this[this.selectedIndex]).val();
        var txt = $(this[this.selectedIndex]).text();
        var slt= $(this);
        if(id1 == "Sehemu Nyingine")
        {
            bootbox.prompt("Jaza hiyo Sehemu Nyingine", function(result) {
                if (result === null) {
                    bootbox.alert("Hakuna kilichojazwa");
                } else {
                    slt.append('<option value="'+ result +'" selected>'+ result +'</option>');

                }
            });

        }
    });
</script>
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Paediatric Functional Assessment Form</h6>

    </div>
    {!! Form::open(array('url'=>'assessments/paediatric','role'=>'form','class'=>'form-ajax','id'=>'formClients')) !!}
        <fieldset class="step" id="ajax-step1">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">1</span>
                Select client to assess
                <small class="display-block">Select client to assess</small>
            </h6>
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
                                    HAI REG NO
                                </th>
                                <th class="text-center">
                                    Unique ID
                                </th>
                                <th class="text-center">
                                    Full Name
                                </th>
                                <th class="text-center">
                                    Sex
                                </th>
                                <th class="text-center">
                                    Age
                                </th>
                                <th class="text-center">
                                    Ration Card No
                                </th>
                                <th class="text-center">
                                    Camp
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
                                    HAI REG NO
                                </td>
                                <td class="text-center">
                                    Unique ID
                                </td>
                                <td class="text-center">
                                    Full Name
                                </td>
                                <td class="text-center">
                                    Sex
                                </td>
                                <td class="text-center">
                                    Age
                                </td>
                                <td class="text-center">
                                    Ration Card No
                                </td>
                                <td class="text-center">
                                    Camp
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
        <fieldset class="step" id="ajax-step2">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">2</span>
                Person with specific needs
                <small class="display-block">Taarifa za muhitaji</small>
            </h6>
            <div class="form-group">
                <label class="control-label">Jina la mtoto</label>
                <input type="text" class="form-control" placeholder="Jina la mtoto" name="full_name" id="full_name"
                       value="{{old('full_name')}}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Ration no</label>
                        <input type="text" class="form-control"  name="rational_number" id="rational_number"
                               value="{{old('rational_number')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Unique No</label>
                        <input type="text" class="form-control"  name="unique_number" id="unique_number"
                               value="{{old('rational_number')}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Jina la mtoto la nyumbani</label>
                <input type="text" class="form-control"  name="home_name" id="home_name"
                       value="{{old('full_name')}}">
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Sex</label>
                    <select class="select" name="sex" id="sex" data-placeholder="Choose an option...">
                        <option></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="control-label">Tarehe ya kuzaliwa</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" class="form-control pickadate"  value="{{old('birth_date')}}" name="birth_date" id="birth_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Jina la baba</label>
                        <input type="text" class="form-control"  name="father_name" id="father_name"
                               value="{{old('father_name')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Umri</label>
                        <input type="text" class="form-control"  name="father_age" id="father_age"
                               value="{{old('father_age')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Kazi</label>
                        <input type="text" class="form-control"  name="father_job" id="father_job"
                               value="{{old('father_job')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Namba ya simu</label>
                        <input type="text" class="form-control"  name="father_phone" id="father_phone"
                               value="{{old('father_phone')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Jina la Mama</label>
                        <input type="text" class="form-control"  name="mother_name" id="mother_name"
                               value="{{old('mother_name')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Umri</label>
                        <input type="text" class="form-control"  name="mother_age" id="mother_age"
                               value="{{old('mother_age')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Kazi</label>
                        <input type="text" class="form-control"  name="mother_job" id="mother_job"
                               value="{{old('mother_job')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Namba ya simu</label>
                        <input type="text" class="form-control"  name="mother_phone" id="mother_phone"
                               value="{{old('mother_phone')}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Anuani ya kudumu</label>
                <input type="text" class="form-control"  name="permanent_address" id="permanent_address"
                       value="{{old('permanent_address')}}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Mtoto alishawahi kusoma shule?</label>
                        <select class="select" name="school_status" id="school_status" data-placeholder="Choose an option...">
                            <option></option>
                            <option value="Ndio">Ndio</option>
                            <option value="Hapana">Hapana</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Sababu </label>
                        <input type="text" class="form-control"  name="school_reasons" id="school_reasons"
                               value="{{old('school_reasons')}}">
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label">Nationality la mtoto</label>
                <select class="select" name="nationality" id="nationality" data-placeholder="Choose an option...">
                    <option></option>
                    @foreach(\App\Country::all() as $item)
                        <option value="{{$item->id}}">{{$item->country_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Sehemu au eneo mtoto alipozaliwa </label>
                <input type="text" class="form-control"  name="domicile" id="domicile"
                       value="{{old('domicile')}}">
            </div>
            <div class="form-group">
                <label class="control-label">Lugha anayoongea mtoto/ njia ya mawasilianoya mtoto </label>
                <input type="text" class="form-control"  name="communication" id="communication"
                       value="{{old('communication')}}">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Idadi ya watoto katika familia </label>
                        <input type="text" class="form-control"  name="total_children" id="total_children"
                               value="{{old('total_children')}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">wangapi wapo hai </label>
                        <input type="text" class="form-control"  name="total_children_alive" id="total_children_alive"
                               value="{{old('total_children_alive')}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Wangapi waliokufa </label>
                        <input type="text" class="form-control"  name="total_children_dead" id="total_children_dead"
                               value="{{old('total_children_dead')}}">
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="step" id="ajax-step3">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">3</span>
                Historia ya mtoto ya kuzaliwa na mimba ya mama
                <small class="display-block">kuzaliwa na mimba ya mama</small>
            </h6>
            <div class="form-group ">
                <label class="control-label">Mtoto amezaliwa wapi?</label>
                <select class="select withOthers" name="place_born" id="place_born" data-placeholder="Choose an option...">
                    <option></option>
                    <option value="Nyumbani">Nyumbani</option>
                    <option value="Hospitali">Hospitali</option>
                    <option value="Kituo Cha Afya">Kituo Cha Afya</option>
                    <option value="Sehemu Nyingine">Sehemu Nyingine</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Mama aliwahi kupata shida angali mjamzito au kuumwa</label>
                <textarea  class="form-control editable" name="mother_pregnant_complications" id="mother_pregnant_complications"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Mama alipata shida wakati wakujifungua?</label>
                <textarea  class="form-control editable" name="mother_birth_complications" id="mother_birth_complications"></textarea>
            </div>
            <div class="form-group">
                <label>Mtoto alizaliwa bila kutimiza siku?  </label>
                <input type="text" name="child_birth_condition" id="child_birth_condition" class="form-control">
            </div>
            <div class="form-group">
                <label>Uchungu wa mama ulikuwa wa muda gani? </label>
                <input type="text" name="mother_labor_days" id="mother_labor_days" class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label">Mtoto aliweza kulia na kunyonya punde baada ya kuzaliwa? </label>
                <input  type="text" class="form-control" name="was_child_cry" id="was_child_cry">
            </div>
        </fieldset>
        <fieldset class="step" id="ajax-step4">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">4</span>
                Historia ya mtoto
                <small class="display-block">Historia ya mtoto</small>
            </h6>
            <div class="form-group">
                <label>Mtoto anashida gani? </label>
                <textarea name="child_complications" id="child_complications" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Mtoto alishawa kupata shida yeyoye/ kuumwa sana?  </label>
                <textarea name="child_complication_1" id="child_complication_1" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Mtoto anashida nyingine tofauti na ya mwanzo?  </label>
                <textarea name="child_complication_2" id="child_complication_2" class="form-control editable"></textarea>
            </div>
        </fieldset>
        <fieldset class="step" id="ajax-step5">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">5</span>
                Hatua za mtoto kukua.
                <small class="display-block">Hatua za mtoto kukua.</small>
            </h6>
            <div class="form-group">
                <label>Kukaa  </label>
                <textarea name="sitting" id="sitting" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Kutambaa </label>
                <textarea name="crowing" id="crowing" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Kusimama  </label>
                <textarea name="standing" id="standing" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Kutembea  </label>
                <textarea name="walking" id="walking" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Kuongea  </label>
                <textarea name="talking" id="talking" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Mtoto anaweza kujieleza shida yake kwa namna gani?   </label>
                <textarea name="child_self_expression" id="child_self_expression" class="form-control editable"></textarea>
            </div>

        </fieldset>
        <fieldset class="step" id="ajax-step6">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">6</span>
               Uchunguzi
                <small class="display-block">Uchunguzi</small>
            </h6>
            <div class="form-group" id="itemsdispatch">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                        <label>Maeneo  </label>
                        <input type="text" class="form-control" name="area[]" id="area">
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                        <label>Aina ya uchunguzi</label>
                        <textarea class="form-control" name="investigation_type[]" id="investigation_type"></textarea>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
                        <label>Matokeo </label>
                        <textarea  class="form-control" name="results[]" id="results"></textarea>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1 col-lg-1">
                        <a href="#" class="addRow"><i class="fa fa-plus"></i> Add record </a>
                    </div>

                </div>
            </div>

        </fieldset>
        <fieldset class="step" id="ajax-step7">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">7</span>
                Matokeo ya jumla
                <small class="display-block">Matokeo ya jumla</small>
            </h6>
            <div class="form-group">
                <label>Uwezo wa mtoto   </label>
                <textarea name="child_ability" id="child_ability" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Shughuli za kufanyia / mazoezi / ushauri  </label>
                <textarea name="activities" id="activities" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Mpango wa muda mrefu juu ya mtoto </label>
                <textarea name="long_term_plan" id="long_term_plan" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Mpango wa muda mfupi juu ya mtoto</label>
                <textarea name="short_term_plan" id="short_term_plan" class="form-control editable"></textarea>
            </div>
            <div class="form-group">
                <label>Ushauri</label>
                <textarea name="consultation" id="consultation" class="form-control editable"></textarea>
            </div>

        </fieldset>
        <fieldset class="step" id="ajax-step8">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">8</span>
            Taarifa inatolewa na nani
            <small class="display-block">Taarifa inatolewa na nani</small>
        </h6>
            <div class="form-group">
                <label>Jina </label>
                <input type="text" name="provider_name" id="provider_name" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cheo  </label>
                        <input type="text" name="provider_designation" id="provider_designation" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tarehe </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" class="form-control pickadate"  value="{{old('provider_date')}}" name="provider_date" id="provider_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Jina la mchukua taarifa </label>
                <input type="text" name="source_name" id="source_name" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cheo  </label>
                        <input type="text" name="source_designation" id="source_designation" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tarehe </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" class="form-control pickadate"  value="{{old('source_date')}}" name="source_date" id="source_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Kituo kinachotumika kupokelewa taarifa  </label>
                <input type="text" name="centre_name" id="centre_name" class="form-control">
            </div>

        </h6>

    </fieldset>
        <div class="row">
            <div class="col-md-8 col-sm-8 pull-left" id="output">

            </div>
        </div>
        <div class="form-wizard-actions">

            <button class="btn btn-default" id="ajax-back" type="reset">Back</button>
            <button class="btn btn-info" id="ajax-next" type="submit">Next</button>
        </div>
    {!! Form::close() !!}

    <div id="ajax-data">

    </div>
</div>
<div class="row">
    <div class="col-md-4 btn-block col-sm-4 pull-right text-right">
        <button type="button" class="btn btn-danger "  data-dismiss="modal">Close</button>
    </div>

</div>
<script>
    $(".addRow").click(function(){

        var div = document.createElement('div');

        div.className = 'row';

        div.innerHTML = ' <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">\
            <label>Maeneo  </label>\
            <input type="text" class="form-control" name="area[]" id="area">\
            </div>\
            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">\
            <label>Aina ya uchunguzi</label>\
        <textarea class="form-control" name="investigation_type[]" id="investigation_type"></textarea>\
            </div>\
            <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">\
            <label>Matokeo </label>\
            <textarea  class="form-control" name="results[]" id="results"></textarea>\
            </div>\
            <div class="col-md-1 col-sm-1 col-xs-1 col-lg-1">\
            <a href="#" class="removeRow "><i class="fa fa-minus"></i> Remove record </a>\
        </div>\
       ';

        document.getElementById('itemsdispatch').appendChild(div);
    });
    $(".removeRow").click(function(){

        alert('testing');
        // document.getElementById('itemsdispatch').removeChild( this.parent().parent() );
    });
    $("#school_status").change(function () {
        var id1 = this.value;
        if(id1 != "Hapana")
        {
            $("#school_reasons").removeAttr('value');
            $("#school_reasons").attr('value','');
            $("#school_reasons").attr('readonly','readonly');

        }else{$("#school_reasons").removeAttr('readonly');}
    });
    $(function() {
        // AJAX form submit
        $(".form-ajax").formwizard({
            disableUIStyles: true,
            formPluginEnabled: true,
            disableInputFields: false,
            inDuration: 150,
            outDuration: 150,ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
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
            rules: {
                client_id:"required",
            },
            messages: {
                client_id: "Please select client first",
            },
            formOptions :{
                dataType: 'json',
                resetForm: true,
                success: function(data){
                    swal({title: "Form Submitted successful!", text: data.message, type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                    setTimeout(function() {
                        location.replace("{{url('assessments/paediatric')}}");
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
            }
        });
    });
    // Update single file input state
    $(".form-ajax").on("step_shown", function(event, data) {
        $.uniform.update();
    });
</script>
<!-- /submit form with AJAX -->