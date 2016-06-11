@extends('masterpages.master_rpc')

@section('cssLinks')



@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Update User Account</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')

    @if ( Session::has('flash_message') )

        <div class="alert {{ Session::get('flash_type') }}">
            <h3>{{ Session::get('flash_message') }}</h3>
        </div>

    @endif
            <div class="float-e-margins animated fadeInRight">
                <div class="row">
                    <div id='result'></div>
                    <form class="form-horizontal" method ="post" action="updateUser">
                        <div class="form-group"><label class="col-sm-2 control-label">Search(User Name)</label>


                            <div class="col-sm-10">
                                <select class="form-control m-b" name="searchdropdown" id="searchdropdown" onchange="selectUser()">

                                    <option>Select</option>
                                    <?php

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

                        <div class="form-group" id="emailDiv"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10"> <input id="email" name="email" type="email" placeholder="Enter Email" class="form-control required" required="" aria-required="true" aria-invalid="true"></div>
                        </div>



                        <div class="form-group" id="fullNameDiv"><label class="col-sm-2 control-label">Full Name</label>

                            <div class="col-sm-10"><input id="fullname" name="fullname" placeholder="Enter Full Name" type="text" class="form-control required"/></div>
                        </div>



                        <div class="form-group" id="roleDiv"><label class="col-sm-2 control-label">Role</label>

                            <div class="col-sm-10"><select class="form-control m-b" id="role" name="role">
                                    <option>Select One..</option>
                                    <option>RPC</option>
                                    <option>Internal Supervisor</option>
                                    <option>External Supervisor</option>
                                    <option>Panel Member</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group" id="designationDiv"><label class="col-sm-2 control-label">Designation</label>

                            <div class="col-sm-10"><select class="form-control m-b" id="designation" name="designation">
                                    <option>Select One..</option>
                                    <option>Senior Lecturer</option>
                                    <option>Lecturer</option>
                                    <option>Assistant Lecturer</option>
                                </select>


                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">

                                <button class="btn btn-primary" onclick="updateUser()" id="btnSaveChangers" name="btnSaveChangers" type="button">Save changes</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


@endsection

@section('ValidationJavaScript')


    <script>
      /*  $(document).ready( function() {
            $('select[name="searchdropdown"]').change(function() {

        });*/
    /*  $('#searchdropdown').on('change', function() {
          var optionSelected = $(this).find("option:selected");
          var eid = optionSelected.val();
          alert(eid);

          $.ajax({
              type: "post",
              url: "test",
              data: {
                  id: eid
              }
              // data: $("#examId").val()
          })
                  .done(function() {
                      alert('im here');
                  });
      });*/




function selectUser(){

              var e = document.getElementById("searchdropdown");
              var searchID = e.options[e.selectedIndex].value;

                          $.ajax({

                              type: "GET",
                              url: '/searchUser',
                              data: {"sid": searchID},
                              dataType: 'json'
                          }).done(function (data) {



                              document.getElementById('email').value =  data['email'];
                              document.getElementById('userName').value =  searchID;

                              document.getElementById('fullname').value =  data['name'];
                              document.getElementById("role").value = data['type'];
                              document.getElementById("designation").value = data['designation'];

                          }).fail(function (data){
                              alert('something Wrong');
                          });
}


      function updateUser(){
          swal({   title: "Are you sure?",
                      text: "Do You want to Update this User ??",
                      type: "warning",   showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Yes, Update it!",
                      closeOnConfirm: false },
                  function(){




                      $('#designationDiv').removeClass().addClass('form-group has-success');
                      $('#fullNameDiv').removeClass().addClass('form-group has-success');
                      $('#emailDiv').removeClass().addClass('form-group has-success');
                      $('#roleDiv').removeClass().addClass('form-group has-success');


                      var email = document.getElementById('email').value;
                      var fullName = document.getElementById('fullname').value;
                      var role = document.getElementById("role").value;
                      var designation = document.getElementById("designation").value;


                      if (designation == 'Select One..' || role == 'Select One..' || fullName=="" || email=="" || !IsEmail(email)) {

                          if(designation == 'Select One..'){
                              $('#designationDiv').addClass('has-error');
                          }
                          if(fullName==""){
                              $('#fullNameDiv').addClass('has-error');

                          }if(email=="" || !IsEmail(email)){
                              $('#emailDiv').addClass('has-error');
                          }
                          if(role == 'Select One..'){
                              $('#roleDiv').addClass('has-error');
                          }

                          swal("Error!", "Something wrong with your inputs !!", "error");
                      }else{





                          ///var e = document.getElementById("searchdropdown");
                          //var searchID = e.options[e.selectedIndex].value;

                          var email = document.getElementById('email').value;
                          var username = document.getElementById('userName').value;

                          var fullName = document.getElementById('fullname').value;
                          var role = document.getElementById("role").value;
                          var designation = document.getElementById("designation").value;

                          $.ajax({

                              type: "GET",
                              url: 'saveUpdatedUser',
                              data: {"username": username,"email": email,"fullName": fullName,"role": role,"designation": designation},
                              dataType: 'json'
                          }).done(function (data) {

                              swal("Updated!", "Your selected Panel Member details has been deleted.", "success");

                          }).fail(function (data){
                              swal("Error!", "Something wrong with your inputs !!", "error");
                          });
                      }
                  }).fail( function() {
                      alert( 'something wrong' );
                  });
////////////////////////////////////////////////////////////////




      }


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