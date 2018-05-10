<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png"
          href="{{asset('assets/img/favicon.png')}}">
    <title>Management Matters - Signup</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href={{ asset('assets/register_resource/css/style.css')}}>
    <link rel="stylesheet" href={{ asset('assets/register_resource/css/style2.css')}}>

    <!--Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <style>
        #toast{
            position: fixed;
            bottom: 20px;
            width: 300px;
            height: auto;
            left: calc(50% - 170px);
            padding: 20px;
            background-color:#FFAB00;
            color:#fff;
            box-shadow: 0 5px 7px rgba(0,0,0,.29);
            border-radius: 2px;
            text-align: left;
            z-index: 99999;
        }
    </style>
</head>

<body>
<div id="main-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 left-side">
                <header>
                    <span>Need an account?</span>
                    <h3>Improve Your <br>Management Skills</h3>
                </header>
                <br>
                <br>
                <br>
                <button id="" class="btn btn-primary pull-center slide">
                    Learner
                </button>
            </div>
            <div class="col-md-6 last-slide">
                <header>
                    <span style="color: #fff;">Need an account?</span>
                    <h3>Better Employees<br>Better Growth</h3>
                </header>
                <br>
                <br>
                <br>
                <button id="" class="btn btn-primary pull-center slide">
                    Organization
                </button>

            </div>

            <div class="col-md-6 right-side">
                <span id="cross1" class="cross1" style="float:right;"></span>
                <span id="cross2" class="cross2" style="float:left;"></span>
                <form action="" method="post">
                    {{ csrf_field() }}
                    <header>
                        <span id="join">Join as a Learner !</span>
                        <span id="join2">Join as an Organization !</span>
                        <input id="role" type="hidden" value="">
                    </header>
                    <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="name" name="name" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
                          <span class="input__label-content input__label-content--hoshi">Name</span>
                      </label>
                    </span>
                    <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="email" id="email" name="email" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
                          <span class="input__label-content input__label-content--hoshi">E-mail</span>
                      </label>
                    </span>
                    <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="password" name="password" id="password" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
                          <span class="input__label-content input__label-content--hoshi">Password</span>
                      </label>
                    </span>
                    <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="password" name="password_confirmation" id="password1" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
                          <span class="input__label-content input__label-content--hoshi">Repeat Passowrd</span>
                      </label>
                    </span>
                    <div id="btn1" class="cta">
                        <button id="pull-left" class="btn btn-primary pull-left" type="submit" name="submit" value="learner">
                            Sign-Up Now
                        </button>
                        <span><a href="{{ url('/login') }}">I am already a member</a></span>
                    </div>
                    <div id="btn2" class="cta">
                        <button id="pull-left" class="btn btn-primary pull-left" type="submit" name="submit" value="organization">
                            Sign-Up Now
                        </button>
                        <span><a href="{{ url('/login') }}">I am already a member</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div> <!-- end #main-wrapper -->
<div id="toast" style="display: none"></div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://dcrazed.com/html/signup-pack/js/scripts.js"></script>
<script src={{asset('assets/register_resource/js/script25.js')}}></script>
<script>
    (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    })();
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".left-side .slide").click(function(){
            slideInRight();
            $("#cross2,#btn2,#join2").hide();
            $("#cross1,#btn1,#join").show();
            $("#role").val('L');
        });
        $(".last-slide .slide").click(function(){
            slideInLeft();
            $("#cross1,#btn1,#join").hide();
            $("#cross2,#btn2,#join2").show();
            $("#role").val('M');
        });

        @if(isset($errors) && count($errors->all()) > 0)
        @foreach ($errors->all() as $key => $error)
        var error="{{$error}}"
        frontToast(error);
        @endforeach
        @endif
    });

    function slideInRight(){
        $(".right-side").css({
            right:"-50%",
            "background-color": "#f5ebeb"
        });
        $(".input__label--hoshi").css({
            "border-bottom": "#ee6f51",
        });

        $(".input__label-content--hoshi").css({
            "color": "#333",
        });
        $(".right-side").animate({
            "right": '0%'
        });

    }
    function slideInLeft(){

        $(".right-side").css({
            right:"100%",
            "background-color": "#f75b36",
        });
        $("#join2").css({
            "color": "#f5ebeb",
        });

        $(".input__label-content--hoshi").css({
            "color": "#f5ebeb",
        });
        $(".right-side").animate({
            "right": '50%'
        });
    }

    function slideOutRight(){
        $(".right-side").animate({
            "right": '-50%'
        });

    }
    function slideOutLeft(){
        $(".right-side").animate({
            "right": '100%'
        });
    }

    function frontToast(error){
        $('#toast').empty().append(error).show('fast');
        setTimeout(function () {
            $('#toast').hide();
        }, 5000);
    }

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cross1").click(function(){
            slideOutRight();
            $("#cross1").hide();
            $("#cross2").show();
        });
        $("#cross2").click(function(){
            slideOutLeft();
            $("#cross2").hide();
            $("#cross1").show();
        });
    });
</script>

</body>
</html>
