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
@section('subheader')
    <h2>Monthly Progress Reports.</h2>
@endsection


@section('content')


<div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
            <form method="post">
                 <div class="form-group">
                 <label class="col-sm-2 control-label">Month</label>

                <div class="col-sm-10">
                 <select class="form-control m-b" name="getMonth" id="getMonth">

                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                 </select></div>

                 </div>

                  <div class="form-group">
                   <div><input type='hidden' name='viewDoc'>
                                    <input type='submit'  class="save_btn btn btn-primary" name='viewSub' value='View Submissions'>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            </div>
                  </div>
                  </form>


                   <div class="col-lg-10">
                                      <div class="ibox float-e-margins">
                                          <div class="ibox-title">
                                              <h3>Monthly Reports   <small>{{$month}}</small></h3>

                                          </div>

                                          <div class="ibox-content">

                                              <table class="table table-hover">
                                                  <thead>
                                                  <tr>
                                                      <th>Project Title</th>
                                                      <th>Registration No</th>
                                                      <th>Student Name   </th>
                                                      <th>Submitted Date </th>
                                                      <th>FeedBack       </th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach($submissions as $sub)
                                                             <tr>
                                                                     <td>{{ $sub->title }}</td>
                                                                     <td>{{ $sub->regId }}</td>
                                                                     <td>{{ $sub->name}}</td>
                                                                     <td>{{ $sub->submittedDate}}</td>
                                                                     <td>
                                                                     <a href="{{ asset('viewdoc/' . $sub->id) }}" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                                                     <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Give FeedBack </a>
                                                                     </td>
                                                             </tr>
                                                     @endforeach
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                   </div>
                   </div>
</div>



@endsection


@stop




