@if($specific_needs="All")
    @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
           @if($camp_id=="All")
            @foreach(\App\Camp::all() as $camp)
                <table>
                    <tr>
                        <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                        <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                    </tr>
                    <tr>
                        <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                        <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                        <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                        <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center">in numbers</td>
                        <td style="text-align: center">in %</td>
                        <td style="text-align: center">in numbers</td>
                        <td style="text-align: center">in %</td>
                        <td style="text-align: center">in numbers</td>
                        <td style="text-align: center">in %</td>
                    </tr>
                    <tr>
                        <td>0-17</td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                    </tr>
                    <tr>
                        <td>18-49</td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                    </tr>
                    <tr>
                        <td>50-59</td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                    </tr>
                    <tr>
                        <td>60 and ></td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                        <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                        <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                    </tr>
                    <tr>
                        <td style=";background-color: #ccc">Total</td>
                        <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                        <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                        <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                        <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                        <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                        <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Major locations:</td>
                        <td colspan="4">{{$camp->camp_name}}</td>
                    </tr>
                </table>
                @endforeach
            @else
            <?php $camp=\App\Camp::find($camp_id);?>
            <table>
                <tr>
                    <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                    <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                </tr>
                <tr>
                    <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                    <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                    <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                    <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: center">in numbers</td>
                    <td style="text-align: center">in %</td>
                    <td style="text-align: center">in numbers</td>
                    <td style="text-align: center">in %</td>
                    <td style="text-align: center">in numbers</td>
                    <td style="text-align: center">in %</td>
                </tr>
                <tr>
                    <td>0-17</td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td>18-49</td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td>50-59</td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td>60 and ></td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td style=";background-color: #ccc">Total</td>
                    <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td colspan="3">Major locations:</td>
                    <td colspan="4">{{$camp->camp_name}}</td>
                </tr>
            </table>
            @endif
    @endforeach
@else
    <?php $code=\App\PSNCode::find($specific_needs);?>
    @if($camp_id=="All")
        @foreach(\App\Camp::all() as $camp)
            <table>
                <tr>
                    <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                    <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
                </tr>
                <tr>
                    <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                    <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                    <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                    <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: center">in numbers</td>
                    <td style="text-align: center">in %</td>
                    <td style="text-align: center">in numbers</td>
                    <td style="text-align: center">in %</td>
                    <td style="text-align: center">in numbers</td>
                    <td style="text-align: center">in %</td>
                </tr>
                <tr>
                    <td>0-17</td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td>18-49</td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td>50-59</td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td>60 and ></td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                    <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td style=";background-color: #ccc">Total</td>
                    <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                    <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                </tr>
                <tr>
                    <td colspan="3">Major locations:</td>
                    <td colspan="4">{{$camp->camp_name}}</td>
                </tr>
            </table>
        @endforeach
    @else
        <?php $camp=\App\Camp::find($camp_id);?>
        <table>
            <tr>
                <th colspan="3" style="text-align: center; background-color: #ccc">Name of Population Planning Group: {{$code->description}} </th>
                <th colspan="4">Activity 1.1.1 Continue the assessment, identification   and documentation of PSNs {{$camp->camp_name}}</th>
            </tr>
            <tr>
                <td rowspan="2" style="text-align: center;background-color: #ccc">Age Group</td>
                <td colspan="2" style="text-align: center ;background-color: #ccc">Male</td>
                <td colspan="2" style="text-align: center ;background-color: #ccc">Female</td>
                <td colspan="2" style="text-align: center ;background-color: #ccc">Total</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center">in numbers</td>
                <td style="text-align: center">in %</td>
                <td style="text-align: center">in numbers</td>
                <td style="text-align: center">in %</td>
                <td style="text-align: center">in numbers</td>
                <td style="text-align: center">in %</td>
            </tr>
            <tr>
                <td>0-17</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','A',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'A',$camp->id,$range)}}</td>
            </tr>
            <tr>
                <td>18-49</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','B',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'B',$camp->id,$range)}}</td>
            </tr>
            <tr>
                <td>50-59</td>
                <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','C',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'C',$camp->id,$range)}}</td>
            </tr>
            <tr>
                <td>60 and ></td>
                <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Male','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteria($code->id,'Female','D',$camp->id,$range)}}</td>
                <td>{{getClientsCountByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
                <td>{{getClientsCountPercentageByCreteriaAgeScore($code->id,'D',$camp->id,$range)}}</td>
            </tr>
            <tr>
                <td style=";background-color: #ccc">Total</td>
                <td>{{getClientsSumCountByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                <td>{{getClientsSumCountPercentageByCreteria($code->id,'Female',$camp->id,$range)}}</td>
                <td>{{getClientsSumCountByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                <td>{{getClientsSumCountPercentageByCreteria($code->id,'Male',$camp->id,$range)}}</td>
                <td>{{getClientsSumCountByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
                <td>{{getClientsSumCountPercentageByCreteriaAgeScore($code->id,$camp->id,$range)}}</td>
            </tr>
            <tr>
                <td colspan="3">Major locations:</td>
                <td colspan="4">{{$camp->camp_name}}</td>
            </tr>
        </table>
    @endif
@endif