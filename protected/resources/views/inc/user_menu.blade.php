                <div class="sidebar-user-material">
                    <div class="category-content">
                        <div class="sidebar-user-material-content">
                            <a href="#"><img src="{{asset("assets/images/user_icon.png")}}" class="img-circle img-responsive" alt=""></a>
                           <h6>{{Auth::user()->full_name}}</h6>
                            <span class="text-size-small"> {{Auth::user()->designation}}</span>
                        </div>

                        <div class="sidebar-user-material-menu">
                            <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                        </div>
                    </div>

                    <div class="navigation-wrapper collapse" id="user-nav">
                        <ul class="navigation">
                            <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
                            <li><a href="{{url('logout')}}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
