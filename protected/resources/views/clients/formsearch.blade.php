<div class="row" style="margin-top: 20px">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                {!! Form::open(array('url'=>'search/clients','role'=>'form','id'=>'formClientsSearchkk')) !!}
                <div class="panel panel-flat">


                    <div class="panel-body">
                        <fieldset class="scheduler-border">
                            <legend class="text-bold">Client Registration Report</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">Arrival Date: Start Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control pickadate"  value="{{old('start_date')}}" name="start_date" id="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">End Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control pickadate" value="{{old('end_date')}}" name="end_date" id="end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="sex" id="sex">
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
                                        <label>Authorization Status</label>
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="auth_status" id="auth_status">
                                            <optgroup label="Camp Name">
                                                <option value="All">All</option>
                                                <option value="pending">Pending</option>
                                                <option value="authorized">Authorized</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Specific Needs?</label>
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="specific_needs" id="specific_needs" data-placeholder="Choose an option...">
                                            <optgroup label="Specific Needs">
                                                <option></option>
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
                                        <select  class="bootstrap-select" data-live-search="true" data-width="100%" name="age_score" id="age_score">
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
                            <div class="col-md-2 col-sm-2">
                                <button type="reset" class="btn btn-block btn-success"><i class="fa fa-search"></i> Reset </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8" id="output">

                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


</div>