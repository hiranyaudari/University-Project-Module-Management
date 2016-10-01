<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>workZone</title>
    @yield('cssLinks')
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">

    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('public_assets/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/sweetalert.css') }}">

    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">{{ Session::get('userName')[0] }}</strong>
                                </span>
                                <span class="text-muted text-xs block">{{ Session::get('userPosition')[0] }}
                                </span>
                            </span>
                        </a>

                    </div>
                    <div class="logo-element">
                       
                    </div>
                </li>
                <li>
                    <a href="/studentdashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Student Dashboard</span> </a>

                </li>
                
                <li>
                    <a href="/grouping"><i class="fa fa-th-large"></i> <span class="nav-label">Form Group</span> </a>

                </li>
                {{--<li>--}}
                    {{--<a href="/forgotpassword"><i class="fa fa-th-large"></i> <span class="nav-label">Change Password</span> </a>--}}
                {{--</li>--}}
                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Monthly Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="/monthlyreports/student/create">Submit Monthly Report</a></li>
                        <li><a href="/monthlyreports/student/feedbacks">View Supervisor Feedbacks</a></li>
                    </ul>
                </li>

                </li>
                <li>
                    <a href="/changeSupervisor"><i class="fa fa-th-large"></i> <span class="nav-label">Change Supervisor</span> </a>

                </li>
                <li>
                    <a href="/upLinksView"><i class="fa fa-th-large"></i> <span class="nav-label">Upload Documents</span> </a>

                </li>

                <li>
                    <a href="/report"><i class="fa fa-th-large"></i> <span class="nav-label">Upload Thesis Report</span> </a>

                </li>
                <li>
                    <a href="/reportfile"><i class="fa fa-th-large"></i> <span class="nav-label">Delete Report</span> </a>

                </li>
                <li>
                    <a href="/viewprogress"><i class="fa fa-th-large"></i> <span class="nav-label">Project Progress</span> </a>

                </li>

                <li>
                    <a href="/studentprofile"><i class="fa fa-th-large"></i> <span class="nav-label">Student Profile</span> </a>

                </li>

                <li>
                    <a href="/diaryhome"><i class="fa fa-th-large"></i> <span class="nav-label">Project Diary</span> </a>

                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#" style="border-color: #ffffff;"><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right" >
                    <li>
                        <span class="m-r-sm text-muted welcome-message" style="color: #2c3e50">Welcome to <big><strong>workZone</strong></big></span>
                    </li>

                    <li class="dropdown" >

                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true" >
                            <i class="fa fa-envelope" style="color: #2c3e50"></i>
                            @for($id2=0;$id2<count(Session::get('notification.UnreadBelongsToStudent'));$id2++)
                                @if(count(Session::get('notification.UnreadBelongsToStudent')[$id2]['allUnreadNotification'])!=0)
                                    <span class="label label-warning">
                                    {{ count(Session::get('notification.UnreadBelongsToStudent')[$id2]['allUnreadNotification']) }}
                                </span>

                                @else

                                @endif
                            @endfor
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul class="dropdown-messages" style="height: 300px; overflow: auto;">
                                    @for($id=0;$id<count(Session::get('notification.BelongsToStudent'));$id++)
                                        @foreach(Session::get('notification.BelongsToStudent')[$id]['allNotification'] as $rpc)
                                            <?php $routeURL = ''; ?>
                                            @if($rpc->url!='')
                                                @foreach(explode('/', $rpc->url) as $index => $element)
                                                    @if($index == 1)
                                                        <?php $name = $element;?>
                                                    @elseif($index == 2)
                                                        <?php $id1 = $element;?>
                                                    @elseif($index == 3)
                                                        <?php $id2 = $element;?>
                                                    @endif
                                                @endforeach

                                                <?php $routeURL = '/'.$name.'/'.$id1.'/'.$rpc->id.'/'.$id2; ?>
                                            @endif
                                            @if($rpc->read==1)
                                                <li>
                                                    <div class="dropdown-messages-box" style="background-color: #ffffff">

                                                        <a href="{{ $routeURL }}" class="pull-left" >
                                                            <img alt="image" src="{{ asset('public_assets/img/a7.jpg') }}" href="{{ $routeURL }}" class="img-circle" src="#">
                                                        </a>


                                                        <div class="media-body" style="color: #000 ;">
                                                            <small class="pull-trigh"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%h");?>hr ago</small>
                                                            <strong > </strong>
                                                            {{$rpc->text }}<strong> by {{ $rpc->from_id }}</strong>. <br>
                                                            <small class="text-muted"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%a");?> days ago at <?php echo date_format($rpc->created_at, 'g:i A');?> - <?php echo $newDate = date("Y/m/d", strtotime($rpc->created_at)); ?>
                                                            </small>
                                                        </div>

                                                    </div>
                                                </li>
                                                <li class="divider"></li>
                                            @elseif($rpc->read==0)

                                                <li>
                                                    <div class="dropdown-messages-box" style=" background-color: #ecf0f1">

                                                        <a href="{{ $routeURL }}" class="pull-left" >
                                                            <img alt="image" src="{{ asset('public_assets/img/a7.jpg') }}" href="{{ $routeURL }}" class="img-circle" src="#">
                                                        </a>

                                                        <div class="media-body" style="color: #000 ;">
                                                            <small class="pull-right"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%h");?>hr ago</small>
                                                            <strong >{{ $rpc->from_id }}</strong>
                                                            {{$rpc->text }}<strong></strong>. <br>
                                                            <small class="text-muted"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%a");?> days ago at <?php echo date_format($rpc->created_at, 'g:i A');?> - <?php echo $newDate = date("Y/m/d", strtotime($rpc->created_at)); ?>
                                                            </small>
                                                            <br>
                                                        </div>
                                                        
                                                        <button style="margin-left: 78px" type="button" class="btn btn-info btn-foursquare"><i class="fa fa-check"></i></button> 
                                                         
                                                        <button style="margin-left: 24px" type="button" class="btn btn-warning btn-foursquare"><i class="fa fa-times"></i></button> 
                                                    
                                                        </div>
                                                </li>
                                                <li class="divider"></li>
                                            @endif
                                            @endforeach
                                    @endfor
                                </ul>
                            </li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="#">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="/logout" style="color: #2c3e50">
                            <i class="fa fa-sign-out" style="color: #2c3e50"></i> Log out
                        </a>
                    </li>

                </ul>

            </nav>
        </div>
        <!-- content 1 -->
        <div style="margin-top: 10px">
            @yield('title')
        </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>

        </div>




        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <!-- content 2 -->
                </div>
                <div class="footer">
                    <div class="pull-right">
                        workZone <strong>Project</strong> Management
                    </div>
                    <div>
                        <strong>Copyright</strong> workZone 2016
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--Form Wizad-->
<!-- Mainly scripts -->
<script src="{{ asset('public_assets/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('public_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>

