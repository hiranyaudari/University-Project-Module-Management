@extends('masterpages.master_student')
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
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>View Supervisor's Feedback</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="panel-body">

                    <div class="panel-group" id="accordion">

                        @foreach($feedbacks as $feedback)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">

                                        @if($feedback->id === 1)
                                            <a aria-expanded="true" class="" data-toggle="collapse" data-parent="#accordion" href="#{{$feedback->id}}">{{ $feedback->month }}</a>
                                        @else
                                            <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{$feedback->id}}">{{ $feedback->month }}</a>
                                        @endif
                                    </h5>
                                </div>
                                @if($feedback->id === 1)
                                    <div style="" aria-expanded="true" id="{{ $feedback->id }}" class="panel-collapse collapse in">
                                @else
                                    <div style="height: 0px;" aria-expanded="false" id="{{ $feedback->id }}" class="panel-collapse collapse">
                                @endif

                                    <div class="panel-body">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Current status of the project</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->currentstatus }}</p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Work Carried out During the last Month</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->workdone }}</p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Timely completion of work according to the initial proposal</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->timelycompletion }}</p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Maintaining regular contact with the Supervisor</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->supervisorcontact }}</p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Are you satisfied with present overall progress of the project?</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->overallprogress }}</p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Any serious problems in the current work that may effect timely completion of the project?</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->seriousproblems }}</p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-5 control-label">Comments</label>
                                                <div class="col-lg-7"><p class="form-control-static">{{ $feedback->comments }}</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                    $('.i-checks').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green'
                    });
                });
            </script>

            <script>
                function checkInputs() {
                    var monthsValue = $('#months').val();
                    var currentStatus = $('#currentStatus').val();
                    var workDone = $('#workDone').val();

                    if(monthsValue==0 || currentStatus=="" || workDone=="") {
                        swal(
                                "Report could not be submitted!",
                                "Please check whether you have entered all the inputs correctly.",
                                "error"
                        );
                        return false;
                    }
                    return true;
                }
            </script>

            @endsection