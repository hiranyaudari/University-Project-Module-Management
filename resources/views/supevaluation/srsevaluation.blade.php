@extends('......masterpages.master_panel_member')
@section('title')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>SRS Submission</h2>
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

<div class="ibox-content">
    <div class=ibox-content">
        <h2>Supervisor and Student details goes HERE</h2>            
    </div>
</div>

<div class="ibox-content" style="font-size: 14">
    <form method="post">
        <table class="table table-bordered">
            <tbody style="font-size: 15">                
                <tr>
                    <td style="width: 1000px"><strong>SRS Document Submission</strong> (10%)</td>
                </tr> 
                <tr>
                    <td style="width: 1000px"></td>
                    <td style="width: 1000px">LO 1 * (10%)</td>
                    <td style="width: 1000px">LO 2 * (30%)</td>
                    <td style="width: 1000px">LO 3 * (50%)</td>
                    <td style="width: 1000px">LO 4 * (10%)</td>
                    <td style="width: 1000px">LO 5 * (0%)</td>
                </tr>
                <tr>
                    <td style="width: 1000px"><strong>Comment :</strong></td>
                    <td ><input type="text" style="width: 120px" id="tex1" onblur="getValue(this)" class="hh" readonly></td>
                    <td ><input type="text" style="width: 120px" id="tex2" onblur="getValue(this)" class="hh"></td>
                    <td ><input type="text" style="width: 120px" id="tex3" onblur="getValue(this)" class="hh"></td>
                    <td ><input type="text" style="width: 120px" id="tex4" onblur="getValue(this)" class="hh"></td>
                    <td ><input type="text" style="width: 120px" id="tex5" onblur="getValue(this)" class="hh"></td>
                </tr> 
                <tr>
                    <td style="width: 1000px"><strong>Marks : (100%)</strong></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo1"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo2"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo3"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo4"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo5"></td>
                </tr> 
                <tr>
                    <td style="width: 1000px"><strong>Marks : </strong></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo1" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo2" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo3" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo4" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo5" disabled style="width: 55px"></td>
                </tr> 
            </tbody>
        </table>
        <p style="alignment-adjust: central; font-size: medium"><a href="{{ asset('public_assets/img/marking_guids/CDAP Assessment Instruments-SRS Document.pdf')}}" 
                                         target="_blank"><strong>Assessment Instruments</strong></a></p>        
        <div class="ibox-content"></div>
        
<!--        <table class="table table-bordered">
            <tbody style="font-size: 15">                
                <tr>
                    <td style="width: 1000px"><strong>Proposal Report</strong> (5%)</td>
                </tr> 
                <tr>
                    <td style="width: 1000px"></td>
                    <td style="width: 1000px">LO 1 * (35%)</td>
                    <td style="width: 1000px">LO 2 * (25%)</td>
                    <td style="width: 1000px">LO 3 * (5%)</td>
                    <td style="width: 1000px">LO 4 * (15%)</td>
                    <td style="width: 1000px">LO 5 * (20%)</td>
                </tr>
                <tr>
                    <td style="width: 1000px"><strong>Comment :</strong></td>
                    <td ><input type="text" style="width: 120px" id="tex6" onblur="getValue(this)" class="hh" readonly></td>
                    <td ><input type="text" style="width: 120px" id="tex7" onblur="getValue(this)" class="hh"></td>
                    <td ><input type="text" style="width: 120px" id="tex8" onblur="getValue(this)" class="hh"></td>
                    <td ><input type="text" style="width: 120px" id="tex9" onblur="getValue(this)" class="hh"></td>
                    <td ><input type="text" style="width: 120px" id="tex10" onblur="getValue(this)" class="hh"></td>
                </tr> 
                <tr>
                    <td style="width: 1000px"><strong>Marks : (100%)</strong></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo6"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo7"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo8"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo9"></td>
                    <td style="width: 1000px"><input type="text" style="width: 55px" name="propPresentation" class="lo10"></td>
                </tr> 
                <tr>
                    <td style="width: 1000px"><strong>Marks : </strong></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo6" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo7" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo8" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo9" disabled style="width: 55px"></td>
                    <td style="width: 1000px"><input type="text" id="finalmarksforlo10" disabled style="width: 55px"></td>
                </tr> 
            </tbody>
        </table>
        
        <div class="ibox-content"></div>-->
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
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">


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

