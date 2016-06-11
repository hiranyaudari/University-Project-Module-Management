@extends('masterpages.master_rpc')

@section('cssLinks')
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <style>
        td.fc-day.fc-past {
            background-color: #293846;
        }
    </style>
@endsection


@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert" id="divAlert" style="font-size: 14px">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>

    @elseif(Session::has('message_success'))
        <div class="alert alert-success" role="alert" id="divAlert" style="font-size: 14px">
            <span class="glyphicon glyphicon-envelope"></span> {{Session::get('message_success') }}
        </div>
    @endif

    <div class="row animated fadeInDown">
        {{--<div class="ibox-content">--}}


        <div class="col-lg-4">
            <div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create Panel</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                        </div>
                    </div>
                    <div class="ibox-content">

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Date</label>
                                <div class="col-lg-9 ">
                                <input id="scheduledate" class="form-control" name="date" type="date" min="{{date("Y-m-d")}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Venue</label>
                                <div class="col-lg-9">
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
                                <label class="col-lg-3 control-label">Supervisor</label>
                                <div class="col-lg-9">
                                    <select id="supervisor" name="supervisor" class="form-control" onchange="checkIfRPC('supervisor'); displayFreeSlots('supervisor');">
                                        <option value="s">Select A Member</option>
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{$supervisor->id}}">{{$supervisor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label id="lblRPC" class="col-lg-3 control-label">LIC</label>
                                <div class="col-lg-9">
                                    <select id="rpc" name="rpc" class="form-control" onchange="displayFreeSlots('rpc')">
                                        {{--<option value="0">Select A Member</option>--}}
                                        {{--@foreach($panelMembers as $member)--}}
                                        {{--<option value="{{$member->id}}">{{$member->name}}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Examiner</label>
                                <div class="col-lg-9">
                                    <select id="examiner" name="examiner" class="form-control" onchange="displayFreeSlots('examiner')">
                                        {{--<option value="0">Select A Member</option>--}}
                                        {{--@foreach($panelMembers as $member)--}}
                                        {{--<option value="{{$member->id}}">{{$member->name}}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-8">
                                    <a id="btnLoadProjects" class="btn btn-sm btn-white">Load Projects</a>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Created Panels</h5>
                    </div>
                    <div class="ibox-content">
                        <div id="external-events">
                            <p>Drag a event and drop into calendar.</p>

                            {{--@foreach($thesisProjects as $thesisEvent)--}}
                                {{--<div id={{$thesisEvent->projectId}} class="external-event navy-bg ui-draggable ui-draggable-handle"--}}
                                     {{--style="position: relative;">{{$thesisEvent->title}}</div>--}}
                            {{--@endforeach--}}

                            <center> <span style="color: red; font-weight: bold;"> No projects yet. Create Panel First </span></center>

                            <p class="m-t">

                            {{--<div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox"  id="drop-remove" class="i-checks" checked="" style="position: absolute; opacity: 0;">--}}
                                {{--<ins class="iCheck-helper"--}}
                                     {{--style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>--}}
                            {{--</div>--}}
                            {{--<label for="drop-remove">remove after drop</label>--}}
                            </p>
                        </div>
                    </div>
                </div>


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Free Slots of Panel Members</h5>
                </div>
                <div class="ibox-content" style="display: block;">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#supervisorFree" aria-expanded="false" class="collapsed">Supervisor</a>
                                    </h5>
                                </div>
                                <div id="supervisorFree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body"> No Free Slots Available Currently </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#rpcFree" class="collapsed" aria-expanded="false">Project Coordinator/Examiner</a>
                                    </h5>
                                </div>
                                <div id="rpcFree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body"> No Free Slots Available Currently </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#examinerFree" class="collapsed" aria-expanded="false">Examiner</a>
                                    </h4>
                                </div>
                                <div id="examinerFree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body"> No Free Slots Available Currently </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!----------------------------------------------------------------------------------->

        <div class="col-lg-8">
            <div id="calendar" class="fc fc-ltr fc-unthemed">

            </div>
        </div>
        <!--------------------------------------------------------------------------------------------->

    </div>


    <div class="modal inmodal" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Project Details</h4>
                </div>

                <div id="projectmodelbody" class="modal-body">

                </div>
                <div class="modal-footer">
                    <a id="btnModalUpdate" name="btnModalUpdate" href="">Update</a>

                </div>

            </div>

        </div>
    </div>

@endsection

@section('ValidationJavaScript')

    <script src="{{ asset('public_assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ asset('public_assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('js/thesis_presentation_scheduling.js') }}"></script>
    <script src="{{ asset('js/thesis_full_calendar.js') }}"></script>

    <script>
        /*
            datepicker on change function
         */
        $('#scheduledate').on('change', function() {
            var selectedDateString = $('#scheduledate').val();
            var day = moment(selectedDateString, "YYYY-MM-DD");
            $('#calendar').fullCalendar( 'gotoDate', day );
        });

        /*
            check members if they are same
         */
//        $('#supervisor, #rpc, #examiner').change(function() {
//            console.log($('#rpc').val());
//            checkMember('supervisor','rpc','examiner');
//        });

        /*
            load the projects of panel members
         */
        $('#btnLoadProjects').click(function() {
            loadProjects();
        });
    </script>

    <script>
        /*
            When the page is loaded call the method to initialize the fullcalendar
         */
        $(document).ready(function () {

            $('.external-events').change(function() {
                alert('changed');
            });

            var eventjson = <?php echo json_encode($events);?>;
            initializeCalendar(eventjson);
        });
    </script>

@endsection