<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li  class="site-menu-item {{ $page=='home' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('home')}}">
                            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Home</span>
                        </a>
                    </li>
                    <li class="site-menu-item  {{ $page=='provider' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('providers')}}">
                            <i class="site-menu-icon material-icons">person_pin</i>
                            <span class="site-menu-title">Providers</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{ $page=='customer' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('customer')}}">
                            <i class="site-menu-icon material-icons">person</i>
                            <span class="site-menu-title">Customers</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{ $page=='service' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('services')}}">
                            <i class="site-menu-icon material-icons">beenhere</i>
                            <span class="site-menu-title">Services</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{ $page=='shout' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('shouts')}}">
                            <i class="site-menu-icon material-icons">record_voice_over</i>
                            <span class="site-menu-title">Service Shout</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{ $page=='request' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('services/request')}}">
                            <i class="site-menu-icon material-icons">format_paint</i>
                            <span class="site-menu-title">Requests</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{ $page=='abuse' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('feedback')}}">
                            <i class="site-menu-icon material-icons">feedback</i>
                            <span class="site-menu-title">Feedback</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{ $page=='report' ? 'active' : ''}}">
                        <a class="animsition-link" href="{{url('reports')}}">
                            <i class="site-menu-icon material-icons">poll</i>
                            <span class="site-menu-title">Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>