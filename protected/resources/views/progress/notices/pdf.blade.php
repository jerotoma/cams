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
            <h5><strong> Progressive Notice</strong></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Client Information</strong></h6>
            <table class="table table-bordered">
                <tr>
                    <th>Client #</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Nationality</th>
                    <th>Date Arrived</th>
                </tr>
                <tr>
                    <td>@if(is_object($notice->client) && $notice->client != null ){{$notice->client->client_number}}@endif</td>
                    <td>@if(is_object($notice->client) && $notice->client != null ){{$notice->client->full_name}}@endif</td>
                    <td>@if(is_object($notice->client) && $notice->client != null ){{$notice->client->sex}}@endif</td>
                    <td>@if(is_object($notice->client) && $notice->client != null ){{$notice->client->age}}@endif</td>
                    <td>@if(is_object($notice->client) && $notice->client->fromOrigin != null ){{$notice->client->fromOrigin->origin_name}}@endif</td>
                    <td>@if(is_object($notice->client) && $notice->client != null ){{date('d-M-Y',strtotime($notice->client->date_arrival))}}@endif</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Case Details</strong></h6>
            <table class="table table-bordered">
                <tr>
                    <th>Reference #</th>
                    <th>Open Date</th>
                    <th>Camp</th>
                    <th>Case Type</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>{{$notice->reference_number}}</td>
                    <td>{{date('d-M-Y',strtotime($notice->open_date))}}</td>
                    <td>@if(is_object($notice->camp) && $notice->camp != null ){{$notice->camp->camp_name}}@endif</td>
                    <td>{{$notice->case_type}}</td>
                    <td>{{$notice->status}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Subjective Information</strong></h6>
            <p class="text-justify"><?php echo $notice->subjective_information;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Objective Information</strong></h6>
            <p class="text-justify"><?php echo $notice->objective_information;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Analysis</strong></h6>
            <p class="text-justify"><?php echo $notice->analysis;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Planning</strong></h6>
            <p class="text-justify"><?php echo $notice->planning;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered">
                <tr>
                    <th>Case Worker Name</th>
                </tr>
                <tr>
                    <th><?php echo $notice->case_worker_name;?></th>
                </tr>
            </table>
        </div>

    </div>
</div>
</body>
</html>