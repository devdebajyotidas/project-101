<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
       <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="material-icons font-large-1">menu</i></a></li>
                <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="branding logo" src="{{url('assets')}}/images/logo/logo.png" data-expand="{{url('assets')}}/images/logo/logo.png" data-collapse="{{url('assets')}}/images/logo/logo.png" class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="material-icons">more_horiz</i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav float-xs-right">
                    <li class="dropdown dropdown-notification nav-item">
                        <a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="material-icons">notifications</i>
                            @if(isset($notifications) && !empty($notifications))
                                <span class="tag tag-pill tag-default tag-danger tag-default tag-up">{{count($notifications)}}</span>
                            @endif</a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                            </li>
                            <li class="list-group scrollable-container">
                                @if(isset($notifications) && count($notifications) > 0 )
                                    <a href="javascript:void(0)" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left valign-middle"><i class="icon-monitor3 icon-bg-circle bg-red bg-darken-1"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-1">99% Server load</h6>
                                                <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                                                    <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Five hour ago</time></small>
                                            </div>
                                        </div>
                                    </a>
                                    @else
                                    <div class="list-group-item no-border">
                                        <div class="media">
                                            <div class="media-left valign-middle"><i class="icon-monitor3 icon-bg-circle bg-red bg-darken-1"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-1">No new notifications</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="{{url('assets')}}/images/portrait/small/avatar.jpg" alt="avatar"><i></i></span><span class="user-name">John Doe</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="material-icons">person</i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="material-icons">history</i> My Activity</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="material-icons">exit_to_app</i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>