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
            <h5><strong> Progress Case Management</strong></h5>
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
                    <td>@if(is_object($case->client) && $case->client != null ){{$case->client->client_number}}@endif</td>
                    <td>@if(is_object($case->client) && $case->client != null ){{$case->client->full_name}}@endif</td>
                    <td>@if(is_object($case->client) && $case->client != null ){{$case->client->sex}}@endif</td>
                    <td>@if(is_object($case->client) && $case->client != null ){{$case->client->age}}@endif</td>
                    <td>@if(is_object($case->client) && $case->client->fromOrigin != null ){{$case->client->fromOrigin->origin_name}}@endif</td>
                    <td>@if(is_object($case->client) && $case->client != null ){{date('d-M-Y',strtotime($case->client->date_arrival))}}@endif</td>
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
                    <td>{{$case->reference_number}}</td>
                    <td>{{date('d-M-Y',strtotime($case->open_date))}}</td>
                    <td>@if(is_object($case->camp) && $case->camp != null ){{$case->camp->camp_name}}@endif</td>
                    <td>{{$case->case_type}}</td>
                    <td>{{$case->status}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Descriptions</strong></h6>
            <p class="text-justify"><?php echo $case->descriptions;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Initial Action</strong></h6>
            <p class="text-justify"><?php echo $case->initial_action;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Feedback</strong></h6>
            <p class="text-justify"><?php echo $case->feedback;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h6><strong>Planning</strong></h6>
            <p class="text-justify"><?php echo $case->planning;?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered">
                <tr>
                    <th>Case Worker Name</th>
                </tr>
                <tr>
                    <th><?php echo $case->case_worker_name;?></th>
                </tr>
            </table>
        </div>

    </div>
</div>
</body>
</html>