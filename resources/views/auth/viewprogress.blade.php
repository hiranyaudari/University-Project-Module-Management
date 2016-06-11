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


        <title>Interim Reports</title>



        <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')


@endsection

{{--@section('subheader')--}}
    {{--<h5>View Specific Project Details</h5>--}}
{{--@endsection--}}

@section('content')
<form>
<div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">

                                        <h3> <font color="black">Project Progress Feedback</font> </h3>
                                    </div>

                                </div>
                            </div>
                            <div class="row" align="center">
                                <div class="col-lg-5"><font color="black">
                                    <dl class="dl-horizontal" >
                                    @foreach($rp as $entry)
                                    <dt> Student Id</dt> <dd>{{$entry->Student_no}}</dd><br>

                                    <dt>Project Progress</dt> <dd>{{$entry->feedback}}</dd><br>


                                    @endforeach

                                    </dl></font>
                                </div>
                                </div>
                                </div>

                                </div>

                                </div>


  </form>


@endsection