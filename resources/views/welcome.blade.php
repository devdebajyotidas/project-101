<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Serloc - Search local serve local</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="{{url('/home-assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/home-assets')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/home-assets')}}/css/animate.css">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="{{url('/home-assets')}}/css/normalize.css">
    <link rel="stylesheet" href="{{url('/home-assets')}}/style.css">
    <link rel="stylesheet" href="{{url('/home-assets')}}/css/responsive.css">
    <script src="{{url('/home-assets')}}/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        html, body { height: auto }

        body {
            background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%);
        }
        .background {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: auto;
            z-index: -1;
        }
        .list-group-item {
            background-color: transparent;
            border:none;
            border-radius: 0;
            color: #fff;
            padding: 5px 5px 5px 0;
        }
        .list-group-item a{
            color:#fff;
            text-decoration: none;
            transition: all 0.3s ease-out;
        }
        .list-group-item a:hover{
            text-decoration: underline;
            transition: all 0.3s ease-out;
        }
        .header-area .fab{
           margin-right: 5px;
        }
        .footer-area{
            margin: 0;
            padding-top: 40px;
        }
        .footer-middle{
            margin-bottom: 0;
            padding-bottom: 20px;
        }
        @media screen and (max-width: 768px){
            .header-area{
                text-align: center;
            }
            .footer-area{
                margin: 0;
                padding-top: 20px;
            }
            .footer-middle .col-xs-12{
               text-align: center;
                padding: 20px 0;
            }
            .social-menu{
                text-align: center;
            }
            .footer-middle{
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
<!--Mainmenu-area-->
<div class="mainmenu-area" data-spy="affix" data-offset-top="100">
    <div class="container">
        <!--Logo-->
        <div class="navbar-header">
            <a href="#" class="navbar-brand logo">
                <h2>Serloc</h2>
            </a>
        </div>
        <!--Logo/-->
    </div>
</div>
<!--Mainmenu-area/-->



<!--Header-area-->
<header class="header-area overlay full-height relative v-center">
    <div class="absolute"></div>
    <div class="container">
        <div class="row v-center">
            <div class="col-xs-12 col-md-7 header-text">
                <h2>Get local services at your home</h2>
                <p>Provider or search services near you.Take the service without paying anything.Download the app to get started.Available on all major platforms</p>
                <a href="#" class="button white" style="margin-right: 20px"><i class="fab fa-google-play"></i> Play Store</a>
                <a href="#" class="button white"><i class="fab fa-app-store-ios"></i> App Store</a>
            </div>
            <div class="hidden-xs hidden-sm col-md-5 text-right">
                <div class="screen-slider">
                    <div class="item">
                        <img src="{{url('/home-assets')}}/images/screen-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--Header-area/-->

<footer class="footer-area relative" style="box-shadow: 0 0 12px rgba(0,0,0,0.14)">
    <div class="absolute"></div>
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 pull-right">
                    <ul class="social-menu text-right x-left">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3" style="color:#ffffff">
                    <h4>Contact Us</h4>
                    <p>Serloc Inc</p>
                    <p>26, South Dumdum</p>
                    <p>Kolkata - 700074</p>
                    <p>1800 2580 125</p>
                    <p>contact@serloc.com</p>
                </div>
                <div class="col-xs-12 col-sm-3" style="color:#ffffff">
                    <h4>Links</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="">Faq</a></li>
                        <li class="list-group-item"><a href="">Privacy Policy</a></li>
                        <li class="list-group-item"><a href="">About Serloc</a></li>
                        <li class="list-group-item"><a href="{{url('login')}}">Cpanel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p><a href="{{url('/')}}">&copy; {{date('Y')}} {{config('app.name')}}</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
{{--<canvas class="background"></canvas>--}}
<div id="particles-js" class="background"></div>
<!--Vendor-JS-->
<script src="{{url('/home-assets')}}/js/vendor/jquery-1.12.4.min.js"></script>
<script src="{{url('/home-assets')}}/js/vendor/bootstrap.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>--}}
<script src="{{url('/js/particles.js')}}"></script>
<script>
    window.onload=function(){

        $(function(){
           refreshParticle()
        })


        particlesJS.load('particles-js', '{{url('/js/particles.json')}}', function() {
            console.log('callback - particles.js config loaded');
        });


    };

    window.onresize=function(){
        refreshParticle();
    }
    function refreshParticle(){
        var body=$('body').height();
        var footer=$('footer').height();
        var h=parseFloat(body-footer - 40)
        console.log(h);
        $('.background').height(h);
    }
</script>
</body>

</html>