<!-- Steps -->
<script src="{{ asset('public_assets/js/plugins/staps/jquery.steps.min.js') }}"></script>

<!-- Jquery Validate -->
<script src="{{ asset('public_assets/js/plugins/validate/jquery.validate.min.js') }}"></script>



@yield('ValidationJavaScript')



<!--Form Wizad-->

<!-- Mainly scripts -->
<script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>

<script src="{{ asset('public_assets/js/bootstrap-formhelpers.js') }}"></script>
<!-- Flot -->
<script src="{{asset('public_assets/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
<!-- Peity -->
<script src="{{ asset('public_assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('public_assets/js/demo/peity-demo.js') }}"></script>
<!-- Custom and plugin javascript -->
<!-- jQuery UI -->
<script src="{{ asset('public_assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- GITTER -->
<script src="{{ asset('public_assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('public_assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Sparkline demo data  -->
<script src="{{ asset('public_assets/js/demo/sparkline-demo.js') }}"></script>
<!-- ChartJS-->
<script src="{{ asset('public_assets/js/plugins/chartJs/Chart.min.js') }}"></script>
<!-- Toastr -->
{{--<script src="{{ asset('public_assets/js/plugins/toastr/toastr.min.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>




<script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/footable/footable.all.min.js') }}"></script>

<script src="{{asset('public_assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>



<script src="{{asset('/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<!-- FastClick -->
<script src='{{asset('/plugins/fastclick/fastclick.min.js')}}/'></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/app.min.js')}}" type="text/javascript"></script>

<!-- AdminLTE dashboards demo (This is only for demo purposes) -->
{{--<script src="{{asset('/dist/js/pages/dashboard.js')}}" type="text/javascript"></script>--}}

{{--<!-- AdminLTE for demo purposes -->--}}
<script src="{{asset('/dist/js/demo.js')}}" type="text/javascript"></script>


<script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
<script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
</body>

</html>
