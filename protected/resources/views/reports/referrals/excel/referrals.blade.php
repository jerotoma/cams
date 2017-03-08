<table class="table datatable-basic table-hover">
    <thead>
    <tr>
        <th>SNO</th>
        <th>Referral Ref</th>
        <th>Date of Referral</th>
        <th>Unique Id</th>
        <th>Full Name</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Camp</th>
        <th>Progress status</th>
        <th>Referring agency</th>
        <th >Receiving Agency</th>
    </tr>
    </thead>
    <tbody>
    <?php $co=1;?>
    @foreach($referrals as $referral)
        <tr>
            <td>{{$co++}}</td>
            <td>{{$referral->reference_no}}</td>
            <td>{{$referral->referral_date}}</td>
            <td>@if(is_object(\App\Client::find($referral->client_id))){{\App\Client::find($referral->client_id)->client_number}}@endif</td>
            <td>@if(is_object(\App\Client::find($referral->client_id))){{\App\Client::find($referral->client_id)->full_name}}@endif</td>
            <td>@if(is_object(\App\Client::find($referral->client_id))){{\App\Client::find($referral->client_id)->age}}@endif</td>
            <td>@if(is_object(\App\Client::find($referral->client_id))){{\App\Client::find($referral->client_id)->sex}}@endif</td>
            <td>@if(is_object(\App\Client::find($referral->client_id))){{\App\Client::find($referral->client_id)->camp->camp_name}}@endif</td>
            <td>{{$referral->status}}</td>
            <td>@if(is_object(\App\ClientReferral::find($referral->id)->referringAgency))
                    {{\App\ClientReferral::find($referral->id)->referringAgency->ref_organisation}} @endif
            </td>
            <td>@if(is_object(\App\ClientReferral::find($referral->id)->receivingAgency))
                    {{\App\ClientReferral::find($referral->id)->receivingAgency->rec_organisation}} @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>SNO</th>
        <th>Referral Ref</th>
        <th>Date of Referral</th>
        <th>Unique Id</th>
        <th>Full Name</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Camp</th>
        <th>Progress status</th>
        <th>Referring agency</th>
        <th >Receiving Agency</th>
    </tr>
    </tfoot>

</table>