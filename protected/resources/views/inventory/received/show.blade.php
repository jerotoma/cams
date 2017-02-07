<div class="portlet light bordered">
    <div class="portlet-body form">
        <div class="form-body">
            <html>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title></title>
            <head>
                <link rel="stylesheet" type="text/css" href="{{asset("assets/css/bootstrap_print.css")}}"  media='all'>
            </head>
            <body style="border-color: #fff">
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-md-12 col-xs-12 text-center">
                        <img src="{{asset('assets/images/helpage.png')}}" width="100px" height="100px"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12 text-center text-uppercase">
                        <h4><strong>
                                GOODS RECEIVED NOTE
                            </strong></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 text-bold">
                        No:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->reference_number}}
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-2 text-bold">
                        Date Received:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->date_received}}
                    </div>
                    <div class="col-md-3 text-right text-bold">
                        Donor Ref:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->donor_ref}}
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-2 text-bold">
                        Received From/Supplier:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->received_from}}
                    </div>
                    <div class="col-md-3 text-right text-bold">
                        Project:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->project}}
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-2 text-bold">
                        HAI Receiving Officer:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->receiving_officer}}
                    </div>
                    <div class="col-md-3 text-right text-bold">
                        Onward Delivery to:
                    </div>
                    <div class="col-md-3"style="border-bottom:solid 1px">
                        {{$item->onward_delivery}}
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
                    <div class="col-md-12">
                        <span class="text-bold">Comments:</span>  <div class="form-group" style="border-bottom:solid 1px">{{$item->comments}}</div>
                    </div>
                </div>
                <div class="form-group" style="border-bottom:solid 1px"></div>
                <div class="form-group" style="border-bottom:solid 1px"></div>

                <div class="row" style="margin-top: 30px">
                    <div class="col-md-2 text-bold">
                        Signature of Recipient:
                    </div>
                    <div class="col-md-2"style="border-bottom:solid 1px">
                        <div class="form-group"></div>
                    </div>
                    <div class="col-md-2 text-right text-bold" >
                        Checked by:
                    </div>
                    <div class="col-md-2" style="border-bottom:solid 1px">
                        <div class="form-group"></div>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px">
                    <div class="col-md-2 text-bold">
                        Date:
                    </div>
                    <div class="col-md-2"style="border-bottom:solid 1px">
                        <div class="form-group"></div>
                    </div>
                    <div class="col-md-2 text-right text-bold" >
                        Date:
                    </div>
                    <div class="col-md-2" style="border-bottom:solid 1px">
                        <div class="form-group"></div>
                    </div>
                </div>
            </div>
            </body>
            </html>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-8 col-sm-8 pull-left" id="output">

                </div>
                <div class="col-md-2 col-sm-2 pull-right text-right">
                    <button type="button" class="btn btn-primary btn-block"  data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>



    </div>
</div>
