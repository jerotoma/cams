@extends('layout.master')
@section('page_js')
    @include('layout.page_js')
@stop
@section('page_title')
    User Settings
@stop
@section('page_heading_title')
    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Settings</span> - Users</h4>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('settings/clients')}}">User Settings</a></li>
    </ul>
@stop
@section('contents')
 <!-- User profile -->
 <div class="row">
    <div class="col-md-12">
        <div class="tabbable">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="activity">
                    <div class="timeline timeline-left content-group">
                        <div class="timeline-container">
                            <!-- Sales stats -->
                            <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <a href="#"><img src="{{asset("assets/images/placeholder.jpg")}}" alt=""></a>
                                    </div>
                                    <div class="panel panel-default timeline-content">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">User Settings</h6>
                                            <div class="heading-elements">
                                                <span class="heading-text"><i class="icon-history position-left text-success"></i> </span>
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body">

                                        </div>
                                    </div>
                                </div>
                                <!-- /sales stats -->

                                <!-- Video posts -->
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <img src="{{asset("assets/images/placeholder.jpg")}}" alt="">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-flat timeline-content">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Latest Activities</h6>
                                                </div>

                                                <div class="panel-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /video posts -->

                            </div>
                        </div>
                        <!-- /timeline -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /user profile -->

@endsection
@section('scripts')
    <script>
        $(".editRecord").click(function(){
            var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modaldis+= '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
            modaldis+= '<div class="modal-content">';
            modaldis+= '<div class="modal-header bg-indigo">';
            modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modaldis+= '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center"><i class="fa fa-edit font-blue-sharp"></i> Change My Password</span>';
            modaldis+= '</div>';
            modaldis+= '<div class="modal-body">';
            modaldis+= ' </div>';
            modaldis+= '</div>';
            modaldis+= '</div>';
            $('body').css('overflow-y','scroll');

            $("body").append(modaldis);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("account/settings/access") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });
    </script>
@stop
