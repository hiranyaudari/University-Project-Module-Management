@extends('masterpages.master_reg')

@section('cssLinks')

    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">
    <script src="{{ asset('public_assets/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/sweetalert.css') }}">

@endsection



@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

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

        <div>

            {!! Form::open(array('url'=>'/register','method'=>'POST', 'class'=>'wizard-big', 'id'=>'form', 'enctype'=>'multipart/form-data' )) !!}
                <h1>Student</h1>
                <fieldset>
                    <h2>Student Information</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Registration Number *</label>
                                <input type="text" name="regId" placeholder="Registration Number" value="{{ old('regId') }}" class="form-control required"/>
                            </div>

                            <div class="form-group">
                                <label>Attempt</label>
                                <select class="form-control m-b" name="attempt">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Student Name *</label>
                                <input type="text" id="studentname" name="studentname" value="{{ old('studentname') }}" placeholder="Name" type="text" class="form-control required"/>
                            </div>

                            <div class="form-group">
                                <label>Student Email *</label>
                                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control required"/>
                            </div>

                        </div>
                        <div class="col-lg-6">

                            <div class="form-group" id="telDiv">
                                <label>Student Telephone *</label>
                                <input id="telephone" name="telephone" type="tel" onkeypress='validate(event)' value="{{ old('telephone') }}" placeholder="Tel" class="form-control required" />
                            </div>

                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" type="password" name="password" placeholder="Password" class="form-control required" />
                            </div>

                            <div class="form-group">
                                <label>Re-Enter Password *</label>
                                <input id="confirm" type="password" name="confirm" type="password" placeholder="Re-Enter Password" class="form-control required" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <div style="margin-top: 20px">
                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>


                <h1>Supervisor</h1>
                <fieldset>
                    <h2>Supervisor Type</h2>
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Type</label>
                                <div class="col-md-6">
                                    <div class="radio"><label> <input type="radio" value="none" name="supervisortype" id="radioSupervisorNone" checked="checked" onclick="displayInternalSupervisor(1)">None</label></div>
                                    <div class="radio"><label> <input type="radio" value="internal" name="supervisortype" id="radioSupervisorInternal" onclick="displayInternalSupervisor(2)" >Internal</label></div>
                                    <div class="radio"><label> <input type="radio" value="external" name="supervisortype" id="radioSupervisorExternal" onclick="displayInternalSupervisor(3)" >External</label></div>
                                </div>
                            </div>

                            <div class="form-group" id="divInternalSupervisor" >
                                <div class="col-md-6">
                                <label>Internal Supervisors</label>
                                <select id="selectInternalSupervisors" class="form-control" name="internalsupervisor">
                                    @foreach($supervisors as $supervisor)
                                        <option value="{{$supervisor->id}}">{{ $supervisor->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </fieldset>

                <h1>External Supervisor</h1>
                <fieldset>
                    <h2>External Supervisor Information (Optional)</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="supervisorName" value="{{ old('supervisorName') }}" placeholder="Supervisor Name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Attached Institute</label>
                                <input type="text" name="supervisorInstitute" value="{{ old('supervisorInstitute') }}" placeholder="Attached Institute" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" name="supervisorDesignation" value="{{ old('supervisorDesignation') }}" placeholder="Designation" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="textarea" name="supervisorAddress" value="{{ old('supervisorAddress') }}" placeholder="Address of Supervisor" class="form-control">
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group" id="telDiv">
                                <label>Telephone Number</label>
                                <input type="text" id="supervisorTelephone" name="supervisorTelephone" value="{{ old('supervisorTelephone') }}" onkeypress='validateSupTel(event)' placeholder="Supervisor Telephone Number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Fax Number</label>
                                <input type="text" id="supervisorFax" name="supervisorFax" value="{{ old('supervisorFax') }}" onkeypress='validateSupFax(event)' placeholder="Supervisor Fax Number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="supervisorEmail" value="{{ old('supervisorEmail') }}" placeholder="Supervisor Email" class="form-control">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Project</h1>
                <fieldset>
                    <h2>Project Details</h2>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Project Title</label>
                            <input type="text" name="projectTitle" placeholder="Project Title" class="form-control required">
                        </div>

                        <div class="form-group">
                            <label>Upload</label>
                            <input name="txtFile" id="txtFile" type="file" class="form-control"/>
                        </div>

                        <textarea name="projectDescription" rows="4" cols="50" value="{{ old('projectDescription') }}" class="form-control required">
                            Enter a short description of your project here
                        </textarea>

                        <div class="form-group">
                            <input id="acceptTerms" name="acceptTerms" value="{{ old('acceptTerms') }}" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                        </div>
                    </div>
                </fieldset>

            {!! Form::close() !!}
            {{--</form>--}}
        </div>
    </div>
    </div>


@endsection

@section('ValidationJavaScript')



    <!-- bootbox code -->
    <script src="{{ asset('public_assets/css/style.css') }}"></script>
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            displayInternalSupervisor(1);

            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);
                    form.submit();
                    // Submit form input

//                    //alert(form.serialize());
//
//                    var userName =document.getElementById('username').value;
//                    var password =document.getElementById('password').value;
//                    var fullName =document.getElementById('fullname').value;
//                    var email =document.getElementById('email').value;
//                    var role =document.getElementById('role').value;
//                    var designation =document.getElementById('designation').value;
//
//                    //var freeSlotID = $(this).find("#freeslotid").text();
//
//
//                    var postData = {
//                        'username' : userName,
//                        'email' : email,
//                        'password' : password,
//                        'designation' : designation,
//                        'role' : role,
//                        'fullname' : fullName
//                    };
//
//                    $.ajax({
//                        type: "GET",
//                        url: "/addUserNewAccount",
//                        data: postData,
//                        //assign the var here
//                        success: function(data){
////alert("heee")
//                            swal("Added!", "Your "+data+"'th Free Slot has been deleted from database.", "success");
//                            document.location.reload();
//
//                        },
//                        error : function(data){
//                            alert( "error "+data);
//                        },
//                        complete : function($result){
//                            // alert( "Completed "+$result);
//                        }


//                    });


                }
            }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
        });
    </script>

    <script>
        function phonenumber(inputtxt)
        {
            var phoneno = /^\d{10}$/;
            if(inputtxt.value.match(phoneno))
            {
                return true;
            }
            else
            {
                alert("Not a valid Phone Number");
                return false;
            }
        }
    </script>

    <script>
        function displayInternalSupervisor(option) {
            if(option==1 || option==3) {
                document.getElementById('divInternalSupervisor').style.display = 'none';
            }

            else if(option==2) {
                document.getElementById('divInternalSupervisor').style.display = 'block';
            }
        }
    </script>

    <script src="{{asset('public_assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>



    <script>

        function validate(evt) {

            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;

                if(theEvent.preventDefault) {
                 //   $('#telDiv').addClass('has-error');
                    theEvent.preventDefault();
                }
            }else{
              //  $('#telDiv').removeClass().addClass('form-group has-success');
            }

            $("#telephone").attr('maxlength','10');

        }


        function validateSupTel(evt) {

            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;

                if(theEvent.preventDefault) {
                   // $('#sTelDiv').addClass('has-error');
                    theEvent.preventDefault();
                }
            }else{
               // $('#sTelDiv').removeClass().addClass('form-group has-success');
            }

            $("#supervisorTelephone").attr('maxlength','10');

        }

        function validateSupFax(evt) {

            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;

                if(theEvent.preventDefault) {
                    // $('#sTelDiv').addClass('has-error');
                    theEvent.preventDefault();
                }
            }else{
                // $('#sTelDiv').removeClass().addClass('form-group has-success');
            }

            $("#supervisorFax").attr('maxlength','10');

        }
    </script>
@endsection