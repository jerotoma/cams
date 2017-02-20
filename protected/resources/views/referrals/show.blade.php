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
            <h3><strong>HelpAge International</strong></h3>
            <h4><strong>
                    INTER – AGENCY REFERRAL FORM
                </strong></h4>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <tr class="col-md-12 ">
            <h5><span class="pull-right"><label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Psychosocial Activities">
                                Routine
                            </label> <label class="checkbox-inline" style="margin-left: 10px">
                                <input type="checkbox" class="styled" name="service_request[]"  value="Psychosocial Activities">
                                Urgent
                            </label> Date of referral (DD/MM/YY): {{date("d/m/Y",strtotime($referral->referral_date))}}</span> <span class="pull-left">Referring agency copy</span></h5>
            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="4">Referring Agency </th>
                </tr>
                <tr>
                    <th>Agency /Org</th>
                    <td>@if(is_object($referral->referringAgency)){{$referral->referringAgency->ref_organisation}} @endif</td>
                    <th>Contact</th>
                    <td>@if(is_object($referral->referringAgency)) {{$referral->referringAgency->ref_contact}} @endif</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>@if(is_object($referral->referringAgency)) {{$referral->referringAgency->ref_phone}} @endif</td>
                    <th>Email</th>
                    <td> @if(is_object($referral->referringAgency)) {{$referral->referringAgency->ref_location}} @endif</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td colspan="3">@if(is_object($referral->referringAgency)) {{$referral->referringAgency->ref_location}} @endif</td>

                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="4">Receiving Agency </th>
                </tr>
                <tr>
                    <th>Agency /Org</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->rec_email}} @endif</td>
                    <th>Contact</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->rec_email}} @endif</td>
                </tr>
                <tr>
                    <th>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->rec_email}} @endif</th>
                    <td></td>
                    <th>Email</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->rec_email}} @endif</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td colspan="3"> @if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->rec_location}} @endif</td>

                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="4">Client Information </th>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_name}} @endif</td>
                    <th>Phone</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_phone}} @endif</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_address}} @endif</td>
                    <th>Age</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_age}} @endif</td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_sex}} @endif</td>
                    <th>Nationality</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_nationality}} @endif</td>
                <tr>
                    <th>Language</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_language}} @endif</td>
                    <th>ID numbers</th>
                    <td>@if(is_object($referral->receivingAgency)) {{$referral->receivingAgency->cl_id_number}} @endif</td>

                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="4">If Client Is a Minor (under 18 years) </th>
                </tr>
                <tr>
                    <th>Name of primary caregiver:</th>
                    <td>@if(is_object($referral->clientInformation)) {{$referral->clientInformation->cl_language}} @endif</td>
                    <th>Relationship to child:</th>
                    <td>@if(is_object($referral->clientInformation)) {{$referral->clientInformation->cl_care_giver_relationship}} @endif
                          </td>
                </tr>
                <tr>
                    <th>Contact information for caregiver</th>
                    <td>@if(is_object($referral->clientInformation)) {{$referral->clientInformation->cl_care_giver_contact}} @endif</td>
                    <th>Is child separated or unaccompanied?  </th>
                    <td></td>
                </tr>
                <tr>
                    <th>Caregiver is informed of referral?  </th>
                    <td colspan="3">@if(is_object($referral->clientInformation))
                            <option>  {{$referral->clientInformation->cl_care_giver_informed}}</option>
                        @endif</td>

                </tr>
            </table>


            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="4"> Background Information/Reason for Referral:
                        (problem description, duration, frequency, etc.) and Services Already Provided
                    </th>
                </tr>
                <tr>
                    <th>Has the client been informed of the referral?  :</th>
                    <td>@if(is_object($referral->referralReason))
                            <option> {{$referral->referralReason->client_referral_info}}</option>
                        @endif</td>
                    <th>Has the client been referred to any other organizations?  </th>
                    <td>@if(is_object($referral->referralReason))
                            <option> {{$referral->referralReason->client_referral_status}}</option>
                        @endif</td>
                </tr>

            </table>


            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="6"> Services Requested  </th>
                </tr>
                <tr>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]"  value="Mental Health Services">
                            Mental Health Services
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Protection Support/ Services" >
                            Protection Support/ Services
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Shelter" >
                            Shelter
                        </label>
                    </td>
                </tr>
                <tr >
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" >
                            Psychological Interventions
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Community Centre/ Social Services" >
                            Community Centre/ Social Services
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]"  value="aterial Assistance">
                            Material Assistance
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Physical Health Care" >
                            Physical Health Care
                        </label>
                    </td>
                </tr>
                <tr >
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Family Tracing Services">
                            Family Tracing Services
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Nutrition">
                            Nutrition
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]"  value="Physical Rehabilitation">
                            Physical Rehabilitation
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]"  value="Legal Assistance">
                            Legal Assistance
                        </label>
                    </td>
                </tr>
                <tr >
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]"  value="Financial Assistance">
                            Financial Assistance
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]" value="Education">
                            Education
                        </label>
                    </td>
                    <td class="col-sm-3">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="service_request[]"  value="Psychosocial Activities">
                            Psychosocial Activities
                        </label>
                    </td>
                </tr>

            </table>


            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="3">Consent to Release Information (Read with client/ caregiver and answer any questions before s/he signs below) </th>
                </tr>
                <tr>
                    <th>I,.............................................................(client name), understand that the purpose of the referral and of disclosing this information to                                        (receiving agency) is to ensure the safety and continuity of care among service providers seeking to serve the client. The service provider,                                        (referring agency), has clearly explained the procedure of the referral to me and has listed the exact information that is to be disclosed. By signing this form,
                        I authorize this exchange of information:</th>

                    <th>Signature of Responsible Party:</th>
                    <td></td>
                </tr>

            </table>


            <table class="table table-bordered">
                <tr>
                    <th style="background-color:#ccc" colspan="4"> Details of Referral</th>
                </tr>
                <tr>
                    <th>Any Contact or other restriction :</th>
                    <td></td>
                    <th>Referral delivered via   Phone (Emegency Only);Email;Electronically(App or datbase; </th>
                    <td></td>
                </tr>
                <tr>
                    <th>Followup Expected Via Phone ;Email ; in Person by Date(DD/MM/YY);</th>
                    <td></td>
                    <th>Intermation agencies Agree to exchange in followup: </th>
                    <td></td>
                </tr>
                <tr>
                    <th>Name and Signature of  receipient</th>
                    <td></td>
                    <th>Date Received(DD/MM/YY) </th>
                    <td></td>
                </tr>

            </table>

        </div>
    </div>

</div>
</body>
</html>