<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top bg-indigo">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('home')}}">CAMPSN Database System</a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

        </ul>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                @permission('authorize')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bell2"></i>
                        <span class="visible-xs-inline-block position-right">Pending for approval</span>
                        <span class="status-mark border-orange-400"></span>
                    </a>

                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            Pending for approval
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-menu7"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-users"></i></a>
                                </div>

                                <div class="media-body">
                                    Registered Clients <a href="#">More..</a>
                                    <div class="media-annotation">{{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime(\Auth::user()->updated_at)) /3600)}} minutes ago</div>
                                </div>
                            </li>
                            <li><hr/></li>

                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs"><i class="icon-bubble8"></i></a>
                                </div>

                                <div class="media-body">
                                    Vulnerability assessment <a href="#">More..</a>
                                    <div class="media-annotation">{{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime(\Auth::user()->updated_at)) /3600)}} minutes ago</div>
                                </div>
                            </li>
                            <li><hr/></li>
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-info-400 btn-rounded btn-icon btn-xs"><i class="icon-list3"></i></a>
                                </div>

                                <div class="media-body">
                                    Clients Referrals <a href="#">More..</a>
                                    <div class="media-annotation">{{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime(\Auth::user()->updated_at)) /3600)}} minutes ago</div>
                                </div>
                            </li>
                            <li><hr/></li>
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-info-400 btn-rounded btn-icon btn-xs"><i class="icon-list3"></i></a>
                                </div>

                                <div class="media-body">
                                    NFIs Inventory <a href="#">More..</a>
                                    <div class="media-annotation">{{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime(\Auth::user()->updated_at)) /3600)}} minutes ago</div>
                                </div>
                            </li>
                            <li><hr/></li>
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="fa fa-list fa-2x"></i></a>
                                </div>

                                <div class="media-body">
                                    Clients Referrals <a href="#">More..</a>
                                    <div class="media-annotation">{{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime(\Auth::user()->updated_at)) /3600)}} minutes ago</div>
                                </div>
                            </li>
                            <li><hr/></li>
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs"><i class="fa fa-money fa-2x"></i></a>
                                </div>

                                <div class="media-body">
                                    Cash Transfer <a href="#">More..</a>
                                    <div class="media-annotation">{{floor(( strtotime(date('Y-m-d H:i:s')) - strtotime(\Auth::user()->updated_at)) /3600)}} minutes ago</div>
                                </div>
                            </li>
                            <li><hr/></li>

                        </ul>
                    </div>
                </li>
                @endpermission
                <li class="dropdown">
                    <a href="{{url('logout')}}" class="dropdown-toggle" >
                        <i class="icon-switch2"> </i> Logout
                    </a>

                </li>

            </ul>
        </div>
    </div>
</div>
<!-- /main navbar -->