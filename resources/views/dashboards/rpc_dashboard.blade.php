@extends('masterpages.master_rpc')

@section('cssLinks')

@endsection

@section('title')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Project Coordinator Dashboard</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection




@section('content')


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-7" style="height: 750px; overflow: auto;">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Project Details</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>last Updated Date</th>
                                <th>Student</th>
                                <th>Project</th>
                            </tr>
                            </thead>
                            <tbody>

                            @for($id=0;$id<count($projectDetails);$id++ )

                                <tr>
                                    @if($projectDetails[$id]->status=='Pending')
                                        <td><span class="label label-primary">Pending</span></td>
                                    @elseif($projectDetails[$id]->status=='Rejected')
                                        <td><span class="label label-danger">Rejected</span></td>
                                    @elseif($projectDetails[$id]->status=='Approved')
                                        <td><span class="label label-primary">Accepted</span></td>
                                    @elseif($projectDetails[$id]->status=='Thesis Evaluated')
                                        <td><span class="label label-default">Thesis Evaluated</span></td>
                                    @elseif($projectDetails[$id]->status=='Proposal Evaluated')
                                        <td><span class="label label-default">Proposal Evaluated</span></td>
                                    @endif
                                    <td><i class="fa fa-clock-o"></i> {{$projectDetails[$id]->updatedDate}}</td>
                                    <td>{{$projectDetails[$id]->StudentRegId}}</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> {{$projectDetails[$id]->projectTitle}} </td>
                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Project Status Statistics </h5>

                        <div ibox-tools></div>
                    </div>
                    <div class="ibox-content">
                        <div class="text-center">
                            <canvas id="doughnutChart1" height="200" width="200"></canvas>
                        </div>
                    </div>
                </div>


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Projects Overview </h5>

                        <div ibox-tools></div>
                    </div>
                    <div class="ibox-content">
                        <!--logeesd user calander-->

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

    </div>


@endsection


@section('ValidationJavaScript')


    <script>

        $(document).ready(function () {

            var ApprovedProjectCount =   '<?php echo $ApprovedProjectCount;?>';
            var PendingProjectCount =   '<?php echo $PendingProjectCount;?>';
            var RejectedProjectCount =   '<?php echo $RejectedProjectCount;?>';
            var PEvaluatedProjectCount =   '<?php echo $PEvaluatedProjectCount;?>';
            var TEvaluatedProjectCount =   '<?php echo $TEvaluatedProjectCount;?>';

            var doughnutData = [
                {


                    value: parseInt(PendingProjectCount),
                    color: "#f39c12",
                    highlight: "#1ab394",
                    label: "Pending"
                },
                {
                    value: parseInt(ApprovedProjectCount),
                    color: "#2ecc71",
                    highlight: "#1ab394",
                    label: "Accepted"
                },
                {
                    value: parseInt(PEvaluatedProjectCount),
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "Proposal Evaluated"
                },
                {
                    value: parseInt(TEvaluatedProjectCount),
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "Thesis Evaluated"
                },
                {
                    value: parseInt(RejectedProjectCount),
                    color: "#e74c3c",
                    highlight: "#1ab394",
                    label: "Rejected"
                }
            ];

            var doughnutOptions = {

            };
            var ctx = document.getElementById("doughnutChart1").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);


            /* initialize the external events
             -----------------------------------------------------------------*/

            /* Encode the array returned from the server as a json array */

            var eventJson = <?php echo json_encode($all_events_belongs_to_current_RPC);?>

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

                },
                events: eventsArray
//                defaultTimedEventDuration: '00:30:00'
            });



        });

    </script>
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
@endsection