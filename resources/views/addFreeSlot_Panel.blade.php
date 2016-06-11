@extends('masterpages.master_rpc')

@section('cssLinks')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">


    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">
    <!--bootstrap-formhelpers-->


@endsection
@section('title')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Manage Free Slots</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection
@section('content')
    <div class="modal-content animated bounceInRight">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Add Time Slot</h4>
        </div>

        <div class="modal-body">


            <label for="txtPanelMember" class="font-normal">Panel Member Name :</label>
            <select class="form-control m-b" name="txtPanelMember" id="txtPanelMember" onchange="getFreeSlotDetailsByEmail()">
                <option>  Select Panel Member </option>
                @foreach($panelMembers as $members=>$value)
                    <option value="{{ $value }}">{{ $members }}</option>
                @endforeach
            </select>
            <!--date-->
            <label for="message-text" class="control-label">Date</label>

            <input class="form-control" id="freeSlotdate" name="freeSlotdate" type="date" min="{{date("Y-m-d")}}">

            <!--date-->

            <label for="message-text" class="control-label">Starting Time</label>
            <div class="bfh-timepicker" id="startingTime" name="startingTime" data-mode="24h">
            </div>


            <label for="message-text" class="control-label">Ending Time</label>

            <div class="bfh-timepicker" id="endingTime" name="endingTime" data-mode="24h">
            </div>
        </div>

        <div class="modal-footer">
            <button id="btnaddFreeSlot" name="btnaddFreeSlot" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</button>

        </div>

    </div>
    <!-------------------------------------------------------------------->
    <div class="ibox">
        <div class="ibox-title">
            {{--<h5>Requested for Meeting</h5>--}}

            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>

            </div>

            {{--<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal1">--}}
            {{--Add new Free Slot--}}
            {{--</button>--}}
            <button type="button" class="btn btn-danger btn-xs" onclick="deleteAllFreeSlotConfirmation()">Reset Selected Panel Member Free Slot</button>

        </div>
        <div class="ibox-content">



            <div class="input-group">
                <input class="form-control" id="txtSearchByFreeSlotDate" name="txtSearchByFreeSlotDate" type="date">

                                    <span class="input-group-btn">
                                        <button type="button" id="btnSearchByFreeSlotDate" class="btn btn-white"> Search</button>
                                    </span>
            </div>
            <div id="divWrapperSearch">
                <table class="table table-hover issue-tracker tableFreSolots" id="tableFreSolots">
                    <thead>
                    <tr>

                        <th>Day</th>
                        <th>Starting Time</th>
                        <th>Ending Time</th>

                    </tr>
                    </thead>
                    <tbody id="tbody">
                    {{--@foreach ($currentUserSlots as $currentUserSlot)--}}


                    {{--<tr class="tablerow">--}}

                    {{--<td id="ftd" class="issue-info">--}}
                    {{--<a href="#">--}}
                    {{--<h3 id="day">{{ $currentUserSlot->freeDay }}</h3>--}}
                    {{--</a>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                    {{--<h4>{{ $currentUserSlot->startingHour.':'.$currentUserSlot->startingMin }}</h4>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                    {{--<h4>{{ $currentUserSlot->endingHour.':'.$currentUserSlot->endingMin }}</h4>--}}
                    {{--</td>--}}

                    {{--<td class="text-right">--}}

                    {{--<div>--}}
                    {{--<button type="button" id="btnupdate" name="btnupdate" class="btn btn-white btn-xs btnupdate" data-toggle="modal" data-target="#exampleModal1update"> Update<div id="freeslotid" name="freeslotid" class="freeslotid" hidden="true">{{ $currentUserSlot->id }}</div></button>--}}
                    {{--<button type="button" id="btndelete" name="btndelete" class="btn btn-white btn-xs btndelete"> Delete<div id="freeslotid" name="freeslotid" class="freeslotid" hidden="true">{{ $currentUserSlot->id }}</div></button>--}}


                    {{--</div>--}}

                    {{--</td>--}}
                    {{--</tr>--}}

                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div>

        </div>







        <!--second model-->
        <div class="modal inmodal in" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
                {{--<div class="modal-content animated bounceInRight">--}}
                {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                {{--<h4 class="modal-title" id="exampleModalLabel">Add Time Slot</h4>--}}
                {{--</div>--}}

                {{--<div class="modal-body">--}}
                {{--<!--date-->--}}
                {{--<label for="message-text" class="control-label">Date</label>--}}

                {{--<input class="form-control" id="freeSlotdate" name="freeSlotdate" type="date" min="{{date("Y-m-d")}}">--}}

                {{--<!--date-->--}}

                {{--<label for="message-text" class="control-label">Starting Time</label>--}}
                {{--<div class="bfh-timepicker" id="startingTime" name="startingTime" data-mode="24h">--}}
                {{--</div>--}}


                {{--<label for="message-text" class="control-label">Ending Time</label>--}}

                {{--<div class="bfh-timepicker" id="endingTime" name="endingTime" data-mode="24h">--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--<div class="modal-footer">--}}
                {{--<button id="btnaddFreeSlot" name="btnaddFreeSlot" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</button>--}}

                {{--</div>--}}

                {{--</div>--}}

            </div>
        </div>
        <!--second model-->




        <!--update model-->
        <div class="modal inmodal in" id="exampleModal1update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Add Time Slot</h4>
                    </div>

                    <div class="modal-body">

                        <label for="message-text" class="control-label">Free Slot ID</label><label>    :   </label>
                        <b><label color="red" id="updateFreeSlotID" name="updateFreeSlotID" /></b>


                        <!--date-->
                        <div>
                            <label for="message-text" class="control-label">Date</label>

                            <input class="form-control" id="freeSlotdateupdte" name="freeSlotdateupdte" type="date" min="{{date("Y-m-d")}}">
                        </div>
                        <!--date-->

                        <label for="message-text" class="control-label">Starting Time</label>

                        <div class="bfh-timepicker startingtime-timepicker" id="startingTimeupdate" name="startingTimeupdate" data-mode="24h">
                        </div>



                        <!---->

                        <!---->


                        <label for="message-text" class="control-label">Ending Time</label>

                        <div class="bfh-timepicker endingtime-timepicker" id="endingTimeUpdate" name="endingTimeUpdate" data-mode="24h">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="btnUpdateFreeSlot" name="btnUpdateFreeSlot" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Save Changes</button>

                    </div>

                </div>

            </div>
        </div>
        <!--update model-->

    </div>

@endsection


@section('ValidationJavaScript')



    <!-- bootbox code -->
    <script src="{{ asset('public_assets/css/style.css') }}"></script>

    <script>

        $(function() {
            $("#btnaddFreeSlot").click(function() {
                // var hidden = $(this).find("#orderDetailedViewOrderId").val();

                var freeSlotDate = document.getElementById('freeSlotdate').value;
                var startingTime = $("#startingTime").val();
                var EndingTime = $("#endingTime").val();

                var startingHour =parseInt(startingTime.substring(0,2));
                var startingMin =parseInt(startingTime.substring(3,5));
                var endingHour =parseInt(EndingTime.substring(0,2));
                var endingMin =parseInt(EndingTime.substring(3,5));

                if(freeSlotDate!="") {

                    if (startingHour <= endingHour) {
                        if (startingHour == endingHour) {
                            if (startingMin < endingMin) {

                                document.getElementById("startingTime").style.outline = "1px solid green";
                                document.getElementById("endingTime").style.outline = "1px solid green";
                                document.getElementById("freeSlotdate").style.outline = "1px solid green";
                                //add ajax
                                addFreeSlot(freeSlotDate,startingTime,EndingTime);
                            } else {
                                document.getElementById("startingTime").style.outline = "1px solid red";
                                document.getElementById("endingTime").style.outline = "1px solid red";
                                //alert("error");
                            }
                        } else {
                            //add ajax
                            document.getElementById("startingTime").style.outline = "1px solid green";
                            document.getElementById("endingTime").style.outline = "1px solid green";
                            document.getElementById("freeSlotdate").style.outline = "1px solid green";
                            addFreeSlot(freeSlotDate,startingTime,EndingTime);
                            //code
                        }
                    } else {
                        //alert("error");
                        document.getElementById("startingTime").style.outline = "1px solid red";
                        document.getElementById("endingTime").style.outline = "1px solid red";
                    }

                }else{

                    document.getElementById("freeSlotdate").style.outline = "1px solid red";

                }



            });
        });


        function addFreeSlot(freeSlotDate,startingTime,EndingTime){
//alert(document.getElementById('txtPanelMember').value);
            var panelMemberEmail = document.getElementById('txtPanelMember').value;
            if(panelMemberEmail!='Select Panel Member') {
                var postData1 = {
                    'freeSlotDate': freeSlotDate,
                    'startingDate': startingTime,
                    'endingDate': EndingTime,
                    'memberemail': panelMemberEmail
                };
                console.log(panelMemberEmail);
                console.log(freeSlotDate);
                console.log(startingTime);
                console.log(EndingTime);
                $.ajax({
                    type: "GET",
                    url: "/addFreeSlot",
                    data: postData1,
                    //assign the var here
                    success: function (data) {
                        if(data!='error'){
                            swal("Added!", "Your free has been Added To database.", "success");
                            getFreeSlotDetailsByEmail();
                        }else{
                            swal("Error!", "This free slot is not avalable for this member.", "error");
                        }

                    },
                    error: function (data) {
                        alert("error " + data);
                    }
                });
            }else{
                swal("Error!", "Please Select a panel Member to add Free Slots.", "error");
            }
        }

        function deleteAllFreeSlotConfirmation() {

            swal({
                        title: "Are you sure?",
                        text: "Do You want to remove all free slots belongs to you ??",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function () {

                        $.ajax({

                            type: "GET",
                            url: '/deleteAllFreeSlot',
                            data: {'panelMemberEmail': document.getElementById('txtPanelMember').value}, 
                            success: function (data) {
                                swal("Deleted!", "Your all free slots has been deleted.", "success");
                                getFreeSlotDetailsByEmail();

                            }, error: function (data) {
                                alert("error " + data);
                            }


                        });
                    }
            );
        }
        <!--date picker-->
        $(function() {
            $(".btnupdate").click(function() {
                var hidden = $(this).find("#freeslotid").text();

                alert(hidden);


                var postData = {
                    'slotID' : hidden
                };

                $.ajax({
                    type: "GET",
                    url: "/searchSpecificFreeSlot",
                    data: postData ,
                    //assign the var here
                    success: function(data){

                        var id = hidden;
                        var freeDay = data['freeDay'];
                        var startingime = data['startingTime'];
                        var endingTime = data['endingTime'];

                        document.getElementById('freeSlotdateupdte').value = freeDay;
                        $('.startingtime-timepicker').val(startingime);
                        $('.endingtime-timepicker').val(endingTime);
                        document.getElementById('updateFreeSlotID').textContent = id;








                    },
                    error : function(data){
                        alert( "error "+data);
                    }


                });




            });
        });



        $(function() {
            $("#btnUpdateFreeSlot").click(function() {



                var freeSlotDate = document.getElementById('freeSlotdateupdte').value;
                var slotID = document.getElementById('updateFreeSlotID').innerText;
                var startingTime = $("#startingTimeupdate").val();
                var EndingTime = $("#endingTimeUpdate").val();
                /*alert("date :"+freeSlotDate);
                 alert("s :"+startingTime);
                 alert("e :"+EndingTime);*/

                var postData = {
                    'freeSlotDate' : freeSlotDate,
                    'startingTime' : startingTime,
                    'EndingTime' : EndingTime,
                    'inSlotId' : slotID
                };

                $.ajax({
                    type: "GET",
                    url: "/updateFreeSlot",
                    data: postData,
                    dataType: 'json',
                    //assign the var here
                    success: function(data){
                        ///  alert(data);
                        $('#exampleModal1update').modal('hide');
                        document.location.reload();
                        //   $("#divWrapperSearch").load('freeSlotManagerload');
                        swal("Updated!", "Your free has been Updated To database.", "success");

                    },
                    error : function(data){
                        swal("Updated!", "Something wrong with free slot update inputs.", "error");
                    },
                    complete : function($result){
                        //alert( "Completed "+$result);
                    }


                });

            });
        });

        function deleteFreeSlot(slotId){
            alert(slotId);
            var postData = {
                'slotID' : slotId
            };

            $.ajax({
                type: "GET",
                url: "/deleteFreeSlot",
                data: postData,
                dataType: 'json',
                //assign the var here
                success: function(){
                    //  document.location.reload();

                    /// swal("Updated!", "Your free has been Updated To database.", "success");
//            "+data+"
                    swal("Deleted!", "Your 'th Free Slot has been deleted from database.", "success");
                    //  document.location.reload();
                },
                error : function(){
                    alert( "error ");
                },
                complete : function($result){
                    //alert( "Completed "+$result);
                }


            });
        }


        $(function() {
            $('.btndelete').click(function() {
                alert("srsf");
//                var freeSlotID = $(this).find("#freeslotid").text();
//                console.log(freeSlotID)
//                alert(freeSlotID);
//                deleteFreeSlot(freeSlotID);
            });
        });



        $(function() {
            $("#btnSearchByFreeSlotDate").click(function() {
                var sday = document.getElementById('txtSearchByFreeSlotDate');
//                var date  = document.getElementById('txtSearchByFreeSlotDate').value;
                $("#divWrapperSearch table tbody tr a h3").each(function () {
                    var string = $(this).text().toLowerCase();
                    if (string.indexOf(sday.value) != -1) {
                        $(this).parent().parent().parent().show();
                    } else {
                        $(this).parent().parent().parent().hide();
                    }
                });
            });
        });
    </script>

    <script>
        function getFreeSlotDetailsByEmail(){
            var Email = document.getElementById('txtPanelMember').value;
            var postData = {
                'panelMemberEmail' : document.getElementById('txtPanelMember').value
            };
            $.ajax({
                type: "GET",
                url: "/searchedFreeSlotDetails",
                data: postData,
                dataType: 'json',
                success: function(data){
                    var table = makeTable(data["currentUserSolts"]);
                }, error : function(data){
                    console.log("error"+data)
                }, complete : function($result){
                }
            });
        }
        function makeTable(json) {
            var tr=[];

            document.getElementById('tbody').innerHTML =null;
            for (var i = 0; i < json.length; i++) {
                tr.push('<tr>');
                tr.push("<td class=\"issue-info\"><a href=\"#\"><h3 id=\"day\">" + json[i].freeDay + "</h3></a></td>");
                tr.push("<td>" + json[i].startingHour+":"+json[i].startingMin + "</td>");
                tr.push("<td>" + json[i].endingHour+":"+json[i].endingMin + "</td>");
                tr.push("<td class=\"text-right\"> <div> " +
//                "<button type=\"button\" id=\"btnupdate\" name=\"btnupdate\" class=\"btn btn-white btn-xs btnupdate\" data-toggle=\"modal\" data-target=\"#exampleModal1update\"> Update </button>" +
//                "<button type=\"button\" id=\"btndelete\" name=\"btndelete\" class=\"btn btn-white btn-xs btndelete\" onclick=\"deleteFreeSlot(json[i].id)\"> Delete </button>" +
                "</div></td>");
                tr.push();
                tr.push('</tr>');
            }
            document.getElementById('tbody').innerHTML +=tr.join('');
        }
    </script>

@endsection

