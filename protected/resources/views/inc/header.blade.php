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
            <p class="navbar-text">Welcome, {{Auth::user()->full_name}}</p>
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