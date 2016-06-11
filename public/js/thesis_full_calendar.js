/**
 * Created by Pranavaghanan on 11/3/2015.
 */

/*
    Full-Calendar Events and Functions
 */


    /* initialize the external events
     -----------------------------------------------------------------*/

    /* Encode the array returned from the server as a json array */
    function initializeCalendar(json) {
        var eventJson = json;

        $('#external-events div.external-event').each(function () {
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                id: $(this).attr('id'),
                title: $.trim($(this).text()), // use the element's text as the event title
                //                            color: '#ff0000', //red for now
                stick: true, // maintain when user navigates
                overlap: false,
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

        for (var i = 0; i < eventJson.length; i++) {

            var tempDate = new Date(eventJson[i].date);
            var d = tempDate.getDate();
            var m = tempDate.getMonth();
            var y = tempDate.getFullYear();

            var events = {
                "id" : eventJson[i].id,
                "title": eventJson[i].title,
                "start": new Date(y, m, d, eventJson[i].time_start.substring(0, 2), eventJson[i].time_start.substring(3, 5)),
                "end": new Date(y, m, d, eventJson[i].time_end.substring(0, 2), eventJson[i].time_end.substring(3, 5)),
                "allDay": false,
                //"url" : 'http://localhost:8000/thesispanels/'+eventJson[i].id
            };
            eventsArray.push(events);
        }

        $('#calendar').fullCalendar({

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'agendaDay',

            viewDisplay: function (view) {
                $('.fc-day').filter(
                    function (index) {
                        return moment($(this).data('date')).isBefore(moment(), 'day')
                    }).addClass('fc-other-month');
            },
            eventStartEditable: true,
            eventDurationEditable: false,
            droppable: true, // this allows things to be dropped onto the calendar

            //set the time range to display the events
            minTime: "08:00:00",
            maxTime: "19:00:00",

            //set duration of presentation for 45 minutes
            defaultTimedEventDuration: '00:45:00',
            slotDuration: '00:15:00',
            timeZone: false,

            //when a event is dropped to the calendar
            drop: function (date, jsEvent, ui) {
                var start = date.format('HH:mm');
                var startMoment = moment('2013-02-08 ' + start);
                var end = startMoment.add(45, 'm').format('HH:mm');

                $(this).remove();
                $.ajax({
                    type: "POST",
                    url: '/thesispanels', 
                    dataType: 'JSON',
                    data: {
                        'projects' : jsEvent.target.id,
                        'txtSupervisor' : $('#supervisor option:selected').text(),
                        'panelmember1': $('#rpc').val(),
                        'panelmember2' : $('#examiner').val(),
                        'presentationvenue' : $('#presentationvenue option:selected').text(),
                        'date' : $('#scheduledate').val(),
                        'startTime': start,
                        'endTime' : end
                    }

                }).done(function (data) {
                    swal(
                        "Schedule successfully added!!",
                        'Panel has been created during the time interval successfully!!',
                        "success"
                    );
                }).fail(function (data) {
                    console.log('post error');
                    swal(
                        "Schedule not updated!",
                        data.responseJSON.message + '. \n\n Please refresh the page or move the slot to appropriate time interval. Refer the free slots for assistance',
                        "error"
                    );

                    loadProjects();
                    $('#calendar').fullCalendar( 'removeEvents',jsEvent.target.id );

                });

            },

            //when moveing an already existing event in calendar
            eventDrop: function (event, delta, revertFunc) {
                console.log("Event Drop Function");

                var start = event.start.format('HH:mm');
                var end = event.end.format('HH:mm');

                $.ajax({
                    type: "PUT",
                    url: '/updatethesisslot/'+event._id, 
                    dataType: 'JSON',
                    data: {
                        'projects' : event._id,
                        'date' : $('#scheduledate').val(),
                        'startTime': start,
                        'endTime' : end
                    }

                }).done(function (data) {
                    swal(
                        "Schedule successfully updated!!",
                        'Panel has been shifted to the new schedule!!',
                        "success"
                    );
                }).fail(function (data) {
                    swal(
                        "Schedule not updated!",
                        data.responseJSON.message,
                        "error"
                    );
                    revertFunc();
                });
            },

        eventClick: function (calEvent, jsEvent, view) {

                $.ajax({
                    type: "GET",
                    url: '/getprojectdetail/'+calEvent._id, 
                    dataType: 'JSON',
                    data: {
                        'projectid' : calEvent._id
                    }

                }).done(function (data) {
                    var html = "<div class=\"wrapper wrapper-content animated fadeInRight\">" +
                        "<div class=\"row\">" +
                            "<div class=\"col-lg-12\">" +
                    "<h2>Project : "+ data.project[0].title + "</h2>" +
                    "<hr/>" +
                    "<br>" +
                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">Supervisor :</label>" +
                    "<p class=\"col-lg-6\">"+ data.project[0].name + "</p>" +
                    "</div>" +

                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">Panel Member 1 :</label>" +
                    "<p class=\"col-lg-6\">"+ data.panelmember1.name + "</p>" +
                    "</div>" +

                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">Panel Member 2 :</label>" +
                    "<p class=\"col-lg-6\">"+ data.panelmember2.name + "</p>" +
                    "</div>" +
                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">Date :</label>" +
                    "<p class=\"col-lg-6\">"+ data.project[0].date + "</p>" +
                    "</div>" +
                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">Venue :</label>" +
                    "<p class=\"col-lg-6\">"+ data.project[0].venue+ "</p>" +
                    "</div>" +
                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">Start Time :</label>" +
                    "<p class=\"col-lg-6\">"+ data.project[0].time_start+ "</p>" +
                    "</div>" +
                    "<div class=\"form-group\">" +
                    "<label class=\"col-lg-6 control-label\">End Time :</label>" +
                    "<p class=\"col-lg-6\">"+ data.project[0].time_end+ "</p>" +
                    "</div>" +
                    "\"";

                    $('#btnModalUpdate').attr('href', '/thesispanels/'+data.project[0].id+'/edit');

                    $('#projectmodelbody').html(html);
                    $('#projectModal').modal('show');
                }).fail(function (data) {
                    console.log('proj detail error');
                });



            },

            eventConstraint: {
                start: moment(),
                end: '2100-01-01' // hard coded goodness unfortunately
            },

            events: eventsArray
        });


    }
