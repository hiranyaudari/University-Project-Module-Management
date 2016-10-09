@extends('masterpages.master_rpc')

@section('cssLinks')

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


@endsection

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Update Module</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection
{{--@section('subheader')--}}
    {{--<h5>Update Supervisor <small>Details.</small></h5>--}}
    {{--<div class="ibox-tools">--}}
        {{--<a class="collapse-link">--}}
            {{--<i class="fa fa-chevron-up"></i>--}}
        {{--</a>--}}

    {{--</div>--}}
{{--@endsection--}}

@section('content')


    <div class="ibox float-e-margins animated fadeInRight">

        <div class="row">
            <div id='result'></div>
            <form class="form-horizontal" method ="post" action="updateExternalSupervisorSubmit">
                <div class="form-group"><label class="col-sm-2 control-label">Search(ID)</label>


                    <div class="col-sm-10">
                        <select class="form-control m-b" name="searchdropdown" id="searchdropdown" 
                                onchange="selectModule(event)">
                            <option>Select One..</option>

                            <?php
                            #
                            foreach($categories1 as $category=>$value)
                            {
                                $category = htmlspecialchars($category);
                                echo '<option value="'. $category .'">'. $value .'</option>';
                            }
                            ?>

                        </select>


                    </div>

                </div>

                
                <div class="form-group"><label class="col-sm-2 control-label">Module ID</label>

                    <div class="col-sm-10"><input id="id" name="id" placeholder="Enter Module ID" 
                                                  type="text" disabled class="form-control required"/></div>
                </div>
                
                
                 <div class="form-group" id="nameDiv"><label class="col-sm-2 control-label">Module Name</label>

                    <div class="col-sm-10"><input id="name" name="name" placeholder="Enter Name" 
                                                  type="text" class="form-control required"/></div>
                </div>

                <div class="form-group" id="indexDiv"><label class="col-sm-2 control-label">Module Index</label>

                    <div class="col-sm-10"><input id="code" name="name" placeholder="Enter Index"
                                                  type="text" class="form-control required"/></div>
                </div>

                <div class="form-group" id="enrollDiv"><label class="col-sm-2 control-label">Enrollment key</label>

                    <div class="col-sm-10"><input id="ek" name="name" placeholder="Enter Enrollment key"
                                                  type="text" class="form-control required"/></div>
                </div>

                
                <div class="form-group" id="yearDiv"><label class="col-sm-2 control-label">Module year</label>

                    <div class="col-sm-10"><select class="form-control m-b" id="year" name="year" onchange="yearVal()">
                            <option>Select One..</option>
                            <option>3rd Year</option>
                            <option>4th Year</option>
                        </select>


                    </div>
                </div>
                    
                <div class="form-group" id="lecturerDiv"><label class="col-sm-2 control-label">Lecturer Incharge</label>


                      

                    <div class="col-sm-10">

                        <select class="form-control m-b" id="lecturerincharge" name="lecturerincharge" onchange="lecturerVal()">
                            <option>Select One..</option>
                            <?php
                            #
                            foreach($lecturers1 as $lec1=>$name)
                            {
                                $lec1 = htmlspecialchars($lec1);
                                echo '<option value="'. $name .'">'. $name .'</option>';
                            }
                            ?>
                        </select>


                    </div>
                     </div>

                
                <div class="form-group" id="descriptionDiv"><label class="col-sm-2 control-label">Module Description</label>

                    <div class="col-sm-10">
                        <input id="description" name="description" 
                               placeholder="Enter Description" type="text" class="form-control required"/></div>
                </div>

                    

                
             

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">

                        <button class="btn btn-primary" type="button" onclick="updateModule()">Save changes</button>
                        <button class="btn btn-primary" type="button" onclick="deleteModule()">Delete Module</button>                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection

