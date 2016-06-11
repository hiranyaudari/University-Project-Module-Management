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
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">


    <title>Thesis Reports</title>



    <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Upload Thesis Reports</h2>
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


    <form class="form-horizontal" method="post"   enctype="multipart/form-data" >
        <div class="form-group">





            <label class="col-lg-2 control-label">Date</label>
            <div class="col-sm-10" >
                <input type="text" class="form-control" data-mask="99/99/9999" name="date" placeholder="" value="<?php $dte= new DateTime();echo $dte->format('Y-m-d '); ?>">
                <br>
                <br>
            </div>

            <label class="col-lg-2 control-label">File</label>
            <div class="col-sm-10" >
                <input type="file" name="filefield"  >
                <br>

                <input type="submit" class="btn btn-w-m btn-primary" >
            </div>





        </div>

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


    </form>

@stop