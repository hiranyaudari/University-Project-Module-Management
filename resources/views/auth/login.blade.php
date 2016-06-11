<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{asset('public_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/style.css')}}" rel="stylesheet">
</head>

<body style="background-color: #ffffff">
<nav class="navbar navbar-default">



    <div class="container-fluid col-lg-12" style="background-color: #293846;
    border-color: #293846;
    color: #FFFFFF;">
        <div class="navbar-header">

            <a class="navbar-brand" style="color:#ffffff" href="#">workZone Project Management</a>
        </div>

    </div>
</nav>


    @if (Session::has('message_error'))
        <div class="alert alert-danger" role="alert" id="divAlert" style="font-size: 14px">
            {{Session::get('message_error') }}
        </div>
    @elseif(Session::has('message_success'))
        <div class="alert alert-success" role="alert" id="divAlert" style="font-size: 14px">
            <span class="glyphicon glyphicon-envelope"></span> {{Session::get('message_success') }}
        </div>
    @endif
<div class="middle-box text-center animated fadeInDown">

    <div>

        {{--<h1 class="logo-name" style="background-color: #1ab394;--}}
    {{--border-color: #1ab394;--}}
    {{--color: #FFFFFF;">workZone</h1>--}}
        <img src="{{ asset('public_assets/img/sliitbanner.jpg')}}" />
    </div>
    </br>
        <h2><strong>Welcome to workZone</strong></h2>
        <!--p>ssd
        </p-->
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Username" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Try Again!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <a href="{{ url('/forgotpassword') }}"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="/registration"><strong>Create an account</strong></a>
        </form>
        <p class="m-t"> <small>workZone &copy; 2016</small> </p>

</div>

<!-- Mainly scripts -->
<script src="{{asset('public_assets/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>

</body>

</html>