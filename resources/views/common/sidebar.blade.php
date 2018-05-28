<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-item active">
                        <a class="{{$page=='home' ? 'animsition-link' : ''}}" href="{{url('home')}}">
                            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Home</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a class="{{ $page=='provider' ? 'animsition-link' : ''}}" href="{{url('providers')}}">
                            <i class="site-menu-icon material-icons">person_pin</i>
                            <span class="site-menu-title">Providers</span>
                        </a>
                        {{--<ul class="site-menu-sub">--}}
                            {{--<li class="site-menu-item">--}}
                                {{--<a class="animsition-link" href="layouts/menu-collapsed.html">--}}
                                    {{--<span class="site-menu-title">Menu Collapsed</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="site-menu-item">--}}
                                {{--<a class="animsition-link" href="layouts/grids.html">--}}
                                    {{--<span class="site-menu-title">Grid Scaffolding</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="site-menu-item">--}}
                                {{--<a class="animsition-link" href="layouts/layout-grid.html">--}}
                                    {{--<span class="site-menu-title">Layout Grid</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    </li>
                    <li class="site-menu-item has-sub">
                        <a class="{{$page=='service' ? 'animsition-link' : ''}}" href="{{url('customer')}}">
                            <i class="site-menu-icon material-icons">person</i>
                            <span class="site-menu-title">Customers</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a class="{{$page=='service' ? 'animsition-link' : ''}}" href="{{url('services')}}">
                            <i class="site-menu-icon material-icons">beenhere</i>
                            <span class="site-menu-title">Services</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a class="{{$page=='shout' ? 'animsition-link' : ''}}" href="{{url('shouts')}}">
                            <i class="site-menu-icon material-icons">record_voice_over</i>
                            <span class="site-menu-title">Service Shout</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a class="{{$page=='abuse' ? 'animsition-link' : ''}}" href="{{url('feedback')}}">
                            <i class="site-menu-icon material-icons">feedback</i>
                            <span class="site-menu-title">Feedback</span>
                        </a>
                    </li>
                    {{--<li class="site-menu-item has-sub">--}}
                        {{--<a class="{{$page=='payment' ? 'animsition-link' : ''}}" href="{{url('payments')}}">--}}
                            {{--<i class="site-menu-icon material-icons">account_balance_wallet</i>--}}
                            {{--<span class="site-menu-title">Payments</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li class="site-menu-item has-sub">
                        <a href="{{url('reports')}}">
                            <i class="site-menu-icon material-icons">poll</i>
                            <span class="site-menu-title">Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>