<div class="portlet light bordered">
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12 col-xs-12 text-center">
                    <img src="{{asset('assets/images/helpage.png')}}" width="100px" height="100px"/>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <h4 class="text-uppercase text-center"><strong>CASH POST-DISTRIBUTION MONITORING</strong></h4>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <h5>1.0 Administrative Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td  valign="top" class="col-md-1"><br />
                                <strong>1.1</strong></td>
                            <th  valign="top" class="col-md-6"><p>District</p></th>
                            <td  valign="top" class="col-md-5"><p> @if($assessment->district_id != "")
                                        {{\App\District::findorfail($assessment->district_id)->district_name}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.2</strong></p></td>
                            <td  valign="top"><p>Village/Camp Name</p></td>
                            <td  valign="top"><p> @if($assessment->camp_id != "")
                                        {{\App\Camp::findorfail($assessment->camp_id)->camp_name}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.3</strong></p></td>
                            <td  valign="top"><p>Date of Interview</p></td>
                            <td  valign="top"><p>{{$assessment->interview_date}}</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.4</strong></p></td>
                            <td  valign="top"><p>Interview starting time</p></td>
                            <td  valign="top"><p>{{$assessment->interview_start_time}}</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.5</strong></p></td>
                            <td  valign="top"><p>Interview finishing time</p></td>
                            <td  valign="top"><p>{{$assessment->interview_end_time}}</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.6</strong></p></td>
                            <td  valign="top"><p>Organisation (HelpAge or    Partner Org)</p></td>
                            <td  valign="top"><p>{{$assessment->organisation}}</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.7</strong></p></td>
                            <td  valign="top"><p>Name of Enumerator</p></td>
                            <td  valign="top"><p>{{$assessment->enumerator_name}}</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>1.8</strong></p></td>
                            <td  valign="top"><p>Name of Respondent    (optional)</p></td>
                            <td  valign="top"><p>{{$assessment->respondent_name}}</p></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <h5>2.0  Demographic Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td  valign="top" class="col-md-1"><br />
                                <strong>2.1</strong></td>
                            <td  colspan="2" valign="top" class="col-md-6"><p>Gender of the Respondent <strong>(1= M, 2=F)</strong></p></td>
                            <td  valign="top" class="col-md-5"><p> @if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_1}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>2.2</strong></p></td>
                            <td  colspan="2" valign="top"><p>Age of the Respondent</p></td>
                            <td  valign="top"><p> @if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_2}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>2.3</strong></p></td>
                            <td  colspan="2" valign="top"><p>Gender of the head of the    HH <strong>(1= M, 2=F)</strong></p></td>
                            <td  valign="top"><p> @if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_3}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>2.4</strong></p></td>
                            <td  colspan="2" valign="top"><p>Is the HH headed by a    person over 60? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_4}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>2.5</strong></p></td>
                            <td  colspan="2" valign="top"><p>Is the HH headed by a    person with a disability? <strong>(1=Yes, 2=    No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_5}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>2.6</strong></p></td>
                            <td  colspan="2" valign="top"><p>Number of people in the HH</p></td>
                            <td  valign="top"><p>@if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_6}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>2.7</strong></p></td>
                            <td  colspan="2" valign="top"><p>Number of older people (over    60) in your HH [including HH Head]</p></td>
                            <td  valign="top"><p>@if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_7}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  rowspan="3" valign="top"><p><strong>2.8</strong></p></td>
                            <td  colspan="2" valign="top"><p>What best describes your    household status </p></td>
                            <td  valign="top"><p>@if(is_object($assessment->demographicDetails))
                                        {{$assessment->demographicDetails->q2_8}}
                                    @endif</p></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <h5>3.0  Distribution of Cash withdrawal Mechanism/Registration with Cash Withdrawal  Agent</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td  valign="top" class="col-md-1"><p><strong>3.1</strong></p></td>
                            <td  valign="top" class="col-md-6"><p>How many hours did it take    you to travel to the voucher/cash card/token distribution/registration?<br />
                                    <strong>1=</strong> &lt;0.5 hours, <strong>2=</strong> 0.5-1 hour, <strong>3=</strong> 1-1.5 hours, <strong>4=</strong> 1.5-2 hours, <strong>5=</strong> 2-2.5 hours,<strong>6=</strong>  &gt;2.5 hours</p></td>
                            <td  valign="top" class="col-md-5"><p>@if(is_object($assessment->cashWithdrawal))
                                        {{$assessment->cashWithdrawal->q3_1}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>3.2</strong></p></td>
                            <td  valign="top"><p>How much did you pay for    transport to get to the distribution/registration site? (Specify Currency)</p></td>
                            <td  valign="top"><p>@if(is_object($assessment->cashWithdrawal))
                                        {{$assessment->cashWithdrawal->q3_2}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>3.3</strong></p></td>
                            <td  valign="top"><p>How long did you have to    wait at the distribution site to get your voucher/cash card/token    distribution?<br />
                                    <strong>1=</strong> &lt;0.5 hours, <strong>2=</strong> 0.5-1 hour, <strong>3=</strong> 1-1.5 hours, <strong>4=</strong> 1.5-2 hours, <strong>5=</strong> 2-2.5 hours,<strong>6=</strong>  &gt;2.5 hours</p></td>
                            <td  valign="top"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->cashWithdrawal))
                                        {{$assessment->cashWithdrawal->q3_3}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>3.4</strong></p></td>
                            <td  valign="top"><p>Was the length of time you    spent travelling to collect the voucher/cash card/token was acceptable? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->cashWithdrawal))
                                        {{$assessment->cashWithdrawal->q3_4}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>3.5</strong></p></td>
                            <td  valign="top"><p>Did the distribution team    treat you with dignity and respect? <strong>(1=Yes,    2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->cashWithdrawal))
                                        {{$assessment->cashWithdrawal->q3_5}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>3.6</strong></p></td>
                            <td  valign="top"><p>Rank the level of security    at the voucher/token/cash card distribution site<br />
                                    <strong>1= Good                        2= Fair                   3= Poor</strong></p></td>
                            <td  valign="top"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->cashWithdrawal))
                                        {{$assessment->cashWithdrawal->q3_6}}
                                    @endif</p></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <h5>4.0 Physically  receiving the cash</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td  valign="top" class="col-md-1"><br />
                                <strong>4.1</strong></td>
                            <td  valign="top" class="col-md-6"><p>Was it you or a proxy that    received the cash at the bank? <br />
                                    <strong>1=</strong>You-the targeted beneficiary,<strong> 2= </strong>Proxy<strong></strong></p></td>
                            <td  valign="top" class="col-md-5"><p> @if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_1}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.2</strong></p></td>
                            <td  valign="top"><p>If answered proxy to    previous question, did your proxy give you the cash?<br />
                                    1= Yes, 2=Some, 3=None</p></td>
                            <td  valign="top"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_2}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.3</strong></p></td>
                            <td  valign="top"><p>How many hours did    you/proxy take to travel to receive the cash?<br />
                                    <strong>1=</strong> &lt;0.5 hours, <strong>2=</strong> 0.5-1 hour, <strong>3=</strong> 1-1.5 hours, <strong>4=</strong> 1.5-2 hours, <strong>5=</strong> 2-2.5 hours,<strong>6=</strong>  &gt;2.5 hours</p></td>
                            <td  valign="top"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_3}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.4</strong></p></td>
                            <td  colspan="2" valign="top"><p>How much did you/proxy    spend on transport to reach the cash distribution site?<br />
                                    @if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_4}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.5</strong></p></td>
                            <td  valign="top"><p>How long did you/proxy have    to wait to receive the cash?<br />
                                    <strong>1=</strong> &lt;0.5 hours, <strong>2=</strong> 0.5-1 hour, <strong>3=</strong> 1-1.5 hours, <strong>4=</strong> 1.5-2 hours, <strong>5=</strong> 2-2.5 hours,<strong>6=</strong>  &gt;2.5 hours</p></td>
                            <td  valign="top"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_5}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.6</strong></p></td>
                            <td  valign="top"><p>Was the length of time you/proxy    spent travelling to receive the cash acceptable? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_6}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.7</strong></p></td>
                            <td  valign="top"><p>Was the frequency of which    the cash was distributed suited to your household needs? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_7}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.8</strong></p></td>
                            <td  valign="top"><p>Was the transfer sufficient    to cover your household&rsquo;s basic needs? <strong>(1=Yes,    2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_8}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.9</strong></p></td>
                            <td  valign="top"><p>Would you prefer to receive    goods/food than cash? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_9}}
                                    @endif</p></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" style="margin-top: 5px;">
                        <tr>
                            <td  valign="top" class="col-md-1"><p><strong>4.10</strong></p></td>
                            <td  valign="top" class="col-md-3"><p>How much cash did you    receive?<br />
                                   </p></td>
                            <td  valign="top" class="col-md-2"><p> <strong>@if(is_object($assessment->physicallyReceivingCash))
                                            {{$assessment->physicallyReceivingCash->q4_10}}
                                        @endif</strong></p></td>
                            <td  valign="top" class="col-md-3"><p>Was this the amount you    expected? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" class="col-md-3"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_10_1}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.11</strong></p></td>
                            <td  colspan="2" valign="top"><p>Did you have to pay anyone    to receive your cash? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_11}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.12</strong></p></td>
                            <td  colspan="2" valign="top"><p>If yes to previous    question, whom did you have to pay?<br />
                                    <strong>1=</strong> Community leader, <strong>2=</strong> NGO staff, <strong>3=</strong> Hawala agent, <strong>4=</strong> Trader, <strong>5=</strong>Police/army, <strong>6=</strong>Other</p></td>
                            <td  valign="top" colspan="2"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_12}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.13</strong></p></td>
                            <td  colspan="2" valign="top"><p>Rank the ease with which    you collected your cash<br />
                                    <strong>1= Good                        2= Fair                   3= Poor</strong></p></td>
                            <td  valign="top" colspan="2"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_13}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.14</strong></p></td>
                            <td  colspan="2" valign="top"><p>Rank the level of security    at the cash distribution site<br />
                                    <strong>1= Good                        2= Fair                   3= Poor</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_14}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.15</strong></p></td>
                            <td  colspan="2" valign="top"><p>Did the people who gave you    the cash treat you with dignity and respect? <br />
                                    <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_15}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.16</strong></p></td>
                            <td  colspan="2" valign="top"><p>Did you receive/proxy any    problems with identification by the cash distributors? (banks, traders,    hawala staff) <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_16}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.17</strong></p></td>
                            <td  colspan="2" valign="top"><p>Did you/proxy experience    any problems with getting the correct bank notes? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_17}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.18</strong></p></td>
                            <td  colspan="2" valign="top"><p>Did you experience any    problems with sending another person to collect the money? <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_18}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.19</strong></p></td>
                            <td  colspan="2" valign="top"><p>I am aware of where and how    to report any complaints/feedback I have about this programme <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_19}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.20</strong></p></td>
                            <td  colspan="2" valign="top"><p>Did you/proxy experience    any other problems collecting the cash that was not already mentioned?  <strong>(1=Yes,    2= No)</strong></p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_20}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.21</strong></p></td>
                            <td  colspan="2" valign="top"><p>If yes to above, please    explain:</p>
                                <p>&nbsp;</p></td>
                            <td  valign="top" colspan="2"><p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_21}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>4.22</strong></p></td>
                            <td  colspan="2" valign="top"><p>Overall, could you please    rate your satisfaction level with the cash assistance provided by HelpAge?<br />
                                    <strong>1=</strong> Highly satisfied, <strong>2=</strong> Satisfied, <strong>3=</strong> Neutral, <strong>4=</strong> Dissatisfied, <strong>5=</strong> Very Dissatisfied</p></td>
                            <td  valign="top" colspan="2"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->physicallyReceivingCash))
                                        {{$assessment->physicallyReceivingCash->q4_22}}
                                    @endif</p></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <h5>5.0 Communal Relations</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td  valign="top" class="col-md-1"><br />
                                <strong>5.1</strong></td>
                            <td  valign="top" class="col-md-6"><p>Control over the cash    received from HelpAge has caused conflict within my household <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"  class="col-md-5"><p>@if(is_object($assessment->communalRelations))
                                        {{$assessment->communalRelations->q5_1}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>5.2</strong></p></td>
                            <td  valign="top"><p>Other members of the    community are jealous of me because of the cash transfer <strong>(1=Yes, 2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->communalRelations))
                                        {{$assessment->communalRelations->q5_2}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>5.3</strong></p></td>
                            <td  valign="top"><p>The older person in the    household is more respected within the household since receiving the cash <strong>(1=Yes, 2= Somewhat, 3=No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->communalRelations))
                                        {{$assessment->communalRelations->q5_3}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>5.4</strong></p></td>
                            <td  valign="top"><p>The older person in the    household is more respected within the community since receiving the cash <strong>(1=Yes, 2= Somewhat, 3= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->communalRelations))
                                        {{$assessment->communalRelations->q5_4}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>5.5</strong></p></td>
                            <td  valign="top"><p>I shared what I received    using the cash HelpAge gave me with other household members  <strong>(1=Yes,    2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->communalRelations))
                                        {{$assessment->communalRelations->q5_5}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>5.6</strong></p></td>
                            <td  valign="top"><p>I shared what I received    using the cash HelpAge gave me with other <u>non-</u>household members  <strong>(1=Yes,    2= No)</strong></p></td>
                            <td  valign="top"><p>@if(is_object($assessment->communalRelations))
                                        {{$assessment->communalRelations->q5_6}}
                                    @endif</p></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <p><strong><em><u>6.0 What  the cash was used for?</u></em></strong><br />
                        <strong>6.1</strong> Please state total of last cash transfer:<strong>  @if(is_object($assessment->cashUsage))
                                {{$assessment->cashUsage->q6_1}}
                            @endif</strong><br />
                        <strong>6.2</strong> Indicate how much of the most recent cash transfer was used for  each category</p>
                    <table class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th></th>
                            <th>Currency</th>
                        </tr>
                        </thead>
                        <?php $co=1;?>
                        @if(is_object($assessment->cashUsage) && is_object($assessment->cashUsage->usages) && count($assessment->cashUsage->usages) >0)
                            @foreach($assessment->cashUsage->usages as $usage)
                                <tr>
                                    <td>@if(is_object($usage->category)){{$usage->category->category_name}} @endif</td>
                                    <td>{{$usage->currency}}</td>
                                </tr>
                                <?php $co++;?>
                            @endforeach
                        @else
                            @foreach(\App\PCCategories::all() as $category)
                                <tr>
                                    <td>{{$category->category_name}}<input type="hidden" value="{{$category->id}}" name="categories[]"></td>
                                    <td><input type="text" name="currencies[]" class="form-control"></td>
                                </tr>
                                <?php $co++;?>
                            @endforeach
                        @endif
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td  valign="top"><p><strong>6.3 </strong></p></td>
                            <td  valign="top" class="col-md-6"><p>Were the prices you paid    for the goods/services you used your cash for different to the usual prices    for this time of year?<br />
                                    <strong>1= Yes, 2=No</strong></p></td>
                            <td  valign="top" class="col-md-3"><p>&nbsp;</p>
                                <p>@if(is_object($assessment->cashUsage))
                                        {{$assessment->cashUsage->q6_3}}
                                    @endif</p></td>
                        </tr>
                        <tr>
                            <td  valign="top"><p><strong>6.4</strong></p></td>
                            <td  valign="top"><p>If yes to 6.3, were the    prices:<br />
                                    <strong>1=</strong>Significantly    Higher, <strong>2=</strong> Higher, <strong>3=</strong> Lower, <strong>4=</strong> Significantly Lower</p></td>
                            <td  valign="top"><p>@if(is_object($assessment->cashUsage))
                                        {{$assessment->cashUsage->q6_4}}
                                    @endif</p></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-8 col-sm-8 pull-left" id="output">

            </div>
            <div class="col-md-2 col-sm-2 pull-right text-right">
                <button type="button" class="btn btn-primary btn-block"  data-dismiss="modal">Close form</button>
            </div>

        </div>
    </div>
</div>
