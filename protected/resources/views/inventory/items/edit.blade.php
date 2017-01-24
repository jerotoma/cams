<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-body form">
        {!! Form::open(array('url'=>'inventory/edit','role'=>'form','id'=>'DepartmentFormUN')) !!}
        <div class="form-body">
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" class="form-control" name="item_name" id="item_name" value="{{$item->item_name}}">
            </div>
            <div class="form-group">
                <label> Description</label>
                <textarea class="form-control" name="description" id="description">{{$item->description}}</textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" id="category_id">
                    @if($item->category_id !="" && is_object($item->category) && count($item->category) >0)
                    <option value="{{$item->category_id}}">{{$item->category->category_name}}</option>
                    @else
                        <option value="">--Select--</option>
                        @endif
                    @foreach(\App\ItemsCategories::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value="{{$item->quantity}}">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <label>Status</label>
                        <select name="status" class="form-control" id="status">
                            @if($item->status !="" )
                                <option value="{{$item->status}}">{{$item->status}}</option>
                            @else
                                <option value="">--Select--</option>
                            @endif
                            <option value="Available">Available</option>
                            <option value="Available">Not available</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Remarks</label>
                <input type="text" class="form-control" name="remarks" id="remarks" value="{{$item->remarks}}">
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <input type="hidden" name="id" id="id" value="{{$item->id}}">
                    <button type="button" class="btn btn-danger "  data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                </div>

            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
{!! Html::script("assets/pages/scripts/jquery.validate.min.js") !!}
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
            item_name: "required",
            status: "required",
            quantity: "required"
        },
        messages: {
            item_name: "Please enter item name",
            status: "Please select status",
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
                            //data: return data from server
                            $("#output").html(data);
                            setTimeout(function() {
                                location.reload();
                                $("#output").html("");
                            }, 2000);
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