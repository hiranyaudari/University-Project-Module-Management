@extends('masterpages.master_rpc')

@section('css_links')

@endsection

@section('title')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Presentation Panel</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection


@section('subheader')

    <h5>Edit Presentation  <small>Panel.</small></h5>
    <div class="ibox-tools">


    </div>
@endsection

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert" id="divAlert" style="font-size: 14px">
                Please Check : @foreach ($errors->all() as $error)
                    {{$error.','}}
                @endforeach

            </div>
        @elseif(Session::has('message_success'))
            <div class="alert alert-success" role="alert" id="divAlert" style="font-size: 14px">
                <span class="glyphicon glyphicon-envelope"></span> {{Session::get('message_success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Presentation Panel</h5>
                        {{--<div class="ibox-tools">--}}
                            {{--<a class="collapse-link">--}}
                                {{--<i class="fa fa-chevron-up"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                    <div class="ibox-content">
                        <div class="row">

                            {!! Form::open(array('route'=>['proposalpanels.update',Crypt::encrypt($presentationPanel->id )],'method'=>'PUT', 'onsubmit' => 'return (checktime() && checkMember())', 'id'=>'editpanelform')) !!}

                            <div class="form-group">
                                <label class="col-md-7 control-label">Project</label>
                                <div >
                                    <select id="projects" name="projects" class="form-control" onchange="getSupervisor()">
                                        @foreach($allProjects as $pro)
                                            <option value="{{$pro->id}}">{{$pro->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">Supervisor</label>
                                <div>
                                    <input type="text" value="{{$supervisor->name}}" id="txtSupervisor" name="txtSupervisor" placeholder="-Select Project-" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">Panel Member 1</label>
                                <div>
                                    <select id="panelmember1" name="panelmember1" class="form-control"  onchange="selectMember1();checkMember()" >
                                        @foreach($membersOne as $member)
                                            <option value="{{$member->id}}">
                                                {{ $member->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">Panel Member 2</label>
                                <div>
                                    <select id="panelmember2" name="panelmember2" class="form-control" onchange="selectMember2();checkMember()">
                                        @foreach($membersTwo as $member)
                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">Venue</label>
                                <div>
                                    <select id="presentationvenue" name="presentationvenue" class="form-control">
                                        <option value="Concept Nursery">Concept Nursery</option>
                                        <option value="D-302">D-302</option>
                                        <option value="D-201">D-201</option>
                                        <option value="A-402">A-402</option>
                                        <option value="A-610">A-610</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">Date</label>
                                <div>
                                    <input class="form-control" value="{{$presentationPanel->date}}" id="date" name="date" type="date" min="{{date("Y-m-d")}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">Start Time</label>
                                <div>
                                    <input id="startTime" class="form-control starttime-timepicker" placeholder="Start Time" value="{{$presentationPanel->time_start}}"  name="startTime" type="time">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-7 control-label">End Time</label>
                                <div>
                                    <input id="endTime" class="form-control endingtime-timepicker" placeholder="End Time" value="{{$presentationPanel->time_end}}" name="endTime" type="time">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-7 col-sm-offset-7">
                                    <a class="btn btn-white" href="{{URL::route('proposalpanels.index')}}">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>


                        </div>
                    </div>
                </div>
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h4>Free Slots of Panel Members</h4>
                        {{--<div class="ibox-tools">--}}
                            {{--<a class="collapse-link">--}}
                                {{--<i class="fa fa-chevron-up"></i>--}}
                            {{--</a>--}}
                            {{--<a class="close-link">--}}
                                {{--<i class="fa fa-times"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                    <div class="ibox-content">
                        <div class="row" id="divSupervisor">
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row" id="divPanelMember1">
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row" id="divPanelMember2">
                        </div>

                    </div>
                </div>
            </div>
            </div>

        </div>
    </div>

@endsection



@section('ValidationJavaScript')
    <script type="text/javascript">

        $( document ).ready(function() {
            getSupervisor();
            selectMember1();
            selectMember2();
        });

        function checkMember() {
            var pm1 = document.getElementById("panelmember1");
            pm1 = pm1.options[pm1.selectedIndex].text;
            var pm2= document.getElementById("panelmember2");
            pm2 = pm2.options[pm2.selectedIndex].text;
            var pm3 = document.getElementById("txtSupervisor").value;

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


        function getSupervisor() {
            var e = document.getElementById("projects");
            var prjId = e.options[e.selectedIndex].value;
            $.ajax({

                type: "GET",
                url: '/getsupervisor', 
                dataType: 'JSON',
                data: {"projectId": prjId}

            }).done(function (data) {
                $('#txtSupervisor').val(data.supervisor);

                var html = "<h5>Supervisor</h5>";
                var i;
                for(i = 0; i <data.supervisorSlots.length; i++) {
                    html += "<li>"+data.supervisorSlots[i].freeDay+
                    "- "+data.supervisorSlots[i].startingHour+
                    ":"+data.supervisorSlots[i].startingMin+
                    " to "+data.supervisorSlots[i].endingHour+
                    ":"+data.supervisorSlots[i].endingMin+
                    "</li>";
                }
                document.getElementById("divSupervisor").innerHTML = html;
            }).fail(function ($data) {
                alert("Something went wrong while requesting details");
            })
        }

        function selectMember1() {
            var e = document.getElementById("panelmember1");
            var memId = e.options[e.selectedIndex].value;
            $.ajax({

                type: "GET",
                url: '/member1', 
                dataType: 'JSON',
                data: {"memberId": memId}

            }).done(function (data) {

                var html = "<h5>Panel Member 1</h5>";
                var i;
                for(i = 0; i <data.memberSlots.length; i++) {
                    html += "<li>"+data.memberSlots[i].freeDay+
                    "- "+data.memberSlots[i].startingHour+
                    ":"+data.memberSlots[i].startingMin+
                    " to "+data.memberSlots[i].endingHour+
                    ":"+data.memberSlots[i].endingMin+
                    "</li>";
                }
                document.getElementById("divPanelMember1").innerHTML = html;
            }).fail(function ($data) {
                alert("Something went wrong while requesting details");
            })
        }

        function selectMember2() {
            var e = document.getElementById("panelmember2");
            var memId = e.options[e.selectedIndex].value;
            $.ajax({

                type: "GET",
                url: '/member1', 
                dataType: 'JSON',
                data: {"memberId": memId}

            }).done(function (data) {

                var html = "<h5>Panel Member 2</h5>";
                var i;
                for (i = 0; i < data.memberSlots.length; i++) {
                    html += "<li>" + data.memberSlots[i].freeDay +
                    "- " + data.memberSlots[i].startingHour +
                    ":" + data.memberSlots[i].startingMin +
                    " to " + data.memberSlots[i].endingHour +
                    ":" + data.memberSlots[i].endingMin +
                    "</li>";
                }
                document.getElementById("divPanelMember2").innerHTML = html;
            }).fail(function ($data) {
                alert("Something went wrong while requesting details");
            })
        }

        function checktime()
        {
            var start = document.getElementById("startTime").value;
            var end = document.getElementById("endTime").value;
            var date = document.getElementById("date").value;

            if(new Date(date) < new Date()) {
                alert("The selected date should exceed current day!!");
                return false;
            }

            if(Date.parse('01/01/2011 '+end) < Date.parse('01/01/2011 '+start))
            {
                alert("End time should exceed the start time");
                return false;
            }
            else if(Date.parse('01/01/2011 '+end) - Date.parse('01/01/2011 '+start)==0)
            {
                alert("Start time and end time cannot be same");
                return false;
            }

            return true;
        }
    </script>

    <script>
        $(document).ready(function() {

            $('.starttime-timepicker').val({{ $presentationPanel->time_start }});
            $('.endingtime-timepicker').val({{ $presentationPanel->time_end }});
        })
    </script>
@endsection