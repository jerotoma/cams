<div class="portlet light bordered">
    <div class="portlet-body form">
        <div class="form-body">
            <fieldset class="scheduler-border">
                <legend class="text-bold">GOODS RECEIVED NOTE</legend>
                <div class="form-group ">
                    <label class="control-label"> Reference No: </label>
                    <input type="text" class="form-control"  name="reference_number" id="reference_number" value="{{$item->reference_number}}" readonly>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Date Received:</label>

                                <input type="text" class="form-control"  value="{{$item->date_received}}" name="date_received" id="date_received" readonly>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Donor Ref</label>
                            <input type="text" class="form-control" name="donor_ref"  id="donor_ref" value="{{$item->donor_ref}}" readonly >

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Project:</label>
                            <input type="text" class="form-control" name="project"  id="project" value="{{$item->project}}" readonly>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Received From/Supplier: </label>
                            <input type="text" class="form-control" name="received_from" id="received_from" value="{{$item->received_from}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> HAI Receiving Officer: </label>
                            <input type="text" class="form-control"  name="receiving_officer" id="receiving_officer" value="{{$item->receiving_officer}}" readonly>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label class="control-label"> Onward Delivery to: </label>
                            <input type="text" class="form-control"  name="onward_delivery" id="onward_delivery" value="{{$item->onward_delivery}}" readonly>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="scheduler-border">
                <legend class="text-bold">ITEMS</legend>
                <div class="form-group">
                    <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                              <th>SNO</th>
                              <th>Item</th>
                              <th>Quantity</th>
                              <th>Descriptions</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(is_object($item->items) && $item->items != null)
                            <?php $c=1;?>
                            @foreach($item->items as $itm)
                        <tr>
                            <td>{{$c++}}</td>
                            <td>@if(is_object($itm->item) && $itm->item != null){{$itm->item->item_name}}@endif</td>
                            <td>{{$itm->quantity}}</td>
                            <td>{{$itm->description}}</td>
                        </tr>
                        @endforeach
                            @endif
                        </tbody>

                    </table>
                </div>
            </fieldset>
            <div class="form-group ">
                <label class="control-label"> Comments: </label>
                <textarea class="form-control"  name="comments" id="comments" readonly>{{$itm->comments}}</textarea>
            </div>
            </fieldset>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-4 col-sm-4 pull-right text-right">
                    <button type="button" class="btn btn-primary btn-block"  data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>



    </div>
</div>
