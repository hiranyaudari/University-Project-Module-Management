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


       



        <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Download Final Report</h2>
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


                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Project ID</th>
                                <th>Student ID</th>
                                <th>Supervisor ID</th>
                                <th>File Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                             @foreach($rp as $entry)
                            <tr>
                                <td>{{$entry->Project_id}}</td>
                                <td>{{$entry->Student_no}}</td>
                                 <td>{{$entry->Supervisor_id}}</td>
                                <td>{{$entry->original_filename}}</td>
                                <td><a href="{{route('getentry', $entry->filename)}}">Download File</a></td>
                            </tr>
                           @endforeach

                        </table>

                    </div>


@endsection