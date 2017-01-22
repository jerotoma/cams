<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Case management Database for Person with special needs| @yield('page_title')</title>

    <!-- Global stylesheets -->
    <link href="{{asset("assets/css/googlefonts.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/icons/icomoon/styles.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/icons/fontawesome/styles.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/core.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/components.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/colors.css")}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset("assets/js/plugins/loaders/pace.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/core/libraries/bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/loaders/blockui.min.js")}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @yield('page_js')

    <!-- /theme JS files -->

</head>

<body class="navbar-top">

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top bg-indigo">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('home')}}">CMDPS Database System</a>

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
            <p class="navbar-text">Welcome, {{Auth::user()->full_name}}!</p>
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

            <ul class="nav navbar-nav">


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


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default ">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user-material">
                    <div class="category-content">
                        <div class="sidebar-user-material-content">
                            <a href="#"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-responsive" alt=""></a>
                            <h6>{{Auth::user()->full_name}}</h6>
                            <span class="text-size-small">{{Auth::user()->designation}}</span>
                        </div>

                        <div class="sidebar-user-material-menu">
                            <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                        </div>
                    </div>

                    <div class="navigation-wrapper collapse" id="user-nav">
                        <ul class="navigation">
                            <li><a href="{{url('account/profile')}}"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('account/settings')}}"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
                            <li><a href="{{url('logout')}}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>

                <!-- /user menu -->


                <!-- Main navigation -->
                @yield("main_navigation")

                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        @yield("page_heading_title")

                    </div>

                    <div class="heading-elements">
                        <div class="heading-btn-group">
                            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    @yield("breadcrumb")
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                @yield("contents")
                <!-- /dashboard content -->


                <!-- Footer -->
                <div class="navbar navbar-default navbar-fixed-bottom">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i class="icon-circle-up2"></i></a></li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-second">
                        <div class="navbar-text">
                            Copyright &copy; {{date("Y")}}. <a href="#">HelpAge International- Case Management Database for Person with Special needs</a>
                        </div>

                        <div class="navbar-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#">Help center</a></li>
                                <li><a href="#">Policy</a></li>
                                <li><a href="#" class="text-semibold">User manual</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
@yield('scripts')
</body>
</html>
