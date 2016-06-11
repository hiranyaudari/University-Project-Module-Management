@extends('masterpages.master_rpc')

@section('css_links')
        <title>Student Details</title>
@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View Specific Student Details</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">
            <h5>{{$r->name}}</h5>
        </div>
    </div>
@endsection

@section('content')


        <div class="row">
        <div>Name : {{$r->regId}}</div>
        <div>Designation : {{$r->name}}</div>
        <div>Email :<a href="">{{$r->email}}</a></div>
        <div>Contact No :{{$r->phone}}</div>
        <div>CourseField :{{$r->courseField}}</div>

        <div>Attempt :{{$r->attempt}}</div>


      </div>


          @endsection