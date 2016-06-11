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


        <title>workZone</title>



        <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
        <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@section('title')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All notices for Student</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

{{--@section('subheader')--}}

    {{--<h5>Notices</h5>--}}
{{--@endsection--}}


@section('content')

           @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
           @endif

<div class="col-md-12">
 <div class="ibox-content">
<table class="table ">

    @foreach($no as $n)

       <form id="{{$n->id}}" action='' method='post' >

            @if($n->type=='notice')
                          <tr >
                              <td><p><Strong>{{ $n->topic }}</Strong></p>
                                  <p> <?php echo nl2br($n->detail)?></p></td>
                          </tr>

            @elseif($n->type=='link')
                       <?php  $v=explode('.',$n->detail)?>

                        @if(array_pop($v)!='pdf')
                             <tr>
                               <td><p><a  href="{{ asset('download/' . $n->detail)}}">{{$n->topic}}</a></p></td>
                             </tr>

                        @else
                            <tr >
                               <td><p><a href="{{ asset('view1/' . $n->detail) }}">{{$n->topic}}</a></p></td>
                           </tr>
                        @endif


            @elseif($n->type=='uplink')
                        <tr>
                           <td><a href="email" id="{{$n->id}} "style="text-decoration: none">{{$n->topic}}</a></td>
                        </tr>



            @endif

       </form>

    @endforeach

</table>
</div>
</div>

@endsection