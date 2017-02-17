@if($camp_id=="All")
@foreach(\App\Camp::all() as $camp)
    <table border="1">
        <thead>
        <tr>
            <th style="text-align:center; background-color: #cccccc" colspan="10">Detailed Registration by Category for {{$camp->camp_name}} ({{$start_time. " to ". $end_time}} )</th>
        </tr>
        <tr>
            <th rowspan="2"  >Specific Needs & Codes </th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">0-17 Yrs</th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">18-49 Yrs</th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">50-59yrs</th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">60 and ></th>
            <th></th>
        </tr>
        <tr>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
            <tr>
                <td>{{$code->description}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountAll($code->id,$range,$camp->id)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
    @endforeach
    @else
    <?php $camp=\App\Camp::find($camp_id);?>
    <table border="1">
        <thead>
        <tr>
            <th style="text-align:center; background-color: #cccccc" colspan="10">Detailed Registration by Category for {{$camp->camp_name}} ({{$start_time. " to ". $end_time}} )</th>
        </tr>
        <tr>
            <th rowspan="2" >Specific Needs & Codes </th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">0-17 Yrs</th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">18-49 Yrs</th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">50-59yrs</th>
            <th colspan="2" style="text-align:center; background-color: #cccccc">60 and ></th>
            <th></th>
        </tr>
        <tr>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>F</th>
            <th>M</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
            <tr>
                <td>{{$code->description}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountAll($code->id,$range,$camp->id)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>

@endif

<table border="1">
    <thead>
    <tr>
        <th colspan="22" align="center">All clients details</th>
    </tr>
    <tr>
        <th colspan="5" align="center">Client Details</th>
        <th colspan="14" align="center">Assessment Details</th>
        <th colspan="3" align="center">Disability Details</th>
    </tr>
    <tr>
        <th> Date registered </th>
        <th> File number  </th>
        <th> Client Name </th>
        <th> Sex </th>
        <th>Date of  Birth </th>
        <th>Nationality </th>
        <th>Date of first consultation </th>
        <th>Consultation No </th>
        <th>Diagnosis </th>
        <th>Medical History</th>
        <th>School/employment </th>
        <th>Social History </th>
        <th> Skin condition </th>
        <th> Activities of daily living </th>
        <th> Joint assessment </th>
        <th> Muscle assessment </th>
        <th> Functional assessment </th>
        <th> Problem list </th>
        <th> Treatment </th>
        <th> Remarks </th>
        <th>Disability Category</th>
        <th>Disability/Diagnosis</th>
        <th>Remarks</th>
    </tr>
    </thead>
</table>