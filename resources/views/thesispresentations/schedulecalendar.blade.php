@extends('masterpages.master_rpc')

@section('cssLinks')
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
@endsection


@section('content')

    <div class="row animated fadeInDown">
    {{--<div class="ibox-content">--}}
        <div class="col-lg-12">
                <div id="calendar" class="fc fc-ltr fc-unthemed"></div>
        </div>
    </div>

    {{--<form class="m-t" role="form" method="POST" action="{{ url('testrole') }}">--}}
        {{--<button type="submit" class="btn btn-primary block full-width m-b">Test</button>--}}
    {{--</form>--}}

@endsection

@section('ValidationJavaScript')
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <script>

        $(document).ready(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/

            /* Encode the array returned from the server as a json array */

            var eventJson = <?php echo json_encode($events);?> ;
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


            /* initialize the calendar
             -----------------------------------------------------------------*/

            var eventsArray = [];

            //add event by event to the calendar
            for( var i=0; i<eventJson.length; i++ ) {

                var tempDate = new Date(eventJson[i].date);

                var d = tempDate.getDate();
                var m = tempDate.getMonth();
                var y = tempDate.getFullYear();

                var events = {
                    "title": eventJson[i].title,
                    "start": new Date(y,m,d,eventJson[i].time_start.substring(0,2),eventJson[i].time_start.substring(3,5)),
                    "end": new Date(y,m,d,eventJson[i].time_end.substring(0,2),eventJson[i].time_end.substring(3,5)),
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
            });


        });

    </script>
@endsection