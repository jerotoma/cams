<div class="row clearfix" style="margin-top: 20px">
    <div class="col-md-12 column">
        @if($request->camp_id =="All")
            @if($request->items =="All")
                @foreach(\App\ItemsInventory::all() as $item)
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                            <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                        </tr>
                        <tr style="background-color: #ccc">
                            <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                        </tr>
                        <tr>
                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                        </tr>
                        <tr>
                            <td  valign="top">0-17</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('A','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Female',$range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('A','Female',$range,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('A',$range,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('A',$range,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top">18-49</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('B','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Female',$range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('B','Female',$range,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('B',$range,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('B',$range,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top">50-59</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('C','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Female',$range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('C','Female',$range,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('C',$range,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('C',$range,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top">60 and &gt;</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('D','Male',$range,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Female',$range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('D','Female',$range,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('D',$range,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('D',$range,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top" ><strong>Total:</strong></td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Male',$range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Male',$range,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Female',$range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Female',$range,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAll($range,$item->id)}} </td>
                        </tr>
                        <tr>
                            <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                            <td  colspan="5" valign="top" style="background-color: #ccc">Nduta Mtendeni</td>
                        </tr>
                    </table>
                @endforeach
            @else
                <?php $item =\App\ItemsInventory::findorfail($request->items);?>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                        <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                    </tr>
                    <tr style="background-color: #ccc">
                        <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                    </tr>
                    <tr>
                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                    </tr>
                    <tr>
                        <td  valign="top">0-17</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('A','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('A','Female',$range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('A','Female',$range,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('A',$range,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('A',$range,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top">18-49</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('B','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('B','Female',$range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('B','Female',$range,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('B',$range,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('B',$range,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top">50-59</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('C','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('C','Female',$range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('C','Female',$range,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('C',$range,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('C',$range,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top">60 and &gt;</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentage('D','Male',$range,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumber('D','Female',$range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentage('D','Female',$range,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotal('D',$range,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotal('D',$range,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top" ><strong>Total:</strong></td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Male',$range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Male',$range,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySex('Female',$range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySex('Female',$range,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAll($range,$item->id)}} </td>
                    </tr>
                    <tr>
                        <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                        <td  colspan="5" valign="top" style="background-color: #ccc">Nduta Mtendeni</td>
                    </tr>
                </table>
            @endif
        @else
            <?php $camp=\App\Camp::find($request->camp_id);?>
            @if($request->items =="All")
                @foreach(\App\ItemsInventory::all() as $item)
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                            <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                        </tr>
                        <tr style="background-color: #ccc">
                            <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                            <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                        </tr>
                        <tr>
                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                            <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                        </tr>
                        <tr>
                            <td  valign="top">0-17</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Female',$range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Female',$range,$camp->id,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('A',$range,$camp->id,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('A',$range,$camp->id,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top">18-49</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Female',$range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Female',$range,$camp->id,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('B',$range,$camp->id,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('B',$range,$camp->id,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top">50-59</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Female',$range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Female',$range,$camp->id,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('C',$range,$camp->id,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('C',$range,$camp->id,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top">60 and &gt;</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Female',$range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Female',$range,$camp->id,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('D',$range,$camp->id,$item->id)}} </td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('D',$range,$camp->id,$item->id)}}</td>
                        </tr>
                        <tr>
                            <td  valign="top" ><strong>Total:</strong></td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Male',$range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Male',$range,$camp->id,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Female',$range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Female',$range,$camp->id,$item->id)}} </td>
                            <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAllByCamp($range,$camp->id,$item->id)}}</td>
                            <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAllByCamp($range,$camp->id,$item->id)}} </td>
                        </tr>
                        <tr>
                            <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                            <td  colspan="5" valign="top" style="background-color: #ccc">{{$camp->camp_name}}</td>
                        </tr>
                    </table>
                @endforeach
            @else
                <?php $item =\App\ItemsInventory::findorfail($request->items);?>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="3" valign="top" style="background-color: #ccc">Name of NFI Item: {{$item->item_name}}</td>
                        <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of  NFIs Items to {{getClientCountItemDistributionByCriteriaInNumberTotalByAll($range,$item->id)}} EVIs to cater for unmet needs.</td>
                    </tr>
                    <tr style="background-color: #ccc">
                        <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                        <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                    </tr>
                    <tr>
                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                        <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                    </tr>
                    <tr>
                        <td  valign="top">0-17</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('A','Female',$range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('A','Female',$range,$camp->id,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('A',$range,$camp->id,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('A',$range,$camp->id,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top">18-49</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('B','Female',$range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('B','Female',$range,$camp->id,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('B',$range,$camp->id,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('B',$range,$camp->id,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top">50-59</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('C','Female',$range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('C','Female',$range,$camp->id,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('C',$range,$camp->id,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('C',$range,$camp->id,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top">60 and &gt;</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberByCamp('D','Female',$range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageByCamp('D','Female',$range,$camp->id,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByCamp('D',$range,$camp->id,$item->id)}} </td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByCamp('D',$range,$camp->id,$item->id)}}</td>
                    </tr>
                    <tr>
                        <td  valign="top" ><strong>Total:</strong></td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Male',$range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Male',$range,$camp->id,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalBySexByCamp('Female',$range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalBySexByCamp('Female',$range,$camp->id,$item->id)}} </td>
                        <td  valign="bottom">{{getClientCountItemDistributionByCriteriaInNumberTotalByAllByCamp($range,$camp->id,$item->id)}}</td>
                        <td  valign="top">{{getClientCountItemDistributionByCriteriaInPercentageTotalByAllByCamp($range,$camp->id,$item->id)}} </td>
                    </tr>
                    <tr>
                        <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                        <td  colspan="5" valign="top" style="background-color: #ccc">{{$camp->camp_name}}</td>
                    </tr>
                </table>
            @endif
        @endif
    </div>

</div>