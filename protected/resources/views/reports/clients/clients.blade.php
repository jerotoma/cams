@if($camp_id=="All")
    @foreach(\App\Camp::all() as $camp)
        <table>
            <tr>
                <td colspan="12">List of PSN Clients at {{$camp->camp_name}} on @if( !$start_time =="1970-01-01")) ({{$start_time. " to ". $end_time}} @endif</td>
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
                    <td></td>
                    <td>@if( !$client->date_arrival =="1970-01-01"){{$client->date_arrival}}@endif</td>
                    <td>{{$client->present_address}}</td>
                    <td>{{$client->ration_card_number}}</td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </table>
    @endforeach

    @else
    <?php $camp=\App\Camp::find($camp_id);?>
    <table>
        <tr>
            <td colspan="12">List of PSN Clients at {{$camp->camp_name}} on @if( !$start_time =="1970-01-01")) ({{$start_time. " to ". $end_time}} @endif</td>
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
                <td></td>
                <td>@if( !$client->date_arrival =="1970-01-01"){{$client->date_arrival}}@endif</td>
                <td>{{$client->present_address}}</td>
                <td>{{$client->ration_card_number}}</td>
                <td>
                </td>
            </tr>
        @endforeach
    </table>
@endif