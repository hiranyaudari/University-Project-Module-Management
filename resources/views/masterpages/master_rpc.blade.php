<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>workZone</title>
    @yield('cssLinks')


    {{--<script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>--}}
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">

    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('public_assets/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/sweetalert.css') }}">

    <script src="{{ asset('public_assets/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/sweetalert.css') }}">

    {{--data tables--}}
    <link href="{{ asset('public_assets/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">


    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/sweetalert.css') }}">
    <link href="{{ asset('public_assets/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/chosen/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/cropper/cropper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/nouslider/jquery.nouislider.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/ionRangeSlider/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">




    <script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <script src="{{ asset('public_assets/js/plugins/staps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap.min.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap-formhelpers.js') }}"></script>
    <script src="{{asset('public_assets/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/demo/peity-demo.js') }}"></script>





    <script src="{{ asset('public_assets/js/plugins/staps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap.min.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap-formhelpers.js') }}"></script>
    <script src="{{asset('public_assets/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/demo/peity-demo.js') }}"></script>


</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>

                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Session::get('userName')[0] }}</strong>
                             </span> <span class="text-muted text-xs block">{{ Session::get('userPosition')[0] }}<b class="caret"></b></span> </span> </a>

                    </div>
                    <div class="logo-element">
                     
                    </div>
                </li>

                <li class="active">
                    <a href="/rpcdashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> <span class="fa"></span></a>

                </li>

                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Project</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/allProjects">All Projects</a></li>
                        <li ><a href="/RPCViewOwnProject">Own Projects</a></li>
                        <li ><a href="/ViewPendingProjects">Pending Projects</a></li>
                        <li ><a href="/viewExternalSupervisorProject">External Supervisor Projects</a></li>

                    </ul>
                </li>
<!--                Harsha added - add research area -->
                 <li>
                    <a href="/addResearchArea"><i class="fa fa-th-large"></i> <span class="nav-label">Add Research Area</span></a>
                </li>
