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
    <link href="{{ asset('public_assets') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">

    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>

@stop

@section('title')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Change Supervisor Details</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    @endsection
{{--@section('subheader')--}}
    {{--<h5>Change Supervisor</h5>--}}
    {{--@endsection--}}

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">

                 <div class="form-group">
                 <label class="col-sm-2 control-label">Project Title</label></div>

                 <select class="form-control" name="chnageProject" id="chnageProject" onchange="viewProjectDetails()">
<option>Select One..</option>
         <?php

                                    foreach($pro as $category=>$value)
                                    {
                                        $category = htmlspecialchars($category);
                                        echo '<option value="'. $category .'">'. $value .'</option>';
                                    }
                                    ?>

                                                            </select>



                           <div class="form-group">
                           <label class="col-sm-2 control-label">Project Description</label>

                           <input type="textArea" disabled placeholder="Description" id="pDescription" class="form-control">

</div>
                             <div class="form-group">
                             <label class="col-sm-2 control-label">Student ID</label>
                             <input type="text" id="sid" disabled placeholder="Student Id" class="form-control">
                             </div>



                            <div class="form-group">
                            <label class="col-sm-2 control-label">Student Name</label>
                            <input type="text" id="sname" disabled="" placeholder="Student Name" class="form-control">
                            </div>


                            <div class="form-group">
                            <label class="col-sm-2 control-label">Current Supervisor</label>
                           <input type="text" disabled="" id="currentSupervisor" placeholder="Current Supervisor" class="form-control"></div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">New Supervisor</label></div>
                            <select class="form-control m-b" name="newSup" id="newSup">

                             <?php

                                foreach($supervisors as $category=>$value)
                                {
                                    $category = htmlspecialchars($category);
                                    echo '<option value="'. $category .'">'. $value .'</option>';
                                }
                                                                ?>



                                                                  </select>

</div>
                             <div class="form-group">
                               <div class="col-sm-4">

                                     <button class="btn btn-primary" type="submit" onclick="changeSupervisor()">Save changes</button>
                               </div>
                              </div>

                </div>
            </div>

            @endsection



@section('ValidationJavaScript')
                       <script>
                          function viewProjectDetails(){

                        var optionSelected = document.getElementById('chnageProject').value;

                              var postData = {
                                  'projectId' : optionSelected
                              };

                              $.ajax({
                                  type: "GET",
                                  url: "/viewProjectByProjectName",
                                  data: postData ,
                                  dataType: 'json',
                                  success: function(data){
                                      document.getElementById('pDescription').value= data[0]['pDescription'];
                                      document.getElementById('sid').value= data[0]['regId'];
                                      document.getElementById('sname').value= data[0]['sName'];
                                      document.getElementById('currentSupervisor').value= data[0]['supName'];
                                  },
                                  error : function(data){
                                      alert( "error "+data);
                                  }
                              });
                          }


                          function changeSupervisor(){

                              swal({   title: "Are you sure?",
                                          text: "Do You want to Update Supervisor of this Project ??",
                                          type: "warning",   showCancelButton: true,
                                          confirmButtonColor: "#DD6B55",
                                          confirmButtonText: "Yes, Update it!",
                                          closeOnConfirm: false },
                                      function(){



                                          var projectId = document.getElementById('chnageProject').value;
                                          var newSupervisor = document.getElementById("newSup").value;
                                          //  var newSupId = e.options[e.selectedIndex].value;


                                          // alert(projectId);


                                          var postData = {
                                              'projectID' : projectId,
                                              'newSup' : newSupervisor

                                          };

                                          $.ajax({
                                              type: "GET",
                                              url: "/changeSupStore",
                                              data: postData ,
                                              dataType: 'json',
                                              success: function(data){
                                                  document.location.reload();
                                                  swal("Updated!", "Project Supervisor has been changed ", "success");
                                              },
                                              error : function(data){
                                                  swal("Error!", "Something wrong.", "error");
                                              }
                                          });


                                      }).fail( function() {
                                          alert( 'something wrong' );
                                      });


                              /////////////////////////////////////////////////////////////////////////////////////////////////////////


                          }
                         </script>


<script src="{{ asset('public/js/plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function () {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });
</script>



<script src="{{ asset('public/js/inspinia.js') }}"></script>
<script src="{{ asset('public/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/jquery-2.1.1.js') }}"></script><!---->
<script src="{{ asset('public/js/inspinia.js') }}"></script>
<script src="{{ asset('public/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/js/plugins/footable/footable.all.min.js') }}"></script>
<!---->

@endsection