var objid;
function getValue(obj)
    {
        objid = obj.id;
    }  

$(document).ready(function () {
    $('.hh').click(function () {
        swal({
           title: "KEEP CALM!",
           text: "Write something interesting:",
           type: "input",
           showCancelButton: true,
           closeOnConfirm: false,
           animation: "slide-from-top",
           inputPlaceholder: "Write something" },
       function(inputValue)
       {
           if (inputValue === false)
               return false;
           if (inputValue === "")
           {    
               swal.showInputError("You need to write something!");
               return false
           }  
         swal("Nice!", "You wrote: " + inputValue, "success");
//           swal({
//               title: 'Nice!',
//               text: 'You wrote: ' + inputValue,
//               timer: 1000
//           });
           document.getElementById(objid).value = inputValue;
       }); 
               
    });
});

//////////////// table 1/////////
$(document).ready(function () {
    $('.lo1').keyup(function () {
        var total = 0;
        $(".lo1").each(function () {
            var marks = (parseInt($(this).val())/100)*10;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforlo1').val(total);
    });
});

$(document).ready(function () {
    $('.lo2').keyup(function () {
        var total = 0;
        $(".lo2").each(function () {
            var marks = (parseInt($(this).val())/100)*30;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforlo2').val(total);
    });
});

$(document).ready(function () {
    $('.lo3').keyup(function () {
        var total = 0;
        $(".lo3").each(function () {
            var marks = (parseInt($(this).val())/100)*50;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforlo3').val(total);
    });
});

$(document).ready(function () {
    $('.lo4').keyup(function () {
        var total = 0;
        $(".lo4").each(function () {
            var marks = (parseInt($(this).val())/100)*10;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforlo4').val(total);
    });
});

$(document).ready(function () {
    $('.lo5').keyup(function () {
        var total = 0;
        $(".lo5").each(function () {
            var marks = (parseInt($(this).val())/100)*0;
            total += !isNaN(marks) ? marks : 0;

        });
        $('#finalmarksforlo5').val(total);
    });
});
///////////table 1 ends here///////////
//
/////////////table 2////////////////////
//$(document).ready(function () {
//    $('.lo6').keyup(function () {
//        var total = 0;
//        $(".lo6").each(function () {
//            var marks = (parseInt($(this).val())/100)*35;
//            total += !isNaN(marks) ? marks : 0;
//
//        });
//        $('#finalmarksforlo6').val(total);
//    });
//});
//
//$(document).ready(function () {
//    $('.lo7').keyup(function () {
//        var total = 0;
//        $(".lo7").each(function () {
//            var marks = (parseInt($(this).val())/100)*25;
//            total += !isNaN(marks) ? marks : 0;
//
//        });
//        $('#finalmarksforlo7').val(total);
//    });
//});
//
//$(document).ready(function () {
//    $('.lo8').keyup(function () {
//        var total = 0;
//        $(".lo8").each(function () {
//            var marks = (parseInt($(this).val())/100)*5;
//            total += !isNaN(marks) ? marks : 0;
//
//        });
//        $('#finalmarksforlo8').val(total);
//    });
//});
//
//$(document).ready(function () {
//    $('.lo9').keyup(function () {
//        var total = 0;
//        $(".lo9").each(function () {
//            var marks = (parseInt($(this).val())/100)*15;
//            total += !isNaN(marks) ? marks : 0;
//
//        });
//        $('#finalmarksforlo9').val(total);
//    });
//});
//
//$(document).ready(function () {
//    $('.lo10').keyup(function () {
//        var total = 0;
//        $(".lo10").each(function () {
//            var marks = (parseInt($(this).val())/100)*20;
//            total += !isNaN(marks) ? marks : 0;
//
//        });
//        $('#finalmarksforlo10').val(total);
//    });
//});
/////////////table 2 ends here/////////
function getTotal()
{//add trnry operation, get 0 if null
    var tot = parseFloat(document.getElementById("finalmarks").value) +
              parseFloat(document.getElementById("finalmarksforsrs").value);

    $('#total').val((Math.round(tot * 10) / 10));
}

</script>