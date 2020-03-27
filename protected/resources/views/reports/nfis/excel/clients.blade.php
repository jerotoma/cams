<div class="row clearfix" style="margin-top: 20px">
    <div class="col-md-12 column">
        <table class="table datatable-column-search-inputs table-bordered table-hover" id="tab_logic">
            <thead>
            <tr >
                <th>No</th>
                <th>HAI Reg #</th>
                <th>Unique id</th>
                <th>Names
                <th>Sex
                <th>Age
                <th>Origin</th>
                <th>Date of Arrival</th>
                <th>Present address</th>
                <th>Ration Card Number</th>
                <th></th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Camp Name</th>
            </tr>
            </thead>
            <tbody>
            <?php $c=1;?>
            @foreach($clients as $client)
                <tr>
                    <td>{{$c++}}</td>
                    <td>{{$client->hai_reg_number}}</td>
                    <td>{{$client->client_number}}</td>
                    <td>{{$client->full_name}}</td>
                    <td>{{$client->sex}}</td>
                    <td>{{$client->age}}</td>
                    <td>
                        @if(is_object(\App\Client::find($client->id)->fromOrigin) && \App\Client::find($client->id)->fromOrigin != null)
                            {{\App\Client::find($client->id)->fromOrigin->origin_name}}
                        @endif
                    </td>
                    <td>{{$client->date_arrival}}</td>
                    <td>{{$client->present_address}}</td>
                    <td>{{$client->ration_card_number}}</td>
                    <td></td>
                    <td>
                        @if(is_object(\App\ItemsInventory::find($client->item_id)) && \App\ItemsInventory::find($client->item_id) != null)
                            {{\App\ItemsInventory::find($client->item_id)->item_name}}
                        @endif
                    </td>
                    <td>{{$client->quantity}}</td>
                    <td>{{$client->distribution_date}}</td>
                    <td>
                        @if(is_object(\App\Client::find($client->id)->camp) && \App\Client::find($client->id)->camp)
                            {{\App\Client::find($client->id)->camp->camp_name}}
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr >
                <th>No</th>
                <th>HAI Reg #</th>
                <th>Unique id</th>
                <th>Names
                <th>Sex
                <th>Age
                <th>Origin</th>
                <th>Date of Arrival</th>
                <th>Present address</th>
                <th>Ration Card Number</th>
                <th></th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Camp Name</th>
            </tr>
            </tfoot>
        </table>
    </div>

</div>