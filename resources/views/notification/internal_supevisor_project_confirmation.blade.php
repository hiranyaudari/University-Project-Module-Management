@extends('masterpages.master_rpc')

@section('cssLinks')
    <title>Project</title>
@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Internal Supervisor Request Details</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')
    <div class="row">

        {{--<div class="alert alert-success alert-dismissible" hidden="true" role="alert" id="acceptSuccess">--}}
        {{--<span  class="glyphicon glyphicon-envelope"><strong id="txtAcceptSuccess"></strong></span>--}}
        {{--</div>--}}

        <div class="alert alert-success alert-dismissable" hidden="true" role="alert" id="acceptSuccess">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <span  class="glyphicon glyphicon-envelope"><strong id="txtAcceptSuccess"></strong></span>
        </div>


        @if($project->status=='Pending')
            <a class="btn btn-w-m btn-link1 fa fa-download col-md-12" href="{{'/viewProjectDetails'.'/'.$project->studentId.'/'. $notificationID.'/'.$project->id }}">This project is Not accepted yet so that you can't make action for this supervisor !!
            </a>
        @endif

        <div class="col-md-16">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">


                        <div class="alert alert-danger alert-dismissible" hidden="true" role="alert" id="acceptSuccess">
                            <span  class="glyphicon glyphicon-envelope"><strong id="txtAcceptSuccess"></strong></span>
                        </div>

                        <div id="contact-1" class="tab-pane active">

                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>Internal Supervisor Request</h2>
                                </div>
                            </div>

                            <div class="client-detail">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">

                                        <strong>Details</strong>

                                        <ul class="list-group clear-list">
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $project->title }} </span>
                                                Project Title
                                            </li>
                                            <li class="list-group-item">
                                                Project Description
                                                <span class="pull-right"> {{ $project->description }} </span>

                                            </li>

                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $Internalsupervisor->name }} </span>
                                                Supervisor Name
                                            </li>

                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $Internalsupervisor->email }} </span>
                                                Supervisor Email
                                            </li>
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $Internalsupervisor->designation }} </span>
                                                Supervisor Designation
                                            </li>
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $Internalsupervisor->speciality }} </span>
                                                Supervisor Speciality
                                            </li>
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $Internalsupervisor->phone }} </span>
                                                Supervisor Tel
                                            </li>
                                        </ul>
                                        <hr>

                                        <br>
                                        <div class="col-lg-12">
                                            <a class="btn btn-w-m btn-link" href="/downloadRequestedProject/{{ $project->url }}"><i class="fa fa-download"></i> Download Document
                                            </a>
                                        </div>
                                        <hr>
                                        @if($project->status=='Approved' AND $project->supervisorId==null)

                                            <div class="col-lg-4">
                                                <button type="button" id="txtAcceptProject" name="txtAcceptProject" class="btn btn-primary btn-sm btn-block" onclick="acceptProjectInternalSupervisor()"><i class="fa fa-envelope"></i> Accept
                                                </button>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" id="txtRejectProject" name="txtRejectProject" class="btn btn-danger btn-sm btn-block" onclick="rejectProjectInternalSupervisor()"><i class="fa fa-envelope"></i> Reject
                                                </button>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" id="txtUnreadNotification" name="txtUnreadNotification" class="btn btn-default btn-sm btn-block" onclick="unreadNotification()"><i class="fa fa-envelope"></i> Not Now
                                                </button>
                                            </div>

                                        @else
                                            <a style="color: #27ae60;font-size: 30px" class="btn btn-w-m fa col-md-12">Supervisor has been assign to this project !!
                                            </a>


                                        @endif



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>






@endsection

@section('ValidationJavaScript')

    <script>
        function acceptProjectInternalSupervisor(){
            var projectId = location.pathname.split('/')[2];


            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            var postData = {
                'InternalSupervisorId' : id,
                'projectId' : projectId
            };


            swal({   title: "Are you sure?",
                text: "Do you want to add this Internal Supervisor for above project?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Add it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type: "GET",
                        url: "/acceptInternalSupervisorForProject",
                        data: postData,
                        success: function(data){
                            console.log(data);
                            swal("Assigned !", " Requested Internal Supervisor has been assigned to this project !!", "success");
                            document.getElementById('txtAcceptSuccess').innerHTML = "  Requested Internal Supervisor has been assigned to this project !!";
                            $("#acceptSuccess").slideDown(500, function(){
//                    $("#acceptSuccess").show();
                                setTimeout(function(){
                                    $("#acceptSuccess").slideUp(500);
                                },5000);

                            });

                        },
                        error : function(data){
                            alert( "error "+data);
                            console.log(data);
                        },
                        complete : function($result){
                        }


                    });


                } else
                {     swal("Cancelled", "", "error");

                }
            });




        }
        function rejectProjectInternalSupervisor(){
            var projectId = location.pathname.split('/')[2];
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            var postData = {
                'InternalSupervisorId' : id,
                'projectId' : projectId
            };
            swal({   title: "Are you sure?",
                text: "Do you want to add Reject Internal Supervisor for above project ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Reject it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type: "GET",
                        url: "/rejectInternalSupervisorForProject",
                        data: postData,
                        success: function(data){
                            console.log(data);
                            swal("Rejected !", "Requested Internal Supervisor has been Rejected to this project !!", "success");
                            document.getElementById('txtAcceptSuccess').innerHTML = "  Requested Internal Supervisor has been Rejected to this project !!";
                            $("#acceptSuccess").slideDown(500, function(){
//                    $("#acceptSuccess").show();
                                setTimeout(function(){
                                    $("#acceptSuccess").slideUp(500);
                                },5000);

                            });

                        },
                        error : function(data){
                            alert( "error "+data);
                            console.log(data);
                        },
                        complete : function($result){
                        }


                    });

                } else
                {     swal("Cancelled", "", "error");

                }
            });


        }

        function unreadNotification(){
            var notificationId = location.pathname.split('/')[3];

            var postData = {
                'notificationId': notificationId
            };


            swal({   title: "Are you sure?",
                text: "Do you want to Unread this Notification ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Unread it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type: "GET",
                        url: "/UnreadNotification",
                        data: postData,
                        //assign the var here
                        success: function (data) {
                            swal("Unread!", "This Notification marked as unread !!", "success");
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                            alert("error " + data);
                        },
                        complete: function ($result) {
                        }


                    });

                } else
                {     swal("Cancelled", "", "error");

                }
            });

        }
    </script>
@endsection


