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


        <title></title>



        <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> Final Report</h2>
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
                                <label class="col-lg-2 control-label">Project Title</label>


                                    <div class="col-sm-6"><select class="form-control m-b" name="title" >
                                                                         @foreach($rp as $std)

                                                                          <option value="{{$std->title}}" style="width: auto" id="panel">{{$std->title}}</option>

                                                                         @endforeach
                                                                         </select>
                                                                          @if ($errors->has('title')) <p class="help-block"><font color="red">{{ $errors->first('title') }}</font></p> @endif



                                    </div>












                                   <div class="col-lg-offset-2 col-lg-10">
                                   <button class="btn btn-w-m btn-primary" type="submit">Search</button>
                                  </div>






                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    </div>
</form>
@stop