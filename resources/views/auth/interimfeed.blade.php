@extends('masterpages.master_panel_member')

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
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">


        <title>Project progress feedback</title>



        <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> Project Progress Feedback</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection
@section('content')

@if(Session::has('message'))
<p class="alert"><font color="green">{{ Session::get('message') }}</font></p>
@endif


<form class="form-horizontal" method="post">

                                <div class="form-group">
                                <label class="col-lg-2 control-label">Student No</label>


                                    <div class="col-sm-10"><select class="form-control m-b" name="regId" >
                                                                         @foreach($rp as $std)

                                                                          <option value="{{$std->regId}}" style="width: auto" id="panel">{{$std->regId}}</option>

                                                                         @endforeach
                                                                         </select>
                                                                          @if ($errors->has('regId')) <p class="help-block"><font color="red">{{ $errors->first('regId') }}</font></p> @endif



                                    </div>





                                   <label class="col-lg-2 control-label">Date</label>
                                   <div class="col-sm-10" >
                                   <input type="text" class="form-control" data-mask="99/99/9999" name="date" placeholder="" value="<?php $dte= new DateTime();echo $dte->format('Y-m-d '); ?>">

                                 <br> </div>



                                 <label class="col-lg-2 control-label">Feedback</label>


                                  <div class="col-sm-10">
                                  <textarea name ="feedback" rows="10" cols="125" placeholder=" Enter feedback" > </textarea>
                                  @if ($errors->has('feedback')) <p class="help-block"><font color="red">{{ $errors->first('feedback') }}</font></p> @endif

                                    </div>


                                   <div class="col-lg-offset-2 col-lg-10">
                                   <button class="btn btn-w-m btn-primary" type="submit">Submit</button>
                                  </div>






                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    </div>
</form>
@stop