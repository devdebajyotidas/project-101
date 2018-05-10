<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Find your necessary local services">
    <meta name="keywords" content="Local Services, Services">
    <meta name="author" content="Samir Maikap">
    <title>Login - {{ ucfirst(config('app.name')) }}</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('assets')}}/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('assets')}}/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('assets')}}/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('assets')}}/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets')}}/images/ico/favicon.png">
    <link rel="shortcut icon" type="image/png" href="{{url('assets')}}/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/bootstrap.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/pages/login-register.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">

    <style>
        html{
            font-family: 'Roboto', sans-serif;
        }
        .container-fluid{
            background-color: #f3f3f3;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23d3d3d3' fill-opacity='0.39' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        }
        .card{
            box-shadow: 0 1px 3px rgba(0,0,0,0.14);
            border: 1px solid transparent;
        }
        .btn{
            font-weight: 500;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
        }
        .logo img{
            width: auto;
            height: 70px;
            display: inline;
        }
        @media screen and (max-width: 765px) {
            .forgot-password {
                margin-bottom: 20px;
                display: block;
            }
        }
    </style>
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 p-0">
                    <div class="card  m-0">
                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <div class="p-2 logo"><img src="{{url('assets')}}/images/logo/logo.png" alt="branding logo"></div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login with {{config('app.name')}}</span></h6>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <form class="form-horizontal form-simple" action="index.html" novalidate>
                                    <fieldset class="form-group position-relative has-icon-left mb-0">
                                        <input type="text" class="form-control form-control-lg input-lg" id="user-name" placeholder="Email" required>
                                        <div class="form-control-position">
                                            <i class="material-icons">person</i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Password" required>
                                        <div class="form-control-position">
                                            <i class="material-icons">vpn_key</i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group row">
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember">
                                                <label for="remember-me"> Remember Me</label>
                                            </fieldset>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group row">
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left forgot-password" style="margin-top: 10px"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><button type="submit" class="btn btn-success btn-lg btn-block rounded">Login</button></div>
                                    </fieldset>

                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="p-10 col-md-12 text-center" style="text-align: center;margin-top: 10px">
                                <p>&copy; {{date("Y")}} {{config('app.name')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="{{url('assets')}}/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="{{url('assets')}}/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="{{url('assets')}}/vendors/js/extensions/pace.min.js" type="text/javascript"></script>

<script src="{{url('assets')}}/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{url('assets')}}/js/core/app.js" type="text/javascript"></script>

</body>
</html>
