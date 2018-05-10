<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16"
          href="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/favicon.png">
    <title>Management Matters - Password reset</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url('assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{url('assets/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{url('assets/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        #wrapper{
            width: calc(100% - 400px);
        }
        .login-sidebar {
            position: fixed;
        }
        .btn-info{
            background: #f75b36 !important;
            border: 1px solid #fff !important;
        }
        .recover-close{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            line-height: 50px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease-out;
        }
        .recover-close:hover{
            background-color: #f3f3f3;
            transition: all 0.3s ease-out;
        }
    </style>

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box login-sidebar">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" method="post" action="">
                {{ csrf_field() }}
                <a href="/" class="text-center db">
                    <img src="{{ asset('assets/img/mm-logo.png') }}"
                         style="width: 200px"
                         alt="Home"/>
                </a>

                <div class="form-group m-t-40">
                    {{--@if (old('email'))--}}
                    {{--<div class="col-xs-12">--}}
                    {{--<div class="alert alert-warning text-center">Invalid Email or Password</div>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    @if(isset($errors) && count($errors->all()) > 0)
                        @foreach ($errors->all() as $key => $error)
                            <div class="col-xs-12">
                                <div class="alert alert-warning text-center">{{$error}}</div>
                            </div>
                        @endforeach
                    @endif
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" required="" placeholder="Password"
                               value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Confirm Password"
                               value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group text-center m-t-15">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                type="submit">Reset Password
                        </button>
                    </div>
                </div>
                {{--<div class="row">--}}
                {{--<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">--}}
                {{--<div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"--}}
                {{--title="Login with Facebook"> <i aria-hidden="true"--}}
                {{--class="fa fa-facebook"></i> </a> <a--}}
                {{--href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"--}}
                {{--title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group m-t-30 m-b-0 text-center">
                    &copy; {{date('Y')}} Managament Matters
                </div>
            </form>
        </div>
    </div>
</section>
<!-- jQuery -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{url('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{url('assets/js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{url('assets/js/custom.min.js')}}"></script>
<!--Style Switcher -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
