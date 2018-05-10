<!DOCTYPE html>
<html>
<title>Password reset - Management Matters</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png"
      href="{{asset('assets/img/favicon.png')}}">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
@include('includes.css')
<body>
<div class="container">
    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload=function(){

        @if(session()->has('success') || session('success'))
        setTimeout(function () {
            showToast('Success', '{{ session('success') }}', 'success');
        }, 500);
        @endif

        @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
        @foreach ($errors->all() as $key => $error)

        setTimeout(function () {
            showToast('Error', '{{ $error }}', 'error');
        }, {{ $timeout * $key }});
        @endforeach
        @endif
    }
</script>
@include('includes.js')
</body>
</html>

