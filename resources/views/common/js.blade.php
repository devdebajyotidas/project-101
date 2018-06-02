{{--Common JS--}}

<!-- Core  -->
<script src="{{url('global')}}/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="{{url('global')}}/vendor/jquery/jquery.js"></script>
<script src="{{url('global')}}/vendor/popper-js/umd/popper.min.js"></script>
<script src="{{url('global')}}/vendor/bootstrap/bootstrap.js"></script>
<script src="{{url('global')}}/vendor/animsition/animsition.js"></script>
<script src="{{url('global')}}/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="{{url('global')}}/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="{{url('global')}}/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="{{url('global')}}/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
<script src="{{url('global')}}/vendor/waves/waves.js"></script>

<!-- Plugins -->
<script src="{{url('global')}}/vendor/switchery/switchery.js"></script>
<script src="{{url('global')}}/vendor/intro-js/intro.js"></script>
<script src="{{url('global')}}/vendor/screenfull/screenfull.js"></script>
<script src="{{url('global')}}/vendor/slidepanel/jquery-slidePanel.js"></script>


<!-- Scripts -->
<script src="{{url('global')}}/js/Component.js"></script>
<script src="{{url('global')}}/js/Plugin.js"></script>
<script src="{{url('global')}}/js/Base.js"></script>
<script src="{{url('global')}}/js/Config.js"></script>

<script src="{{url('assets')}}/js/Section/Menubar.js"></script>
<script src="{{url('assets')}}/js/Section/Sidebar.js"></script>
<script src="{{url('assets')}}/js/Section/PageAside.js"></script>
<script src="{{url('assets')}}/js/Plugin/menu.js"></script>

<!-- Config -->
<script src="{{url('global')}}/js/config/colors.js"></script>
<script src="{{url('assets')}}/js/config/tour.js"></script>
<script>Config.set('assets', '{{url('assets')}}');</script>

<!-- Page -->
<script src="{{url('assets')}}/js/Site.js"></script>
<script src="{{url('global')}}/js/Plugin/asscrollable.js"></script>
<script src="{{url('global')}}/js/Plugin/slidepanel.js"></script>
<script src="{{url('global')}}/js/Plugin/switchery.js"></script>
<script src="{{url('global')}}/js/Plugin/matchheight.js"></script>
<script src="{{url('global')}}/js/Plugin/jvectormap.js"></script>
<script src="{{url('global')}}/js/Plugin/peity.js"></script>

<script src="{{url('global')}}/vendor/jquery-appear/jquery.appear.js"></script>
<script src="{{url('global')}}/vendor/nprogress/nprogress.js"></script>
<script src="{{url('global')}}/js/Plugin/jquery-appear.js"></script>
<script src="{{url('global')}}/js/Plugin/nprogress.js"></script>
<script src="{{url('assets')}}/examples/js/advanced/animation.js"></script>

<!--Inputs-->
<script src="{{url('global')}}/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="{{url('global')}}/js/Plugin/jquery-placeholder.js"></script>
<script src="{{url('global')}}/js/Plugin/material.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{url('global')}}/vendor/icheck/icheck.min.js"></script>
<script src="{{url('global')}}/js/Plugin/icheck.js"></script>
{{--Extended Js--}}
<script src="{{url('global')}}/vendor/alertify/alertify.js"></script>
<script src="{{url('global')}}/js/Plugin/alertify.js"></script>


@if($page=='home')
    <script src="{{url('global')}}/vendor/gmaps/gmaps.js"></script>
    <script src="{{url('global')}}/js/Plugin/gmaps.js"></script>
    <script src="{{url('assets')}}/examples/js/pages/map-google.js"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAs6egI5LIpX6H3RoACfXSRNGDfDbM68mk"></script>
@elseif($page=='provider' || $page=='customer' || $page=='service')
    {{----}}
@elseif($page=='shout')
    <script src="{{url('global')}}/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="{{url('global')}}/vendor/datepair/datepair.min.js"></script>
    <script src="{{url('global')}}/vendor/datepair/jquery.datepair.min.js"></script>
    <script src="{{url('global')}}/js/Plugin/datepair.js"></script>
    <script src="{{url('global')}}/js/Plugin/bootstrap-datepicker.js"></script>
@elseif($page=='report')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
    <script src="{{url('global')}}/vendor/chart-js/Chart.js"></script>
    <script src="{{url('/js/utils.js')}}"></script>
    <script src="{{url('global')}}/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="{{url('global')}}/vendor/datepair/datepair.min.js"></script>
    <script src="{{url('global')}}/vendor/datepair/jquery.datepair.min.js"></script>
    <script src="{{url('global')}}/js/Plugin/datepair.js"></script>
    <script src="{{url('global')}}/js/Plugin/bootstrap-datepicker.js"></script>
@endif

<script>
    (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
            Site.run();
        });
    })(document, window, jQuery);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

{{--Extended Js--}}