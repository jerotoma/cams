<?php
    $end_time ="";
    $start_time="";
    $range="";
    if($request->start_date != ""){
        $start_time = date("Y-m-d", strtotime($request->start_date));
    }
    if($request->end_date != ""){
        $end_time = date("Y-m-d", strtotime($request->end_date));
    }
    if($start_time != "" && $end_time !=""){
        $range = [$start_time, $end_time];
    }
    ?>
    @if($request->camp_id=="All")
        @foreach(\App\Camp::all() as $camp)
            <table  >
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
                    <th style="text-align:center; background-color: #cccccc"></th>
                </tr>
                <tr>
                    <th></th>
                    <th  style="text-align:center; background-color: #cccccc">F</th>
                    <th  style="text-align:center; background-color: #cccccc">M</th>
                    <th  style="text-align:center; background-color: #cccccc">F</th>
                    <th  style="text-align:center; background-color: #cccccc">M</th>
                    <th  style="text-align:center; background-color: #cccccc">F</th>
                    <th  style="text-align:center; background-color: #cccccc">M</th>
                    <th  style="text-align:center; background-color: #cccccc">F</th>
                    <th  style="text-align:center; background-color: #cccccc">M</th>
                    <th style="text-align:center; background-color: #cccccc">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $t1=$t2=$t3=$t4=$t5=$t6=$t7=$t8=$t9=0
                ?>
                @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
                    <tr>
                        <td>{{$code->description}}</td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}<?php $t1 = $t1 + getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}<?php $t2 = $t2 + getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}<?php $t3 = $t3 + getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}<?php $t4 = $t4 + getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}<?php $t5 = $t5 + getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}<?php $t6 = $t6 +getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}<?php $t7 = $t7 + getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range);?></td>
                        <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}<?php $t8 = $t8 + getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range);?></td>
                        <td>{{getClientsCountAll($code->id,$range,$camp->id)}}<?php $t9 = $t9 + getClientsCountAll($code->id,$range,$camp->id);?></td>
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <td>{{$t1}}</td>
                    <td>{{$t2}}</td>
                    <td>{{$t3}}</td>
                    <td>{{$t4}}</td>
                    <td>{{$t5}}</td>
                    <td>{{$t6}}</td>
                    <td>{{$t7}}</td>
                    <td>{{$t8}}</td>
                    <td>{{$t9}}</td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        @endforeach
    @else
        <?php $camp=\App\Camp::find($request->camp_id);?>
        <table >
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
                <th style="text-align:center; background-color: #cccccc"></th>
            </tr>
            <tr>
                <th></th>
                <th  style="text-align:center; background-color: #cccccc">F</th>
                <th  style="text-align:center; background-color: #cccccc">M</th>
                <th  style="text-align:center; background-color: #cccccc">F</th>
                <th  style="text-align:center; background-color: #cccccc">M</th>
                <th  style="text-align:center; background-color: #cccccc">F</th>
                <th  style="text-align:center; background-color: #cccccc">M</th>
                <th  style="text-align:center; background-color: #cccccc">F</th>
                <th  style="text-align:center; background-color: #cccccc">M</th>
                <th style="text-align:center; background-color: #cccccc">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $t1=$t2=$t3=$t4=$t5=$t6=$t7=$t8=$t9=0
            ?>
            @foreach(\App\PSNCode::where('for_reporting','=','Yes')->get() as $code)
                <tr>
                    <td>{{$code->description}}</td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range)}}<?php $t1 = $t1 + getClientsCountByCreteria($code->id,'Female','A',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range)}}<?php $t2 = $t2 + getClientsCountByCreteria($code->id,'Male','A',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range)}}<?php $t3 = $t3 + getClientsCountByCreteria($code->id,'Female','B',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range)}}<?php $t4 = $t4 + getClientsCountByCreteria($code->id,'Male','B',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range)}}<?php $t5 = $t5 + getClientsCountByCreteria($code->id,'Female','C',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range)}}<?php $t6 = $t6 +getClientsCountByCreteria($code->id,'Male','C',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range)}}<?php $t7 = $t7 + getClientsCountByCreteria($code->id,'Female','D',$camp->id,$range);?></td>
                    <td>{{getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range)}}<?php $t8 = $t8 + getClientsCountByCreteria($code->id,'Male','D',$camp->id,$range);?></td>
                    <td>{{getClientsCountAll($code->id,$range,$camp->id)}}<?php $t9 = $t9 + getClientsCountAll($code->id,$range,$camp->id);?></td>
                </tr>
            @endforeach
            <tr>
                <th>Total</th>
                <td>{{$t1}}</td>
                <td>{{$t2}}</td>
                <td>{{$t3}}</td>
                <td>{{$t4}}</td>
                <td>{{$t5}}</td>
                <td>{{$t6}}</td>
                <td>{{$t7}}</td>
                <td>{{$t8}}</td>
                <td>{{$t9}}</td>
            </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    @endif