@extends('masterpages.master_student')

@section('cssLinks')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">

<link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('public_assets/css/bootstrap-formhelpers.css') }}" rel="stylesheet">
<link href="{{ asset('public_assets/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">

@endsection

@section('title')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tasks Schedule</h2>
        <ol class="breadcrumb">

        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@endsection

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

<div class="col-sm-12">
<div class="row">
	
	<div class="col-sm-12">

            
            <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Tasks log</h5>
            <div class="ibox-tools">

            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">

                <table style="font-size: 13px" class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">

                    <thead>
                        <tr role="row">
<!--                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">Select</th>-->
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 100px;" aria-sort="ascending">Task No</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 253px;">Task</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 550px;">Description</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 250px;">Plan to Finish</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 300px;">Task State</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 300px;">Start Date</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 300px;">End Date</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 200px;">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Alltasks as $key=>$taskd)
                        <tr>
                            <td> {{ $taskd->id }} </td>
                            <td> {{ $taskd->task }} </td>
                            <td> <?php echo wordwrap($taskd->description, 70, "\n", TRUE) ?></td>
                            <td> {{ $taskd->plantofinish }} </td>
                            <td> {{ $taskd->state }} </td>
                            <td> {{ $taskd->sdate }} </td>
                            <td> {{ $taskd->edate }} </td>
                            <td> {{ $taskd->hours }} </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'id' => 'deleteForm', 'action' => ['diaryController@destroy', $taskd->id ]]) !!}
                    <center>
                        <!--                        remove button-->
                        {!! Form::button( '<i class="fa fa-trash fa-lg" title="Delete"></i>',
                        ['onclick' => 'deleteresearcharea()',
                        'class' => 'delete text-danger deleteForm',
                        'id' => 'btnDeleteProduct',
                        'data-id' => $taskd->id ] ) !!}
                        <!--                        end remove button-->

                        
                        <!--                        update button-->
                        <!--<a onclick = "deletePresentationPanel()" id=""class="btn btn-sm btn-danger">Delete</a>-->
                        {!! Form::button( '<i class="fa fa-edit fa-lg" style="color: blue"title="Edit"></i>',
                        ['onclick' => 'editresearcharea()',
                        'class' => 'delete text-danger editeForm',
                        'id' => 'btnediteProduct',
                        'data-id' => $taskd->id ] ) !!}
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
                            <th rowspan="1" colspan="1">Task No</th>
                            <th rowspan="1" colspan="1">Task</th>
                            <th rowspan="1" colspan="1">Description</th>
                            <th rowspan="1" colspan="1">Plan to Finish</th>
                            <th rowspan="1" colspan="1">Task State</th>
                            <th rowspan="1" colspan="1">Start Date</th>
                            <th rowspan="1" colspan="1">End Date</th>
                            <th rowspan="1" colspan="1">Hours</th>                            
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
            
            
	</div>
</div>
	
    <div class="row" style="padding-left: 14px">
    <div class="col-lg-6">
        <form role="form">
            
            <div class="form-group"> 
                <input name="entertask" class="form-control" placeholder="Enter task">
            </div>
            
            <div class="form-group">
			<textarea name="desc" class="form-control" rows="3" placeholder="Enter description"></textarea>
            </div>
            
			<div class="form-group"> 
                <input name="plantof" class="form-control" placeholder="Plan to finish">
            </div>
			
            <div class="form-group">
                <label>Task State</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Not Start
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Start
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Finish
                    </label>
                </div>
				
				<div class="form-group"> 
                <input name="start" class="form-control" placeholder="Start Date" disabled>
				</div>
				
				<div class="form-group"> 
                <input name="end" class="form-control" placeholder="End Date" disabled>
				</div>
				
				<div class="form-group"> 
                <input name="spenthours" class="form-control" placeholder="Spent Hours">
				</div>
				
            </div>
            
            <div class="summernote"></div>

        <div class="form-group">
            <div class="col-md-4">
                <button onclick="added()" name="addNotice" id="adda"class="btn btn-w-m btn-primary">Submit</button>
<!--                <script>@if ($errors->any()== true){
            swal("Good job!", "Research Area is added!", "success");
        }
@endif</script>-->
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                
            </div>
        </div>
            <input type="reset" name="Submit2" value="Reset" class="btn btn-w-m btn-primary">
            
        </form>
    </div>
	</div>
<br>
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