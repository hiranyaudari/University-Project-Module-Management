@extends('masterpages.master_rpc')

@section('css_links')
        <title>Project Details</title>
    @endsection
@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View Specific Project Details</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')




     <div class="col-lg-12">
       <div class="ibox float-e-margins">

       @foreach($t as $r)
         <div class="ibox-title">
            <h5>{{$r->title}}</h5>
         </div>

        <div class="ibox-content">
        <div>Title : {{$r->title}}</div>
        <div>Decription : {{$r->description}}</div>
        <div>Student:<a href="{{ asset('studentDetails/' . $r->name)}}">{{$r->name}}</a></div>

      </div>
      @endforeach
          </div>
          </div>
          </div>
          @endsection