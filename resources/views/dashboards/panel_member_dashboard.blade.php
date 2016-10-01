@extends('masterpages.master_panel_member')

@section('cssLinks')

@endsection

@section('title')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Panel Member Dashboard</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection




@section('content')

    <div class="row">
        <div class="col-md-5">
            <div class="ibox-content" style="height: 700px; overflow: auto;">

                <div class="row">
                    <button type="button" class="btn btn-block btn-outline btn-primary" data-toggle="modal" data-target="#myModal">Add Event to the Timeline</button>
                    <button type="button" class="btn btn-block btn-outline btn-default" data-toggle="modal" data-target="#myModalviewTodayTimeLine" onclick="getMyTodayTimeline()">Today Timeline</button>
                </div>

                <div id="vertical-timeline" class="vertical-container light-timeline">
                    @foreach($currentPanelMemberTimeLine as $events)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                @if($events->eventType==='Supervisor Meeting')
                                    <i class="fa fa-comments"></i>
                                    @elseif($events->eventType==='Other')
                                @elseif($events->eventType==='Other')
                                    <i class="fa fa-user-md"></i>
                                @endif
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>{{ $events->eventType }}</h2>

                                <b><small>{{ $events->eventName }}</small></b>
                                <p>{{   $events->eventDescription }}
                                </p>


                                    <span class="vertical-date">
                                        <?php $eventDate = new DateTime($events->eventDate);  $today = new DateTime(); $dateDiff = $eventDate->diff($today)->format("%a");?>
                                        <?php if($dateDiff==0) {?>
                                        Today
                                        <?php }else if($dateDiff == 1){?>
                                        Tomorrow
                                        <?php }else{?>
                                        {{$eventDate->diff($today)->format("%a") }} days.
                                        <?php }?>
                                        <br>
                                        <small>{{   $events->eventDate }}</small>
                                            <div>
                                                <b>{{   $events->eventTime }}</b>
                                            </div>
                                    </span>
                                <div class="row">
                                    <form id="buttonForm">
                                        <a href="#" class="btn btn-sm btn-outline btn-warning" onclick="getEventDataForEventId({{$events->id}})" data-toggle="modal" data-target="#myModalUpdate" onclick=""> update Event</a>
                                        <a href="#" class="btn btn-sm btn-outline btn-danger"  onclick="deleteEvent({{$events->id}})"> Delete Event</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>

        <div class="col-md-7">

            <!--logeesd user calander-->
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Calender </h5>
                    <div class="ibox-tools">
                        {{--<a class="collapse-link">--}}
                        {{--<i class="fa fa-chevron-up"></i>--}}
                        {{--</a>--}}


                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row animated fadeInDown">
                        {{--<div class="ibox-content">--}}
                        <div class="col-lg-12">
                            <div id="calendar" class="fc fc-ltr fc-unthemed"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="row">
        <!---->
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Requested for Supervisor Meeting</h5>

                <div class="ibox-tools">
                    {{--<a class="collapse-link">--}}
                    {{--<i class="fa fa-chevron-up"></i>--}}
                    {{--</a>--}}

                </div>
            </div>



            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-1">
                        <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                    </div>
                    <div class="col-md-11">
                        <div class="input-group"><input type="text" placeholder="Search" onkeyup="searchRequests()" id="txtSearchSupervisorRequest" class="input-sm form-control"> <span class="input-group-btn">
                                        </span></div>
                    </div>
                </div>

                <div class="project-list" id="topDiv">

                    <table class="table table-hover">
                        <tbody>
                        @foreach($supervisor_requests_array as $requests)
                            <tr>

                                <td class="project-status" id="StudentRegID">
                                    <span class="label label-primary">{{$requests[0]["studentRegId"]}}</span>
                                </td>
                                <td class="project-title" id="divProjectTitle">
                                    <a href="project_detail.html">{{$requests[0]["reason"]}}</a>
                                    <br>
                                    <small>{{$requests[0]["projectTitle"]}}</small>
                                </td>
                                <td class="project-completion">
                                    {{$requests[0]["date"]}}
                                </td>
                                <td class="project-people">
                                    {{$requests[0]["time"]}}
                                </td>


                                <td class="project-actions">
                                    <a class="btn btn-white btn-sm"><i class="fa fa-folder" onclick="makeActionForSupervisorRequest( '<?php echo $requests[0]["eventid"];?>' , '<?php echo $requests[0]["studentRegId"];?>' ,'1' )"></i> Accept </a>
                                    <a class="btn btn-white btn-sm"><i class="fa fa-pencil" onclick="makeActionForSupervisorRequest('<?php echo $requests[0]["eventid"];?>' , '<?php echo$requests[0]["studentRegId"];?>'  ,'2' )"></i> Reject </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!--add Event to the time line model-->
    <div class="modal inmodal in" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

                    <h4 class="modal-title">Add Event to Time Line</h4>
                    <small class="font-bold"></small>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label class="font-noraml">Event Type</label>
                        <select class="form-control m-b" name="ddEventType" id="ddEventType">
                            <option>Board Meeting</option>
                            <option>Supervisor Meeting</option>
                            <option>Other</option>

                        </select>

                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Name</label>

                        <div><input type="text" class="form-control col-md-12" id="txtEventName" name="txtEventName"></div>

                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Date</label>
                        <input class="form-control" id="txtEventDate" name="txtEventDate" type="date" >
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Time</label>
                        <div class="bfh-timepicker" id="txtEventTime" name="txtEventTime" data-mode="12h">
                        </div>
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Description</label>

                         <textarea  rows="4" cols="50" class="form-control required" id="txtEventDescription" name="txtEventDescription" placeholder="">

                        </textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addEventToTheTimeline()">Add Event</button>
                </div>
            </div>
        </div>
    </div>
    <!--add Event to the time line model-->

    <!--update Event to the time line model-->
    <div class="modal inmodal in" id="myModalUpdate" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

                    <h4 class="modal-title">Update Event in Time Line</h4>
                    <small class="font-bold"></small>
                </div>
                <div class="modal-body">

                    <div class="form-group"><label class="font-noraml">Event Type</label>
                        <select class="form-control m-b" name="ddEventTypeupdate" id="ddEventTypeupdate">
                            <option>Board Meeting</option>
                            <option>Supervisor Meeting</option>
                            <option>Other</option>

                        </select>

                    </div>
                    <input hidden="true" id="eventIDUpdate" name="eventIDUpdate"/>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Name</label>

                        <div><input type="text" class="form-control col-md-12" id="txtEventNameupdate" name="txtEventNameupdate"></div>

                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Date</label>
                        <input class="form-control" id="txtEventDateupdate" name="txtEventDateupdate" type="date" min="{{date("Y-m-d")}}">
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Time</label>
                        <div class="bfh-timepicker" id="txtEventTimeupdate" name="txtEventTimeupdate" data-mode="12h">
                        </div>
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Event Description</label>

                         <textarea  rows="4" cols="50" class="form-control required" id="txtEventDescriptionupdate" name="txtEventDescriptionupdate" placeholder="">

                        </textarea>

                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateEvent()">Update Event</button>
                </div>
            </div>
        </div>
    </div>
    <!--add Event to the time line model-->



    <!--update Event to the time line model-->
    <div class="modal inmodal in" id="myModalviewTodayTimeLine" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

                    <h4 class="modal-title">Today Time Line only</h4>
                    <small class="font-bold"></small>
                </div>
                <div class="modal-body">

                    <!------------------------------------->

                    <div class="ibox-content inspinia-timeline" style="height: 300px;overflow: auto;" >

                        <div class="timeline-item" id="TodayTimelineDiv">

                        </div>

                    </div>

                    <!--------------------------------------------->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--add Event to the time line model-->
