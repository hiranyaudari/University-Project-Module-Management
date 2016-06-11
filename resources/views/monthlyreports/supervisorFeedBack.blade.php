@extends('masterpages.master_panel_member')
@section('cssLinks')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
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

    <div class="col-lg-12">
        <div id="divselectionpanel" class="panel panel-danger">
            <div class="panel-heading">
                Select Monthly Report
            </div>
            <div class="panel-body  form-inline">
                <p>
                <div class="col-md-10">
                    <select class="form-control" name="months" id="months">
                        <option value="0">-Select a month-</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                    <select class="form-control" name="projects" id="projects">
                        <option value="0">-Select a project-</option>
                    </select>

                    <button id="btnLoad" class="btn btn-primary">Load Report</button>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-2">

                </div>
                </p>
            </div>
        </div>
    </div>

    <br />
    <div class="col-lg-6" id="divsupervisor">
        {!! Form::open(array('route'=>'monthlyreports.supervisor.store','onsubmit=return checkInputs()','method'=>'POST', 'id'=>'monthlysupervisorform')) !!}

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Supervisor Feedback Form</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <div class="row">
                    <div class="col-md-6 b-r">
                        Current status of the project
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" value="1" name="currentstatus" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Good</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="2" name="currentstatus" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Satisfactory</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="3" name="currentstatus" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Need Improvement   </label>
                                </div>

                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="4" name="currentstatus" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Not Satisfactory</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 b-r">
                        Work Carried out During the last Month
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" value="1" name="workdone" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Good</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="2" name="workdone" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Satisfactory</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="3" name="workdone" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Need Improvement   </label>
                                </div>

                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="4" name="workdone" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Not Satisfactory</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 b-r">
                        Timely completion of work according to the initial proposal
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" value="1" name="timelycompletion" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Good</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="2" name="timelycompletion" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Satisfactory</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="3" name="timelycompletion" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Need Improvement   </label>
                                </div>

                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="4" name="timelycompletion" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Not Satisfactory</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 b-r">
                        Maintaining regular contact with the Supervisor
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" value="1" name="supervisorcontact" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Good</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="2" name="supervisorcontact" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Satisfactory</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="3" name="supervisorcontact" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Need Improvement   </label>
                                </div>

                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="4" name="supervisorcontact" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Not Satisfactory</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 b-r">
                        Are you satisfied with present overall progress of the project
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" value="1" name="overallprogress" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Yes</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="2" name="overallprogress" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        Do you see any serious problems in the current work that may effect timely completion of the project
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" value="1" name="seriousproblems" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>Yes</label>
                                </div>
                                <div class="i-checks"><label class="">
                                        <div class="iradio_square-green" style="position: relative;">
                                            <input type="radio" checked="" value="2" name="seriousproblems" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            </ins>
                                        </div>
                                        <i></i>No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        Comments
                    </div>
                    <div class="col-md-6">
                        <div class="vertical-timeline-block">
                            <div class="row col-sm-12">
                                <div><textarea name="comments" id="comments" rows="8" class="form-control"></textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
            <br />
                <input id="reportNo" name="reportNo" type="hidden" value="">
                <input id="projectNo" name="projectNo" type="hidden" value="">
            <button id="btnSubmit" class="btn btn-primary col-lg-offset-8" type="submit">Submit Feedback</button>
        </div>
    </div>
    {!! Form::close() !!}
    </div>

    <div class="col-lg-6"  id="divstudent">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Monthly Progress Report</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="row">
                        <div class="col-md-3 b-r"> Registration No </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <input id="studentNo" name="studentNo" type="text" class="form-control" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3 b-r"> Student Name </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <input id="studentName" name="studentName" type="text" class="form-control" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3 b-r">
                            Project Title
                        </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <input id="title" type="text" class="form-control" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3 b-r">
                            Current status of the project
                        </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <textarea id="currentStatus" name="currentStatus" rows="8" class="form-control" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3 b-r">
                            Work carried out during the last month
                        </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <textarea id="workDone" name="workDone" rows="8" class="form-control" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3 b-r">
                            Submitted Date
                        </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <input id="submittedon" type="text" class="form-control" value="" readonly>
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

    <script src="{{asset('public_assets/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            //initialize the radio buttons and checkbox
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            //disable supervisor form and student feedback before load project
            nodes = document.getElementById("divsupervisor").getElementsByTagName('*');
            for(var i = 0; i < nodes.length; i++)
            {
                nodes[i].disabled = true;
            }
            //enable supervisor form and student feedback after load project

        });
    </script>

    <script>
        /*
            Load respective projects when selecting month
         */
        $('#months').change(function() {
            var month = $('#months').val();
            $.ajax({
                type: "GET",
                url: '/ajax/monthlyreports/getprojects', // This is what I have updated
                dataType: 'JSON',
                'data': {
                    "month" : month
                }

            }).done(function (data) {
                var result = data.projects;

                $('#projects').find('option').remove().end().append('<option value="0">- Select A Project -</option>');
                $.each(result, function(key, value) {
                    $('#projects').append($('<option/>').attr("value", value.id).text(value.title));
                });

            }).fail(function (data) {
                console.log(data)
            });
        });
    </script>

    <script>
        /*
         Load respective monthly reports when selecting project
         */
        $('#btnLoad').click(function() {
            var projectId = $('#projects').val();
            var month = $('#months').val();
            $.ajax({
                type: "GET",
                url: '/ajax/monthlyreports/getmonthlyreport', // This is what I have updated
                dataType: 'JSON',
                'data': {
                    "month" : month,
                    "projectId" : projectId
                }

            }).done(function (data) {
                console.log(data);
                $('#studentNo').val(data.student.regId);
                $('#studentName').val(data.student.name);
                $('#title').val(data.project.title);
                $('#currentStatus').val(data.monthlyReport.currentstatus);
                $('#workDone').val(data.monthlyReport.workdone);
                $('#reportNo').val(data.monthlyReport.id);
                $('#projectNo').val(data.project.id);

                var submittedDate = new moment(data.monthlyReport.created_at);
                $('#submittedon').val(submittedDate.format('dddd, MMMM Do YYYY'));

                for(var i = 0; i < nodes.length; i++)
                {
                    nodes[i].disabled = false;
                }

                $('#divselectionpanel').removeClass('panel-danger');
                $('#divselectionpanel').addClass('panel-success');

            }).fail(function (data) {
                console.log(data.responseText);
            });
        });
    </script>

    <script>
        function checkInputs() {
            if($('#comments').val()=="") {
                swal(
                        "Feedback could not be submitted!",
                        "Please enter a valid comments for the student",
                        "error"
                );
                return false;
            } else if($('#projects').val==0) {
                swal(
                        "Feedback could not be submitted!",
                        "Please select a project from the dropdown before submitting your feedback",
                        "error"
                );
                return false;
            } else if($('#projects').val==0) {
                swal(
                        "Feedback could not be submitted!",
                        "Please select a month before submitting your feedback",
                        "error"
                );
                return false;
            }
            return true;
        }
    </script>

@endsection