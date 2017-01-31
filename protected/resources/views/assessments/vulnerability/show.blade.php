<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
<head>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/bootstrap_print.css")}}"  media='all'>
</head>
<body style="border-color: #fff">
<div class="portlet-body form">
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <img src="{{asset('assets/images/helpage.png')}}" width="100px" height="100px"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h3><strong>HelpAge International</strong></h3> <br/>
            Box 259, Kibondo Field Office<br/>
            Tel :  ;  Fax : <br/>
            Website : www.helpage.org
        </div>
    </div>
    <hr style="background-color: #e7ecf1 ; border-color: #e7ecf1 ;margin-bottom: 20px"/>
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h4><strong>
                    COMMUNITY BASED REHABILITATION PROGRAMME (CBR)<br/>
                    VULNERABILITY ASSESSMENT FORM
                </strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">General Information - Assessment</th>
                </tr>
                <tr>
                    <th class="col-md-3">Assessors' names:</th>
                    <td class="col-md-4">{{$assessment->q1_1}}</td>
                    <th class="col-md-2">Code</th>
                    <td class="col-md-3">{{$assessment->q1_2}}</td>
                </tr>
                <tr>
                    <th> Camp name</th>
                    <th> District</th>
                    <th colspan="2"> Date of interview</th>
                </tr>
                <tr>
                    <td> {{$assessment->q1_4}}</td>
                    <td> {{$assessment->q1_5}}</td>
                    <td colspan="2"> {{$assessment->q1_3}}</td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Personal Info - Household profile</th>
                </tr>
                <tr>
                    <th class="col-md-3">Full Name</th>
                    <th class="col-md-3">Sex</th>
                    <th class="col-md-3">Age</th>
                    <th class="col-md-3">Civil status</th>

                </tr>
                <tr>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_1}}@endif
                    </td>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_3}}@endif

                    </td>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_4}}@endif

                    </td>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_5}}@endif

                    </td>

                </tr>
                <tr>
                    <th class="col-md-3">Place of origin</th>
                    <th class="col-md-3">Date of arrival</th>
                    <th class="col-md-3">Present address</th>
                    <th class="col-md-3">IDP Registered</th>


                </tr>
                <tr>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_6}}@endif
                    </td>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_7}}@endif

                    </td>
                    <td>
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_8}}@endif

                    </td>
                    <td colspan="2">
                        @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_9}}@endif

                    </td>
                </tr>
                <tr>
                    <th class="col-md-3">Name of the head of household (if different)</th>
                    <th class="col-md-3">Age of head of household</th>
                    <th class="col-md-3">Relation to the head of household:</th>
                    <th class="col-md-3" >No. of children in the HH < 5Y</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_10}}@endif</td>
                    <td > @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_11}}@endif</td>
                    <td >@if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_12}}@endif</td>
                    <td  > @if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_12}}@endif</td>
                </tr>
                <tr>
                    <th class="col-md-6" colspan="2">No. of children between 6 and 18Y</th>
                    <th class="col-md-6" colspan="2"> Number of women</th>
                </tr>
                <tr>
                    <td colspan="2">@if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_12}}@endif</td>
                    <td colspan="2">@if(is_object($assessment->householdProfile) && $assessment->householdProfile != null)
                            {{$assessment->householdProfile->q2_13}}@endif</td>
                </tr>


            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Economic situation</th>
                </tr>
                <tr>
                    <th >Past activity (before displacement)</th>
                    <th >Present activity</th>
                    <th >Household's source of income at the present moment</th>
                    <th >Do you receive any assistance</th>

                </tr>
                <tr>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th>How many family members live with you?</th>
                    <th>Do you share expenses with them</th>
                    <th>How much do you spend per week</th>
                    <th>How often do you buy food?</th>

                </tr>
                <tr>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->economicSituation) && $assessment->economicSituation != null)
                            {{$assessment->economicSituation->q3_8}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Type of vulnerability (fast screening)</th>
                </tr>
                <tr>
                    <th >Older people with impairment?</th>
                    <th >Older people with temporary impairment? </th>
                    <th >Older people with chronic condition</th>
                    <th >Dependency</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Older people head of household?</th>
                    <th >Household without any male presence </th>
                    <th colspan="2">Separation from family members</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_6}}
                        @endif</td>
                    <td colspan="2">@if(is_object($assessment->vulnerabilityType) && $assessment->vulnerabilityType != null)
                            {{$assessment->vulnerabilityType->q4_7}}
                        @endif</td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Type of impairment</th>
                </tr>
                <tr>
                    <th >Physical impairment?</th>
                    <th >Hearing impairment? </th>
                    <th >Speech impairment</th>
                    <th >Visual impairment</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Mental Illness?</th>
                    <th >Need of long term medical treatment? </th>
                    <th >What condition</th>
                    <th >Are drugs available</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_8}}
                        @endif</td>
                </tr>
                <tr>
                    <th colspan="2">What kind of medication?</th>
                    <th colspan="2">For how long can you continue your treatment? </th>

                </tr>
                <tr>
                    <td colspan="2">@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_9}}
                        @endif</td>
                    <td colspan="2">@if(is_object($assessment->impairmentType) && $assessment->impairmentType != null)
                            {{$assessment->impairmentType->q5_10}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="3" class="text-center text-bold">Nutrition</th>
                </tr>
                <tr>
                    <th >Screening?</th>
                    <th >How many meals per day? </th>
                    <th >Source of meal</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->nutrition) && $assessment->nutrition != null)
                            {{$assessment->nutrition->q6_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->nutrition) && $assessment->nutrition != null)
                            {{$assessment->nutrition->q6_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->nutrition) && $assessment->nutrition != null)
                            {{$assessment->nutrition->q6_3}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Independence and participation</th>
                </tr>
                <tr>
                    <th >Are you independent in your daily activities?</th>
                    <th >Bathing:? </th>
                    <th >Using toilets</th>
                    <th >Dressing</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->independenceParticipation->q7_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->independenceParticipation->q7_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->nutrition->q7_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->nutrition->q7_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Eating?</th>
                    <th >Cooking? </th>
                    <th >Cleaning?</th>
                    <th >Community activities</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->independenceParticipation->q7_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->independenceParticipation->q7_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->nutrition->q7_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->independenceParticipation) && $assessment->independenceParticipation != null)
                            {{$assessment->nutrition->q7_8}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Psychosocial</th>
                </tr>
                <tr>
                    <th >Changes in sleep pattern?</th>
                    <th >Images about what happened:? </th>
                    <th >Feeling of being isolated</th>
                    <th >Changes in the appetite</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->psychosocial->q8_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->psychosocial->q8_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->nutrition->q8_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->nutrition->q8_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Changes in behaviour?</th>
                    <th >Crying spells? </th>
                    <th >Scared/fear</th>
                    <th >How would you describe your relationship</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->psychosocial->q8_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->psychosocial->q8_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->nutrition->q8_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->psychosocial) && $assessment->psychosocial != null)
                            {{$assessment->nutrition->q8_8}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold">Protection</th>
                </tr>
                <tr>
                    <th >Isolation and dependency?</th>
                    <th >Family separation? </th>
                    <th >Neglect and deprivation</th>
                    <th >Loss/no documentation</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->protection->q9_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->protection->q9_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->nutrition->q9_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->nutrition->q9_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Discrimination?</th>
                    <th >Violence? </th>
                    <th >Threats and harassment</th>
                    <th >Unsafe living conditions</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->protection->q9_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->protection->q9_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->nutrition->q9_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->protection) && $assessment->protection != null)
                            {{$assessment->nutrition->q9_8}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold"> Needs of items</th>
                </tr>
                <tr>
                    <th >Assisting devices?</th>
                    <th >Crutches? </th>
                    <th >Toilet chair</th>
                    <th >Urine flaks</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >White cane?</th>
                    <th >Walking aids? </th>
                    <th >Wheel chairs</th>
                    <th >Incontinent kit</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_8}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Bedpan?</th>
                    <th >Needs for specific Items? </th>
                    <th >Mattresses</th>
                    <th >Blanket</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_9}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_10}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_11}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_12}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Stove?</th>
                    <th >Toileteries? </th>
                    <th >Diapers</th>
                    <th >Jarrican</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_13}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_14}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_15}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_16}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Clothing?</th>
                    <th >Dignity kit men? </th>
                    <th >Dignity kit women</th>
                    <th >Underwear</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_17}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_18}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_19}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_20}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Needs for protection items?</th>
                    <th >Flashlight? </th>
                    <th >Whistle</th>
                    <th >Radio</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_21}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->itemsNeeds->q10_22}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_23}}
                        @endif</td>
                    <td >@if(is_object($assessment->itemsNeeds) && $assessment->itemsNeeds != null)
                            {{$assessment->nutrition->q10_24}}
                        @endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" class="text-center text-bold"> Referral</th>
                </tr>
                <tr>
                    <th >Needs for referral?</th>
                    <th >Health? </th>
                    <th >Psychosocial</th>
                    <th >Child protection</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->referral->q11_1}}
                        @endif</td>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->referral->q11_2}}
                        @endif</td>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->nutrition->q11_3}}
                        @endif</td>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->nutrition->q11_4}}
                        @endif</td>
                </tr>
                <tr>
                    <th >Shelter?</th>
                    <th >NFIs? </th>
                    <th >Livelihood</th>
                    <th >Nutrition</th>
                </tr>
                <tr>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->referral->q11_5}}
                        @endif</td>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->referral->q11_6}}
                        @endif</td>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->nutrition->q11_7}}
                        @endif</td>
                    <td >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->nutrition->q11_8}}
                        @endif</td>
                </tr>
                <tr>
                    <th class="col-md-6" colspan="2">Shelter?</th>
                    <th class="col-md-6" colspan="2">NFIs? </th>
                </tr>
                <tr>
                    <td class="col-md-6" colspan="2" >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->referral->q11_9}}
                        @endif</td>
                    <td class="col-md-6" colspan="2" >@if(is_object($assessment->referral) && $assessment->referral != null)
                            {{$assessment->referral->q11_10}}
                        @endif
                    </td>

                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th  class="text-center text-bold"> Personal observation of vulnerability focal point/volunteer. Comments</th>
                </tr>
                <tr>
                    <td >{{$assessment->referral->comments}}</td>

                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" style="margin-top: 10px">
                <thead>
                <tr>
                    <th colspan="4">Examined By:</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Signature</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $assessment->examiner_name; ?></td>
                    <td><?php echo $assessment->examiner_title; ?></td>
                    <td><?php  if($assessment->consultation_date != "") echo date("j F, Y",strtotime($assessment->consultation_date)); ?></td>
                    <td></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>