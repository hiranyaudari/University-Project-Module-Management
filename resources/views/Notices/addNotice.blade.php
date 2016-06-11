@extends('masterpages.master_rpc')

@section('css_links')

@endsection


@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add New Notice</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection


{{--@section('subheader')--}}
    {{--<h5>Add New Notice</h5>--}}
{{--@endsection--}}




@section('content')

<div class="row">

    @if (count($errors) > 0)

        <div class=" alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form id="form1" name="form1" method="post" action="" >


        <div class="col-sm-10 form-group">
            <label>Topic</label>
            <input name="topic" type="text" id="topics" class="form-control"/>
        </div>


        <div class="col-sm-10 form-group">
            <label>Detail</label>
            <textarea name="detail" class="form-control" name="detail" ></textarea>
        </div>

        <div class="summernote"></div>


        <div class="form-group">
            <div class="col-md-4">
                <button type="submit" name="addNotice" value="Submit" class="btn btn-w-m btn-primary">Add</button>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="reset" name="Submit2" value="Reset" class="btn btn-w-m btn-primary">
            </div>
        </div>


    </form>

</div>

@endsection

@section('ValidationJavaScript')
    <script src="//cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            $('.summernote').ckeditor();
        });
    </script>
@endsection
