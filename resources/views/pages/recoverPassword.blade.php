<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password</title>
    <link href="{{asset('public_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/style.css')}}" rel="stylesheet">
</head>

<body class="gray-bg">
    
    <nav class="navbar navbar-default">



    <div class="container-fluid col-lg-12" style="background-color: #2F4050;
    border-color: #1ab394;
    color: #FFFFFF;">
        <div class="navbar-header">

            <a class="navbar-brand" style="color:#ffffff" href="#">workZone Project Management</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
<!--<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="container-fluid col-lg-12" style="background-color: #2F4050;
    border-color: #1ab394;
    color: #FFFFFF;">
        <div class="navbar-header">

            <a class="navbar-brand" style="color:#ffffff" href="#">workZone Project Management</a>
        </div>

    

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
        </div>
</nav>-->
<div class="middle-box text-center animated fadeInDown">
    <div>
        <div>
            <h7 class="logo-name" style="background-color: #2F4050; margin-left: -150px;
    border-color: #1ab394;
    color: #ecf0f1;"><small><small>work</small></small>Zone</h7>
        </div>
        <br>
        <h3>Change Password</h3>
        <!--p>ssd
        </p-->
        <p>Enter the password you received in the email and your new password.</p>
        <form class="m-t" role="form" method="POST" action="{{ url('/resetpassword') }}">

            <input type="hidden" name="code" value=" {{$code}} ">

            <div class="form-group">
                <input type="password" class="form-control" name="currentPassword" placeholder="Enter password received in Email" >
                <input type="password" class="form-control" name="newPassword" placeholder="Enter new password" >
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password" >
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Change Password</button>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{--<strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        <p class="m-t"> <small>workZone Project Management &copy; 2016</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public_assets/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>

</body>

</html>