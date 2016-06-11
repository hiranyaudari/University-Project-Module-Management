<!DOCTYPE html>
<html>


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>500 Error</title>


    <link href="{{ asset('public_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/404/css/style.css') }}" rel="stylesheet" type="text/css"  media="all" />

</head>


<body class="gray-bg">

<!--start-wrap--->
{{--<div class="wrap">--}}
<!---start-header---->

<div class="header">
    <div class="logo">
        <h1><span style="color: #ffffff" <a href="#">Internal Server Error</a></h1>
    </div>
</div>

<!---End-header---->
<div class="middle-box text-center animated fadeInDown">
    <!--start-content------>
    <div class="error-desc">
        {{--<img src="{{asset('public_assets/404/images/error-img.png')}}" title="error" />--}}
        <p>The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
            You can go back to the home page: </p>
        <br />
        <br />

        @if (Session::has('message_error'))
            <div class="alert alert-danger" role="alert" id="divAlert" style="font-size: 14px">
                {{ Session::get('message_error') }}
            </div>
        @endif
        <a href="/">Back To Home</a>
        <div class="copy-right">
            <p>2016 All rights Reserved | workZone</a></p>
        </div>
    </div>
</div>
<!--End-Cotent------>
{{--</div>--}}
<!--End-wrap--->

</body>



</html>
