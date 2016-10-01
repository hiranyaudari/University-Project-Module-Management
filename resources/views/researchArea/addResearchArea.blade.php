@extends('masterpages.master_rpc')

@section('css_links')


@section('title')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Research Area</h2>
        <ol class="breadcrumb">

        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

@endsection
{{--@section('subheader')--}}
{{--<h5>Add Research Area</h5>--}}
{{--@endsection--}}

@section('content')

@if (Session::has('message_error'))
<div class="alert alert-danger" role="alert" id="divAlert" style="font-size: 14px">
    {{ Session::get('message_error') }}
</div>
@elseif(Session::has('message_success'))
<div class="alert alert-success" role="alert" id="divAlert" style="font-size: 14px">
    <span class="glyphicon glyphicon-envelope"></span> {{Session::get('message_success') }}
</div>
@endif
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>All Research Area Details</h5>
            <div class="ibox-tools">

            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">

                <table style="font-size: 13px" class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">

                    <thead>
                        <tr role="row">
<!--                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">Select</th>-->
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 100px;" aria-sort="ascending">Research Area No</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 253px;">Research Area</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 162px;">Researcher I</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 115px;">Researcher II</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 550px;">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Allresearchareas as $key=>$researcharea)
                        <tr>
<!--                        <td ><input  type="checkbox" name="checkbox2[]" value="{{ $researcharea->id }}" ></td>-->
                            <td> {{ $researcharea->id }} </td>
                            <td> {{ $researcharea->research_area }} </td>
                            <td> {{ $researcharea->researcher_i }} </td>
                            <td> {{ $researcharea->researcher_ii }} </td>
                            <td> <?php echo $researcharea->research_area ;echo wordwrap($researcharea->description, 70, "\n", TRUE) ?></td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'id' => 'deleteForm', 'action' => ['AddResearchArea@destroy', $researcharea->id ]]) !!}
                    <center>
                        <!--                        remove button-->
                        {!! Form::button( '<i class="fa fa-trash fa-lg" title="Delete"></i>',
                        ['onclick' => 'deleteresearcharea()',
                        'class' => 'delete text-danger deleteForm',
                        'id' => 'btnDeleteProduct',
                        'data-id' => $researcharea->id ] ) !!}
                        <!--                        end remove button-->

                        
                        <!--                        update button-->
                        <!--<a onclick = "deletePresentationPanel()" id=""class="btn btn-sm btn-danger">Delete</a>-->
                        {!! Form::button( '<i class="fa fa-edit fa-lg" style="color: blue"title="Edit"></i>',
                        ['onclick' => 'editresearcharea()',
                        'class' => 'delete text-danger editeForm',
                        'id' => 'btnediteProduct',
                        'data-id' => $researcharea->id ] ) !!}
                        <!--                        end update button-->
                    </center>
                    {!! Form::close() !!}
                    </td>
                    </tr>
                    
                    @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
<!--                        <th rowspan="1" colspan="1">Select</th>-->
                            <th rowspan="1" colspan="1">Research Area No</th>
                            <th rowspan="1" colspan="1">Research Area</th>
                            <th rowspan="1" colspan="1">Researcher I</th>
                            <th rowspan="1" colspan="1">Researcher II</th>
                            <th rowspan="1" colspan="1">Description</th>
                        </tr>
                    </tfoot>
                </table>
                {{--<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 21 to 30 of 57 entries</div>
				<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination">
				<li class="paginate_button previous" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous">
				<a href="#">Previous</a></li><li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
				<a href="#">1</a></li><li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
				<a href="#">2</a></li><li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0">
				<a href="#">3</a></li><li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
				<a href="#">4</a></li><li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
				<a href="#">5</a></li><li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
				<a href="#">6</a></li><li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next">
				<a href="#">Next</a></li></ul></div></div>--}}
            </div>

        </div>
    </div>
</div>

<div class="row" style="margin-left: 0px">

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
            <label>Research Area <strong style="color: red">*</strong></label>
            <input name="Research_Area" type="text" id="research" class="form-control"/>
        </div>

        <div class="col-sm-10 form-group">
            <label>Researcher I</label>
            <input name="researcher1" type="text" id="person" class="form-control"/>
        </div>
        <div class="col-sm-10 form-group">
            <label>Researcher II</label>
            <input name="researcher2" type="text" id="person2" class="form-control"/>
        </div>

        <div class="col-sm-10 form-group">
            <label>Description</label>
            <textarea name="desc" class="form-control" ></textarea>
        </div>

        <div class="summernote"></div>


        <div class="form-group">
            <div class="col-md-4">
                <button onclick="added()" name="addNotice" id="adda"class="btn btn-w-m btn-primary">Add</button>
<!--                <script>@if ($errors->any()== true){
            swal("Good job!", "Research Area is added!", "success");
        }
        @endif</script>-->
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
                    $(document).ready(function () {
                        $('.summernote').ckeditor();
                    });
</script>

<script>

//        $('.deleteForm').on('click', function(e) {  
//
//    var dataId = $(this).attr('data-id');
       //alert($("tr", $(this).closest("DataTables_Table_0")).index(this));   
//    
//});

//  deletes the selected research area
    function deleteresearcharea()
    {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Research Area!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false},
        function (isConfirm)
        {
            if (isConfirm)
            {
                document.getElementById("deleteForm").submit();
                swal("Deleted!", "Research Area is deleted!", "success");
            }
            else
            {
                swal("Cancelled", "Your research area is safe :)", "error");
            }
        });
        return x;
        confirm("Do you want to delete this Research Area");
    }

//    edit the selected research area
    function editresearcharea() {
            
        swal("KEEP CALM!", "it's \n COMING SOON!", "success");
        //swal("Updated!!", "Research Area is Updated", "success");      
    }

</script>

@endsection
