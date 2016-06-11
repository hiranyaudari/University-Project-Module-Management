@extends('masterpages.master_rpc')

@section('cssLinks')

    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
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

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Accounts Management</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

{{--@section('subheader')--}}
    {{--<h5>User Accounts </h5>--}}
{{--@endsection--}}




@section('content')

    @if ( Session::has('flash_message') )

        <div class="alert {{ Session::get('flash_type') }}">
            <h3>{{ Session::get('flash_message') }}</h3>
        </div>

    @endif

    <div class="wrapper wrapper-content animated fadeInRight">

        <div>
            <!--h2>
                Add New User Account
            </h2>
            <p>
                Add User Account details.
            </p-->



            <form id="form" class="wizard-big">
                <h1>Account</h1>
                <fieldset>
                    <h2>Account Information</h2>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Username *</label>

                                <input id="username" name="username" placeholder="User Name" type="text" class="form-control required"/>
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" type="password" name="password" placeholder="Password" type="text" class="form-control required"/>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <input id="confirm" type="password" name="confirm" type="password" placeholder="Re-Password" class="form-control required"/>
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
                <h1>Profile</h1>
                <fieldset>
                    <h2>Profile Information</h2>
                    <div class="row">
                        <div class="col-lg-6">

                            <!--label>Registered ID *</label-->
                            <!--div class="form-group">
                                <input id="name" name="registereID" placeholder="Registered ID" type="text" class="form-control required"/>
                            </div-->
                            <div class="form-group">
                                <label>FUll Name *</label>
                                <input id="fullname" name="fullname" placeholder="Full Name" type="text" class="form-control required"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <input id="email" name="email" type="email" placeholder="Enter email" class="form-control required" required="" aria-required="true" aria-invalid="true">

                            </div>

                        </div>
                    </div>
                </fieldset>

                <h1>Profile cont.</h1>
                <fieldset>
                    <h2>Profile Information</h2>
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label>Role *</label>
                                <!--select id="position" name="position" type="text" class="form-control"-->
                                <!-- Brand and toggle get grouped for better mobile display -->

                                <select id="role" name="role" class="form-control">
                                    <option>LIC</option>
                                    <option>Panel Member</option>

                                </select>

                                <!---->
                            </div>

                            <div class="form-group">
                                <label>Designation *</label>
                                <!--select id="position" name="position" type="text" class="form-control"-->
                                <!-- Brand and toggle get grouped for better mobile display -->

                                <select id="designation" name="designation" class="form-control">
                                    <option>Senior Lecturer</option>
                                    <option>Lecturer</option>
                                    <option>Assistance Lecturer</option>
                                </select>

                                <!---->
                            </div>
                            
                            <div class="form-group">
                                <label>Research Area *</label>
                                <!--select id="position" name="position" type="text" class="form-control"-->
                                <!-- Brand and toggle get grouped for better mobile display -->

                                <select id="designation" name="designation" class="form-control">
                                    <option>Big Data Management </option>
                                    <option>Business Intelligence</option>
                                    <option>Computational Linguistics</option>
                                    <option>Artificial Intelligence(AI)</option>
                                </select>

                                <!---->
                            </div>

                        </div>
                        <div class="col-lg-6">


                        </div>
                    </div>
                </fieldset>

                <h1>Finish</h1>
                <fieldset>
                    <h2>Terms and Conditions</h2>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                </fieldset>
            </form>
        </div>
    </div>
    </div>


@endsection

@section('ValidationJavaScript')



    <!-- bootbox code -->
    <script src="{{ asset('public_assets/css/style.css') }}"></script>
    <script>
        $(document).ready(function(){
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

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
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
                   // var form = $(this);
                  //  form.submit();
                    // Submit form input

                    //alert(form.serialize());

                    var userName =document.getElementById('username').value;
                    var password =document.getElementById('password').value;
                    var fullName =document.getElementById('fullname').value;
                    var email =document.getElementById('email').value;
                    var role =document.getElementById('role').value;
                    var designation =document.getElementById('designation').value;

                    //var freeSlotID = $(this).find("#freeslotid").text();


                  var postData = {
                        'username' : userName,
                    'email' : email,
                    'password' : password,
                    'designation' : designation,
                    'role' : role,
                    'fullname' : fullName
                    };

                    $.ajax({
                        type: "GET",
                        url: "/addUserNewAccount",
                        data: postData,
                        //assign the var here
                        success: function(data){
//alert("heee")
                            swal("Added!", "Your "+data+"'th Free Slot has been deleted from database.", "success");
                            document.location.reload();

                        },
                        error : function(data){
                            alert( "error "+data);
                        },
                        complete : function($result){
                           // alert( "Completed "+$result);
                        }


                    });



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


    <script src="{{asset('public_assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>


@endsection