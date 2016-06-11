@extends('masterpages.master_rpc')

@section('css_links')

        <title>External Supervisors</title>
    @endsection
@section('title')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Specific External Supervisor Details</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">
            <h5>{{$r->name}}</h5>
        </div>
    </div>
@endsection

@section('content')


        <div class="ibox-content">
        <div>Name : {{$r->name}}</div>
        <div>Designation : {{$r->designation}}</div>
        <div>Email :<a href="">{{$r->email}}</a></div>
        <div>Contact No :{{$r->phone}}</div>
        <div>Speciality :{{$r->speciality}}</div>

        <div>University :{{$r->university}}</div>

      </div>

          @endsection