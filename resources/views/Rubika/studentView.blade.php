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

@endsection


@section('subheader')
<h5>Upload Reports</h5>
@endsection


 @section('content')

@foreach($upLinks as $link)
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content text-left p-md">

                        <h2><span class="text-navy" style="color: #ff0000">{{$link->deadline}}</span></h2></br>
                        <h5>{{$link->description }}</h5>

                        <a href="{{ URL::to('uploads/' . $link->id )}}"><h4>{{$link->linkName }}</h4></a>

                    </div>
                </div>
            </div>
        </div>
       </div>
       @endforeach


@endsection
@stop

