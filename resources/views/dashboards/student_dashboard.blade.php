@extends('masterpages.master_student')

@section('cssLinks')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">



@endsection

@section('title')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Student Dashboard</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection



@section('content')
    <button type="button" class="btn btn-primary btn-rounded btn-block" data-toggle="modal" data-target="#myModal">Request A Supervisor Meeting</button>

    <hr>
    <!------------------------------------------------------------------------------>


    <div class="row">
        <div class="col-md-6">
            <div class="ibox">
            <div class="ibox-title">
                <h4>All Notices</h4>
            </div>
            <div class="ibox-content">

                @foreach($notices as $n)
                    @if($n->type=='notice')
                        <form id="{{$n->id}}" action='' method='post'>
                            <div class="social-feed-box">

                    <div class="pull-right social-action dropdown">
                        <button data-toggle="dropdown" class="dropdown-toggle btn-white" aria-expanded="false">
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu m-t-xs">
                            <li><a href="#">Config</a></li>
                        </ul>
                    </div>
                    <div class="social-avatar">

                        <div class="media-body">
                            <b><h3>
                                <?php echo nl2br($n->topic)?>
                            </h3></b>

                        </div>
                        <div>
                            <a class="text-muted">@if(date("Y-m-d")==  $n->updated_at )
                                    Today

                                @endif
                                 <a><?php echo explode(' ', $n->updated_at)[0]; ?></a></a>{{ ' - ' }}
                                 <?php echo explode(' ', $n->updated_at)[1]; ?>
                        </div>
                        <div>
                            <a></a>
                        </div>
                    </div>
                    <div class="social-body">
                        <p>
                            <?php echo nl2br($n->detail)?>
                        </p>


                    </div>


                </div>
                        </form>
                        <hr>
                    @endif
                @endforeach

            </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox">
            <div class="ibox-title">
                <h4>Presentation Calender</h4>
            </div>
            <div class="ibox-content">
                <div class="col-lg-12 row animated fadeInDown">
                    <div id="calendar" class="fc fc-ltr fc-unthemed"></div>
                </div>
            </div>
            </div>
        </div>
    </div>




    <!------------------------------------------------------------------------------>
    <!--Request Supervisor Meeting model-->

    <div class="modal inmodal in" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

                    <h4 class="modal-title">Request A Supervisor Meeting</h4>
                    <small class="font-bold"></small>
                </div>
                <div class="modal-body">

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Reason</label>

                        <div><input type="text" class="form-control col-md-12" id="txtEventName" name="txtEventName"></div>

                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Date</label>
                        <input class="form-control" id="txtEventDate" name="txtEventDate" type="date" min="{{date("Y-m-d")}}">
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Time</label>
                        <div class="bfh-timepicker" id="txtEventTime" name="txtEventTime" data-mode="12h">
                        </div>
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Description</label>

                         <textarea  rows="4" cols="50" class="form-control required" id="txtEventDescription" name="txtEventDescription" placeholder="">

                        </textarea>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="RequestSupervisorMeeting()">Request Meeting</button>
                </div>
            </div>
        </div>
    </div>
    <!--Request Supervisor Meeting model-->
@endsection

@section('ValidationJavaScript')
    <script>
        function RequestSupervisorMeeting() {
            var eventName =document.getElementById('txtEventName').value;
            var eventDate = document.getElementById('txtEventDate').value;
            var eventtype = 'Supervisor Meeting';
            console.log(eventName+" sfs "+eventDate);
            if (eventName != '' && eventDate != '') {

                var postData = {
                    'eventType': eventtype,
                    'eventName': eventName,
                    'eventDate': eventDate,
                    'eventTime': $("#txtEventTime").val(),
                    'eventDescription': document.getElementById('txtEventDescription').value
                };

                $.ajax({
                    type: "GET",
                    url: "/addEventToTimeline/0/"+eventtype+"/Request",
                    data: postData,
                    success: function (data) {

                        console.log(data);
                        document.location.reload();
                        swal("Requested!", "Your request has been sent to the Supervisor.", "success");

                    },
                    error: function (data) {
                        swal("Error!", "Something wrong with free slot update inputs.", "error");
                    },
                    complete: function ($result) {

                    }


                });
            }else{
                swal("Error!", "You must fill Event name and event date.", "error");
            }
        }
    </script>
    <script>

        $(document).ready(function(){

            $(".sortable-list").sortable({
                connectWith: ".connectList"
            }).disableSelection();

        });
    </script>
    <!-- Mainly scripts -->

    <script src="{{ asset('public_assets/js/jquery-ui-1.10.4.min.js') }}"></script>


@endsection