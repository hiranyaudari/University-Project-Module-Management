@extends('masterpages.master_rpc')

@section('cssLinks')
    <title>Project</title>
@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Project Details</h2>
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
                                {{--<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">--}}

                                        {{--<strong>Details</strong>--}}

                                        {{--<ul class="list-group clear-list">--}}
                                            {{--<li class="list-group-item fist-item">--}}
                                                {{--<span class="pull-right"> {{ $project->title }} </span>--}}
                                                {{--Project Title--}}
                                            {{--</li>--}}
                                            {{--<li class="list-group-item">--}}
                                                {{--Project Description--}}
                                                {{--<span class="pull-right"> {{ $project->description }} </span>--}}

                                            {{--</li>--}}
                                        {{--</ul>--}}
                                        {{--<hr>--}}

                                        {{--<br>--}}
                                        {{--<div class="col-lg-12">--}}
                                            {{--<a class="btn btn-w-m btn-link" href="/downloadRequestedProject/{{ $project->url }}"><i class="fa fa-download"></i> Download Document--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                        {{--<hr>--}}
                                        {{--<hr>--}}
                                        {{--<hr>--}}


                                        {{--@if($project->status == 'Pending')--}}
                                            {{--<div class="col-lg-4">--}}
                                                {{--<button type="button" id="txtAcceptProject" name="txtAcceptProject" class="btn btn-primary btn-sm btn-block" onclick="acceptProject()"><i class="fa fa-envelope"></i> Accept--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-lg-4">--}}
                                                {{--<button type="button" id="txtRejectProject" name="txtRejectProject" class="btn btn-danger btn-sm btn-block" onclick="rejectProject()"><i class="fa fa-envelope"></i> Reject--}}
                                                {{--</button>--}}
                                            {{--</div>--}}


                                        {{--@elseif($project->status == 'Approved')--}}
                                            {{--<a style="color: #27ae60;font-size: 30px" class="btn btn-w-m fa col-md-12">This project has been accepted !!--}}
                                            {{--</a>--}}
                                        {{--@elseif($project->status == 'Rejected')--}}
                                            {{--<a style="color: #c0392b;font-size: 30px" class="btn btn-w-m fa col-md-12">This project has been Rejected !!--}}
                                            {{--</a>--}}
                                        {{--@endif--}}

                                    {{--</div>--}}
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

                                        {{--<ul class="list-group clear-list">--}}
                                            {{--<li class="list-group-item fist-item">--}}
                                                {{--<span class="pull-right"> {{ $student->name }} </span>--}}
                                                {{--Student Name--}}
                                            {{--</li>--}}
                                            {{--<li class="list-group-item fist-item">--}}
                                                {{--<span class="pull-right"> {{ $student->regId }} </span>--}}
                                                {{--Registration Id--}}
                                            {{--</li>--}}
                                            {{--<li class="list-group-item">--}}
                                                {{--<span class="pull-right">  {{ $student->email }}  </span>--}}
                                                {{--Student Email--}}


                                            {{--</li>--}}
                                            {{--<li class="list-group-item">--}}
                                                {{--<span class="pull-right">  {{ $student->phone }}  </span>--}}
                                                {{--Student Telephone--}}


                                            {{--</li>--}}
                                            {{--<li class="list-group-item">--}}
                                                {{--<span class="pull-right">  {{ $student->courseField }}  </span>--}}
                                                {{--Course Field--}}


                                            {{--</li>--}}
                                            {{--<li class="list-group-item">--}}
                                                {{--<span class="pull-right">  {{ $student->attempt }}  </span>--}}
                                                {{--Attempt--}}


                                            {{--</li>--}}
                                        {{--</ul>--}}

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
        function acceptProject(){
            var url = window.location.pathname;
            var projectId = url.substring(url.lastIndexOf('/') + 1);
            var StudentId = location.pathname.split('/')[1];
            alert(StudentId);
            var postData = {
                'projectId' : id
            };

            $.ajax({
                type: "GET",
                url: "/acceptProject",
                data: postData,
                success: function(data){
                    console.log(data);
                    document.getElementById('txtAcceptSuccess').innerHTML = "  This Project accepted by the LIC !!";
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

        }
    </script>

    <script>
        function rejectProject() {
            var url = window.location.pathname;
            var projectId = url.substring(url.lastIndexOf('/') + 1);

            var postData = {
                'projectId': id
            };

            $.ajax({
                type: "GET",
                url: "/rejectProject",
                data: postData,
                //assign the var here
                success: function (data) {
                    console.log(data);
//                document.location.reload();

                    document.getElementById('txtAcceptSuccess').innerHTML = "  This Project Rejected by the LIC !!";
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
        }
    </script>

@endsection


