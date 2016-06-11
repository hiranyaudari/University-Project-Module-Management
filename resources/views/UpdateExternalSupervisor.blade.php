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


@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Update External Supervisor</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection
{{--@section('subheader')--}}
    {{--<h5>Update Supervisor <small>Details.</small></h5>--}}
    {{--<div class="ibox-tools">--}}
        {{--<a class="collapse-link">--}}
            {{--<i class="fa fa-chevron-up"></i>--}}
        {{--</a>--}}

    {{--</div>--}}
{{--@endsection--}}

@section('content')


    <div class="ibox float-e-margins animated fadeInRight">

        <div class="row">
            <div id='result'></div>
            <form class="form-horizontal" method ="post" action="updateExternalSupervisorSubmit">
                <div class="form-group"><label class="col-sm-2 control-label">Search(ID)</label>


                    <div class="col-sm-10">
                        <select class="form-control m-b" name="searchdropdown" id="searchdropdown" onchange="selectUser(event)">


                            <?php
                            #
                            foreach($categories1 as $category=>$value)
                            {
                                $category = htmlspecialchars($category);
                                echo '<option value="'. $category .'">'. $value .'</option>';
                            }
                            ?>

                        </select>


                    </div>

                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group"><label class="col-sm-2 control-label">User Name</label>

                    <div class="col-sm-10"><input id="userName" name="userName" placeholder="Enter User Name" type="text" disabled class="form-control required"/></div>
                </div>

                <div class="form-group"><label class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10"><input id="status" name="status" placeholder="Enter Status" type="text" disabled class="form-control required"/></div>
                </div>

                <div class="form-group" id="emailDiv"><label class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                        <input id="email" name="email" onkeypress="validateEmail(event)" type="email" placeholder="Enter Email" class="form-control required" required="" aria-required="true" aria-invalid="true"></div>
                </div>



                <div class="form-group" id="fullNameDiv"><label class="col-sm-2 control-label">Full Name</label>

                    <div class="col-sm-10">
                        <input id="fullname" name="fullname" onkeypress="validateFullName(event)" placeholder="Enter Full Name" type="text" class="form-control required"/></div>
                </div>



                <div class="form-group"><label class="col-sm-2 control-label">Supervisor Type</label>

                    <div class="col-sm-10"><select class="form-control m-b" id="role" disabled name="role">
                            <option>Select One..</option>
                            <option>External Supervisor</option>
                            <option>Internal Supervisor</option>
                        </select>


                    </div>
                </div>

                <div class="form-group" id="designationDiv"><label class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">

                        <select class="form-control m-b" id="designation" name="designation" onchange="designationVal()">
                            <option>Select One..</option>
                            <option>Senior Lecturer</option>
                            <option>Assistant Lecturer</option>
                            <option>Lecturer</option>
                        </select>


                    </div>
                </div>
                <div class="form-group" id="teliv"><label class="col-sm-2 control-label">Tel</label>

                    <div class="col-sm-10"><input id="tel" name="tel" onkeypress='validate(event)' placeholder="Enter Tel No" type="text" class="form-control required"/></div>
                </div>

                <div class="form-group" id="speciality"><label class="col-sm-2 control-label">Speciality</label>

                    <div class="col-sm-10"><input id="spe" name="spe" onkeypress='validateSpe(event)' placeholder="Enter Supervisor Speciality" type="text" class="form-control required"/></div>
                </div>

                <div class="form-group" id="uniDiv"><label class="col-sm-2 control-label">University</label>

                    <div class="col-sm-10"><input id="uni" name="uni" placeholder="Enter University" type="text" class="form-control required"/></div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">

                        <button class="btn btn-primary" type="button" onclick="updateUser()">Save changes</button>

                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection

