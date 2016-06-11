<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v1.9.1/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Feb 2015 05:55:00 GMT -->

<!-- Mirrored from claytonta.lankapanel.biz/template/Template (10)/webapplayers.com/inspinia_admin-v1.9.1/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Mar 2015 10:17:49 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Supervisor</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    @yield('css_links')

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Harsha Pradeep</strong>
                             </span> <span class="text-muted text-xs block">Senior Lecturer <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                                            </div>
                </li>



                <li>
                    <a href="viewProjects"><i class="fa fa-envelope"></i> <span class="nav-label">My Projects </span></a>

                </li>

                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Submissions</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="IT_Submissions">IT</a></li>
                        <li><a href="IS_Submissions">IS</a></li>
                        <li><a href="SE_Submissions">SE</a></li>
                        <li><a href="CS_Submissions">CS</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Monthly Progress Reports</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="IT_MPReports">IT</a></li>
                        <li><a href="IS_MPReports">IS</a></li>
                        <li><a href="CS_MPReports">CS</a></li>
                        <li><a href="SE_MPReports">SE</a></li>

                    </ul>
                </li>
                <li>
                    <a href="projectPool"><i class="fa fa-files-o"></i> <span class="nav-label">ProjectPool</span><span class="fa arrow"></span></a>

                </li>
                <li>
                    <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Schedules</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="">FreeSlots</a></li>
                        <li><a href="">Presentation Schedules</a></li>

                    </ul>
                </li>


               </ul>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="http://webapplayers.com/inspinia_admin-v1.9.1/search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome To workZone</span>
                </li>


                <li>
                    <a href="login.html">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
     </div>
          </div>
    @yield('main_content')
          @yield('javascripts')
          </body>
          </html>