@endsection

@section('ValidationJavaScript')



    <!-- Custom and plugin javascript -->

    <style>
        body.DTTT_Print {
            background: #fff;

        }
        .DTTT_Print #page-wrapper {
            margin: 0;
            background:#fff;
        }

        button.DTTT_button, div.DTTT_button, a.DTTT_button {
            border: 1px solid #e7eaec;
            background: #fff;
            color: #676a6c;
            box-shadow: none;
            padding: 6px 8px;
        }
        button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
            border: 1px solid #d2d2d2;
            background: #fff;
            color: #676a6c;
            box-shadow: none;
            padding: 6px 8px;
        }

        .dataTables_filter label {
            margin-right: 5px;

        }
    </style>

    <script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <script>


        function addEventToTheTimeline() {
            eventtype = document.getElementById('ddEventType').value;
            eventName = document.getElementById('txtEventName').value;
            eventDate = document.getElementById('txtEventDate').value;
            eventTime = $("#txtEventTime").val();
            eventDes = document.getElementById('txtEventDescription').value;
            //  alert(eventName);
            //  alert(eventDate);
            if (eventName != '' && eventDate != '') {

                var postData = {
                    'eventType': eventtype,
                    'eventName': eventName,
                    'eventDate': eventDate,
                    'eventTime': eventTime,
                    'eventDescription': eventDes
                };

                $.ajax({
                    type: "GET",
                    url: "/addEventToTimeline/1/"+eventtype+"/Order",
                    data: postData,
                    success: function (data) {
                        document.location.reload();
                        swal("Added!", "Your event has been added to your timeline.", "success");

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
        function deleteEvent(eventId){

            swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this event ??!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes!",
                        cancelButtonText: "Cancel!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function(isConfirm){

                        if (isConfirm) {

                            $.ajax({
                                type: "GET",
                                url: "/deleteEventToTimeline",
                                data: { 'eventId' :  eventId},
                                success: function (data) {
                                    document.location.reload();
                                    swal("Deleted!", "Your event has been deleted from your timeline.", "success");

                                },
                                error: function (data) {
                                },
                                complete: function ($result) {
                                }


                            });
                        }

                    });


        }
        function updateEvent(){
            var eventtype = document.getElementById('ddEventTypeupdate').value;
            var eventName = document.getElementById('txtEventNameupdate').value;
            var eventDate = document.getElementById('txtEventDateupdate').value;
            var eventTime = $("#txtEventTimeupdate").val();
            var eventDes = document.getElementById('txtEventDescriptionupdate').value;

            var postData = {
                'eventType': eventtype,
                'eventName': eventName,
                'eventDate': eventDate,
                'eventTime': eventTime,
                'eventDescription': eventDes,
                'eventId' : document.getElementById('eventIDUpdate').value
            };


            $.ajax({
                type: "GET",
                url: "/updateEventToTimeline",
                data: postData,
                success: function (data) {
                    document.location.reload();
                    swal("Updated!", "Your event has been updated from your timeline.", "success");

                },
                error: function (data) {
//                    swal("Updated!", "Something wrong with free slot update inputs.", "error");
                },
                complete: function ($result) {
                    //alert( "Completed "+$result);
                }


            });
        }
        function getEventDataForEventId(eventId){
            $.ajax({
                type: "GET",
                url: "/getEventDataDetails",
                data: { 'eventId' : eventId },
                success: function (data) {
                    console.log(data);
                    document.getElementById('eventIDUpdate').value  = eventId;
                    document.getElementById('ddEventTypeupdate').value = data[0].eventType;
                    document.getElementById('txtEventNameupdate').value = data[0].eventName.split("about")[0];
                    document.getElementById('txtEventDateupdate').value = data[0].eventDate;

                    $('#txtEventTimeupdate').val(data[0].eventTime);
                    document.getElementById('txtEventDescriptionupdate').value =  data[0].eventDescription;

                },
                error: function (data) {
                },
                complete: function ($result) {
                }


            });
        }

        function makeActionForSupervisorRequest(eventId,studentId,action)
        {
            var NAInput = '';
            if(action=='2'){
                swal({   title: "Reply Back!",
                            text: "Write something interesting:",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "Write something" },
                        function(inputValue){
                            if (inputValue === false) return false;
                            NAInput = inputValue;
                            AcceptOrRejectMeetingRequest(eventId,studentId,action,NAInput);
                        });

            }else{
                AcceptOrRejectMeetingRequest(eventId,studentId,action,NAInput);
            }


        }
        function AcceptOrRejectMeetingRequest(eventId,studentId,action,NAInput){

            $.ajax({
                type: "GET",
                url: "/AcceptOrRejectSupervisorMeetingRequest",
                data: { 'eventId' : eventId,
                    'actionType' : action,
                    'studentId': studentId,
                    'NAInput' : NAInput},
                success: function (data) {

                    document.location.reload();
//                    alert("heee "+data);
                    swal("Done!", "Done !", "success");

                },
                error: function (data) {

                    swal("Error", "Something wrong with free slot update inputs.", "error");
                },
                complete: function ($result) {
                    //alert( "Completed "+$result);
                }


            });
        }
    </script>


    <script>
        $(document).ready(function(){

            $('#loading-example-btn').click(function () {
                btn = $(this);
                simpleLoad(btn, true)

                simpleLoad(btn, false)
            });
        });

        function simpleLoad(btn, state) {
            if (state) {
                btn.children().addClass('fa-spin');
                btn.contents().last().replaceWith(" Loading");
            } else {
                setTimeout(function () {
                    btn.children().removeClass('fa-spin');
                    btn.contents().last().replaceWith(" Refresh");
                }, 2000);
            }
        }


        function searchRequests(){

            var sRequests = document.getElementById('txtSearchSupervisorRequest');

            $("#topDiv table tbody tr #StudentRegID span").each(function () {
                var string = $(this).text().toLowerCase();

                if (string.indexOf(sRequests.value) != -1) {
                    $(this).parent().parent().show();
                } else {
                    $(this).parent().parent().hide();
                }
            });



        }
        function getMyTodayTimeline(){

            $.ajax({
                type: "GET",
                url: "/getCurrentUserTimeLine",
                success: function (data) {

                    var div =[];

                    console.log(data["today"].length);
                    document.getElementById('TodayTimelineDiv').innerHTML = null;
                    for (var i = 0; i < data["today"].length; i++) {

                        div.push('<div class="row">');
                        div.push('<div class="col-xs-3 date">');

                        if(data["today"][i]["eventType"]==='Supervisor Meeting')
                            div.push('<i class="fa fa-briefcase"></i>');
                        else if(data["today"][i]["eventType"]=='Other'){
                            div.push('<i class="fa fa-coffee"></i>');
                        }else{

                        }

                        div.push(data["today"][i]["eventTime"]);
                        div.push('<br>');
                        var now     = new Date();
                        var hour    = now.getHours();
                        var eventimeHour = data["today"][i]["eventTime"].split(":")[0];
                        if(eventimeHour>hour){
                            var diffhr = eventimeHour-hour;
                        }else{
                            var diffhr = hour-eventimeHour;
                        }

                        div.push('<small class="text-navy">'+'after '+diffhr+ 'hours'+'</small>');
                        div.push('</div>');
                        div.push('<div class="col-xs-7 content no-top-border">');
                        div.push('<p class="m-b-xs"><strong>'+data["today"][i]["eventType"]+'</strong></p>');
                        div.push('<b><small>'+ data["today"][i]["eventName"] +'</small></b>');
                        div.push('<p>'+data["today"][i]["eventDescription"]+'</p>');
                        div.push('</div>');
                        div.push('</div>');
                    }
                    document.getElementById('TodayTimelineDiv').innerHTML +=div.join('');

                },
                error: function (data) {
//                    swal("Updated!", "Something wrong with free slot update inputs.", "error");
                },
                complete: function ($result) {
                    //alert( "Completed "+$result);
                }


            });

        }
    </script>

    <script>

        $(document).ready(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/

            /* Encode the array returned from the server as a json array */

            var eventJson = <?php echo json_encode($all_events_belongs_to_current_panel_member);?>

                    $('#external-events div.external-event').each(function() {

                        // store data so the calendar knows to render an event upon drop
                        $(this).data('event', {
                            title: $.trim($(this).text()), // use the element's text as the event title
                            stick: true // maintain when user navigates
                        });

                        // make the event draggable
                        $(this).draggable({
                            zIndex: 1111999,
                            revert: true,      // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        });

                    });

//            console.log(eventJson);
            /* initialize the calendar
             -----------------------------------------------------------------*/

            var eventsArray = [];

            //add event by event to the calendar
            for( var i=0; i<eventJson.length; i++ ) {
                var tdate = eventJson[i][0].date.substring(0,4)+'/'+ eventJson[i][0].date.substring(5,7)+'/'+ eventJson[i][0].date.substring(8,10)
                var tempDate = new Date(tdate);

                var d = tempDate.getDate();
                var m = tempDate.getMonth();
                var y = tempDate.getFullYear();

                var events = {
                    "title": eventJson[i].title,
                    "start": new Date(y,m,d,eventJson[i][0].time.substring(0,2),eventJson[i][0].time.substring(3,5)),
                    "end": new Date(y,m,d,eventJson[i][0].eTime.substring(0,2),eventJson[i][0].eTime.substring(3,5)),
                    "allDay": false
                };
                eventsArray.push(events);
            }

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar
                drop: function() {
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },

                eventDrop: function(event, delta, revertFunc) {

                    alert(event.title + " was dropped on " + event.start.format());

                    if (!confirm("Are you sure about this change?")) {
                        revertFunc();
                    }
                },
                events: eventsArray
//                defaultTimedEventDuration: '00:30:00'
            });


        });

    </script>

@endsection
