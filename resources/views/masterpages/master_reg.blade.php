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
    <link href="{{ asset('public_assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('public_assets/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/sweetalert.css') }}">

</head>

<body class="gray-bg">
    <div id="wrapper">
    @yield('title')
<div class="animated fadeInRight">
    <div class="row">
       <div class="col-lg-12">
           <nav class="navbar navbar-default">
               <div class="container-fluid col-lg-12" style="background-color: #2F4050;
    border-color: #2F4050;
    color: #FFFFFF;">
                   <div class="navbar-header">

                       <a class="navbar-brand" href="#" style="color: #ffffff;">workZone Project Management</a>
                   </div>

               </div>
           </nav>

           <div class="ibox float-e-margins">
               <div class="ibox-title">
                   @yield('subheader')

               </div>

               <div class="ibox-content">



                   @yield('content')
               </div>
           </div>
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
                        workZone <strong>Project</strong> Management.
                    </div>
                    <div>
                        <strong>Copyright</strong> workZone 2016
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
    <script src="{{ asset('public_assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/staps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/validate/jquery.validate.min.js') }}"></script>

    @yield('ValidationJavaScript')

    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script async="" src="{{ asset('public_assets/Landing_page/analytics/analytics.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap-formhelpers.js') }}"></script>
    <script src="{{asset('public_assets/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
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


    <!-- jQuery 2.1.3 -->
    <!--script src="{{asset('/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
    <!-- jQuery UI 1.11.2 -->
    <!--script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!--script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <!--script src="{{asset('/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <!--script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{asset('/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <!-- Sparkline -->
    <!--script src="{{asset('/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <!-- jvectormap -->
    <!--script src="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <!--script src="{{asset('/plugins/knob/jquery.knob.js')}}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <!--script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <!-- datepicker -->
    <!--script src="{{asset('/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <!--script src="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
    <!-- iCheck -->
    <!--script src="{{asset('/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <!--script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <!--script src='{{asset('/plugins/fastclick/fastclick.min.js')}}/'></script>
    <!-- AdminLTE App -->
    <!--script src="{{asset('/dist/js/app.min.js')}}" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--script src="{{asset('dashboards')}}" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <!--script src="{{asset('/dist/js/demo.js')}}" type="text/javascript"></script>


</body>

</html>
