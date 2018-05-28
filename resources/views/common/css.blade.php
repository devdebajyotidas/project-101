{{--Common CSS--}}

<!-- Stylesheets -->
<link rel="stylesheet" href="{{url('global')}}/css/bootstrap.min.css">
<link rel="stylesheet" href="{{url('global')}}/css/bootstrap-extend.min.css">
<link rel="stylesheet" href="{{url('assets')}}/css/site.min.css">
<link rel="stylesheet" href="{{url('/')}}/css/style.css">

<!-- Plugins -->

<link rel="stylesheet" href="{{url('global')}}/vendor/animsition/animsition.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/asscrollable/asScrollable.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/switchery/switchery.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/intro-js/introjs.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/slidepanel/slidePanel.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/flag-icon-css/flag-icon.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/waves/waves.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/nprogress/nprogress.css">
<link rel="stylesheet" href="{{url('assets')}}/examples/css/advanced/animation.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


<!-- Fonts -->
<link rel="stylesheet" href="{{url('global')}}/fonts/material-design/material-design.min.css">
<link rel="stylesheet" href="{{url('global')}}/fonts/brand-icons/brand-icons.min.css">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{--Extended CSS--}}
<link rel="stylesheet" href="{{url('assets')}}/examples/css/uikit/modals.css">
<link rel="stylesheet" href="{{url('global')}}/vendor/icheck/icheck.css">

<link rel="stylesheet" href="{{url('global')}}/vendor/alertify/alertify.css">
<link rel="stylesheet" href="{{url('assets')}}/examples/css/advanced/alertify.css">


@if($page=='home')
    <link rel="stylesheet" href="{{url('assets')}}/examples/css/pages/map.css">
@elseif($page=='profile')
    {{--<link rel="stylesheet" href="{{url('assets')}}/examples/css/pages/profile.css">--}}
    <link rel="stylesheet" href="{{url('global')}}/vendor/slick-carousel/slick.css">
    <link rel="stylesheet" href="{{url('assets')}}/examples/css/pages/profile-v2.css">
    @elseif($page=='employee profile')
    <link rel="stylesheet" href="{{url('assets')}}/examples/css/pages/profile_v3.css">
@elseif($page=='provider' || $page=='customer' || $page=='service')

@elseif($page=='payment')
    <link rel="stylesheet" href="{{url('assets')}}/examples/css/widgets/social.css">
@elseif($page=='report')
    <link rel="stylesheet" href="{{url('global')}}/vendor/chartist/chartist.css">
    <link rel="stylesheet" href="{{url('global')}}/vendor/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{url('global')}}/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="{{url('assets')}}/examples/css/dashboard/v1.css">
    <link rel="stylesheet" href={{url('assets')}}/examples/css/charts/flot.css">
 @elseif($page=='shout')
    <link rel="stylesheet" href="../../../global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
@endif

