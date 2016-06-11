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
        <link href="{{ asset('public_assets') }}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">

@endsection


@section('subheader')
<h5>View Upload Links</h5>
@endsection


 @section('content')



<div class="row">
<div class="col-md-10" >
</div>

<form method='post'>
          <input  type='submit' name='addLink'  value='Add Upload Link' align="left" class="btn btn-primary btn-xs m-l-sm">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>
</div>

<div class="row">
<div class="wrapper wrapper-content animated fadeInRight">

        <ul> <h2><span style="color: #3cdb2d"> {{ $message }} </span> </h2></ul>

     </div>
</div>

  <div class="ibox-content">
        <table class="table table-hover">
        <thead>
            <tr>
                <th>Category</th>
                <th>Document</th>
                <th>Link Name</th>
                <th>Description</th>
                <th>Deadline</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
             @foreach($uploadLinks as $link)
                   <tr class="tablerow">
                        <td>{{$link->category }}</td>
                        <td>{{$link->docType }}</td>
                        <td>{{$link->linkName}}</td>
                        <td>{{$link->description}}</td>
                        <td>{{$link->deadline}}</td>
                        <td><a href="{{ asset('editLink/' . $link->id) }}" class="edit_btn btn btn-primary btn-xs m-l-sm">Edit   </a></td>
                        <td>

                        <form method='post'>
                                <input type='hidden' name='hideLink'  value={{$link->id}}>
                                 <button type="submit" name="hide"  class="btn btn-primary btn-xs m-l-sm">{{$link->status}}</button>
                                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          </form></td>

                         <td >  <form method='post'>
                                   <input type='hidden' name='deleteLink'  value={{$link->id}}>
                                   <button type="submit" name="delete"  class="btn btn-primary btn-xs m-l-sm ">Delete </button>
                                   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          </form></td>


                   </tr>

              @endforeach
        </tbody>
       </table>
 </div>

@endsection
@stop
