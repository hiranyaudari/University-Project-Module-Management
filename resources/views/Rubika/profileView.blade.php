@extends('masterpages.master_rpc')
@section('css_links')

    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">



    <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">


@endsection

@section('title')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Supervisor Profiles</h2>

        </div>

    </div>
    @endsection


@section('content')

<div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                 <div class="form-group">
                                 <label class="col-sm-3 control-label">Select a Supervisor</label>
                                     <div class="col-sm-9">

                 <select class="form-control" name="supervisor" id="supervisor" onchange="viewProfile()">
                    <option>Select One..</option>
                     <?php

                                    foreach($sup as $category=>$value)
                                    {
                                        $category = htmlspecialchars($category);
                                        echo '<option value="'. $category .'">'. $value .'</option>';
                                    }
                                    ?>

                  </select>
                  </div>
                  </div></br></br>

                    <h1>Profile Info</h1></br></br>

                           <div class="form-group">
                           <label class="col-sm-3 control-label">Full Name</label>
                            <div class="col-sm-9">
                           <input type="text" disabled placeholder="Full Name" id="sName" class="form-control">
                           </div>
                           </div></br></br>

                             <div class="form-group">
                             <label class="col-sm-3 control-label">Designation</label>
                             <div class="col-sm-9">
                             <input type="text" id="designation" disabled placeholder="Designation" class="form-control">
                             </div>
                             </div></br></br>



                            <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                            <input type="text" id="email" disabled="" placeholder="Email Address" class="form-control">
                            </div>
                            </div></br></br>


                            <div class="form-group">
                            <label class="col-sm-3 control-label">Contact No</label>
                             <div class="col-sm-9">
                           <input type="text" disabled="" id="phone" placeholder="Phone No" class="form-control">
                           </div>
                           </div></br></br>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Interested Areas</label>
                    <div class="col-sm-9">
                    <textarea name="projects" disabled="" id="speciality" placeholder=" Interested topics" class="form-control">
                     </textarea>
                    </div>
                     </div></br></br>



                     </div></br></br>



                </div>
            </div>

            @endsection



@section('ValidationJavaScript')
                       <script>
                          function viewProfile(){

                        var optionSelected = document.getElementById('supervisor').value;

                              var postData = {
                                  'supervisorID' : optionSelected
                              };


                              $.ajax({
                                  type: "GET",
                                  url: "/viewSupProfile",
                                  data: postData ,
                                  dataType: 'json',
                                  success: function(data){

                                  console.log();
                                      document.getElementById('sName').value= data[0].pName;
                                      document.getElementById('designation').value= data[0].designation;
                                      document.getElementById('email').value= data[0].email;
                                      document.getElementById('phone').value= data[0].contact;
                                      document.getElementById('speciality').value= data[0].interest;


                                  },
                                  error : function(data){
                                      alert( "error "+data);
                                  }

                              }).fail( function() {
                                       alert( 'something wrong' );
                                   });
                          }

                          </script>

@endsection
@stop