@section('ValidationJavaScript')


    <script>
        function selectUser(evt) {

            $('#designationDiv').removeClass().addClass('form-group has-success');
            $('#fullNameDiv').removeClass().addClass('form-group has-success');
            $('#emailDiv').removeClass().addClass('form-group has-success');
            $('#teliv').removeClass().addClass('form-group has-success');
            $('#speciality').removeClass().addClass('form-group has-success');
            $('#uniDiv').removeClass().addClass('form-group has-success');

            var e = document.getElementById("searchdropdown");
            var searchID = e.options[e.selectedIndex].value;

            if (searchID == 0) {

                document.getElementById('email').value = "";
                document.getElementById('userName').value = "";
                document.getElementById('fullname').value = "";
                document.getElementById("role").value = "Select One..";
                document.getElementById("designation").value = "Select One..";
                document.getElementById("tel").value = "";
                document.getElementById("spe").value = "";
                document.getElementById("status").value = "";

                document.getElementById("uni").value = '';

            }else{
            $.ajax({

                type: "GET",
                url: 'updateExternalSupervisorSearch', 
                data: {"sid": searchID},
                dataType: 'json'
            }).done(function (data) {


                document.getElementById('email').value = data['email'];
                document.getElementById('userName').value = searchID;
                document.getElementById('fullname').value = data['fullname'];
                document.getElementById("role").value = data['type'];
                document.getElementById("designation").value = data['designation'];
                document.getElementById("tel").value = data['phone'];
                document.getElementById("spe").value = data['spe'];
                document.getElementById("status").value = data['status'];
                if (data['type'] == 'Internal Supervisor') {
                    document.getElementById("uni").value = 'SLIIT';
                    document.getElementById("uni").disabled = true;
                } else {
                    document.getElementById("uni").value = data['uni'];
                    document.getElementById("uni").disabled = false;
                }


            }).fail(function () {
                alert('something Wrong');
            });
        }
        }
     /*   function deleteSup(){

            var userName = document.getElementById('userName').value;
            $.ajax({

                type: "POST",
                url: 'updateExternalSupervisorDelete', 
                data: {"sidnn": userName}

            }).done(function ($data) {
                alert($data);

            }).fail(function (){
                alert('something Wrong');
            });
        }*/

        function updateUser() {



            swal({   title: "Are you sure?",
                        text: "Do You want to Update User ??",
                        type: "warning",   showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Update it!",
                        closeOnConfirm: false },
                    function(){


                        var email = document.getElementById('email').value;
                        var userName = document.getElementById('userName').value;
                        var fullName = document.getElementById('fullname').value;
                        var role = document.getElementById("role").value;
                        var designation = document.getElementById("designation").value;
                        var tel = document.getElementById("tel").value;
                        var speciality = document.getElementById("spe").value;
                        var status = document.getElementById("status").value;
                        var uni = document.getElementById("uni").value;

                        if (designation == 'Select One..' || fullName=="" || email=="" || speciality=="" ||tel.length!=10 || !IsEmail(email)) {

                            if(designation == 'Select One..'){
                                $('#designationDiv').addClass('has-error');
                            }
                            if(fullName==""){
                                $('#fullNameDiv').addClass('has-error');

                            }if(email=="" || !IsEmail(email)){
                                $('#emailDiv').addClass('has-error');
                            }
                            if(speciality==""){
                                $('#speciality').addClass('has-error');
                            }
                            if(tel.length!=10){
                                $('#teliv').addClass('has-error');
                            }
                            swal("Error!", "Something wrong with your inputs !!", "error");
                        }
                        else{



                            $.ajax({

                                type: "GET",
                                url: 'updateExternalSupervisorUpdate',
                                data: {
                                    "username": userName,
                                    "email": email,
                                    "fullName": fullName,
                                    "role": role,
                                    "designation": designation,
                                    "tel": tel,
                                    "speciality": speciality,
                                    "status": status, "uni": uni
                                },
                                dataType: 'json'
                            }).done(function (data) {

                                swal("Updated!", "Your selected Supervisor details has been Updated.", "success");

                            }).fail(function (data) {
                                swal("Error!", "Something wrong.", "error");
                            });
                        }



                    }).fail( function() {
                        alert( 'something wrong' );
                    });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
        //js
        /* $(document).ready(function()
         {
         $('#searchdropdown').change(function() {
         var myurl = $(this).attr('href');
         $.ajax(
         {
         url: myurl,
         type: "get",
         datatype: "html",
         beforeSend: function()
         {
         $('#ajax-loading').show();
         }
         })
         .done(function(data)
         {
         $('#ajax-loading').hide();
         $("#comments").empty().html(data.html);
         })
         .fail(function(jqXHR, ajaxOptions, thrownError)
         {
         alert('No response from server');
         });
         return false;
         });
         });*/

    </script>



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
                    var form = $(this);
                    form.submit();
                    // Submit form input

                    //alert(form.serialize());

                    bootbox.alert("Hello world!", function() {

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


        function validate(evt) {

            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;

                if(theEvent.preventDefault) {
                    $('#teliv').addClass('has-error');
                    theEvent.preventDefault();
                }
            }else{
                $('#teliv').removeClass().addClass('form-group has-success');
            }

            $("#tel").attr('maxlength','10');

        }
      function  validateSpe(evt){
         // var theEvent = evt || window.event;
        //  var key = theEvent.keyCode || theEvent.which;
        //  key = String.fromCharCode( key );
         var key =  document.getElementById('spe').value;

          if(key!=""){
              $('#speciality').removeClass().addClass('form-group has-success');
          }else{
              $('#speciality').removeClass().addClass('form-group has-error');
          }

      }
        function  validateEmail(evt){
            // var theEvent = evt || window.event;
            //  var key = theEvent.keyCode || theEvent.which;
            //  key = String.fromCharCode( key );
            var key =  document.getElementById('email').value;

            if(key!=""){
                $('#emailDiv').removeClass().addClass('form-group has-success');
            }else{
                $('#emailDiv').removeClass().addClass('form-group has-error');
            }

        }
        function validateFullName(evt){
            var key =  document.getElementById('fullname').value;

            if(key!=""){
                $('#fullNameDiv').removeClass().addClass('form-group has-success');
            }else{
                $('#fullNameDiv').removeClass().addClass('form-group has-error');
            }

        }
        function designationVal(){
            var designation = document.getElementById("designation").value;
            if (designation == 'Select One..') {

                $('#designationDiv').addClass('has-error');

            }else{
                $('#designationDiv').removeClass().addClass('form-group has-success');
            }
        }

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    </script>


@endsection