/**
 * Created by Pranavaghanan on 11/3/2015.
 */

function checkMember(panel1, panel2, supervisor) {
    console.log('check member function');
    var pm1 = document.getElementById(panel1);
    pm1 = pm1.options[pm1.selectedIndex].text;

    console.log('panel1' + pm1);
    var pm2= document.getElementById(panel2);
    pm2 = pm2.options[pm2.selectedIndex].text;
    console.log('panel2' + pm2);

    var pm3 = document.getElementById(supervisor);
    pm3 = pm3.options[pm3.selectedIndex].text;
    console.log('panel3' + pm3);

    if(pm1 == pm2) {
        alert("Both panel members cannot be the same!");
        return false;
    }

    else if(pm1==pm3) {
        alert("Please check! Supervisor and Panel Member 1 are same!");
        return false;
    }

    else if(pm2==pm3) {
        alert("Please check! Supervisor and Panel Member 2 are same!");
        return false;
    }

    return true;
}

function checkIfRPC(supervisor) {

    console.log('check rpc' + supervisor);
    var selectedDateString = $('#scheduledate').val();
    if(selectedDateString) {
        var supervisorId = $('#' + supervisor).val();
        $.ajax({
            type: "GET",
            url: '/checkIfRPC', 
            dataType: 'JSON',
            data: {"supervisorId": supervisorId}

        }).done(function (data) {
            var result = data.result;
            if (result) {
                console.log("checkrpc success");
                console.log(result);
                $('#lblRPC').html('Examiner');
                loadRPC(supervisor, true);
                loadExaminer(supervisor, true);
            } else {
                $('#lblRPC').html('RPC');
                loadRPC(supervisor, false);
                loadExaminer(supervisor, true);
            }

        }).fail(function (data) {
            console.log(data)
        })
    }
    else {
        alert('Select the presentation date first');
    }
}

function loadExaminer(supervisor, option) {

    console.log('loadexaminer' + supervisor + option);
    var supervisorId = $('#'+supervisor).val();
    var selectedDateString = $('#scheduledate').val();

    $.ajax({
        type: "GET",
        url: '/getavailablemembers', 
        dataType: 'JSON',
        'data': {
            "supervisorId": supervisorId,
            "date" : selectedDateString,
            'isRPC' : option
        }

    }).done(function (data) {
        var result = data.members;

        console.log("result loadexaminer");
        console.log(data);

        $('#examiner')
            .find('option')
            .remove()
            .end();
        //.append('<option value="0">Select A Member</option>')
        //.val('whatever')
        ;
        $.each(result, function(key, value) {
            $('#examiner').append($('<option/>').attr("value", key).text(value));
        });

        $('#examiner').trigger('change');
    }).fail(function (data) {
        console.log(data)
    });
}

function loadRPC(supervisor, option) {
    var supervisorId = $('#'+supervisor).val();
    var selectedDateString = $('#scheduledate').val();

    console.log('loadrpc' + supervisor + option);
    $.ajax({
        type: "GET",
        url: '/getavailablemembers', 
        dataType: 'JSON',
        'data': {
            "supervisorId": supervisorId,
            "date": selectedDateString,
            'isRPC': option
        }

    }).done(function (data) {
        var result = data.members;
        console.log("result loadrpc");
        console.log(data);
            $('#rpc')
                .find('option')
                .remove()
                .end();
            //.append('<option value="0">Select A Member</option>')
            //.val('whatever')

            $.each(result, function (key, value) {
                $('#rpc').append($('<option/>').attr("value", key).text(value));
            });

            $('#rpc').trigger('change');

    }).fail(function (data) {
        console.log(data)
    });
}

function displayFreeSlots(panelmember) {
    var memId = $('#'+panelmember).val();
    console.log('memid ' + memId);
    $.ajax({

        type: "GET",
        url: '/member1', 
        dataType: 'JSON',
        data: {"memberId": memId}

    }).done(function (data) {
        var html = "<div class=\"panel-body\">";
        var i;
        for (i = 0; i < data.memberSlots.length; i++) {
            html += "<li>" + data.memberSlots[i].freeDay +
                "- " + data.memberSlots[i].startingHour +
                ":" + data.memberSlots[i].startingMin +
                " to " + data.memberSlots[i].endingHour +
                ":" + data.memberSlots[i].endingMin +
                "</li>";
        }
        html += "</div>";
        console.log(html);
        $('#'+panelmember+'Free').html(html);


    }).fail(function ($data) {
        $('#'+panelmember+'Free').html('No Free Slots Available Currently');
    })
}

function loadProjects() {

    if($('#rpc').val()==null || $('#examiner').val()==null) {
        alert("Select panel members first");
    }
    else {

        $('#external-events').html("Projects Loading...");
        $.ajax({

            type: "GET",
            url: '/getthesisprojects', 
            dataType: 'JSON',
            data: {
                "supervisorId": $('#supervisor').val(),
                'memberOneId': $('#rpc').val(),
                'memberTwoId': $('#examiner').val()
            }

        }).done(function (data) {
            console.log(data);

            var html = "<p>Drag a event and drop into calendar.</p>";

            $.each(data.projects, function (key, value) {
                console.log(value.projectId);
                html += "<div id=\"" + value.projectId + "\" class=\"external-event navy-bg ui-draggable ui-draggable-handle\" style=\"position: relative;\">" + value.title + "</div>";
            })

            html += "<p class=\"m-t\"> " +
            //    "<div class=\"icheckbox_square-green checked\" style=\"position: relative;\"><input type=\"checkbox\"  id=\"drop-remove\" class=\"i-checks\" checked=\"\" style=\"position: absolute; opacity: 0;\">" +
            //    "<ins class=\"iCheck-helper\" style=\"position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);\"></ins></div>" +
            //    "<label for=\"drop-remove\">remove after drop</label>" +
                "</p\"";

            console.log(html);
            $('#external-events').html(html);

            initializeCalendar(data.events);
        }).fail(function ($data) {
            $('#' + panelmember + 'Free').html('No Projects are available currently');
        })
    }
}
