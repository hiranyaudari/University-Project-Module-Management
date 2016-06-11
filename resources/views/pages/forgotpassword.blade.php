<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="{{asset('public_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/style.css')}}" rel="stylesheet">
</head>

<body style="background-color:#ffffff ">
<nav class="navbar navbar-default">



    <div class="container-fluid col-lg-12" style="background-color: #2F4050;
    border-color: #1ab394;
    color: #FFFFFF;">
        <div class="navbar-header">

            <a class="navbar-brand" style="color:#ffffff" href="#">workZone Project Management</a>
        </div>

    </div>
</nav>




<div class="middle-box text-center animated fadeInDown">

    <div style="margin-left: -150px">
        <h7 class="logo-name" style="background-color: #2F4050;
    border-color: #1ab394;
    color: #ecf0f1;"><small><small>work</small></small>Zone</h7>
        </div>
    <br>

        <h3>Have Trouble Signing In??</h3>
        <!--p>ssd
        </p-->
        <p>Enter the email you use to login to recover your password</p>
        <form class="m-t" role="form" method="POST" action="{{ url('/forgotpassword') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter email here" value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn btn-primary full-width block m-b">Reset Password</button>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{--<strong>Whoops!</strong> There were some problems with your inputs.<br><br>--}}
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                </div>
            @endif
        </form>
        <p class="m-t"> <small>workZone Project Management &copy; 2016</small> </p>

</div>

<!-- Mainly scripts -->
<script src="{{asset('public_assets/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>

</body>

</html>