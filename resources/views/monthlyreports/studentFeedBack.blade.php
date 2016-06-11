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

    {!! Form::open(array('route'=>'monthlyreports.student.store','method'=>'POST', 'onsubmit'=>'return checkInputs()', 'id'=>'monthlystudentform')) !!}

    <div class="col-lg-12">
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
                                    <input id="studentNo" name="studentNo" type="text" class="form-control" value="{{$student->regId}}" readonly>
                                    <input id="studentId" name="studentId" type="hidden" value="{{$student->id}}">
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
                                    <input id="title" type="text" class="form-control" value="{{$project->title}}" readonly>
                                    <input id="projectId" name="projectId" type="hidden" class="form-control" value="{{$project->id}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3 b-r">
                          
                        </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">

                                    <select class="form-control m-b" name="months" id="months">
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 b-r">
                            Current Status Of The Project
                        </div>
                        <div class="col-md-9">
                            <div class="vertical-timeline-block">
                                <div class="row col-sm-12">
                                    <textarea id="currentStatus" name="currentStatus" rows="8" class="form-control">{{ old('currentStatus') }}</textarea>
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
                                    <textarea id="workDone" name="workDone" rows="8" class="form-control">{{ Input::old('workDone') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button id="btnSubmit" class="btn btn-primary col-lg-offset-10" type="submit">Submit Report</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
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