@extends('masterpages.master_panel_member')

@section('cssLinks')
    <title>Project</title>
@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Internal Supervisor Project Details</h2>
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
                                    <h2>You have been assign to a project as a supervisor by LIC</h2>
                                </div>
                            </div>

                            <div class="client-detail">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                    <div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">

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


@endsection


