@if($camp_id=="All")
    @foreach(\App\Camp::all() as $camp)
        <table>
            <tr>
                <td colspan="12">List of PSN Clients at {{$camp->camp_name}} on @if( !$start_time =="1970-01-01")) ({{$start_time. " to ". $end_time}} @endif</td>
            </tr>
            <tr>
                <th>No</th>
                <th>Reg #</th>
                <th>Unique id</th>
                <th>Names
                <th>Sex
                <th>Age
                <th>Marital Status
                <th>Name of Parents
                <th>Name of Spouse
                <th>M</th>
                <th>F</th>
                <th>T</th>
                <th>Origin</th>
                <th>Date of Arrival</th>
                <th>Present address</th>
                <th>Ration Card Number</th>
                <th>Vul 1</th>
                <th>Vul 2</th>
                <th>Vul 3</th>
                <th>Vul 4</th>
                <th>Vul 5</th>
            </tr>
            <?php $c=1;?>
            @foreach(\App\Client::where('camp_id','=',$camp->id)->whereBetween('date_arrival', $range)->get() as $client)
                <tr>
                    <td>{{$c++}}</td>
                    <td>{{$client->hai_reg_number}}</td>
                    <td>{{$client->client_number}}</td>
                    <td>{{$client->full_name}}</td>
                    <td>{{$client->sex}}</td>
                    <td>{{$client->age}}</td>
                    <td>{{$client->marital_status}}</td>
                    <td>{{$client->males_total}}</td>
                    <td>{{$client->spouse_name}}</td>
                    <td>{{$client->males_total}}</td>
                    <td>{{$client->females_total}}</td>
                    <td>{{$client->females_total + $client->males_total }}</td>
                    @if(is_object($client->fromOrigin) && $client->fromOrigin)
                        {{$client->fromOrigin->origin_name}}
                    @endif
                    <td>@if( !$client->date_arrival =="1970-01-01"){{$client->date_arrival}}@endif</td>
                    <td>{{$client->present_address}}</td>
                    <td>{{$client->ration_card_number}}</td>
                    @if(is_object($client->vulnerabilityCodes))
                        @foreach($client->vulnerabilityCodes as $code)
                            <td>{{$client->ration_card_number}}</td>
                        @endforeach
                    @endif


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
            <th>No</th>
            <th>Reg #</th>
            <th>Unique id</th>
            <th>Names
            <th>Sex
            <th>Age
            <th>Marital Status
            <th>Name of Parents
            <th>Name of Spouse
            <th>M</th>
            <th>F</th>
            <th>T</th>
            <th>Origin</th>
            <th>Date of Arrival</th>
            <th>Present address</th>
            <th>Ration Card Number</th>
            <th>Vul 1</th>
            <th>Vul 2</th>
            <th>Vul 3</th>
            <th>Vul 4</th>
            <th>Vul 5</th>
        </tr>
        <?php $c=1;?>
        @foreach(\App\Client::where('camp_id','=',$camp->id)->whereBetween('date_arrival', $range)->get() as $client)
            <tr>
                <td>{{$c++}}</td>
                <td>{{$client->hai_reg_number}}</td>
                <td>{{$client->client_number}}</td>
                <td>{{$client->full_name}}</td>
                <td>{{$client->sex}}</td>
                <td>{{$client->age}}</td>
                <td>{{$client->marital_status}}</td>
                <td>{{$client->males_total}}</td>
                <td>{{$client->spouse_name}}</td>
                <td>{{$client->males_total}}</td>
                <td>{{$client->females_total}}</td>
                <td>{{$client->females_total + $client->males_total }}</td>
                @if(is_object($client->fromOrigin) && $client->fromOrigin)
                    {{$client->fromOrigin->origin_name}}
                @endif
                <td>@if( !$client->date_arrival =="1970-01-01"){{$client->date_arrival}}@endif</td>
                <td>{{$client->present_address}}</td>
                <td>{{$client->ration_card_number}}</td>
                @if(is_object($client->vulnerabilityCodes))
                    @foreach($client->vulnerabilityCodes as $code)
                       <td>{{$client->ration_card_number}}</td>
                    @endforeach
                 @endif


            </tr>
        @endforeach
    </table>
@endif