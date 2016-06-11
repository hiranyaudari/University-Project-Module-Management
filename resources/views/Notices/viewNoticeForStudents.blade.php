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


    <title>All Notices</title>



    <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection




{{--@section('subheader')--}}
    {{--<h5>View Notices</h5>--}}

{{--@endsection--}}



@section('content')

    <div class="row">
        <div class="col-md-9" >
            @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif




            <table class="table table-hover" >

                @foreach($no as $n)

                    <form id="{{$n->id}}" action='' method='post' >

                        @if($n->type=='notice')

                            <form id="{{$n->id}}" action='' method='post'>

                                <div class="ibox-title">
                                    <h5>All Notices</h5>


                                </div>

                                <div class="ibox-content">
                                    <div> <?php echo nl2br($n->detail)?></div>
                                </div>




                            </form>
                        @elseif($n->type=='link')
                            <?php  $v=explode('.',$n->detail)?>

                            @if(array_pop($v)!='pdf')


                                <div class="ibox-title">


                                    <h5><a  href="{{ asset('download/' . $n->detail)}}">{{$n->topic}}</a></h5>
                                    <div class="col-sd-3" align="right">
                                        <form method="post">
                                            <input type='hidden' name='toDelete'  value="{{$n->id}}">
                                            <input  type='submit' name='delete'  value='delete' class="btn btn-primary btn-xs m-l-sm">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form>

                                    </div>
                                </div>



                            @else


                                <div class="ibox-title">


                                    <h5>     <a href="{{ asset('view1/' . $n->detail) }}">{{$n->topic}}</a></h5>
                                    <div class="col-sd-3" align="right">
                                        <input type='hidden' name='toDelete'  value="{{$n->id}}">
                                        <p><input  type='submit' name='delete'  value='delete' class="btn btn-primary btn-xs m-l-sm">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                                    </div>
                                </div>
                            @endif


                        @elseif($n->type=='uplink')

                            <table class="ibox-title" width="800">
                                <tr>


                                    <td width ="600">  <h5><a href="email" id="{{$n->id}} "style="
                     text-decoration: none" >{{$n->topic}}</a></h5></td>



                                    <td >  <form method='post'>
                                            <input type='hidden' name='toDelete'  value="{{$n->id}}">
                                            <button type="submit" name="delete"  class="btn btn-primary btn-xs m-l-sm ">Delete</button>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form></td>



                                    <td>  <form method='post'>
                                            <input type='hidden' name='tohide'  value="{{$n->id}}">
                                            <button type="submit" name="hide"  class="btn btn-primary btn-xs m-l-sm">Hide</button>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form></td>



                                    <td>  <form method='post'>
                                            <input type='hidden' name='tovisible'  value="{{$n->id}}">
                                            <button type="submit" name="hide"  class="btn btn-primary btn-xs m-l-sm disabled" >visible</button>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form></td>





                                </tr>
                            </table>

                        @elseif($n->type=='hideuplink')
                            <table class="ibox-title" width="800">
                                <tr>


                                    <td width ="600">  <h5><a href="email" id="{{$n->id}} "style="
                     text-decoration: none" >{{$n->topic}}</a></h5></td>


                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='toDelete'  value="{{$n->id}}">
                                            <button type="submit" name="delete"  class="btn btn-primary btn-xs m-l-sm ">Delete</button>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form>
                                    </td>

                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='tohide'  value="{{$n->id}}">
                                            <button type="submit" name="hide"  class="btn btn-primary btn-xs m-l-sm disabled">Hide</button>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form>
                                    </td>

                                    <td>
                                        <form method='post'>
                                            <input type='hidden' name='tovisible'  value="{{$n->id}}">
                                            <button type="submit" name="hide"  class="btn btn-primary btn-xs m-l-sm " >visible</button>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        @endif

                    </form>
                @endforeach
            </table>

        </div>


    </div>
    </div>
@endsection



