@extends('masterpages.master_rpc')
@section('title')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Final Evaluation Form</h2>
        <ol class="breadcrumb">

        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

@endsection
@section('content')

@if (count($errors) > 0)
<div class=" alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::has('success'))
<div class="alert  alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div class="ibox-content" style="height: 220px; margin-bottom: 10px">
    <div class=ibox-content" style="width: 400px; float: left">
<!--                   <select name="filter_sup" style="margin-right: 5px; width: 200px; height: 30px">
                        <option selected disabled>--Supervisors--</option>
                            @foreach ($supervisaornames as $key=>$supvisor)
                            <option value={{$supvisor->id}}>{{$supvisor->name}}</option>
                            @endforeach
                           </select>-->

        <select name="filter_sup" id="stuIDs" onchange="selectStudentDetails()" style="margin-right: 5px; margin-left: 13px; width: 200px; height: 30px">
        <option selected disabled>--Student ID--</option>
            @foreach ($students as $key=>$stu)
                @foreach ($studentid as $key=>$sid)
                    @if($stu->studentId == $sid->id)
                        <option value="{{$stu->studentId}}">{{$sid->regId}}</option>
                    @endif
                @endforeach
            @endforeach
    </select>
   
<!--                                    <span><b></b> - <i>{{$stu->title}}</i> </span>-->
    </div> 
    
    <div class="form-group" style="float: right">
        <label class="col-sm-2 control-label" style="width: 150px">Student Name</label>
                <div class="col-sm-10">
                    <input id="stuname" name="userName" placeholder="Student Name" type="text" disabled class="form-control required"/>
                </div>
    </div>
    
    <div class="form-group" style="margin-top: 50px; width: 400px">
        <label class="col-sm-2 control-label" style="width: 300px">Project Title</label>
                <div class="col-sm-10">
                    <input id="protitle" name="userName" placeholder="Project Title" type="text" style="width: 500px" disabled class="form-control required"/>
                </div>
    </div>
    
    <div class="form-group" style="margin-top: 120px">
        <label class="col-sm-2 control-label" style="width: 300px">Project ID</label>
                <div class="col-sm-10">
                    <input id="proid" name="userName" placeholder="Project ID" type="text" style="width: 500px" disabled class="form-control required"/>
                </div>
    </div>
    
</div>

<div class="ibox-content" style="font-size: 14">
    <form method="post">

        <table class="table table-bordered">
            <tbody>
                
                <tr>
                    <td style="width: 1000px"><strong>Proposal Submission</strong> (10%)
                        <br><p style="padding-top: 10px">&emsp; Presentation (5%) 
                        <br>&emsp; Report (5%)
                        
                        </p>
                    
                    </td>
                        
                    <td style="width: 200px">
                        <input type="text" id="finalmarks" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksforproposal"  > Marks <br>
                        <input type="text"  style="width: 40px; margin-top: 2px" name="ProjectproposalPresentation" class="marksforproposal"  > Marks</p></td>
               </tr>
               
               <tr>
                    <td style="width: 1000px"><strong>SRS Submission</strong> (10%)
                        <br><p style="padding-top: 10px">&emsp; Report (10%)
                        </p></td>

                    <td style="width: 200px">
                        <input type="text" id="finalmarksforsrs" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksforsrs"  > Marks</p></td>
               </tr>
               
               <tr>
                    <td style="width: 1000px"><strong>Prototype</strong> (15%)
                        <br><p style="padding-top: 10px">&emsp; Presentation (15%) 
                        </p></td>

                    <td style="width: 200px">
                        <input type="text" id="finalmarksforprotype" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksforprototype"  > Marks</p></td>
               </tr>
               
               <tr>
                    <td style="width: 1000px"><strong>Mid Review</strong> (20%)
                        <br><p style="padding-top: 10px">&emsp; Presentation (10%) 
                        <br>&emsp; Report (10%)</p></td>

                    <td style="width: 200px">
                        <input type="text" id="finalmarksformid" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksformidreview"  > Marks <br>
                        <input type="text"  style="width: 40px; margin-top: 2px" name="ProjectproposalPresentation" class="marksformidreview"> marks</p></td>
               </tr>
               
               <tr>
                    <td style="width: 1000px"><strong>Final Presentation</strong> (15%)
                        <br><p style="padding-top: 10px">&emsp; Presentation (10%) 
                        <br>&emsp; Report (5%)</p></td>

                    <td style="width: 200px">
                        <input type="text" id="finalmarksforpresentation" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksforfinalpresentation"  > Marks <br>
                        <input type="text"  style="width: 40px; margin-top: 2px" name="ProjectproposalPresentation" class="marksforfinalpresentationsecond"  > Marks</p></td>
               </tr>
               
               <tr>
                    <td style="width: 1000px"><strong>Viva</strong> (15%)
                        <br><p style="padding-top: 10px">&emsp; Viva (15%) </p></td>

                    <td style="width: 200px">
                        <input type="text" id="finalmarksforviva" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksforviva"  > Marks <br></p></td>
               </tr>
               
               <tr>
                    <td style="width: 1000px"><strong>Other Assessment</strong> (15%)
                        <br><p style="padding-top: 11px">&emsp; Research Book (5%)
                        <br>&emsp; Research Paper (5%)
                        <br>&emsp; Website (5%)</p></td>

                    <td style="width: 200px">
                        <input type="text" id="finalmarksforothers" placeholder="0" disabled style="width: 80px">
                        <p><input type="text"  style="width: 40px; margin-top: 5px" name="ProjectproposalPresentation" class="marksforother"  > Marks <br>
                        <input type="text"  style="width: 40px; margin-top: 2px" name="ProjectproposalPresentation" class="marksforother"  > Marks <br>
                        <input type="text"  style="width: 40px; margin-top: 2px" name="ProjectproposalPresentation" class="marksforother"  > Marks</p></td>
               </tr>


