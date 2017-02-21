@if($camp_id=="All")
    @foreach(\App\Camp::all() as $camp)
        <table>
            <tr>
                <th style="text-align: center; background-color: #ccc" colspan="5">Population Planning Groups as at {{$camp->camp_name}} ({{$start_time. " to ". $end_time}}</th>
            </tr>
            <tr>
                <th style="text-align: center; background-color: #ccc">Age group</th>
                <th style="text-align: center; background-color: #ccc">Females</th>
                <th style="text-align: center; background-color: #ccc">Males</th>
                <th style="text-align: center; background-color: #ccc">Total</th>
                <th style="text-align: center; background-color: #ccc">%</th>
            </tr>
            <tr>
                <td>0-17 Yrs   </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Female','A',$camp->id,$range)}} </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Male','A',$camp->id,$range)}} </td>
                <td> {{getClientNumberByAgeScoreByCamp('A',$camp->id,$range)}} </td>
                <td> {{getClientPercentageByAgeScoreByCamp('A',$camp->id,$range)}} </td>
            </tr>
            <tr>
                <td>18-49 Yrs  </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Female','B',$camp->id,$range)}} </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Male','B',$camp->id,$range)}} </td>
                <td> {{getClientNumberByAgeScoreByCamp('B',$camp->id,$range)}} </td>
                <td> {{getClientPercentageByAgeScoreByCamp('B',$camp->id,$range)}} </td>
            </tr>
            <tr>
                <td>50-59 Yrs   </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Female','C',$camp->id,$range)}} </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Male','C',$camp->id,$range)}} </td>
                <td> {{getClientNumberByAgeScoreByCamp('C',$camp->id,$range)}} </td>
                <td> {{getClientPercentageByAgeScoreByCamp('C',$camp->id,$range)}} </td>
            </tr>
            <tr>

                <td>60 and > Yrs</td>
                <td> {{getClientNumberBySexAgescoreByCamp('Female','D',$camp->id,$range)}} </td>
                <td> {{getClientNumberBySexAgescoreByCamp('Male','D',$camp->id,$range)}} </td>
                <td> {{getClientNumberByAgeScoreByCamp('D',$camp->id,$range)}} </td>
                <td> {{getClientPercentageByAgeScoreByCamp('D',$camp->id,$range)}} </td>
            </tr>
            <tr>
                <th>Total</th>
                <td> {{getClientNumberBySexByCamp('Female',$camp->id,$range)}} </td>
                <td> {{getClientNumberBySexByCamp('Male',$camp->id,$range)}} </td>
                <td> {{getAllClientsNumberByCamp($camp->id,$range)}} </td>
                <td> 100% </td>
            </tr>
        </table>
        @endforeach
    @else
    <?php $camp=\App\Camp::find($camp_id);?>
    <table>
        <tr>
            <th style="text-align: center; background-color: #ccc" colspan="5">Population Planning Groups as at {{$camp->camp_name}} ({{$start_time. " to ". $end_time}}</th>
        </tr>
        <tr>
            <th style="text-align: center; background-color: #ccc">Age group</th>
            <th style="text-align: center; background-color: #ccc">Females</th>
            <th style="text-align: center; background-color: #ccc">Males</th>
            <th style="text-align: center; background-color: #ccc">Total</th>
            <th style="text-align: center; background-color: #ccc">%</th>
        </tr>
        <tr>
            <td>0-17 Yrs   </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Female','A',$camp->id,$range)}} </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Male','A',$camp->id,$range)}} </td>
            <td> {{getClientNumberByAgeScoreByCamp('A',$camp->id,$range)}} </td>
            <td> {{getClientPercentageByAgeScoreByCamp('A',$camp->id,$range)}} </td>
        </tr>
        <tr>
            <td>18-49 Yrs  </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Female','B',$camp->id,$range)}} </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Male','B',$camp->id,$range)}} </td>
            <td> {{getClientNumberByAgeScoreByCamp('B',$camp->id,$range)}} </td>
            <td> {{getClientPercentageByAgeScoreByCamp('B',$camp->id,$range)}} </td>
        </tr>
        <tr>
            <td>50-59 Yrs   </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Female','C',$camp->id,$range)}} </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Male','C',$camp->id,$range)}} </td>
            <td> {{getClientNumberByAgeScoreByCamp('C',$camp->id,$range)}} </td>
            <td> {{getClientPercentageByAgeScoreByCamp('C',$camp->id,$range)}} </td>
        </tr>
        <tr>

            <td>60 and > Yrs</td>
            <td> {{getClientNumberBySexAgescoreByCamp('Female','D',$camp->id,$range)}} </td>
            <td> {{getClientNumberBySexAgescoreByCamp('Male','D',$camp->id,$range)}} </td>
            <td> {{getClientNumberByAgeScoreByCamp('D',$camp->id,$range)}} </td>
            <td> {{getClientPercentageByAgeScoreByCamp('D',$camp->id,$range)}} </td>
        </tr>
        <tr>
            <th>Total</th>
            <td> {{getClientNumberBySexByCamp('Female',$camp->id,$range)}} </td>
            <td> {{getClientNumberBySexByCamp('Male',$camp->id,$range)}} </td>
            <td> {{getAllClientsNumberByCamp($camp->id,$range)}} </td>
            <td> 100% </td>
        </tr>
    </table>
@endif