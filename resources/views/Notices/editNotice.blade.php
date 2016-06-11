@extends('masterpages.master_rpc')

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
            <h2>Edit Notice</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

{{--@section('subheader')--}}

{{--<h5>Edit Notice</h5>--}}
{{--@endsection--}}



@section('content')


        @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @endif




<div class="row">

  <form id="form1" name="form1" method="post" action="">



      <div class="col-sm-10 form-group">
          <label>Topic</label>
          <input name="e_topic" id="topics" type="text" id="topics" value="{{$v->topic}}" class="form-control"/>
      </div>


      <div class="col-sm-10 form-group">
          <label>Detail</label>
          <textarea name="e_detail" class="form-control" name="detail" >{{$v->detail}}</textarea>
      </div>


      <div class="form-group">
          <div class="col-md-4">
              <div><input type='hidden' name='toEdit'  value="{{$v->id}}">
                  <input type='submit'  class="save_btn btn btn-primary" name='edit' value='Save'>
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          </div>
      </div>
</div>

  </form>
 </div>
</div>
@endsection