<!--                <tr>
                    <td><strong>Scientific Know How</strong></td>

                    <td><p><input type="text"  style="width: 40px" name="scientificKnowHow" class="marks" > Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                </tr>

                <tr>
                    <td><strong>Logic</strong><br>
                        Justification (Use of appropriate technology) ,Validity<br>
                        Viability of the project<br></td>

                    <td><p><input type="text" style="width: 40px" name="logic"  class="marks" > Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                </tr>

                <tr>
                    <td ><strong>Presentation </strong><br>Performance at the Q/A session<br>
                        Document<br>
                        Oral presentation
                    </td>

                    <td><p><input type="text"  style="width: 40px" name="presentation" class="marks" > Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                </tr>


                <tr>
                    <td ><strong>Work Process </strong><br>
                        In sufficient detail and realistic<br></td>

                    <td><p><input type="text"  style="width: 40px" name="workProcess" class="marks" > Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                </tr>-->

            </tbody>
        </table>
        <div align="right" style="margin-left: 620px"> <input type="button"style="float: left" value="Get Total" class="save_btn btn btn-primary btn-xl m-l-sm" onclick="getTotal()"></div>
        <div align="right" style="padding-right: 42px">
            
            <input type="text"  placeholder="Total" style="width: 50px; height: 35px" disabled> / 
            <input type="text" name="total" id="total" style="width: 50px; ; height: 35px" readonly placeholder="100"> <b>Marks</b></div>
<br>
        <div><textarea name="comment" disabled rows="4" cols="80" placeholder="Comment"></textarea></div><br>
        <div><select name="status" disabled><option> Status </option></select></div>
        <div align="right" style="padding-right: 180px"> <input type='submit'  class="save_btn btn btn-primary btn-xl m-l-sm" name='editThesisFormMarks' align="right">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"></div>
    </form>
</div>
</div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

//$(document).ready(function () {
//    $('.finalmarks').valueOf(function () {
//        var total = 0;
//        $(".finalmarks").each(function () {
//            var marks = parseInt($(this).val());
//            total += !isNaN(marks) ? marks : 0;
//
//        });
//        $('#total').val(total);
//    });
//});



$(document).ready(function () {
    $('.marksforproposal').keyup(function () {
        var total = 0;
        $(".marksforproposal").each(function () {
            var marks = (parseInt($(this).val())/100)*5;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarks').val(total);
    });
});

$(document).ready(function () {
    $('.marksforsrs').keyup(function () {
        var total = 0;
        $(".marksforsrs").each(function () {
            var marks = (parseInt($(this).val())/100)*10;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforsrs').val(total);
    });
});

$(document).ready(function () {
    $('.marksforprototype').keyup(function () {
        var total = 0;
        $(".marksforprototype").each(function () {
            var marks = (parseInt($(this).val())/100)*15;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforprotype').val(total);
    });
});

$(document).ready(function () {
    $('.marksformidreview').keyup(function () {
        var total = 0;
        $(".marksformidreview").each(function () {
            var marks = (parseInt($(this).val())/100)*10;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksformid').val(total);
    });
});
//////////////////////////////10%//////////////////////////////////////
$(document).ready(function () {
    $('.marksforfinalpresentation').keyup(function () {
        var total = 0;
        $(".marksforfinalpresentation").each(function () {
            var marks = (parseInt($(this).val())/100)*10;
            total += !isNaN(marks) ? marks : 0;
             
        });    
        //alert($('#finalmarksforpresentation').val()) ;
        $('#finalmarksforpresentation').val(total);
    });        
});
//////////////////////////////5%//////////////////////////////////////
$(document).ready(function () {
    $('.marksforfinalpresentationsecond').keyup(function () {
        var total = 0;
        $(".marksforfinalpresentationsecond").each(function () {
            var marks = (parseInt($(this).val())/100)*5;
            total += !isNaN(marks) ? marks : 0;
             
        });    
        var temp2 = (parseInt($('#finalmarksforpresentation').val()));
        //alert(temp2);
        $('#finalmarksforpresentation').val(temp2 + total);
    });        
});
////////////////////////////////////////////////////////////////////
$(document).ready(function () {
    $('.marksforviva').keyup(function () {
        var total = 0;
        $(".marksforviva").each(function () {
            var marks = (parseInt($(this).val())/100)*15;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforviva').val(total);
    });
});

$(document).ready(function () {
    $('.marksforother').keyup(function () {
        var total = 0;
        $(".marksforother").each(function () {
            var marks = (parseInt($(this).val())/100)*5;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforothers').val(total);
    });
});

function getTotal()
{//add trnry operation, get 0 if null
    var tot = parseFloat(document.getElementById("finalmarks").value) +
              parseFloat(document.getElementById("finalmarksforsrs").value);

    $('#total').val((Math.round(tot * 10) / 10));
}

function selectStudentDetails()
{
    var e = document.getElementById("stuIDs");
    var searchID = e.options[e.selectedIndex].value;

        $.ajax({
        type: "GET",
        url: '/searchstudent',
        data: {"sid": searchID},
        dataType: 'json'
        
        }).done(function (data) {

            document.getElementById('stuname').value = data['sname'];
            document.getElementById('protitle').value = data['title'];
            document.getElementById('proid').value = data['pid'];

        }).fail(function (data) {
            swal("Failed", "Something Wrong! :)", "error");
        });
}

</script>