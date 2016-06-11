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
            <h2> Uploaded Thesis Report</h2>
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
    @if(Session::has('message'))
        <p class="alert"><font color="green">{{ Session::get('message') }}</font></p>
    @endif

    <div class="ibox-content">
        <form action="" method="post">


            <table class="table"  >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Project ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>File Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rp as $rep)
                    <tr>
                        <td><input  type="checkbox" name="checkbox[]" value="{{$rep->id}}" ></td>
                        <td>{{$rep->Project_id}}</td>
                        <td>{{$rep->Student_no}}</td>
                        <td>{{$rep->date}}</td>
                        <td>{{$rep->filename}}</td>
                    </tr>
                @endforeach

                <td> <button type="submit" class="btn btn-w-m btn-primary" name="add"  align ="center">DELETE</button></td>


            </table>
    </form>
    </div>


@endsection
