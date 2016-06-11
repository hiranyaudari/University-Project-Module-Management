@extends('masterpages.master_rpc')

@section('cssLinks')
    <title>Project without Supervisor</title>
@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Project without Supervisor</h2>
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


        <div class="col-md-6">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">


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

                                        <br>
                                        <div class="col-lg-12">
                                            <a class="btn btn-w-m btn-link" href="/downloadRequestedProject/{{ $project->url }}"><i class="fa fa-download"></i> Download Document
                                            </a>
                                        </div>
                                        <hr>
                                        <hr>


                                        @if($project->supervisorId === null)

                                        <div class="form-group">
                                            <label>Select Supervisor</label>
                                            <select class="form-control m-b" id="selectSupervisor">

                                                @foreach($supervisors as $supevisor=>$value)

                                                    <option value="{{ $supevisor }}">{{ $value }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <hr>

                                        <div class="col-lg-6">
                                            <button type="button" id="txtAddSupervisor" name="txtAddSupervisor" class="btn btn-primary btn-sm btn-block" onclick="addSupervisorForProject()"><i class="fa fa-envelope"></i> Add
                                            </button>
                                        </div>

                                            <div class="col-lg-6">
                                                <button type="button" id="txtUnreadNotification" name="txtUnreadNotification" class="btn btn-default btn-sm btn-block" onclick="unreadNotification()"><i class="fa fa-envelope"></i> Not Now
                                                </button>
                                            </div>



                                        @else
                                                <a style="color: #27ae60;font-size: 30px" class="btn btn-w-m fa col-md-12">Supervisor has been assigned !!
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

        <div class="col-md-6">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">


                        <div class="alert alert-danger alert-dismissible" hidden="true" role="alert" id="acceptSuccess">
                            <span  class="glyphicon glyphicon-envelope"><strong id="txtAcceptSuccess"></strong></span>
                        </div>

                        <div id="contact-1" class="tab-pane active">

                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>Student Details Details</h2>
                                </div>
                            </div>

                            <div class="client-detail">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">

                                        <strong>Details</strong>

                                        <ul class="list-group clear-list">
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $student->name }} </span>
                                                Student Name
                                            </li>
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> {{ $student->regId }} </span>
                                                Registration Id
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">  {{ $student->email }}  </span>
                                                Student Email


                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">  {{ $student->phone }}  </span>
                                                Student Telephone


                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">  {{ $student->courseField }}  </span>
                                                Course Field


                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">  {{ $student->attempt }}  </span>
                                                Attempt


                                            </li>
                                        </ul>

                                        <hr>


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
    function addSupervisorForProject(){
        var panelMemberId = document.getElementById('selectSupervisor').value;
        var url = window.location.pathname;
        var projectId = url.substring(url.lastIndexOf('/') + 1);

        var postData = {
            'panelMemberId': panelMemberId,
            'projectId': projectId
        };

        swal({   title: "Are you sure?",
            text: "Do you want to assign this Supervisor to above project ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Set it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {

                $.ajax({
                    type: "GET",
                    url: "/addSupervisorForProject",
                    data: postData,
                    //assign the var here
                    success: function (data) {
                        console.log(data);
//                document.location.reload();
                        swal("Assigned!", "Supervisor has been assigned to this project !!", "success");
                        document.getElementById('txtAcceptSuccess').innerHTML = "  New Supervisor has been added to this Project !!";
                        $("#acceptSuccess").slideDown(500, function(){
//                    $("#acceptSuccess").show();
                            setTimeout(function(){
                                $("#acceptSuccess").slideUp(500);
                            },5000);

                        });
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
                        x=false;
                      var x =  swal("Unread!", "This Notification marked as unread !!", "success");
                        if(x){
document.location.reload();
                        }
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


