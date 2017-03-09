<table >
    <thead>
    <tr>
        <th>No</th>
        <th>Unique id</th>
        <th>Names</th>
        <th>Sex</th>
        <th>Age</th>
        <th>Marital Status</th>
        <th>Name of Parents</th>
        <th>Name of Spouse</th>
        <th>M</th>
        <th>F</th>
        <th>T</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th>Present address</th>
        <th>Ration Card Number </th>
        <th>Vul 1</th>
        <th>Vul 2</th>
        <th>Vul 3</th>
        <th>Vul 4</th>
        <th>Vul 5</th>
        <th>Error Descriptions</th>
    </tr>
    </thead>
    <tbody>
    <?php $co=1;?>
    @foreach($clients as $client)
        <tr>
            <td class="text-center">
                {{$co++}}
            </td>
            <td>{{$client->unique_id}}</td>
            <td @if($client->names =="") style="background-color: #dd0000;" @endif>{{$client->names}}</td>
            <td @if($client->sex =="") style="background-color: #dd0000;" @endif>{{$client->sex}}</td>
            <td @if($client->age =="") style="background-color: #dd0000;" @endif>{{$client->age}}</td>
            <td @if($client->marital_status =="") style="background-color: #dd0000;" @endif>{{$client->marital_status}}</td>
            <td >{{$client->name_of_parents}}</td>
            <td>{{$client->name_of_spouse}}</td>
            <td @if($client->m =="")style="background-color: #dd0000;" @endif>{{$client->m}}</td>
            <td @if($client->f =="") style="background-color: #dd0000;" @endif>{{$client->f}}</td>
            <td @if($client->t =="") style="background-color: #dd0000;" @endif>{{$client->t}}</td>
            <td @if($client->origin =="") style="background-color: #dd0000;" @endif>{{$client->origin}}</td>
            <td @if($client->date_of_arrival =="") style="background-color: #dd0000;" @endif>{{$client->date_of_arrival}}</td>
            <td>{{$client->present_address}}</td>
            <td>{{$client->ration_card_number}} </td>
            <td @if($client->vul_1 =="") style="background-color: #dd0000;" @endif>{{$client->vul_1}}</td>
            <td>{{$client->vul_2}}</td>
            <td>{{$client->vul_3}}</td>
            <td>{{$client->vul_4}}</td>
            <td>{{$client->vul_5}}</td>
            <td style="background-color: #dd0000;">{{$client->error_descriptions}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>No</th>
        <th>Unique id</th>
        <th>Names</th>
        <th>Sex</th>
        <th>Age</th>
        <th>Marital Status</th>
        <th>Name of Parents</th>
        <th>Name of Spouse</th>
        <th>M</th>
        <th>F</th>
        <th>T</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th> Present address</th>
        <th>Ration Card Number </th>
        <th>Vul 1</th>
        <th>Vul 2</th>
        <th>Vul 3</th>
        <th>Vul 4</th>
        <th>Vul 5</th>
        <th>Error Descriptions</th>
    </tr>
    </tfoot>
</table>