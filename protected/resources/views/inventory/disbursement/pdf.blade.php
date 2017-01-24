<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
<head>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/global/plugins/bootstrap/css/bootstrap.min.css")}}"  media='all'>
</head>
<body>
<div class="portlet-body form">
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <img src="{{asset('assets/logo.png')}}" width="100px" height="100px"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h3><strong>INTERNATIONAL RESCUE COMMITTEE</strong></h3> <br/>
            Box 259, Kasulu Field Office<br/>
            Tel : 028 2810705 ;  Fax : 028 2810706<br/>
            Email : irc.kasulu@tanzania.theirc.org
        </div>
    </div>
    <hr style="background-color: #e7ecf1 ; border-color: #e7ecf1 ;margin-bottom: 20px"/>
    <div class="row">
        <div class="col-md-12 col-xs-12 text-center">
            <h4><strong>
                    COMMUNITY BASED REHABILITATION PROGRAMME (CBR)<br/>
                    PROGRAMME DE REHABILITATION SUR BASE COMMUNAUTAIRE (PRBC)<br/>
                    <br/>
                    Material Supports Form
                </strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12">
            <table class="table table-bordered">

                <tbody>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">Date</th>
                    <td class="col-md-10 col-sm-10 col-xs-10">
                        {{$disbursement->distributed_date}}
                    </td>
                </tr>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">Progress Number</th>
                    <td class="col-md-10 col-sm-10 col-xs-10">
                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null)
                            {{$disbursement->beneficiary->progress_number}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">Name:</th>
                    <td class="col-md-10 col-sm-10 col-xs-10">
                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null)
                            {{$disbursement->beneficiary->full_name}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">Sex</th>
                    <td class="col-md-10 col-sm-10 col-xs-10">
                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null)
                            {{$disbursement->beneficiary->sex}}
                        @endif

                    </td>
                </tr>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">Age</th>
                    <td class="col-md-10 col-sm-10 col-xs-10">
                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null)
                            {{$disbursement->beneficiary->age}}
                        @endif

                    </td>
                </tr>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">Location/Address: </th>
                    <td class="col-md-10 col-sm-10 col-xs-10">
                        @if(is_object($disbursement->beneficiary) && $disbursement->beneficiary != null)
                            {{$disbursement->beneficiary->address}}
                        @endif
                    </td>
                </tr>


                </tbody>
            </table>

            <table class="table table-bordered">

                <tbody>
                <tr>
                    <th colspan="4" class="col-md-12 col-sm-12 col-xs-12 text-center">Material Supported</th>
                </tr>
                <tr>
                    <th class="col-md-2 col-sm-2 col-xs-2">SNO </th>
                    <th >Item/materials distributed</th>
                    <th >Quantity</th>
                    <th >Donor type</th>
                </tr>
                <tr>
                    <td class="col-md-2 col-sm-2 col-xs-2">1. </td>
                    <td >@if(is_object($disbursement->item) && $disbursement->item != null )
                            {{$disbursement->item->item_name}}
                        @endif</td>
                    <td >{{ $disbursement->quantity}}</td>
                    <td >{{ $disbursement->donor_type}}</td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>

</div>
</body>
</html>