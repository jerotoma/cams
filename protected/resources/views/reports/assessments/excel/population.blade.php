<div class="row clearfix" style="margin-top: 20px">
    <div class="col-md-12 column">
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
            <table class="table table-bordered" >
                <thead>
                <tr>
                    <th style="text-align:center; background-color: #cccccc" colspan="10">Detailed Assessments by Category for Nduta & Mtendeni ({{$start_time. " to ". $end_time}} )</th>
                </tr>
                <tr>
                    <th rowspan="2"  >Specific Needs</th>
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
                @foreach(\App\Need::all() as $need)
                    <tr>
                        <td>{{$need->need_name}}</td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Female','A',$range)}}<?php $t1 = $t1 + getClientAssessmentNeedsAll($need->id,'Female','A',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Male','A',$range)}}<?php $t2 = $t2 + getClientAssessmentNeedsAll($need->id,'Male','A',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Female','B',$range)}}<?php $t3 = $t3 + getClientAssessmentNeedsAll($need->id,'Female','B',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Male','B',$range)}}<?php $t4 = $t4 + getClientAssessmentNeedsAll($need->id,'Male','B',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Female','C',$range)}}<?php $t5 = $t5 + getClientAssessmentNeedsAll($need->id,'Female','C',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Male','C',$range)}}<?php $t6 = $t6 +getClientAssessmentNeedsAll($need->id,'Male','C',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Female','D',$range)}}<?php $t7 = $t7 + getClientAssessmentNeedsAll($need->id,'Female','D',$range);?></td>
                        <td>{{getClientAssessmentNeedsAll($need->id,'Male','D',$range)}}<?php $t8 = $t8 + getClientAssessmentNeedsAll($need->id,'Male','D',$range);?></td>
                        <td>{{getClientAssessmentNeedsTotalAll($need->id,$range)}}<?php $t9 = $t9 + getClientAssessmentNeedsTotalAll($need->id,$range);?></td>
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
        @else
            <?php $camp=\App\Camp::find($request->camp_id);?>
            <table class="table table-bordered" >
                <thead>
                <tr>
                    <th style="text-align:center; background-color: #cccccc" colspan="10">Detailed Registration by Category for {{$camp->camp_name}} ({{$start_time. " to ". $end_time}} )</th>
                </tr>
                <tr>
                    <th rowspan="2"  >Specific Needs </th>
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
                @foreach(\App\Need::all() as $need)
                    <tr>
                        <td>{{$need->need_name}}</td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','A',$camp->id,$range)}}<?php $t1 = $t1 + getClientAssessmentNeedsAllByCamp($need->id,'Female','A',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','A',$camp->id,$range)}}<?php $t2 = $t2 + getClientAssessmentNeedsAllByCamp($need->id,'Male','A',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','B',$camp->id,$range)}}<?php $t3 = $t3 + getClientAssessmentNeedsAllByCamp($need->id,'Female','B',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','B',$camp->id,$range)}}<?php $t4 = $t4 + getClientAssessmentNeedsAllByCamp($need->id,'Male','B',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','C',$camp->id,$range)}}<?php $t5 = $t5 + getClientAssessmentNeedsAllByCamp($need->id,'Female','C',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','C',$camp->id,$range)}}<?php $t6 = $t6 +getClientAssessmentNeedsAllByCamp($need->id,'Male','C',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Female','D',$camp->id,$range)}}<?php $t7 = $t7 + getClientAssessmentNeedsAllByCamp($need->id,'Female','D',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCamp($need->id,'Male','D',$camp->id,$range)}}<?php $t8 = $t8 + getClientAssessmentNeedsAllByCamp($need->id,'Male','D',$camp->id,$range);?></td>
                        <td>{{getClientAssessmentNeedsAllByCampTotal($need->id,$range,$camp->id)}}<?php $t9 = $t9 + getClientAssessmentNeedsAllByCampTotal($need->id,$range,$camp->id);?></td>
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
    </div>

</div>