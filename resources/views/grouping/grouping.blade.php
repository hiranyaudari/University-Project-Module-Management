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
            <h2>Form group</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection


@section('content')



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">

            <br>
            <img alt="image" class="img-circle" src="img/leaderImage.png" height="70px" width="70px"/>

                <b>Group Leader : </b> {{$leaderName}}
            &nbsp;&nbsp;&nbsp;&nbsp;

            <button class="btn btn-primary" id="invteBtn" type="button"
                    onclick="inviteMembers()" disabled>Invite All</button>
            <button class="btn btn-warning" id="rstBtn" onclick="clearMembers()" disabled>Reset</button>



            <div id="maincontainer">

                <div id="contentwrapper">
                    <div id="maincolumn">
                        <div class="text" style="float: left">
                            <hr/>

                            <form enctype="multipart/form-data" method="get" id="frmMain" name="frmMain">
                            @foreach ($students as $key=>$stu)
                                <label>
                                    <input class="single-checkbox" type="checkbox" id="student_names[]"
                                           name="student_names[]" value= "{{$stu->name}}"
                                           onClick="addToList(this, 'txt1');" />
                                    <span><b>{{$stu->name}}</b> - <i>{{$stu->email}}</i> </span>

                                </label><br/>
                            @endforeach

                            <br clear="both" />
                            </form>


                        </div>
                    </div>  <div class="col-lg-10" style="float: right">
                        <textarea  name="txt1" id="txt1" style="width:370px;height:300px;font-size:20px; margin: -255px 21px -26px 453px; resize: none;" rows="3" readonly> </textarea>

                    </div>

                    </div>

            </div>

        </div>

    </div>



    <link rel="stylesheet" type="text/css" href="http://skfox.com/jqExamples/jq14_jqui172_find_bug/jq132/css/ui-lightness/jquery-ui-1.7.2.custom.css" />
    <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

    <script>

        /*function for resetting*/
           function clearMembers() {
            var atLeastOneIsChecked = $('input[name="student_names[]"]:checked').length > 0;
            if(atLeastOneIsChecked==true){
                swal({
                        title: "Are you sure?",
                        text: "Do You want to clear all selected candidates ??",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, clear it!",
                        closeOnConfirm: false},

                    function (isConfirm) {

                        if (isConfirm)
                        {
                            document.getElementById("invteBtn").disabled = true;
                            document.getElementById("rstBtn").disabled = true;
                            $('input:checkbox').removeAttr('checked');
                            $("#txt1").val('');

                            swal("Success!", "Inviting selected members was cancelled.", "success");

                        }
                        else
                        {
                            swal("Cancelled", "Your selections are safe :)", "error");
                        };

                    }
                )


                ;}

        }

        /*inviting members*/
        function inviteMembers() {
            swal({
                        title: "Are you sure?",
                        text: "Do You want to invite these selected candidates ??",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, invite them!",
                        closeOnConfirm: false},

                    function (isConfirm) {

                        if (isConfirm)
                        {
                            document.getElementById("invteBtn").disabled = true;
                            document.getElementById("rstBtn").disabled = true;
                            
                            sendinvitation();
                            $('input:checkbox').removeAttr('checked');
                            $("#txt1").val('');
                            
                            swal("Success!", "Invitations were sent!", "success");

                        }
                        else
                        {
                            swal("Failed", "Sending invitations was failed, try again.", "error");
                        };

                    }
            )
        }
        
        function sendinvitation()
        {
            
            var names = $('#txt1').val().split(/\n/);
                for (i = 0; i < names.length; i++)
                { 
                    
                        alert(names[i]);
                        $.ajax({
                            type: "POST",
                            url: "/GroupController/storetoNotifiTable",
                            contentType: 'application/json',
                            data: JSON.stringify({function_param: names})
                        });

                }                  
        }

        /*adding names to text area*/
        function addToList(checkObj, outputObjID)
        {
            var count = 0;
            var checkGroup = checkObj.form[checkObj.name];
            var checkGroupLen = checkGroup.length;
            var valueList = new Array();
            for (var i=0; i<checkGroupLen; i++)
            {
                if (checkGroup[i].checked)
                {
                    valueList[valueList.length] = checkGroup[i].value;
                }
            }
            document.getElementById(outputObjID).value = valueList.join('\r\n');


            var isTxtAreaFilled = $.trim( $('#txt1').val() );
            if(isTxtAreaFilled) {

                document.getElementById("invteBtn").disabled = false;
                document.getElementById("rstBtn").disabled = false;

            }else{

                document.getElementById("invteBtn").disabled = true;
                document.getElementById("rstBtn").disabled = true;
            }

            return;

        }


        /*limiting the number of the invitees*/
        jQuery(function(){
            var max = 5;
            var checkboxes = $('input[type="checkbox"]');

            checkboxes.change(function(){
                var current = checkboxes.filter(':checked').length;
                checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
                if(current >= max)
                    swal("This is it", "You have selected the maximum number of invitees", "warning");
            });
        });



    </script>
@endsection