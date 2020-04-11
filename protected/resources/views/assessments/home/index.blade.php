@extends('site.master')
@section('page_js')
    <script type="text/javascript" src="{{asset("assets/js/plugins/tables/datatables/datatables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/selects/select2.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/bootbox.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/ui/ripple.min.js")}}"></script>
@stop
@section('scripts')
    <script>
        $(function() {
            $(".addRecord").click(function(){
                var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header bg-indigo">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp text-bold text-uppercase" style="text-align: center"><i class="fa fa-plus font-blue-sharp"></i> PSN Needs/Home assessment</span>';
                modaldis+= '</div>';
                modaldis+= '<div class="modal-body">';
                modaldis+= ' </div>';
                modaldis+= '</div>';
                modaldis+= '</div>';
                $('body').css('overflow-y','scroll');

                $("body").append(modaldis);
                $("#myModal").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load("<?php echo url("assessments/home/create") ?>");
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                })

            });

            // Confirmation dialog
            $('.authorizeAllRecords').on('click', function() {
                var id1 = $(this).parent().attr('id');
                var btn=$(this).parent().parent().parent().parent().parent().parent();
                bootbox.confirm("Are you sure? You want to authorize All pending records", function(result) {
                    if(result){
                        $.ajax({
                            url:"<?php echo url('authorize/home/assessments') ?>",
                            type: 'post',
                            data: {_method: 'post', _token :"{{csrf_token()}}"},
                            success:function(msg){
                                location.reload();
                            }
                        });
                    }
                });
            });
        });

        function closePrint () {
            document.body.removeChild(this.__container__);
        }

        function setPrint () {
            this.contentWindow.__container__ = this;
            this.contentWindow.onbeforeunload = closePrint;
            this.contentWindow.onafterprint = closePrint;
            this.contentWindow.focus(); // Required for IE
            this.contentWindow.print();
        }

        function printPage (sURL) {
            var oHiddFrame = document.createElement("iframe");
            oHiddFrame.onload = setPrint;
            oHiddFrame.style.visibility = "hidden";
            oHiddFrame.style.position = "fixed";
            oHiddFrame.style.right = "0";
            oHiddFrame.style.bottom = "0";
            oHiddFrame.src = sURL;
            document.body.appendChild(oHiddFrame);
        }
    </script>

@stop
@section('main_navigation')
    @include('inc.main_navigation')
@stop
@section('page_title')
    PSN Needs/Home assessment
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">PSN Needs/Home assessment  </span> </h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('assessments/home')}}">PSN Needs/Home assessment </a></li>
    </ul>
@stop
@section('contents')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-12 text-right">
            @permission('create')
            <a  href="#" class="addRecord btn btn-primary"><i class="fa fa-plus "></i> <span>Assess Client</span></a>
            @endpermission
            @permission('authorize')
            <a  href="#" class="authorizeAllRecords btn btn-danger"><i class="fa fa-check "></i> <span>Authorize All</span></a>
            @endpermission
            <a  href="{{url('assessments/home')}}" class="btn  btn-primary"><i class="fa fa-list "></i> <span>List All Assessment</span></a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title text-bold">PSN Needs/Home Assessment  List</h5>
        </div>
        <div class="panel-body">
            <home-assessment-component></home-assessment-component>
        </div>
    </div>
@stop
