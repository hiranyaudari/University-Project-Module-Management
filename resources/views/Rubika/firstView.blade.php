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
                 <label class="col-sm-2 control-label">Select a Supervisor</label></div>

                 <select class="form-control m-b" name="supervisor" id="supervisor">
                    <option>Select One..</option>
                                     @foreach($supervisors as $sup)
                                    {
                                        <option>{{$sup}}</option>
                                    }
                                    @endforeach

                  </select>
                  </div>

                  <div>

                  <form method='post'>
                                      <input  type='submit' name='viewProfile'  value='View Profile' class="btn btn-primary btn-xs m-l-sm">
                                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  </form>
                  </div>



                           <div class="form-group">
                           <label class="col-sm-2 control-label">Full Name</label>

                           <input type="text" disabled placeholder="Full Name" id="sName" class="form-control">
                           </div>

                             <div class="form-group">
                             <label class="col-sm-2 control-label">Designation</label>
                             <input type="text" id="designation" disabled placeholder="Designation" class="form-control">
                             </div>



                            <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <input type="text" id="email" disabled="" placeholder="Email Address" class="form-control">
                            </div>


                            <div class="form-group">
                            <label class="col-sm-2 control-label">Contact No</label>
                           <input type="text" disabled="" id="phone" placeholder="Phone No" class="form-control"></div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Interested Areas</label></div>
                    <input type="textarea" disabled="" id="speciality" placeholder="Interested topics" class="form-control"></div>
                     </div>


                    <div class="form-group">
                    <label class="col-sm-2 control-label">Currently Supervising Projects</label></div>

                    <input type="textarea" disabled="" id="projects" placeholder=" Current Projects" class="form-control"></div>

                     </div>



                </div>
            </div>

            @endsection




@stop