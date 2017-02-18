<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Case management Database for Person with specific needs| @yield('page_title')</title>

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

    <!-- Theme css files -->
    @yield('page_css')

    <!-- /theme css files -->
<!-- Theme JS files -->
    @yield('page_js')

    <!-- /theme JS files -->

</head>

<body class="navbar-top" style="overflow:auto;">

   @include('inc.header')

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default ">
            <div class="sidebar-content">

                <!-- User menu -->
                     @include('inc.user_menu')
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
                @include('inc.footer')
                 
                <!-- /Footer -->

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
