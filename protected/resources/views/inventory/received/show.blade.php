<div class="portlet light bordered">
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12 col-xs-12 text-center">
                    <img src="{{asset('assets/images/helpage.png')}}" width="100px" height="100px"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xs-12 text-center text-uppercase">
                    <h3><strong>HelpAge International</strong></h3>
                    <h4><strong>
                            GOODS RECEIVED NOTE
                        </strong></h4>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th> No:</th>
                            <td colspan="3" class="text-left">{{$item->reference_number}}</td>

                        </tr>
                        <tr>
                            <th>  Date Received:</th>
                            <td class="text-left">{{$item->date_received}}</td>
                            <th>Donor Ref:</th>
                            <td class="text-left">{{$item->donor_ref}}</td>
                        </tr>
                        <tr>
                            <th> Received From/Supplier:</th>
                            <td class="text-left">{{$item->received_from}}</td>
                            <th>Project:</th>
                            <td class="text-left">{{$item->project}}</td>
                        </tr>
                        <tr>
                            <th>HAI Receiving Officer:</th>
                            <td class="text-left">{{$item->receiving_officer}}</td>
                            <th>Onward Delivery to:</th>
                            <td class="text-left">{{$item->onward_delivery}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-md-1">SNO</th>
                            <th class="col-md-4">Item</th>
                            <th class="col-md-1">Quantity</th>
                            <th class="col-md-6">Descriptions</th>
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
            </div>
            <div class="row" style="margin-top: 30px">
                <div class="col-md-12 col-xs-12">
                    <h6><strong>Comments</strong></h6>
                    <p class="text-justify"><?php echo $item->comments;?></p>
                </div>
            </div>
            <div class="row" style="margin-top: 30px">
                <div class="col-md-12 col-xs-12">
                    <table class="table table-bordered">
                        <tr>
                            <th class="col-md-3 col-xs-3">Signature of Recipient:</th>
                            <th class="col-md-3 col-xs-3"></th>
                            <th class="col-md-3 col-xs-3">Checked by:</th>
                            <th class="col-md-3 col-xs-3"></th>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <th></th>
                            <th>Date:</th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="form-actions">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-8 col-sm-8 pull-left" id="output">

            </div>
            <div class="col-md-2 col-sm-2 pull-right text-right">
                <button type="button" class="btn btn-primary btn-block"  data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
