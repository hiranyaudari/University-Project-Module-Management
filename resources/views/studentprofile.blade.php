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


        <title>Student Profile</title>



        <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2  ><font color="#006400" > workZone Student Profile</font> </h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

{{--@section('subheader')--}}
    {{--<h5>View Specific Project Details</h5>--}}
{{--@endsection--}}

@section('content')
<form>
<div class="wrapper wrapper-content animated fadeInUp"  >
                    <div class="ibox" align="center">
                        <div class="ibox-content"  align="center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">

                                        <h2> <font color="#006400"></font> </h2>
                                    </div>

                                </div>
                            </div>
                            <div class="row" align="center">
                                <div class="col-lg-5" align="center"><font color="green">
                                    <dl class="dl-horizontal" >
                                    @foreach($studentProfile as $entry)

                                    <dt> Student Id</dt> <dd>{{$entry->regId}}</dd><br>

                                    <dt>Student name</dt> <dd>{{$entry->sName}}</dd><br>
                                    <dt>Email </dt> <dd>{{$entry->email}}</dd><br>
                                    <dt>Contact Number</dt> <dd>{{$entry->phone}}</dd><br>
                                    <dt>Project Id</dt> <dd>{{$entry->projId}}</dd><br>
                                    <dt>Project Title </dt> <dd>{{$entry->title}}</dd><br>
                                    <dt>Project Supervisor</dt> <dd>{{$entry->supervisorName}}</dd><br>
                                    <dt>Project Description</dt> <dd>{{$entry->pDescription}}</dd><br>

                                    @endforeach

                                    </dl></font>
                                </div>
                                </div>
                                </div>

                                </div>

                                </div>


  </form>


@endsection