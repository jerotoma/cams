<div class="row clearfix" style="margin-top: 20px">
    <div class="col-md-12 column">
        <table class="table datatable-column-search-inputs table-bordered table-hover" id="tab_logic">
            <thead>
            <tr >
                <th>No</th>
                <th>HAI REG NUMBER</th>
                <th>Names</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Camp Name</th>
                <th>Quantity</th>
                <th>Distribution Date</th>
            </tr>
            </thead>
            <tbody>
            <?php $c=1;?>
            @foreach($clients as $client)
                @if(!isClientInDistributionLimit($request->items,$client->id) && $request->items !="All")
                <tr>
                    <td>{{$c++}}</td>
                    <td>{{$client->hai_reg_number}}</td>
                    <td>{{$client->full_name}}</td>
                    <td>{{$client->sex}}</td>
                    <td>{{$client->age}}</td>
                    <td>
                        @if(is_object(\App\Client::find($client->id)->camp) && \App\Client::find($client->id)->camp)
                            {{\App\Client::find($client->id)->camp->camp_name}}
                        @endif
                    </td>
                    <td></td>
                    <td></td>

                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

</div>