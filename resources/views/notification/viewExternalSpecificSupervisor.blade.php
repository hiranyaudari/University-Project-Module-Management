@extends('masterpages.master_rpc')

@section('cssLinks')
    <title>External Supervisor</title>
@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>External Supervisor Details</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')

    <div class="row">


        <div class="alert alert-success alert-dismissable" hidden="true" role="alert" id="acceptSuccess">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <span  class="glyphicon glyphicon-envelope"><strong id="txtAcceptSuccess"></strong></span>
        </div>
        <div class="alert alert-success alert-dismissable" hidden="true" role="alert" id="rejectSuccess">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <span  class="glyphicon glyphicon-envelope"><strong id="txtRejectSuccess"></strong></span>
        </div>


        @if($project->status=='Pending')
            <a class="btn btn-w-m btn-link1 fa fa-download col-md-12" href="{{'/viewProjectDetails'.'/'.$student->id.'/'. $notificationId.'/'.$project->id }}">This project is Not accepted yet so that you can't make action for this supervisor !!
            </a>
        @endif




        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Supervisor Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>{{ $supervisor->name }}</h2>
                                </div>
                            </div>

                            <div class="client-detail">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">

                                        <strong>Details</strong>

                                        <ul class="list-group clear-list">
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right">{{ $supervisor->university }}</span>
                                                Attached Institute
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">{{ $supervisor->designation }}</span>
                                                Designation
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">{{ $supervisor->phone }}</span>
                                                Tel Number
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">{{ $supervisor->email }}</span>
                                                Email
                                            </li>

                                        </ul>

                                        <hr>




                                        @if($supervisor->status =='Pending')
                                            @if($project->status!='Pending')
                                            <div class="col-lg-4">
                                                <button type="button" id="txtAcceptExternalSupervisor" name="txtAcceptExternalSupervisor" class="btn btn-primary btn-sm btn-block" onclick="acceptExternalSupervisor()"><i class="fa fa-envelope"></i> Accept
                                                </button>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" id="txtRejectExternalSupervisor" name="txtAcceptExternalSupervisorNotNow" class="btn btn-danger btn-sm btn-block" onclick="rejectExternalSupervisor()"><i class="fa fa-envelope"></i> Reject
                                                </button>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" id="txtUnreadNotification" name="txtUnreadNotification" class="btn btn-default btn-sm btn-block" onclick="unreadNotification()"><i class="fa fa-envelope"></i> Not Now
                                                </button>
                                            </div>
                                            @endif
                                        @elseif($supervisor->status == 'Approved')
                                            <a style="color: #27ae60;font-size: 30px" class="btn btn-w-m fa col-md-12">This Supervisor has been accepted !!
                                            </a>
                                        @elseif($supervisor->status == 'Rejected')
                                            <a style="color: #c0392b;font-size: 30px" class="btn btn-w-m fa col-md-12">This Supervisor has been Rejected !!
                                            </a>
                                        @endif


                                        {{--@if($project->status=='Approved')--}}
                                        {{--<div class="col-lg-6">--}}
                                        {{--<button type="button" id="txtRejectExternalSupervisor" name="txtRejectExternalSupervisor" class="btn btn-danger btn-sm btn-block" onclick="rejectExternalSupervisor()"><i class="fa fa-envelope"></i> Reject--}}
                                        {{--</button>--}}
                                        {{--</div>--}}
                                        {{--@endif--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Project Details</h5>
                </div>
                <div class="ibox-content">
                    <div>


                        <div class="alert alert-danger alert-dismissible" hidden="true" role="alert" id="acceptSuccess">
                            <span  class="glyphicon glyphicon-envelope"><strong id="txtAcceptSuccess"></strong></span>
                        </div>

                        <div id="contact-1" class="tab-pane active">

                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>Requested Project Details</h2>
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
                                        </ul>

                                        <hr>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-w-m btn-link" href="/downloadRequestedProject/{{ $project->url }}"><i class="fa fa-download"></i> Download Document
                    </a>
                </div>
            </div>
            <div class="col-lg-12">




            </div>
        </div>
    </div>








@endsection

@section('ValidationJavaScript')
    <script>
        function acceptExternalSupervisor(){
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
var projectId = location.pathname.split('/')[1];

            var postData = {
                'panelMemberId' : id
            };



            swal({   title: "Are you sure?",
                text: "Do you want to to Accept this External Supervisor ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Unread it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type: "GET",
                        url: "/acceptExternalSupervisor",
                        data: postData,
                        success: function(data){
                            console.log(data);
                            document.getElementById('txtAcceptSuccess').innerHTML = "  External Supervisor has been Added Successfully !!";
                            $("#acceptSuccess").slideDown(500, function(){
//                    $("#acceptSuccess").show();
                                setTimeout(function(){
                                    $("#acceptSuccess").slideUp(500);
                                },5000);

                            });

                        },
                        error : function(data){
                            console.log(data);
                            swal("Accepted !", "External Supervisor has not been Added !!", "success");

                            document.getElementById('txtRejectSuccess').innerHTML = "  External Supervisor has not been Added !!";
                            $("#rejectSuccess").slideDown(500, function(){
//                    $("#acceptSuccess").show();
                                setTimeout(function(){
                                    $("#rejectSuccess").slideUp(500);
                                },5000);

                            });
                        },
                        complete : function($result){
                        }


                    });

                } else
                {     swal("Cancelled", "", "error");

                }
            });


        }
    </script>

    <script>
        function rejectExternalSupervisor() {
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            var postData = {
                'panelMemberId': id
            };
            swal({   title: "Are you sure?",
                text: "Do you want to Reject this External Supervisor ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Reject this External!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        type: "GET",
                        url: "/RejectExternalSupervisor",
                        data: postData,
                        //assign the var here
                        success: function (data) {
                            console.log(data);
                            swal("Rejected !", "External Supervisor has been Rejected Successfully !!", "success");
                            document.getElementById('txtAcceptSuccess').innerHTML = "  External Supervisor has been Rejected Successfully !!";
                            $("#acceptSuccess").slideDown(500, function(){
//                    $("#acceptSuccess").show();
                                setTimeout(function(){
                                    $("#acceptSuccess").slideUp(500);
                                },5000);

                            });
//                document.location.reload();
                        },
                        error: function (data) {
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
    <script>
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