                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">{{Auth::user()->full_name}}</span>
                                <div class="text-size-mini text-muted">
                                    {{Auth::user()->designation}}
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-user-material-menu">
                            <a href="#user-nav" data-toggle="collapse"> <i class="icon-user"></i> <span>My account</span> <i class="caret"></i></a>
                        </div>
                    </div>
                    <div class="navigation-wrapper collapse" id="user-nav">
                        <ul class="navigation">
                            <li><a href="{{url('account/profile')}}"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('logout')}}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /user menu -->