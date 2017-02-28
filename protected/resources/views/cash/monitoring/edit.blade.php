<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery_ui/core.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/wizards/form_wizard/form.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
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
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.date.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/pickers/pickadate/picker.time.js")}}"></script>
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
        $('.datatable-column-search-inputs-select-client tfoot td').not(':last-child').each(function () {
            var title = $('.datatable-column-search-inputs-select-client thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
        });

        var table = $('.datatable-column-search-inputs-select-client').DataTable({
            "scrollX": false,
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
    // Default functionality
    $('.pickatime').pickatime({
        format: 'H:i',
        interval: 5,
    });

    $('#prompt').on('click', function() {
        bootbox.prompt("Please enter your name", function(result) {
            if (result === null) {
                bootbox.alert("Prompt dismissed");
            } else {
                bootbox.alert("Hi <b>"+result+"</b>");
            }
        });
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
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Cash post-distribution monitoring</h6>

    </div>
    {!! Form::model($assessment,array('route'=>array('monitoring.update',$assessment->id),'method'=>'PUT','role'=>'form','class'=>'form-ajax','id'=>'formClients'))!!}
    <fieldset class="step" id="ajax-step1">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">1</span>
            Administrative Details
            <small class="display-block">Administrative Details</small>
        </h6>
        <div class="form-group ">
            <label class="control-label">Date of interview</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                <input type="text" class="form-control pickadate" placeholder="Date of interview" value="{{$assessment->interview_date}}" name="interview_date" id="interview_date">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label">Interview starting time</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-alarm"></i></span>
                        <input type="text" class="form-control pickatime"  name="interview_start_time" id="interview_start_time" value="{{$assessment->interview_start_time}}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label">Interview finishing time</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-alarm"></i></span>
                        <input type="text" class="form-control pickatime" name="interview_end_time" id="interview_end_time" value="{{$assessment->interview_end_time}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Organisation (HelpAge or Partner Org)</label>
            <input type="text" class="form-control"  name="organisation" id="organisation"
                   value="{{$assessment->organisation}}">
        </div>
        <div class="form-group ">
            <label class="control-label">Name of Enumerator</label>
            <input type="text" class="form-control"  name="enumerator_name" id="enumerator_name"
                   value="{{$assessment->enumerator_name}}">
        </div>
        <div class="form-group ">
            <label class="control-label">Name of Respondent (optional)</label>
            <input type="text" class="form-control"  name="respondent_name" id="respondent_name"
                   value="{{$assessment->respondent_name}}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Camp name</label>
                    <select class="select" name="camp_id" id="camp_id" data-placeholder="Choose an option..." readonly="">
                        @if($assessment->camp_id != "")
                            <option value="{{\App\Camp::findorfail($assessment->camp_id)->id}}">{{\App\Camp::findorfail($assessment->camp_id)->camp_name}}</option>
                            @endif
                        <option></option>
                        @foreach(\App\Camp::all() as $item)
                            <option value="{{$item->id}}">{{$item->camp_name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label">District</label>
                    <select class="select" name="district_id" id="district_id" data-placeholder="Choose an option..." readonly="">
                        @if($assessment->district_id != "")
                            <option value="{{\App\District::findorfail($assessment->district_id)->id}}">{{\App\District::findorfail($assessment->district_id)->district_name}}</option>
                        @endif
                        <option></option>
                        @foreach(\App\District::all() as $item)
                            <option value="{{$item->id}}">{{$item->district_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="step" id="ajax-step2">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">2</span>
            Demographic Details
            <small class="display-block">Let us know about household</small>
        </h6>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender of the Respondent </label>
                    <select name="q2_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->demographicDetails))
                          <option value="{{$assessment->demographicDetails->q2_1}}">{{$assessment->demographicDetails->q2_1}}</option>
                        @endif
                            <option></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Age of the Respondent</label>
                    <input type="number" class="form-control" name="q2_2" id="q2_2"
                    @if(is_object($assessment->demographicDetails))
                        value="{{$assessment->demographicDetails->q2_2}}"
                    @endif>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender of the head of the HH </label>
                    <select name="q2_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->demographicDetails))
                            <option value="{{$assessment->demographicDetails->q2_3}}" selected>{{$assessment->demographicDetails->q2_3}}</option>
                        @endif
                        <option></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Is the HH headed by a person over 60?</label>
                    <select name="q2_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->demographicDetails))
                            <option value="{{$assessment->demographicDetails->q2_4}}" selected>{{$assessment->demographicDetails->q2_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Is the HH headed by a person with a disability? </label>
                    <select name="q2_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->demographicDetails))
                            <option value="{{$assessment->demographicDetails->q2_5}}" selected>{{$assessment->demographicDetails->q2_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Number of people in the HH</label>
                    <input type="number" class="form-control" name="q2_6" id="q2_6"
                    @if(is_object($assessment->demographicDetails))
                       value="{{$assessment->demographicDetails->q2_6}}"
                    @endif>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Number of older people (over 60) in your HH [including HH Head]</label>
                    <input type="number" class="form-control" name="q2_7" id="q2_7"
                    @if(is_object($assessment->demographicDetails))
                        value="{{$assessment->demographicDetails->q2_7}}"
                    @endif>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>What best describes your household status </label>
                    <select name="q2_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->demographicDetails))
                            <option value="{{$assessment->demographicDetails->q2_8}}" selected>{{$assessment->demographicDetails->q2_8}}</option>
                        @endif
                        <option></option>
                        <option value="Moved here due to natural disaster">Moved here due to natural disaster</option>
                        <option value="Normally Resident in this area">Normally Resident in this area</option>
                        <option value="Moved here due to conflict">Moved here due to conflict</option>
                        <option value="Moved here for other reasons">Moved here for other reasons</option>
                    </select>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset class="step" id="ajax-step3">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">3</span>
            Distribution of Cash withdrawal Mechanism/Registration with Cash Withdrawal Agent
            <small class="display-block">Cash withdrawal Mechanism</small>
        </h6>
        <div class="form-group">
            <label>How many hours did it take you to travel to the voucher/cash card/token distribution/registration?:</label>
            <select name="q3_1" data-placeholder="Choose an option..." class="select">
                @if(is_object($assessment->cashWithdrawal))
                    <option value="{{$assessment->cashWithdrawal->q3_1}}" selected>{{$assessment->cashWithdrawal->q3_1}}</option>
                @endif
                <option></option>
                <option value="<0.5 hours"><0.5 hours</option>
                <option value="0.5-1 hour">0.5-1 hour</option>
                <option value="1-1.5 hours">1-1.5 hours</option>
                <option value="1.5-2 hours">1.5-2 hours</option>
                <option value="2-2.5 hours">2-2.5 hours</option>
                <option value=">2.5 hours">>2.5 hours</option>
            </select>
        </div>

        <div class="form-group">
            <label>How much did you pay for transport to get to the distribution/registration site? (Specify Currency):</label>
            <input type="text" name="q3_2" class="form-control"
            @if(is_object($assessment->cashWithdrawal))
                 value="{{$assessment->cashWithdrawal->q3_2}}"
            @endif>
        </div>
        <div class="form-group">
            <label>How long did you have to wait at the distribution site to get your voucher/cash card/token distribution?:</label>
            <select name="q3_3" data-placeholder="Choose an option..." class="select">
                @if(is_object($assessment->cashWithdrawal))
                    <option value="{{$assessment->cashWithdrawal->q3_3}}" selected>{{$assessment->cashWithdrawal->q3_3}}</option>
                @endif
                <option></option>
                <option value="<0.5 hours"><0.5 hours</option>
                <option value="0.5-1 hour">0.5-1 hour</option>
                <option value="1-1.5 hours">1-1.5 hours</option>
                <option value="1.5-2 hours">1.5-2 hours</option>
                <option value="2-2.5 hours">2-2.5 hours</option>
                <option value=">2.5 hours">>2.5 hours</option>
            </select>
        </div>
        <div class="form-group">
            <label>Was the length of time you spent travelling to collect the voucher/cash card/token was acceptable? :</label>
            <select name="q3_4" data-placeholder="Choose an option..." class="select">
                @if(is_object($assessment->cashWithdrawal))
                    <option value="{{$assessment->cashWithdrawal->q3_4}}" selected>{{$assessment->cashWithdrawal->q3_4}}</option>
                @endif
                <option></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="form-group">
            <label>Did the distribution team treat you with dignity and respect?  :</label>
            <select name="q3_5" data-placeholder="Choose an option..." class="select">
                @if(is_object($assessment->cashWithdrawal))
                    <option value="{{$assessment->cashWithdrawal->q3_5}}" selected>{{$assessment->cashWithdrawal->q3_5}}</option>
                @endif
                <option></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="form-group">
            <label>Rank the level of security at the voucher/token/cash card distribution site:</label>
            <select name="q3_6" data-placeholder="Choose an option..." class="select">
                @if(is_object($assessment->cashWithdrawal))
                    <option value="{{$assessment->cashWithdrawal->q3_6}}" selected>{{$assessment->cashWithdrawal->q3_6}}</option>
                @endif
                <option></option>
                <option value="Good">Good</option>
                <option value="Fair">Fair</option>
                <option value="Poor">Poor</option>
            </select>
        </div>
    </fieldset>

    <fieldset class="step" id="ajax-step4">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">4</span>
            Physically receiving the cash
            <small class="display-block"></small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Was it you or a proxy that received the cash at the bank? </label>
                    <select name="q4_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_1}}" selected>{{$assessment->physicallyReceivingCash->q4_1}}</option>
                        @endif
                        <option></option>
                        <option value="You- the targeted beneficiary">You- the targeted beneficiary</option>
                        <option value="Proxy">Proxy</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>If answered proxy to previous question, did your proxy give you the cash?</label>
                    <select name="q4_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_2}}" selected>{{$assessment->physicallyReceivingCash->q4_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>How many hours did you/proxy take to travel to receive the cash?:</label>
                    <select name="q4_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_3}}" selected>{{$assessment->physicallyReceivingCash->q4_3}}</option>
                        @endif
                        <option></option>
                        <option value="<0.5 hours"><0.5 hours</option>
                        <option value="0.5-1 hour">0.5-1 hour</option>
                        <option value="1-1.5 hours">1-1.5 hours</option>
                        <option value="1.5-2 hours">1.5-2 hours</option>
                        <option value="2-2.5 hours">2-2.5 hours</option>
                        <option value=">2.5 hours">>2.5 hours</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>How much did you/proxy spend on transport to reach the cash distribution site?</label>
                    <input type="number" name="q4_4" class="form-control"
                    @if(is_object($assessment->physicallyReceivingCash))
                        value="{{$assessment->physicallyReceivingCash->q4_4}}"
                    @endif>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>How long did you/proxy have to wait to receive the cash?</label>
                    <select name="q4_5" data-placeholder="Choose an option..." class="select withOthers">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_5}}" selected>{{$assessment->physicallyReceivingCash->q4_5}}</option>
                        @endif
                        <option></option>
                        <option value="<0.5 hours"><0.5 hours</option>
                        <option value="0.5-1 hour">0.5-1 hour</option>
                        <option value="1-1.5 hours">1-1.5 hours</option>
                        <option value="1.5-2 hours">1.5-2 hours</option>
                        <option value="2-2.5 hours">2-2.5 hours</option>
                        <option value=">2.5 hours">>2.5 hours</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Was the length of time you/proxy spent travelling to receive the cash acceptable? </label>
                    <select name="q4_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_6}}" selected>{{$assessment->physicallyReceivingCash->q4_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Was the frequency of which the cash was distributed suited to your household needs</label>
                    <select name="q4_7" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_7}}" selected>{{$assessment->physicallyReceivingCash->q4_7}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Was the transfer sufficient to cover your household’s basic needs? </label>
                    <select name="q4_8" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_8}}" selected>{{$assessment->physicallyReceivingCash->q4_8}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Would you prefer to receive goods/food than cash? </label>
                    <select name="q4_9" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_9}}" selected>{{$assessment->physicallyReceivingCash->q4_9}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>How much cash did you receive? </label>
                    <input type="number" name="q4_10" class="form-control"
                    @if(is_object($assessment->physicallyReceivingCash))
                        value="{{$assessment->physicallyReceivingCash->q4_10}}"
                    @endif>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Was this the amount you expected?  </label>
                    <select name="q4_10_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_10_1}}" selected>{{$assessment->physicallyReceivingCash->q4_10_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Did you have to pay anyone to receive your cash? </label>
                    <select name="q4_11" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_11}}" selected>{{$assessment->physicallyReceivingCash->q4_11}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>If yes to previous question, whom did you have to pay? </label>
                    <select name="q4_12" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_12}}" selected>{{$assessment->physicallyReceivingCash->q4_12}}</option>
                        @endif
                        <option></option>
                        <option value="Community leader">Community leader</option>
                        <option value="NGO staff">NGO staff</option>
                        <option value="Hawala agent">Hawala agent</option>
                        <option value="Trader">Trader</option>
                        <option value="Police/army">Police/army</option>
                        <option value="Police/army">Police/army</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Rank the ease with which you collected your cash</label>
                    <select name="q4_13" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_13}}" selected>{{$assessment->physicallyReceivingCash->q4_13}}</option>
                        @endif
                        <option></option>
                        <option value="Good">Good</option>
                        <option value="Fair">Fair</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Rank the level of security at the cash distribution site</label>
                    <select name="q4_14" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_14}}" selected>{{$assessment->physicallyReceivingCash->q4_14}}</option>
                        @endif
                        <option></option>
                        <option value="Good">Good</option>
                        <option value="Fair">Fair</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Did the people who gave you the cash treat you with dignity and respect? </label>
                    <select name="q4_15" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_15}}" selected>{{$assessment->physicallyReceivingCash->q4_15}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Did you receive/proxy any problems with identification by the cash distributors? (banks, traders, hawala staff) </label>
                    <select name="q4_16" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_16}}" selected>{{$assessment->physicallyReceivingCash->q4_16}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Did you/proxy experience any problems with getting the correct bank notes? </label>
                    <select name="q4_17" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_17}}" selected>{{$assessment->physicallyReceivingCash->q4_17}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Did you experience any problems with sending another person to collect the money</label>
                    <select name="q4_18" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_18}}" selected>{{$assessment->physicallyReceivingCash->q4_18}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>I am aware of where and how to report any complaints/feedback I have about this programme </label>
                    <select name="q4_19" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_19}}" selected>{{$assessment->physicallyReceivingCash->q4_19}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Did you/proxy experience any other problems collecting the cash that was not already mentioned?  </label>
                    <select name="q4_20" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_20}}" selected>{{$assessment->physicallyReceivingCash->q4_20}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>If yes to above, please explain</label>
                    <textarea name="q4_21" class="form-control">@if(is_object($assessment->physicallyReceivingCash)){{$assessment->physicallyReceivingCash->q4_21}}@endif</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Overall, could you please rate your satisfaction level with the cash assistance provided by HelpAge?</label>
                    <select name="q4_22" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->physicallyReceivingCash))
                            <option value="{{$assessment->physicallyReceivingCash->q4_22}}" selected>{{$assessment->physicallyReceivingCash->q4_22}}</option>
                        @endif
                        <option></option>
                        <option value="Highly satisfied">Highly satisfied</option>
                        <option value="Satisfied">Satisfied</option>
                        <option value="Neutral">Neutral</option>
                        <option value="Dissatisfied">Dissatisfied</option>
                        <option value="Very Dissatisfied">Very Dissatisfied</option>
                    </select>
                </div>
            </div>
        </div>

    </fieldset>
    <fieldset class="step" id="ajax-step5">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">5</span>
            Communal Relations
            <small class="display-block">Communal Relations</small>
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Control over the cash received from HelpAge has caused conflict within my household </label>
                    <select name="q5_1" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->communalRelations))
                            <option value="{{$assessment->communalRelations->q5_1}}" selected>{{$assessment->communalRelations->q5_1}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Other members of the community are jealous of me because of the cash transfer  </label>
                    <select name="q5_2" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->communalRelations))
                            <option value="{{$assessment->communalRelations->q5_2}}" selected>{{$assessment->communalRelations->q5_2}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>The older person in the household is more respected within the household since receiving the cash </label>
                    <select name="q5_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->communalRelations))
                            <option value="{{$assessment->communalRelations->q5_3}}" selected>{{$assessment->communalRelations->q5_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>The older person in the household is more respected within the community since receiving the cash :</label>
                    <select name="q5_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->communalRelations))
                            <option value="{{$assessment->communalRelations->q5_4}}" selected>{{$assessment->communalRelations->q5_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>I shared what I received using the cash HelpAge gave me with other household </label>
                    <select name="q5_5" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->communalRelations))
                            <option value="{{$assessment->communalRelations->q5_5}}" selected>{{$assessment->communalRelations->q5_5}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>I shared what I received using the cash HelpAge gave me with other non-household members  </label>
                    <select name="q5_6" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->communalRelations))
                            <option value="{{$assessment->communalRelations->q5_6}}" selected>{{$assessment->communalRelations->q5_6}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="step" id="ajax-step6">
        <h6 class="form-wizard-title text-semibold">
            <span class="form-wizard-count">6</span>
            What the cash was used for?
            <small class="display-block">What the cash was used for?</small>
        </h6>
        <div class="form-group">
            <label>Please state total of last cash transfer:</label>
            <input type="number" name="q6_1" class="form-control"
            @if(is_object($assessment->cashUsage))
               value="{{$assessment->cashUsage->q6_1}}"
            @endif>
        </div>
        <div class="form-group">
            <label>Indicate how much of the most recent cash transfer was used for each category:</label>
            <table class="table table-bordered table-hover" >
                <thead>
                <tr>
                    <th></th>
                    <th>Currency</th>
                </tr>
                </thead>
                <?php $co=1;?>
                @if(is_object($assessment->cashUsage) && is_object($assessment->cashUsage->usages) && count($assessment->cashUsage->usages) >0)
                @foreach($assessment->cashUsage->usages as $usage)
                    <tr>
                        <td>{{$usage->category_name}}<input type="hidden" value="{{$usage->category_id}}" name="categories[]"></td>
                        <td><input type="text" name="currencies[]" class="form-control" value="{{$usage->currency}}"></td>
                    </tr>
                    <?php $co++;?>
                @endforeach
                    @else
                    @foreach(\App\PCCategories::all() as $category)
                        <tr>
                            <td>{{$category->category_name}}<input type="hidden" value="{{$category->id}}" name="categories[]"></td>
                            <td><input type="text" name="currencies[]" class="form-control"></td>
                        </tr>
                        <?php $co++;?>
                    @endforeach
                    @endif
            </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>I shared what I received using the cash HelpAge gave me with other household </label>
                    <select name="q6_3" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->cashUsage))
                            <option value="{{$assessment->cashUsage->q6_3}}" selected>{{$assessment->cashUsage->q6_3}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>I shared what I received using the cash HelpAge gave me with other non-household members  </label>
                    <select name="q6_4" data-placeholder="Choose an option..." class="select">
                        @if(is_object($assessment->cashUsage))
                            <option value="{{$assessment->cashUsage->q6_4}}" selected>{{$assessment->cashUsage->q6_4}}</option>
                        @endif
                        <option></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Enumerator Observations/Important Notes:</label>
            <textarea name="enumerator_observations" class="form-control">{{$assessment->enumerator_observations}}</textarea>
        </div>

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
    function getPSNProfile(id1) {
        if (id1 != "") {
            $.get("<?php echo url('getvulassessmentpsnprofile') ?>/" + id1, function (data) {
                $("#clientProfile").html(data);
            });
        } else {
            $("#clientProfile").html("");
        }
    }

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
                camp_id:"required",
                district_id:"required",
                interview_date:"required",
                interview_start_time:"required",
                interview_end_time:"required",
                enumerator_name:"required",
                organisation:"required",
            },
            messages: {
                client_id: "Please select client first",
                camp_id: "Please select camp",
                district_id: "Please select district first",
                interview_date: "Please enter interview date",
                interview_start_time: "Please enter start time",
                interview_end_time: "Please enter end time",
                enumerator_name: "Please enter enumerator name",
                organisation: "Please enter organisation",
            },
            formOptions :{
                dataType: 'json',
                resetForm: true,
                success: function(data){
                    swal({title: "Form Submitted successful!", text: data.message, type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
                    setTimeout(function() {
                        location.replace("{{url('post/cash/monitoring')}}");
                        $("#output").html("");
                    }, 2000);
                },
                error: function(jqXhr,status, response) {
                    console.log(jqXhr);
                    if( jqXhr.status === 401 ) {
                        location.replace('{{url('login')}}');
                    }
                    if( jqXhr.status === 400 ) {
                        if(jqXhr.responseJSON.errors ==1){
                            errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p>';
                            errorsHtml += '<p>'+ jqXhr.responseJSON.message +'</p></div>';
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
            }
        });
    });
</script>
<!-- /submit form with AJAX -->