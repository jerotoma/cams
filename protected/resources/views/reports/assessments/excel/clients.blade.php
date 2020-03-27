<table class="table datatable-column-search-inputs table-bordered table-hover" id="tab_logic">
    <thead>
    <tr >
        <th>No</th>
        <th>Reg #</th>
        <th>Unique id</th>
        <th>Names
        <th>Sex
        <th>Age
        <th>Marital Status
        <th>Name of Parents
        <th>Name of Spouse
        <th>Number of Males</th>
        <th>Number of Females</th>
        <th>Household Number</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th>Present address</th>
        <th>Ration Card Number</th>
        <th>Relation to the head of household</th>
        <th>Client Needs</th>
        <th>Vul 1</th>
        <th>Vul 2</th>
        <th>Vul 3</th>
        <th>Vul 4</th>
        <th>Vul 5</th>
    </tr>
    </thead>
    <tbody>
    <?php $c=1;?>
    @foreach($clients as $client)
        <?php
        $clients_needs="  ";
        if ($request->clients_needs != "All" ){

            $cneed=\App\Need::find($request->clients_needs);
            $clients_needs=$cneed->need_name;
        }
        else{
            $cneed=\DB::table('vulnerability_assessments')
                ->where('assessment_id','=',$client->assessment_id)
                ->join('client_needs', 'vulnerability_assessments.id', '=', 'client_needs.assessment_id')
                ->where('client_needs.status', '=', "Yes")
                ->join('needs', 'client_needs.need_id', '=', 'needs.id')
                ->select('needs.*')->get();
            foreach ($cneed as $value)
            {
                $clients_needs .=$value->need_name.",";
            }
            $clients_needs=substr($clients_needs,0,strlen($clients_needs)-1);
        }

        ?>
        <tr>
            <td>{{$c++}}</td>
            <td>{{$client->hai_reg_number}}</td>
            <td>{{$client->client_number}}</td>
            <td>{{$client->full_name}}</td>
            <td>{{$client->sex}}</td>
            <td>{{$client->age}}</td>
            <td>{{$client->marital_status}}</td>
            <td>{{$client->care_giver}}</td>
            <td>{{$client->spouse_name}}</td>
            <td>{{$client->males_total}}</td>
            <td>{{$client->females_total}}</td>
            <td>{{$client->females_total + $client->males_total }}</td>
            <td>
                @if(is_object(\App\Client::find($client->id)->fromOrigin) && \App\Client::find($client->id)->fromOrigin)
                    {{\App\Client::find($client->id)->fromOrigin->origin_name}}
                @endif
            </td>
            <td> @if( $client->date_arrival !="1970-01-01"){{$client->date_arrival}}@endif </td>
            <td>{{$client->present_address}}</td>
            <td>{{$client->ration_card_number}}</td>
            <td>{{$client->hh_relation}}</td>
            <td>{{$clients_needs}}</td>
            @if(is_object(\App\Client::find($client->id)->vulnerabilityCodes) && count(\App\Client::find($client->id)->vulnerabilityCodes) >0)
                @foreach(\App\Client::find($client->id)->vulnerabilityCodes as $code)
                    @if(is_object($code->code) && $code->code != null)
                        <td class="text-center">{{$code->code->code}}</td>
                    @endif
                @endforeach
                @for($i=0; $i <(5-count(\App\Client::find($client->id)->vulnerabilityCodes)) ; $i++)
                    <td></td>
                @endfor
            @else
                @for($i=0; $i <5 ; $i++)
                    <td></td>
                @endfor
            @endif

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr >
        <th>No</th>
        <th>Reg #</th>
        <th>Unique id</th>
        <th>Names
        <th>Sex
        <th>Age
        <th>Marital Status
        <th>Name of Parents
        <th>Name of Spouse
        <th>Number of Males</th>
        <th>Number of Females</th>
        <th>Household Number</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th>Present address</th>
        <th>Ration Card Number</th>
        <th>Relation to the head of household</th>
        <th>Client Needs</th>
        <th>Vul 1</th>
        <th>Vul 2</th>
        <th>Vul 3</th>
        <th>Vul 4</th>
        <th>Vul 5</th>
    </tr>
    </tfoot>
</table>