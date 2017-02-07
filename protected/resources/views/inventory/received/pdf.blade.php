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
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <table class="table " border="0" cellpadding="0" cellspacing="0">
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
        <div class="col-md-12">
            <table class="table" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Comments:</th>
                </tr>
                <tr>
                    <td style="border-bottom: solid 1px">{{$item->comments}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 30px">
        <table class="table" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th class="col-md-3"> Signature of Recipient:</th>
                <th class="col-md-3" style="border-bottom: solid 1px"></th>
                <th class="col-md-3">Checked by:</th>
                <th class="col-md-3" style="border-bottom: solid 1px"></th>
            </tr>
            <tr>
                <th class="col-md-3"> Date:</th>
                <th class="col-md-3" style="border-bottom: solid 1px"></th>
                <th class="col-md-3">Date:</th>
                <th class="col-md-3" style="border-bottom: solid 1px"></th>
            </tr>
        </table>
    </div>

</div>
</body>
</html>