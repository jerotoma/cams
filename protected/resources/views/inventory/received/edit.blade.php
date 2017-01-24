<!-- BEGIN SAMPLE FORM PORTLET-->
{!! Html::style("assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css") !!}
{!! Html::style("assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" ) !!}
{!! Html::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" ) !!}
{!! Html::style("assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" ) !!}
{!! Html::style("assets/global/plugins/clockface/css/clockface.css" ) !!}
{!! Html::script("assets/tinymce/js/tinymce/tinymce.min.js") !!}
<script>tinymce.init({ selector:'textarea' });</script>
<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::open(array('url'=>'inventory/received/edit','role'=>'form','id'=>'DepartmentFormUN')) !!}
        <div class="form-body">
            <div class="form-group">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Received date</label>
                            <div class="input-group input-medium date date-picker" data-date="" data-date-format="yyyy-mm-dd" data-date-viewmode="years" data-date-end-date="+0d">
                                <input type="text" class="form-control" name="received_date" id="received_date" readonly value="{{$item->received_date}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Way Bill Number</label>
                            <input type="text" class="form-control" name="way_bill_number" id="way_bill_number" value="{{$item->way_bill_number}}" >
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Item</label>
                            <select name="item_name" id="item_name" class="form-control">
                                @if($item->item_name !="" && $item->item_name != null)
                                    <option value="{{$item->item_name}}" selected>{{$item->item_name}}</option>
                                    @endif
                                    <option value="">--Select--</option>
                                @foreach(\App\ItemsInventory::orderBy('item_name','ASC')->get() as $itm)
                                    <option value="{{$itm->item_name}}">{{$itm->item_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Population</label>
                            <select name="population" id="population" class="form-control">
                                @if($item->population !="" && $item->population != null)
                                    <option value="{{$item->population}}" selected>{{$item->population}}</option>
                                @endif
                                <option value="">--Select--</option>
                                <option value="All">All</option>
                                @foreach(\App\Country::orderBy('country_name','ASC')->get() as $country)
                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Donor</label>
                            <input type="text" class="form-control" name="donor" id="donor" value="{{$item->donor}}">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Received From</label>
                            <input type="text" class="form-control" name="received_from" id="received_from"  value="{{$item->received_from}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Received By</label>
                            <input type="text" class="form-control" name="receiver" id="receiver" value="{{$item->receiver}}">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity" value="{{$item->quantity}}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    <input type="hidden" name="id" id="id" value="{{$item->id}}">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                </div>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
{!! Html::script("assets/pages/scripts/jquery.validate.min.js") !!}
{!! Html::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" ) !!}
{!! Html::script("assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" ) !!}
{!! Html::script("assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" ) !!}
{!! Html::script("assets/global/plugins/clockface/js/clockface.js" ) !!}
{!! Html::script("assets/pages/scripts/components-date-time-pickers.min.js" ) !!}


<script>

    $("#region_id").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('fetch/districts') ?>/"+id1,function(data){
                $("#district_id").html(data);
            });

        }else{$("#district_id").html("<option value=''>----</option>");}
    });
    $("#DepartmentFormUN").validate({
        rules: {
            item_id: "required",
            way_bill_number: "required",
            received_from: "required",
            donor: "required",
            receiver: "required",
            quantity: "required",
            received_date: "required",
            population: "required"
        },
        messages: {
            item_id: "Please field is required",
            way_bill_number: "Please field is required",
            received_from: "Please field is required",
            donor: "Please field is required",
            receiver: "Please field is required",
            quantity: "Please field is required",
            received_date: "Please field is required",
            population: "Please field is required"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#DepartmentFormUN').serializeArray();
            var formURL = $('#DepartmentFormUN').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            if(data =="<span class='text-success'><i class='fa-info'></i> Saved successfully</span>")
                            {
                                //data: return data from server
                                $("#output").html(data);
                                setTimeout(function() {
                                    location.replace("{{url('inventory/received')}}");
                                    $("#output").html("");
                                }, 2000);
                            }
                            else
                            {
                                $("#output").html(data);

                            }

                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });
</script>