@section('ValidationJavaScript')


    <script>
        function selectModule(evt) {

//            $('#designationDiv').removeClass().addClass('form-group has-success');
//            $('#fullNameDiv').removeClass().addClass('form-group has-success');
//            $('#emailDiv').removeClass().addClass('form-group has-success');
//            $('#teliv').removeClass().addClass('form-group has-success');
//            $('#speciality').removeClass().addClass('form-group has-success');
//            $('#uniDiv').removeClass().addClass('form-group has-success');

            var e = document.getElementById("searchdropdown");
            var searchID = e.options[e.selectedIndex].value;

            if (searchID == 0) {

                document.getElementById('id').value = "";
                document.getElementById('year').value = "Select One..";
                document.getElementById('lecturerincharge').value = "Select One..";
                document.getElementById('description').value = "";
                document.getElementById('name').value="";
                document.getElementById('code').value="";
                document.getElementById('ek').value="";
              

            }else{
            $.ajax({

                type: "GET",
                url: 'updateModuleSearch', 
                data: {"sid": searchID},
                dataType: 'json'
            }).done(function (data) {

                document.getElementById('name').value = searchID;
                document.getElementById('id').value = data['id'];
                document.getElementById('year').value = data['year'];
                document.getElementById('ek').value = data['ek'];
                document.getElementById('code').value = data['code'];
                document.getElementById("lecturerincharge").value = data['lecturerincharge'];
                document.getElementById("description").value = data['description'];
                


            }).fail(function () {
                alert('something Wrong');
            });
        }
        }
     /*   function deleteSup(){

            var userName = document.getElementById('userName').value;
            $.ajax({

                type: "POST",
                url: 'updateExternalSupervisorDelete', 
                data: {"sidnn": userName}

            }).done(function ($data) {
                alert($data);

            }).fail(function (){
                alert('something Wrong');
            });
        }*/
        function deleteModule(){
            
            swal({   title: "Are you sure?",
                        text: "Do You want to Delete Module ??",
                        type: "warning",   showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes,Delete it!",
                        closeOnConfirm: true },
                    function(){

                        var name = document.getElementById('name').value;
                        var id = document.getElementById('id').value;
                        var code=document.getElementById('code').value;
                        var ek=document.getElementById('ek').value;
                        var year = document.getElementById('year').value;
                        var lecturerincharge = document.getElementById('lecturerincharge').value;
                        var description = document.getElementById("description").value;
                        

                        if (year == 'Select One..' || lecturerincharge=='Select One..'|| description=="" ||name=="" || ek=="" || code=="")
                        {

                            if(year == 'Select One..'){
                                $('#yearDiv').addClass('has-error');
                            }
                            if(lecturerincharge=='Select One..'){
                                $('#lecturerDiv').addClass('has-error');

                            }if(description=="") {
                            $('#descriptionDiv').addClass('has-error');

                             }if(code=="") {
                            $('#codeDiv').addClass('has-error');

                             }if(ek == ""){
                            $('#enrollDiv').addClass('has-error');
                            
                            }if(name==""){
                                $('#nameDiv').addClass('has-error');
                            }
                            
                            swal("Error!", "Something wrong with your inputs !!", "error");
                        }
                        else{



                            $.ajax({

                                type: "GET",
                                url: 'updateModuleDelete',
                                data: {
                                    "name":name
                                },
                                dataType: 'json'
                                
                            })
                                    /*.done(function (data) {

                                
                                window.location.reload();
                            })*/
            swal("Deleted!", "Your selected Module has been Deleted.", "success");
                        $(document).ajaxStop(function(){ location.reload(true); });
                        }



                    }).fail( function() {
                        alert( 'something wrong' );
                    });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
        
        function updateModule() {



            swal({   title: "Are you sure?",
                        text: "Do You want to Update Module ??",
                        type: "warning",   showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Update it!",
                        closeOnConfirm: false },
                    function(){

                        var name = document.getElementById('name').value;
                        var id = document.getElementById('id').value;
                        var code = document.getElementById('code').value;
                        var ek = document.getElementById('ek').value;
                        var year = document.getElementById('year').value;
                        var lecturerincharge = document.getElementById('lecturerincharge').value;
                        var description = document.getElementById("description").value;
                        

                        if (year == 'Select One..' || lecturerincharge=='Select One..'|| description=="") {

                            if(year == 'Select One..'){
                                $('#yearDiv').addClass('has-error');
                            }
                            if(lecturerincharge=='Select One..'){
                                $('#lecturerDiv').addClass('has-error');

                            }if(description==""){
                                $('#descriptionDiv').addClass('has-error');

                            }if(code=="") {
                                $('#codeDiv').addClass('has-error');

                            }if(ek == ""){
                                $('#enrollDiv').addClass('has-error');
                            }if(name==""){
                                $('#nameDiv').addClass('has-error');
                            }                         
                            swal("Error!", "Something wrong with your inputs !!", "error");
                        }
                        else{



                            $.ajax({

                                type: "GET",
                                url: 'updateModuleUpdate',
                                data: {
                                    "name":name,
                                    "id": id,
                                    "code":code,
                                    "ek":ek,
                                    "year": year,
                                    "lecturerincharge": lecturerincharge,
                                    "description": description
                                    
                                    
                                },
                                dataType: 'json'
                            }).done(function (data) {

                                swal("Updated!", "Your selected Module details has been Updated.", "success");

                            }).fail(function (data) {
                                swal("Error!", "Something wrong.", "error");
                            });
                        }



                    }).fail( function() {
                        alert( 'something wrong' );
                    });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
        //js
        /* $(document).ready(function()
         {
         $('#searchdropdown').change(function() {
         var myurl = $(this).attr('href');
         $.ajax(
         {
         url: myurl,
         type: "get",
         datatype: "html",
         beforeSend: function()
         {
         $('#ajax-loading').show();
         }
         })
         .done(function(data)
         {
         $('#ajax-loading').hide();
         $("#comments").empty().html(data.html);
         })
         .fail(function(jqXHR, ajaxOptions, thrownError)
         {
         alert('No response from server');
         });
         return false;
         });
         });*/

    </script>
    <script>
        var ModalEffects = (function() 
        {



        @if(Session::has('delete_success'))
            window.onload  = function() {
                swal("Deleted!", "Your selected Module has been Deleted.", "success"); };
                $(window).resize();
        @endif       
                
        })();
    </script> 


    <!-- bootbox code -->
    <script src="{{ asset('public_assets/css/style.css') }}"></script>
    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);
                    form.submit();
                    // Submit form input

                    //alert(form.serialize());

                    bootbox.alert("Hello world!", function() {

                    });
                }
            }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
        });


        function validate(evt) {

            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {updateSupindex
                theEvent.returnValue = false;

                if(theEvent.preventDefault) {
                    $('#teliv').addClass('has-error');
                    theEvent.preventDefault();
                }
            }else{
                $('#teliv').removeClass().addClass('form-group has-success');
            }

            $("#tel").attr('maxlength','10');

        }
      
        
      
        function yearVal(){
            var year = document.getElementById("year").value;
            if (year == 'Select One..') {

                $('#yearDiv').addClass('has-error');

            }else{
                $('#yearDiv').removeClass().addClass('form-group has-success');
            }
        }
        
        function lecturerVal(){
            var lec = document.getElementById("lecturerincharge").value;
            if (lec == 'Select One..') {

                $('#lecturerDiv').addClass('has-error');

            }else{
                $('#lecturerDiv').removeClass().addClass('form-group has-success');
            }
        }

       
    </script>


@endsection
