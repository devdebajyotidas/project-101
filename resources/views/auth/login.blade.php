
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Find your necessary local services">
    <meta name="keywords" content="Local Services, Services">
    <meta name="author" content="Astakyuta - Samir Maikap">
    <title>Account login</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('assets')}}/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('assets')}}/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('assets')}}/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('assets')}}/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets')}}/images/ico/favicon.png">
    <link rel="shortcut icon" type="image/png" href="{{url('assets')}}/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

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
    <link rel="stylesheet" href="{{url('assets')}}/examples/css/pages/login-v3.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="{{url('global')}}/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="{{url('global')}}/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="{{url('global')}}/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{url('global')}}/vendor/media-match/media.match.min.js"></script>
    <script src="{{url('global')}}/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{url('global')}}/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
    <style>
        @media screen and (max-width: 600px) {
            .page-content{
                padding: 30px 0 !important;
            }
        }

    </style>
</head>
<body class="animsition page-login-v3 layout-full">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Page -->

<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
        <div class="panel" style="box-shadow: 0 1px 3px rgba(0,0,0,0.14)">
            <div class="panel-body">
                <div class="brand">
                    <img class="brand-img" src="{{url('assets')}}//images/logo-colored.png" alt="...">
                    <h2 class="brand-text font-size-18">Serloc</h2>
                </div>
                <form method="post" action="{{url('login')}}" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control" name="email" />
                        <label class="floating-label">Email</label>
                    </div>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control" name="password" />
                        <label class="floating-label">Password</label>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                            <input type="checkbox" id="inputCheckbox" name="remember">
                            <label for="inputCheckbox">Remember me</label>
                        </div>
                        <a class="float-right" href="forgot-password.html">Forgot password?</a>
                    </div>
                    @if($errors->any())
                        <div class="form-group clearfix text-left mt-40 mb-0">
                            <p class="mt-20 text-danger">{{$errors->first()}}</p>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
                </form>
            </div>
        </div>

        <footer class="page-copyright page-copyright-inverse">

            <p>© {{date('Y')}} {{config('app.name')}}</p>

        </footer>
    </div>
</div>
<!-- End Page -->

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
<script src="{{url('global')}}/vendor/jquery-placeholder/jquery.placeholder.js"></script>

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
<script src="{{url('global')}}/js/Plugin/jquery-placeholder.js"></script>
<script src="{{url('global')}}/js/Plugin/material.js"></script>

<script>
    (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
            Site.run();
        });
    })(document, window, jQuery);
</script>
</body>
</html>
