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
    <link href="{{ asset('public_assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Form groups</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

{{--@section('subheader')--}}
{{--<h5>View Specific Project Details</h5>--}}
{{--@endsection--}}

@section('content')



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <br>
            <img alt="image" class="img-circle" src="img/leaderImage.png" height="70px" width="70px"/>
                <b>Group Leader : </b> {{ Session::get('userName')[0] }}
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary" type="button" onclick="inviteMembers()">Invite All</button>
            <button class="btn btn-primary" type="reset" onclick="clearMembers()">Reset</button>


            <div id="maincontainer">


                <div id="contentwrapper">
                    <div id="maincolumn">
                        <div class="text">
                            <hr/>
                            <div class="listBlock2" style="float: left; padding-right: 20px; display:inline; height:360px">
                                <h2>Inviting candidates</h2>
                                <div id="sortable2" class='droptrue' style="display:inline; height:360px">
                                    <div class="ui-state-default" id="article_1" draggable="false"><header draggable="false">Leader</header></div>
                                </div>
                            </div>

                            <div class="listBlock1" style="float: left">
                                <h2>Available students</h2>

                                <div id="sortable1" class='droptrue' >
                                    @foreach($students as $key=>$stu)

                                    <div class="ui-state-default" id="article_1"><h3>{{ $stu->name }}</h3> - {{ $stu->email }}</div>
                                    @endforeach

                                </div>
                            </div>
                            <br clear="both" />
                            <!--<p>Which articles, in which order?: <br /> <input type="text" id="postOrder" name="postOrder" value="" size="30"><br /> *Normally this field would be hidden</p>-->
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
    <style type="text/css">

        .listBlock2 {
            padding: 50px;
            width: 500px;
            height: 500px;
        }
        .listBlock1 {
            padding: 50px;
            width: 350px;
            height: auto;
        }
        #sortable2 div {
            color: #fff;

            padding: 5px;
            background: #18a689;

            -webkit-border-top-left-radius: 0px;
            -moz-border-radius-topleft: 0px;
            -ms-border-radius-topleft: 0px;
            border-top-left-radius: 0px;
            -webkit-border-top-right-radius: 0px;
            -ms-border-top-right-radius: 0px;
            -moz-border-radius-topright: 0px;
            border-top-right-radius: 0px;
        }
        #sortable1 div{
            color: #fff;
            width: 200px;
            padding: 5px;
            background: #18a689;

            -webkit-border-top-left-radius: 0px;
            -moz-border-radius-topleft: 0px;
            -ms-border-radius-topleft: 0px;
            border-top-left-radius: 0px;
            -webkit-border-top-right-radius: 0px;
            -ms-border-top-right-radius: 0px;
            -moz-border-radius-topright: 0px;
            border-top-right-radius: 0px;
        }

        #sortable2 {


            height: 500px;
            width: 200px;
            float: left;
            padding: 3px;
            background-color: #ccc;
            margin-right: 5px;
            -webkit-border-radius: 0px;
            -ms-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;


            text-align: center;
            cursor: move;
        }
        #sortable1{


            height: auto;
            width: 200px;
            float: left;
            padding: 3px;
            background-color: #ccc;
            margin-right: 5px;
            -webkit-border-radius: 0px;
            -ms-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;


            text-align: center;
            cursor: move;
        }

    </style>
    <style>
        /* Prevent the text contents of draggable elements from being selectable.
        [draggable] {
          -moz-user-select: none;
          -khtml-user-select: none;
          -webkit-user-select: none;
          user-select: none;
           Required to make elements draggable in old WebKit
          -khtml-user-drag: element;
          -webkit-user-drag: element;
        }
        .column {
          height: 150px;
          width: 150px;
          float: left;
          border: 2px solid #666666;
          background-color: #ccc;
          margin-right: 5px;
          -webkit-border-radius: 10px;
          -ms-border-radius: 10px;
          -moz-border-radius: 10px;
          border-radius: 10px;
          -webkit-box-shadow: inset 0 0 3px #000;
          -ms-box-shadow: inset 0 0 3px #000;
          box-shadow: inset 0 0 3px #000;
          text-align: center;
          cursor: move;
        }
        .column header {
          color: #fff;
          text-shadow: #000 0 1px;
          box-shadow: 5px;
          padding: 5px;
          background: -moz-linear-gradient(left center, rgb(0,0,0), rgb(79,79,79), rgb(21,21,21));
          background: -webkit-gradient(linear, left top, right top,
                                       color-stop(0, rgb(0,0,0)),
                                       color-stop(0.50, rgb(79,79,79)),
                                       color-stop(1, rgb(21,21,21)));
          background: -webkit-linear-gradient(left center, rgb(0,0,0), rgb(79,79,79), rgb(21,21,21));
          background: -ms-linear-gradient(left center, rgb(0,0,0), rgb(79,79,79), rgb(21,21,21));
          border-bottom: 1px solid #ddd;
          -webkit-border-top-left-radius: 10px;
          -moz-border-radius-topleft: 10px;
          -ms-border-radius-topleft: 10px;
          border-top-left-radius: 10px;
          -webkit-border-top-right-radius: 10px;
          -ms-border-top-right-radius: 10px;
          -moz-border-radius-topright: 10px;
          border-top-right-radius: 10px;
        }

        .column.over {
          border: 2px dashed #000;
        }*/
    </style>

    <link rel="stylesheet" type="text/css" href="http://skfox.com/jqExamples/jq14_jqui172_find_bug/jq132/css/ui-lightness/jquery-ui-1.7.2.custom.css" />
    <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <script language="JavaScript" type="text/javascript">

        $(function() {
            $("div.droptrue").sortable({
                connectWith: 'div',
                opacity: 0.6,
                update : updatePostOrder
            });

            $("#sortable1, #sortable2").disableSelection();
            $("#sortable1, #sortable2").css('minHeight',$("#sortable1").height()+"px");
            updatePostOrder();
        });
        var cnt = 0;
        function updatePostOrder() {
            var arr = [];
            if(cnt <= 8)
                {//alert(cnt);
                cnt++;
                $("#sortable2 div").each(function(){
                    arr.push($(this).attr('id'));
                });
                $('#postOrder').val(arr.join(','));
            }
            else
            {
             swal("කලබලෙනේ !", "ඔය ඇති රෙද්ද ..!", "error");
            }            
        }

    </script>

    <script>
        function clearMembers() {

            swal({
                        title: "Are you sure?",
                        text: "Do You want to clear all selected candidates ??",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, clear it!",
                        closeOnConfirm: false
                    },
                    function () {

                        $.ajax({



                        });
                    }
            );
        }

        function clearMembers() {

            swal({
                        title: "Are you sure?",
                        text: "Do You want to clear all selected candidates ??",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, clear it!",
                        closeOnConfirm: false
                    },
                    function () {

                        $.ajax({



                        });
                    }
            );
        }
        //function handleDragStart(e) {
        //  //this.style.opacity = '0.4';  // this / e.target is the source node.
        //}
        //
        //var cols = document.querySelectorAll('#columns .column');
        //[].forEach.call(cols, function(col) {
        //  col.addEventListener('dragstart', handleDragStart, false);
        //});
        //////////////////////////////////////////////////
        //function handleDragStart(e) {
        //  //this.style.opacity = '0.4';  // this / e.target is the source node.
        //}
        //
        //function handleDragOver(e) {
        //  if (e.preventDefault) {
        //    e.preventDefault(); // Necessary. Allows us to drop.
        //  }
        //
        //  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.
        //
        //  return false;
        //}
        //
        //function handleDragEnter(e) {
        //  // this / e.target is the current hover target.
        //  this.classList.add('over');
        //}
        //
        //function handleDragLeave(e) {
        //  this.classList.remove('over');  // this / e.target is previous target element.
        //}
        //
        //var cols = document.querySelectorAll('#columns .column');
        //[].forEach.call(cols, function(col) {
        //  col.addEventListener('dragstart', handleDragStart, false);
        //  col.addEventListener('dragenter', handleDragEnter, false);
        //  col.addEventListener('dragover', handleDragOver, false);
        //  col.addEventListener('dragleave', handleDragLeave, false);
        //});
        /////////////////////////////////////////////////
        //
        //function handleDrop(e) {
        //  // this / e.target is current target element.
        //
        //  if (e.stopPropagation) {
        //    e.stopPropagation(); // stops the browser from redirecting.
        //  }
        //
        //  // See the section on the DataTransfer object.
        //
        //  return false;
        //}
        //
        //function handleDragEnd(e) {
        //  // this/e.target is the source node.
        //
        //  [].forEach.call(cols, function (col) {
        //    col.classList.remove('over');
        //  });
        //}
        //
        //var cols = document.querySelectorAll('#columns .column');
        //[].forEach.call(cols, function(col) {
        //  col.addEventListener('dragstart', handleDragStart, false);
        //  col.addEventListener('dragenter', handleDragEnter, false)
        //  col.addEventListener('dragover', handleDragOver, false);
        //  col.addEventListener('dragleave', handleDragLeave, false);
        //  col.addEventListener('drop', handleDrop, false);
        //  col.addEventListener('dragend', handleDragEnd, false);
        //});
        /////////////////////////////////////////////
        //
        //var dragSrcEl = null;
        //
        //function handleDragStart(e) {
        //  // Target (this) element is the source node.
        //  //this.style.opacity = '0.4';
        //
        //  dragSrcEl = this;
        //
        //  e.dataTransfer.effectAllowed = 'move';
        //  e.dataTransfer.setData('text/html', this.innerHTML);
        //}
        /////////////////////////////////////////////////
        //
        //function handleDrop(e) {
        //  // this/e.target is current target element.
        //
        //  if (e.stopPropagation) {
        //    e.stopPropagation(); // Stops some browsers from redirecting.
        //  }
        //
        //  // Don't do anything if dropping the same column we're dragging.
        //  if (dragSrcEl != this) {
        //    // Set the source column's HTML to the HTML of the column we dropped on.
        //    dragSrcEl.innerHTML = this.innerHTML;
        //    this.innerHTML = e.dataTransfer.getData('text/html');
        //  }
        //
        //  return false;
        //}
    </script>
@endsection