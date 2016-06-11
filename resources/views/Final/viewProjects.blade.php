@extends('masterpages.master_panel_member')
@section('css_links')


    <!--link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css"-->
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

    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>



@stop

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View My Project</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

{{--@section('subheader')--}}
    {{--<h5>My Project View</h5>--}}
{{--@endsection--}}
@section('content')
<div class="table-responsive">
  <table id="myTable" name="myTable" class="table table-hover issue-tracker" >

   <tr>

           <th>Project Title</th>
           <th>Description</th>
           <th>Student Registration No</th>
           <th>Student Name</th>
           <th>Contact No</th>
           <th>Email Address</th>

   </tr>
     @foreach($myProjects as $prj)
           <tr class="tablerow">

           <td>{{$prj->title}}</td>
           <td> {{ $prj->description }}</td>

           <td>{{$prj->regId}}</td>
           <td>{{$prj->name}}</td>
           <td>{{$prj->phone}}</td>
           <td>{{$prj->email}}</td>


           </tr>
 @endforeach

</table>
 </div>

@endsection



  @section('javascripts')

      {{--<script src="http://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>--}}

<script src="{{ asset('public/js/inspinia.js') }}"></script>
<script src="{{ asset('public/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/jquery-2.1.1.js') }}"></script><!---->
<script src="{{ asset('public/js/inspinia.js') }}"></script>
<script src="{{ asset('public/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/js/plugins/footable/footable.all.min.js') }}"></script>
<!---->


      <script>

          $(document).ready(function(){
              $('#myTable').DataTable();
          });
      </script>
  @endsection

