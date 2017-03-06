<div class="row" style="margin-top: 20px">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                {!! Form::open(array('url'=>'reports/referrals','role'=>'form','id'=>'formClientReport')) !!}
                <div class="panel panel-flat">


                    <div class="panel-body">
                        <fieldset class="scheduler-border">
                            <legend class="text-bold">Referral Reports</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Date of Referral: Start Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control pickadate"  value="{{old('start_date')}}" name="start_date" id="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Date of Referral: End Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control pickadate" value="{{old('end_date')}}" name="end_date" id="end_date">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Camp</label>
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="camp_id" id="camp_id">
                                            <optgroup label="Camp Name">
                                                <option value="All">All</option>
                                                @foreach(\App\Camp::all() as $item)
                                                    <option value="{{$item->id}}">{{$item->camp_name}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Progress Status</label>
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="progress_status" id="progress_status" data-placeholder="Choose an option...">
                                            <optgroup label="Progress Status">
                                                <option value="All">All</option>
                                                <option value="Open">Open</option>
                                                <option value="In Progress waiting feedback">In Progress waiting feedback</option>
                                                <option value="Closed">Closed</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group ">
                                        <label>What type of report type do you need?</label>
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="report_type" id="report_type" data-placeholder="Choose an option...">
                                            <optgroup label="Report Type">
                                                <option></option>
                                                <option value="1">List of Referrals</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Export Type</label>
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="export_type" id="export_type" data-placeholder="Choose an option...">
                                            <optgroup label="Export Type">
                                                <option value="1" >Preview</option>
                                                <option value="2">Export to MS Excel</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-cog"></i> Generate Report </button>
                            </div>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>