@extends('masterpages.master_rpc')

@section('cssLinks')

    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('public_assets/css/plugins/switchery/switchery.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/chosen/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
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
@section('subheader')
    <h2>Upload Links</h2>
@endsection


@section('content')



      <div class="row">
          <div class="col-md-10" >
          </div>

          <form method='post'>
                    <input  type='submit' name='viewLink'  value='View Upload Links' align="left" class="btn btn-primary btn-xs m-l-sm">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          </form>
          </div>

          <div class="wrapper wrapper-content animated fadeInRight">

                  <ul> <h2><span style="color: #3cdb2d"> {{ $message }} </span> </h2></ul>
                  <ul> <h2><span style="color: #ff0000"> {{ $errorMessage }} </span> </h2></ul>

               </div>

<div class="wrapper wrapper-content animated fadeInRight">
            <form id="uploads" name="uploads" method="post" action="" >
                <div class="row">

                 <div class="form-group">
                 <label class="col-sm-3 control-label">CourseField</label>
                     <div class="col-sm-9">
                                  <select class="form-control m-b" name="getCourse" id="getCourse">

                                             <option>IT</option>
                                             <option>IS</option>
                                             <option>CS</option>
                                             <option>SE</option>

                                  </select>
                     </div>
                 </div>

                <div class="form-group">
                 <label class="col-sm-3 control-label">Document Type</label>
                                      <div class="col-sm-9">
                                                   <select class="form-control m-b" name="docType" id="docType">

                                                              <option>Proposal</option>
                                                              <option>Interim Report</option>
                                                              <option>Thesis</option>
                                                              <option>January Monthly Report</option>
                                                              <option>February Monthly Report</option>
                                                              <option>March Monthly Report</option>
                                                              <option>April Monthly Report</option>
                                                              <option>May Monthly Report</option>
                                                              <option>June Monthly Report</option>
                                                              <option>July Monthly Report</option>
                                                              <option>August Monthly Report</option>
                                                              <option>September Monthly Report</option>
                                                              <option>October Monthly Report</option>
                                                              <option>November Monthly Report</option>
                                                              <option>December Monthly Report</option>


                                                   </select>
                                      </div>
                 </div>

                 <div class="form-group">
                         <label class="col-sm-3 control-label">link Visible As</label>
                         <div class="col-sm-9">
                         <input type="text" name="linkName" placeholder="link Name" class="form-control m-b">
                         </div>
                 </div>
                 </br>

                 <div class="form-group">
                         <label class="col-sm-3 control-label">Description</label>
                         <div class="col-sm-9">
                         <input type="textArea" name="description"  placeholder="short description about the upload" class="form-control m-b">
                         </div>
                 </div>

                  </br></br>

                 <div class="form-group">
                        <label class="col-sm-3 control-label">Deadline</label>

                        <div class="form-group" id="datePicker1">
                            <div class="col-sm-9">

                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="deadline" name="deadline" class="form-control"  value="">
                               </div>
                            </div>
                        </div>
                 </div>

                  </br></br>
                 <div class="form-group">
                             <div class="col-md-4">
                                 <button type="submit" name="createLink" value="Submit" class="btn btn-w-m btn-primary">Create Upload Link</button>
                                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                             </div>
                         </div>

          </div>
          </form>
   </div>

   @endsection
@section('ValidationJavaScript')
<!-- Mainly scripts -->
    <script src="{{ asset('public_assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('public_assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/plugins/pace/pace.min.js') }}"></script>

    <script src="{{ asset('public_assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>


  <script>



   $('#datePicker1 .input-group.date').datepicker({
                  todayBtn: "linked",
                  minDate:0,
                  format: 'yyyy-m-d',
                  keyboardNavigation: false,
                  forceParse: false,
                  calendarWeeks: true,
                  autoclose: true

              });


  </script>


  @endsection
  @stop