<!--                end of add research area-->
                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Supervisor</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/ExternalSup">Add Supervisor</a></li>
                        <li class="active"><a href="/updateExternalSupervisor">Update Supervisor</a></li>
                        <li class="active"><a href="/changeSup">Change Supervisor</a></li>
                        <li>
                            <a href="/profile"> <span class="nav-label">View Profile</span> </a>

                        </li>
                        <li><a href="/approvedExternalSupervisors">View Approved</a></li>
                        <!--li ><a href="#">View Pending</a></li-->
                        <li ><a href="/rejectedSupervisors">View Rejected</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Notice</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/addNotice">Add Notice</a></li>
                        <li ><a href="/viewNotice">View Notice</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">User Accounts</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/addUser">Register</a></li>
                        <li ><a href="/updateUser">Update</a></li>


                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Proposal Presentations</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="/proposalpanels">View Presentation Schedules</a></li>
                        <li><a href="/proposalpanels/create">Create a Panel</a></li>
                        <li><a href="/viewAllPanelmembers">All Panel Members</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Thesis Presentations</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="/thesispanels">View presentation schedules</a></li>
                        {{--<li><a href="/thesispanels/create">Create a Panel</a></li>--}}
                        <li><a href="/thesispanels/calendar/add">Create a schedule </a></li>
                        <li><a href="/thesispanels/calendar">View schedules in calendar</a></li>
                    </ul>
                </li>

                {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Monthly Reports</span><span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                        {{--<li><a href="/monthlyreports">View Monthly Reports</a></li>--}}
                        {{--<li><a href="/monthlyreports/student/create">Student Monthly Report</a></li>--}}
                        {{--<li><a href="/monthlyreports/supervisor/create">Supervisor Feedback Form</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Proposal Evaluation</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/viewInternalProposals">View evaluated thesis</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Thesis Evaluation</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/form">Edit Form</a></li>
                        <li class="active"><a href="/viewInternalProjects">View evaluated thesis</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/freeSlotManager"><i class="fa fa-th-large"></i> <span class="nav-label">Free Slot Management</span></a>

                </li>
                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Upload Links</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="/upload">Add Link</a></li>
                        <li ><a href="/viewLink">View Links</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/viewSubmissions"><i class="fa fa-th-large"></i> <span class="nav-label">Student Submissions</span> </a>

                </li>

            </ul>

        </div>

    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">

            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0" >
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right" >
                    <li>
                        <span class="m-r-sm text-muted welcome-message" style="color: #2c3e50">Welcome to <big><strong>workZone</strong></big></span>
                    </li>
                    <!----------------------------------->
                    <li class="dropdown" >
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true" >
                            <i class="fa fa-envelope" style="background-color: #ecf0f1"></i>
                            <?php $totalUnreadMessagesCount = 0;?>

                            @for($i1=0; $i1<count(Session::get('notification.UnreadBelongsToRPC'))  ;$i1++)
                                <?php $totalUnreadMessagesCount = $totalUnreadMessagesCount+count(Session::get('notification.UnreadBelongsToRPC')[$i1]["allUnreadNotification"]) ?>
                            @endfor

                            @if($totalUnreadMessagesCount!=0)
                                <span class="label label-warning">
                                        {{$totalUnreadMessagesCount}}
                                    </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul class="dropdown-messages" style="height: 300px; overflow: auto;">
                                    @for($id=0;$id<count(Session::get('notification.BelongsToRPC'));$id++)
                                        @foreach(Session::get('notification.BelongsToRPC')[$id]['allNotification'] as $rpc)
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

                                            @else
                                                <?php $routeURL = '/justReadNotification/'.$rpc->id; ?>
                                            @endif

                                            @if($rpc->read==1)
                                                <li>
                                                    <div class="dropdown-messages-box" style="background-color: #ffffff">

                                                        <a href="{{ url($routeURL) }}" class="pull-left" >
                                                            <img alt="image" src="{{ asset('public_assets/img/a7.jpg') }}" href="{{  url($routeURL)  }}" class="img-circle" src="#">
                                                        </a>


                                                        <div class="media-body" style="color: #000 ;">
                                                            <small class="pull-trigh"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%h");?>h ago</small>
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

                                                        <a href="{{  url($routeURL)  }}" class="pull-left" >
                                                            <img alt="image" src="{{ asset('public_assets/img/a7.jpg') }}" href="{{  url($routeURL)  }}" class="img-circle" src="#">
                                                        </a>

                                                        <div class="media-body" style="color: #000 ;">
                                                            <small class="pull-right"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%h");?>hr ago</small>
                                                            <strong >{{ $rpc->from_id }}</strong>
                                                            {{$rpc->text }}<strong></strong>. <br>
                                                            <small class="text-muted"><?php $now = new DateTime();
                                                                echo $now->diff($rpc->created_at)->format("%a");?> days ago at <?php echo date_format($rpc->created_at, 'g:i A');?> - <?php echo $newDate = date("Y/m/d", strtotime($rpc->created_at)); ?>
                                                            </small>
                                                        </div>

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
                    <!---------------------------------->
                    <li>
                        <a href="/logout" style="color: #2c3e50">
                            <i class="fa fa-sign-out" style="color: #2c3e50"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div id="target">
            <div style="margin-top: 10px">
                @yield('title')
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">

                @yield('content')

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

<script src="{{ asset('public_assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('public_assets/js/demo/peity-demo.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('public_assets/js/demo/sparkline-demo.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/chartJs/Chart.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/toastr/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{asset('public_assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('public_assets/js/demo/chartjs-demo.js') }}"></script>

<script src="{{asset('public_assets/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>




<script src="{{ asset('public_assets/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/jsKnob/jquery.knob.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/nouslider/jquery.nouislider.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/switchery/switchery.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/iCheck/icheck.min.js') }}"></script>
{{--<script src="{{ asset('public_assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>--}}
<script src="{{ asset('public_assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/clockpicker/clockpicker.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/cropper/cropper.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public_assets/sweetalert.min.js') }}"></script>
<script src="{{ asset('public_assets/js/jquery-ui.custom.min.js') }}"></script>
{{----}}
<script src="{{ asset('public_assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('public_assets/js/demo/sparkline-demo.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/chartJs/Chart.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/toastr/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="{{ asset('public_assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{asset('public_assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>



<script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public_assets/js/plugins/footable/footable.all.min.js') }}"></script>
</body>
</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  