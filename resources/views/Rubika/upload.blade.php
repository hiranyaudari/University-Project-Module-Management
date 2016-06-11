@extends('masterpages.master_student')


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
        <link href="{{asset('public_assets/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('public_assets/css/animate.cs')}}" rel="stylesheet">
        <link href="{{asset('public_assets/css/plugins/dropzone/basic.css')}}" rel="stylesheet">
        <link href="{{asset('public_assets/css/plugins/dropzone/dropzone.css')}}" rel="stylesheet">

@endsection


@section('subheader')
<h5>Upload Document Here</h5>
@endsection

@section('content')

<div class="ibox float-e-margins">
    <form id="uploads" name="uploads" method="post" action="" enctype='multipart/form-data'>
        <div class="ibox-content text-right p-md">


                <div class="row">
                   <div class="form-group">
                           <label class="col-sm-2 control-label">Add File</label>
                              <div class="col-sm-5">
                                    <input type="file" name="formField" id="formField">
                               </div>

                       </div>
                </div>
                </br>

                <div class="row">
                        <div class="form-group">
                              <label class="col-sm-2 control-label">Author</label>
                                 <div class="col-sm-5">
                                     <input type="text" name="regNo" class="form-control m-b" value="{{$regNo}}" readonly>
                                 </div>

                         </div>
                </div>

                <div class="row">
                    <div class="form-group">
                         <label class="col-sm-2 control-label">Document</label>
                             <div class="col-sm-5">
                             <input type="text" name="docType" class="form-control m-b" value="{{$link->docType}}" readonly>
                              </div>
                    </div>
                </div>

                 <div class="row">
                      <div class="form-group">
                            <label class="col-sm-2 control-label">Due Date</label>
                                 <div class="col-sm-5">
                                    <input type="text" name="deadline" class="form-control m-b" value="{{$link->deadline}}" readonly>
                                 </div>
                      </div>
                 </div>

                 <div class="row">
                   <div class="form-group">
                      <label class="col-sm-2 control-label">Time Remaining</label>
                        <div class="col-sm-5">
                            <input type="text" name="daysRemaining" class="form-control m-b" value="{{$daysRemaining}}" readonly>
                        </div>
                     </div>
                  </div>


                   <div class="form-group">

                        <div class="col-md-4">
                            <button type="submit" name="upload" value="upload" class="btn btn-w-m btn-primary">Upload Document</button>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                         </div>

                  </div>




            </div>
    </form>
            </div>


     @endsection




