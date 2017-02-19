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
        </div>
    </div>
    <hr style="background-color: #e7ecf1 ; border-color: #e7ecf1 ;margin-bottom: 20px"/>
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h4><strong>
                    PSN Needs/Home assessment Form <br/>
                </strong></h4>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <table class="table table-bordered">
                <tr>
                    <th>PSN Case code: </th>
                    <th colspan="3">{{$assessment->case_code}}</th>
                </tr>
                <tr>
                    <th>Date of assessment: </th>
                    <th>{{$assessment->assessment_date}}</th>
                    <th>Ration card number (if any): </th>
                    <th>{{$assessment->client->ration_card_number}}</th>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12 ">
            <h5 class="text-bold">Profile Information of PSN</h5>
            <table class="table table-bordered">
                <tr>
                    <th >Name of PSN</th>
                    <td colspan="5">@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->full_name}}@endif</td>
                </tr>
                <tr>
                    <th>Date of Birth(if known)</th>
                    <td>@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->birth_date}}@endif</td>
                    <th>Age</th>
                    <td>@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->age}}@endif</td>
                    <th>Gender</th>
                    <td>@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->sex}}@endif</td>
                </tr>
                <tr>
                    <th >Nationality/Tribe(s) of PSN</th>
                    <td colspan="5">@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->full_name}}@endif</td>
                </tr>
                <tr>
                    <th >Name of caregiver/Parent/household head(if different):</th>
                    <td colspan="5">@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->care_giver}}@endif</td>
                </tr>
                <tr>
                    <th >Location (Camp Name):</th>
                    <td colspan="5">@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->camp->camp_name}}@endif</td>
                </tr>
                <tr>
                    <th >Location (District):</th>
                    <td colspan="5">@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->camp->district->district_name}}@endif</td>
                </tr>
                <tr>
                    <th >Family size:</th>
                    <td colspan="5">@if(is_object($assessment->client) && $assessment->client != null)
                            {{$assessment->client->household_number}}@endif</td>
                </tr>
                <tr>
                    <th >Link case code:</th>
                    <td colspan="5"> {{$assessment->linked_case_code}}</td>
                </tr>
            </table>
        </div>
    </div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12 ">
        <h5 class="text-bold">Description of the individual special needs and the family situation</h5>
        <table class="table table-bordered">
            <tr>
                <td ><?php echo $assessment->needs_description?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12 ">
        <h5 class="text-bold">Case workers Findings</h5>
        <table class="table table-bordered">
            <tr>
                <td ><?php echo $assessment->findings?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12 ">
        <h5 class="text-bold">Diagnosis</h5>
        <table class="table table-bordered">
            <tr>
                <td ><?php echo $assessment->diagnosis?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12 ">
        <h5 class="text-bold">Case worker’s recommendations and comments</h5>
        <table class="table table-bordered">
            <tr>
                <td ><?php echo $assessment->recommendations?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row" style="margin-top: 10px">
    <div class="col-md-12 ">
        <h5 class="text-bold">Final decision</h5>
        <table class="table table-bordered">
            <tr>
                <td ><?php echo $assessment->final_decision?></td>
            </tr>
        </table>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <table class="table ">
                <thead>
                <tr>
                    <th>Name of Case Worker: </th>
                    <th></th>
                    <th>Signature</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Name of Project Coordinator: </th>
                    <th></th>
                    <th>Signature</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Organization: </th>
                    <th></th>
                    <th>Date</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Name of Case Worker: </th>
                    <th></th>
                    <th>Signature</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Name of Project Coordinator: </th>
                    <th></th>
                    <th>Signature</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>