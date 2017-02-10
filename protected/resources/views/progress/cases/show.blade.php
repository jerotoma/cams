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
            <h4><strong>
                    INTER – AGENCY REFERRAL FORM
                </strong></h4>
            <h5><strong>
                    Progress Number: {{$referral->progress_number}}
                </strong></h5>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-2">Case name: </th>
                    <td class="col-md-10" colspan="3">{{$referral->case_name}} </td>
                </tr>
                <tr>
                    <th class="col-md-2">Date: </th>
                    <td class="col-md-3">{{$referral->referral_date}} </td>
                    <th class="col-md-2">Completed by: </th>
                    <td class="col-md-5">{{$referral->completed_by}} </td>
                </tr>

            </table>
            <table class="table table-bordered" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th class="col-md-3">Name of Client Concerned: </th>
                    <td class="col-md-9" colspan="3">@if(is_object($referral->client) && $referral->client != null){{$referral->client->full_name}} @endif</td>
                </tr>
                <tr>
                    <th class="col-md-3">Location the referral originated:  </th>
                    <td class="col-md-9" colspan="3">{{$referral->location}}</td>
                </tr>
                <tr>
                    <th class="col-md-3">Age: </th>
                    <th class="col-md-3">Disabilities: </th>
                    <th class="col-md-3">Date of birth: </th>
                    <th class="col-md-3">Sex: </th>
                </tr>
                <tr>
                    <td class="col-md-3"> {{$referral->age}}</td>
                    <td class="col-md-3">{{$referral->disabilities}} </td>
                    <td class="col-md-3">{{date("d-M-Y", strtotime($referral->birth_date))}} </td>
                    <td class="col-md-3">@if(is_object($referral->client) && $referral->client != null){{$referral->client->sex}} @endif</td>
                </tr>
                <tr>
                    <th class="col-md-3"> Ethnic Background</th>
                    <td class="col-md-9" colspan="3">{{$referral->ethnic_background}} </td>
                </tr>
                <tr>
                    <th class="col-md-3"> Contact <small></small></th>
                    <td class="col-md-3" >{{$referral->contact}} </td>
                    <th class="col-md-3"> Telephone number:</th>
                    <td class="col-md-3" >{{$referral->phone}} </td>
                </tr>
                <tr>
                    <th class="col-md-3"> Name of Person Who Originated concern and contact details: </th>
                    <td class="col-md-9" colspan="3">{{$referral->person_name }}</td>
                </tr>
                <tr>
                    <th class="col-md-3"> Relationship to client: </th>
                    <td class="col-md-3" >{{$referral->relationship }}</td>
                    <th class="col-md-3"> Approached for assistance with plot/address: </th>
                    <td class="col-md-3" >{{$referral->person_name_address }}</td>
                </tr>

            </table>
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-6">Consent Obtained to Share Information: </th>
                    <td class="col-md-6" colspan="3">{{$referral->consent}} </td>
                </tr>
                <tr>
                    <th class="col-md-6">Parental Consent provided if Client is Under 18 years of Age: </th>
                    <td class="col-md-6">{{$referral->parental_consent}} </td>
                </tr>
                <tr>
                    <th class="col-md-6">Any Attachment included:  </th>
                    <td class="col-md-6">{{$referral->attachment}} </td>
                </tr>

            </table>
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-6">Initial Action Recommended or Taken: </th>
                    <td class="col-md-6" colspan="3">{{$referral->initial_action}} </td>
                </tr>
                <tr>
                    <th class="col-md-6">Timeframes agreed/proposed: </th>
                    <td class="col-md-6" colspan="3">{{$referral->time_frames}} </td>
                </tr>
                <tr>
                    <th class="col-md-12" colspan="4">Additional Comments Regarding Concern [any information volunteered by client]:  </th>

                </tr>
                <tr>
                    <td class="col-md-12" colspan="4">{{$referral->additional_comments}} </td>
                </tr>
                <tr>
                    <th class="col-md-3">Primary Concern: </th>
                    <td class="col-md-9" colspan="3">{{$referral->primary_concern}} </td>
                </tr>

            </table>
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-3">Referred to:  </th>
                    <td class="col-md-3" >{{$referral->referred_to}} </td>
                    <th class="col-md-3">Position:  </th>
                    <td class="col-md-3" >{{$referral->referred_to_position}} </td>
                </tr>
                <tr>
                    <th class="col-md-3">Organization/ Institution: </th>
                    <td class="col-md-9" colspan="3">{{$referral->organization}} </td>
                </tr>
                <tr>
                    <th class="col-md-3">Telephone number: </th>
                    <td class="col-md-3">{{$referral->org_phone}} </td>
                    <th class="col-md-3">Email address: </th>
                    <td class="col-md-3">{{$referral->org_email}} </td>
                </tr>

            </table>

        </div>
    </div>

</div>
</body>
</html>