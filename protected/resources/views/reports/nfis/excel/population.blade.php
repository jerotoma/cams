<div class="row clearfix" style="margin-top: 20px">
    <div class="col-md-12 column">
        @if($request->camp_id =="All")
            <table class="table table-bordered table-hover">
                <tr>
                    <td colspan="3" valign="top" style="background-color: #ccc">Name of Population Planning Group:</td>
                    <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of    unconditional cash assistance to {{getClientCountCashProvisionByCriteriaInNumberTotalByAll($range)}} EVIs to cater for unmet needs.</td>
                </tr>
                <tr style="background-color: #ccc">
                    <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                </tr>
                <tr>
                    <td  valign="top">0-17</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('A','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentage('A','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('A','Female',$range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentage('A','Female',$range)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotal('A',$range)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotal('A',$range)}}</td>
                </tr>
                <tr>
                    <td  valign="top">18-49</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('B','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentage('B','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('B','Female',$range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentage('B','Female',$range)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotal('B',$range)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotal('B',$range)}}</td>
                </tr>
                <tr>
                    <td  valign="top">50-59</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('C','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentage('C','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('C','Female',$range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentage('C','Female',$range)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotal('C',$range)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotal('C',$range)}}</td>
                </tr>
                <tr>
                    <td  valign="top">60 and &gt;</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('D','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentage('D','Male',$range)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumber('D','Female',$range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentage('D','Female',$range)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotal('D',$range)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotal('D',$range)}}</td>
                </tr>
                <tr>
                    <td  valign="top" ><strong>Total:</strong></td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalBySex('Male',$range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalBySex('Male',$range)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalBySex('Female',$range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalBySex('Female',$range)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalByAll($range)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalByAll($range)}} </td>
                </tr>
                <tr>
                    <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                    <td  colspan="5" valign="top" style="background-color: #ccc">Nduta Mtendeni</td>
                </tr>
            </table>
        @else
            <?php $camp=\App\Camp::find($request->camp_id);?>
            <table class="table table-bordered table-hover">
                <tr>
                    <td colspan="3" valign="top" style="background-color: #ccc">Name of Population Planning Group:</td>
                    <td  colspan="4" valign="top" style="background-color: #ccc">Activity 1.2.9: Provision of    unconditional cash assistance to {{getClientCountCashProvisionByCriteriaInNumberTotalByAllByCamp($range,$camp->id)}} EVIs to cater for unmet needs.</td>
                </tr>
                <tr style="background-color: #ccc">
                    <td rowspan="2" style="background-color: #ccc"><strong>Age Group</strong></td>
                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Male</strong></td>
                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Female</strong></td>
                    <td  colspan="2" valign="top" style="background-color: #ccc"><strong>Total</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in    numbers</strong></td>
                    <td  valign="top" style="background-color: #ccc"><strong>in %</strong></td>
                </tr>
                <tr>
                    <td  valign="top">0-17</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('A','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('A','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('A','Female',$range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('A','Female',$range,$camp->id)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalByCamp('A',$range,$camp->id)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalByCamp('A',$range,$camp->id)}}</td>
                </tr>
                <tr>
                    <td  valign="top">18-49</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('B','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('B','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('B','Female',$range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('B','Female',$range,$camp->id)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalByCamp('B',$range,$camp->id)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalByCamp('B',$range,$camp->id)}}</td>
                </tr>
                <tr>
                    <td  valign="top">50-59</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('C','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('C','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('C','Female',$range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('C','Female',$range,$camp->id)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalByCamp('C',$range,$camp->id)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalByCamp('C',$range,$camp->id)}}</td>
                </tr>
                <tr>
                    <td  valign="top">60 and &gt;</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('D','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('D','Male',$range,$camp->id)}}</td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberByCamp('D','Female',$range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageByCamp('D','Female',$range,$camp->id)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalByCamp('D',$range,$camp->id)}} </td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalByCamp('D',$range,$camp->id)}}</td>
                </tr>
                <tr>
                    <td  valign="top" ><strong>Total:</strong></td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalBySexByCamp('Male',$range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalBySexByCamp('Male',$range,$camp->id)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalBySexByCamp('Female',$range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalBySexByCamp('Female',$range,$camp->id)}} </td>
                    <td  valign="bottom">{{getClientCountCashProvisionByCriteriaInNumberTotalByAllByCamp($range,$camp->id)}}</td>
                    <td  valign="top">{{getClientCountCashProvisionByCriteriaInPercentageTotalByAllByCamp($range,$camp->id)}} </td>
                </tr>
                <tr>
                    <td  colspan="2" valign="top" style="background-color: #ccc">Major locations:</td>
                    <td  colspan="5" valign="top" style="background-color: #ccc">{{$camp->camp_name}}</td>
                </tr>
            </table>
        @endif
    </div>

</div>