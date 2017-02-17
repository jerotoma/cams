@if($camp_id=="All")
    @foreach(\App\Camp::all() as $camp)
    <table>
        <tr>
            <td colspan="12">List of PSN Clients at {{$camp->camp_name}} on ({{$start_time. " to ". $end_time}} )</td>
        </tr>
        <tr>
            <th>SN</th>
            <th>Unique ID</th>
            <th>Full Name</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Number of males</th>
            <th>Number of Females</th>
            <th>Origin</th>
            <th>Date of Arrival</th>
            <th>Present Address</th>
            <th>Ration Card Number</th>
            <th>PSN Code</th>
        </tr>
        <?php $c=1;?>
        @foreach(\App\Client::where('camp_id','=',$camp->id)->whereBetween('date_arrival', $range)->get() as $client)
        <tr>
            <td>{{$c++}}</td>
            <td>{{$client->client_number}}</td>
            <td>{{$client->full_name}}</td>
            <td>{{$client->sex}}</td>
            <td>{{$client->age}}</td>
            <td>{{$client->males_total}}</td>
            <td>{{$client->females_total}}</td>
            <td>@if(is_object($client->fromOrigin->origin_name)){{$client->fromOrigin->origin_name}}@endif</td>
            <td>{{$client->date_arrival}}</td>
            <td>{{$client->present_address}}</td>
            <td>{{$client->ration_card_number}}</td>
            <td>@if(is_object($client->vulnerability))
                   @foreach($client->vulnerability as $code)
                        @if(is_object($code->code)){{$code->code->code}}@endif
                       @endforeach
            @endif
            </td>
        </tr>
            @endforeach
    </table>
    @endforeach

    @else
    <?php $camp=\App\Camp::find($camp_id);?>
    <table>
        <tr>
            <td colspan="12">List of PSN Clients at {{$camp->camp_name}} on ({{$start_time. " to ". $end_time}} )</td>
        </tr>
        <tr>
            <th>SN</th>
            <th>Unique ID</th>
            <th>Full Name</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Number of males</th>
            <th>Number of Females</th>
            <th>Origin</th>
            <th>Date of Arrival</th>
            <th>Present Address</th>
            <th>Ration Card Number</th>
            <th>PSN Code</th>
        </tr>
        <?php $c=1;?>
        @foreach(\App\Client::where('camp_id','=',$camp->id)->whereBetween('date_arrival', $range)->get() as $client)
            <tr>
                <td>{{$c++}}</td>
                <td>{{$client->client_number}}</td>
                <td>{{$client->full_name}}</td>
                <td>{{$client->sex}}</td>
                <td>{{$client->age}}</td>
                <td>{{$client->males_total}}</td>
                <td>{{$client->females_total}}</td>
                <td>@if(is_object($client->origin->origin_name)){{$client->origin->origin_name}}@endif</td>
                <td>{{$client->date_arrival}}</td>
                <td>{{$client->present_address}}</td>
                <td>{{$client->ration_card_number}}</td>
                <td>@if(is_object($client->vulnerability))
                        @foreach($client->vulnerability as $code)
                            @if(is_object($code->code)){{$code->code->code}}@endif
                        @endforeach
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endif