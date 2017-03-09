<table class="table datatable-column-search-inputs table-bordered table-hover" id="tab_logic" >
    <thead>
    <tr>
        <th>No</th>
        <th>Unique id</th>
        <th>Names</th>
        <th>Sex</th>
        <th>Age</th>
        <th>Marital Status</th>
        <th>M</th>
        <th>F</th>
        <th>T</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th>Vul 1</th>
        <th>Amount</th>
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
            <th>{{$client->unique_id}}</th>
            <th @if($client->names =="") style="background-color: #dd0000;" @endif>{{$client->names}}</th>
            <th @if($client->sex =="") style="background-color: #dd0000;" @endif>{{$client->sex}}</th>
            <th @if($client->age =="") style="background-color: #dd0000;" @endif>{{$client->age}}</th>
            <th @if($client->marital_status =="") style="background-color: #dd0000;" @endif>{{$client->marital_status}}</th>
            <th @if($client->m =="") style="background-color: #dd0000;" @endif>{{$client->m}}</th>
            <th @if($client->f =="") style="background-color: #dd0000;" @endif>{{$client->f}}</th>
            <th @if($client->t =="") style="background-color: #dd0000;" @endif>{{$client->t}}</th>
            <th @if($client->origin =="") style="background-color: #dd0000;" @endif>{{$client->origin}}</th>
            <th @if($client->date_of_arrival =="") style="background-color: #dd0000;" @endif>{{$client->date_of_arrival}}</th>
            <th @if($client->vul_1 =="") style="background-color: #dd0000;" @endif>{{$client->vul_1}}</th>
            <th>{{$client->amount}}</th>
            <th style="background-color: #dd0000;">{{$client->error_descriptions}}</th>
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
        <th>M</th>
        <th>F</th>
        <th>T</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th>Vul 1</th>
        <th>Amount</th>
        <th>Error Descriptions</th>
    </tr>
    </tfoot>
</table>