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
                    <h4 class="text-uppercase"><strong>
                            NFIs Items Distribution
                        </strong></h4>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th> Distribution Date:</th>
                            <td colspan="3" class="text-left">{{$disbursement->disbursements_date}}</td>
                            <th>  Items Distributed By:</th>
                            <td class="text-left">{{$disbursement->disbursements_by}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th >SNO</th>
                            <th >HAI Reg#</th>
                            <th >Full Name</th>
                            <th >Sex</th>
                            <th >Age</th>
                            <th >Item Name</th>
                            <th >Item Category</th>
                            <th >Quantity</th>
                            <th >Remarks</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(is_object($disbursement->distributions) && $disbursement->distributions != null)
                            <?php $c=1;?>
                            @foreach($disbursement->distributions as $itm)
                                <tr>
                                    <td>{{$c++}}</td>
                                    <td>@if(is_object($itm->client) && $itm->client != null){{$itm->client->hai_reg_number}}@endif</td>
                                    <td>@if(is_object($itm->client) && $itm->client != null){{$itm->client->full_name}}@endif</td>
                                    <td>@if(is_object($itm->client) && $itm->client != null){{$itm->client->sex}}@endif</td>
                                    <td>@if(is_object($itm->client) && $itm->client != null){{$itm->client->age}}@endif</td>
                                    <td>@if(is_object($itm->item) && $itm->item != null){{$itm->item->item_name}}@endif</td>
                                    <td>@if(is_object($itm->item) && is_object($itm->item->category) && $itm->item != null){{$itm->item->category->category_name}}@endif</td>
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
                    <p class="text-justify"><?php echo $disbursement->comments;?></p>
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
