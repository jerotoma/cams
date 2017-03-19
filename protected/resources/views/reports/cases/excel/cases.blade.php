<table class="table datatable-basic table-hover">
    <thead>
    <tr>
        <th rowspan="2">SNO</th>
        <th rowspan="2">Reference #</th>
        <th rowspan="2">Open Date</th>
        <th rowspan="2">Case Type</th>
        <th rowspan="2">Descriptions</th>
        <th rowspan="2">Initial Action</th>
        <th rowspan="2">Feedback</th>
        <th rowspan="2">Planning</th>
        <th rowspan="2">Case Worker Name</th>
        <th rowspan="2">Progress Status</th>
        <th rowspan="2">Camp Name</th>
        <th colspan="17" align="center" class="text-center">Related Client</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Client HAI Reg number</th>
        <th>Client Names</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Marital Status</th>
        <th>Household Number</th>
        <th>Origin</th>
        <th>Date of Arrival</th>
        <th>Present address</th>
        <th>Ration Card Number</th>
        <th>Relation to the head of household</th>
        <th colspan="5">Vulnerability Code</th>
    </tr>
    </thead>
    <tbody>
    <?php $co=1;?>
    @foreach($cases as $case)
        <tr>
            <td>{{$co++}}</td>
            <td>{{$case->reference_number}}</td>
            <td>{{$case->open_date}}</td>
            <td>{{$case->case_type}}</td>
            <td><?php echo strip_tags($case->descriptions);?></td>
            <td><?php echo strip_tags($case->initial_action);?></td>
            <td><?php echo strip_tags($case->feedback);?></td>
            <td><?php echo strip_tags($case->planning);?></td>
            <td><?php echo strip_tags($case->case_worker_name);?></td>
            <td><?php echo strip_tags($case->status);?></td>
            <td>@if(is_object(\App\ClientCase::find($case->id)->camp) && \App\ClientCase::find($case->id)->camp != null ) {{\App\ClientCase::find($case->id)->camp->camp_name}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->client_number}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->full_name}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->age}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->sex}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->marital_status}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->household_number}}@endif</td>
            <td>
                @if(is_object(\App\Client::find($case->client_id)->fromOrigin) && \App\Client::find($case->client_id)->fromOrigin)
                    {{\App\Client::find($case->client_id)->fromOrigin->origin_name}}
                @endif
            </td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->date_arrival}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->present_address}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->ration_card_number}}@endif</td>
            <td>@if(is_object(\App\Client::find($case->client_id))){{\App\Client::find($case->client_id)->hh_relation}}@endif</td>
            @if(is_object(\App\Client::find($case->client_id)->vulnerabilityCodes) && count(\App\Client::find($case->client_id)->vulnerabilityCodes) >0)
                @foreach(\App\Client::find($case->client_id)->vulnerabilityCodes as $code)
                    @if(is_object($code->code) && $code->code != null)
                        <td class="text-center">{{$code->code->code}}</td>
                    @endif
                @endforeach
                @for($i=0; $i <(5-count(\App\Client::find($case->client_id)->vulnerabilityCodes)) ; $i++)
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

</table>