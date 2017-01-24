<!-- BEGIN SAMPLE FORM PORTLET-->
{!! Html::style("assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css") !!}
{!! Html::style("assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" ) !!}
{!! Html::style("assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" ) !!}
{!! Html::style("assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" ) !!}
{!! Html::style("assets/global/plugins/clockface/css/clockface.css" ) !!}

<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::open(array('url'=>'inventory/disbursement/edit','role'=>'form','id'=>'DepartmentFormUN')) !!}

        <div class="form-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <label>Date</label>
                        <input type="text" class="form-control input-medium date-picker" readonly name="distributed_date" id="distributed_date" data-date-format="yyyy-mm-dd" value="{{$disbursement->distributed_date}}" data-date-viewmode="years" data-date-end-date="+0d">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <label>Progress Number</label>
                        <input type="text" name="progress_number" id="progress_number" placeholder="Enter Progress number" class="form-control" readonly value="{{$disbursement->beneficiary->progress_number}}">
                    </div>

                </div>
            </div>
            <div class="form-group" id="itemsdispatch">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                        <label> Item/materials distributed</label>
                        <select name="item" id="item" class="form-control" >
                            @if($disbursement->item !="")
                                <option value="{{$disbursement->item->id}}" selected>{{$disbursement->item->item_name}}</option>
                            @endif
                            <option value="">--Select--</option>
                            @foreach(\App\ItemsInventory::orderBy('item_name','ASC')->get() as $itm)
                                <option value="{{$itm->id}}">{{$itm->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value="{{$disbursement->quantity}}">
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label>Donor type</label>
                <input type="text" class="form-control" name="donor_type" id="donor_type" value="{{$disbursement->donor_type}}">
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    <input type="hidden" name="id" id="id" value="{{$disbursement->id}}">
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
            progress_number: "required",
            donor_type: "required",
            item: "required",
            quantity: "required",
            distributed_date: "required"
        },
        messages: {
            progress_number: "Please field is required",
            donor_type: "Please field is required",
            item: "Please field is required",
            distributed_date: "Please field is required",
            quantity: "Please enter quantity"
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
                            if(data =="<span class='text-success'><i class='fa fa-info'></i> Saved successfully</span>")
                            {
                                //data: return data from server
                                $("#output").html(data);
                                setTimeout(function() {
                                    location.replace("{{url('inventory/disbursement')}}");
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