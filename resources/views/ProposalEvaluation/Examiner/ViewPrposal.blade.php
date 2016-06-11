@extends('......masterpages.master_panel_member')
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> Proposal Presentation Evaluation</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')




                <form id="form2" name="form1" method="post" action="">
                  <div class="ibox-content col-lg-9">
                  <div class="col-lg-9">
                   <strong>Student ID Number<l style="padding-left:20px">: {{$student->regId}}</l><br>
                   Student Name<l style="padding-left:53px"> :{{$student->name}}</l><br>
                   Thesis title<l style="padding-left:73px"> :{{$student->title}}</l><br>

                    </strong>
                   </div>
                   <div class="col-lg-9"><strong>
                   <font color="blue">Status<l style="padding-left:107px">:{{$x->status}}</l></font><br>
                   Evaluated Date<l style="padding-left:48px">:{{$details[18]}}</l><br>
                   <font color="blue">Total Marks<l style="padding-left:70px"> :{{$marks}}</l></font><br>
                  </strong>
                  </div>
                  </div>

                <div class="ibox-content col-lg-9 " style="padding-left: 0px">
                <div class="project-list">
                  <table class="table " style="font-size: 13px">

<tbody>

<tr><td>
<strong>Introduction(10 Marks)</strong><br>
  Topic clearly introduced  <br>
  Project gap clearly identified<br>
  Demonstrated the depth of knowledge about subject area<br>
  <div style="vertical-align: top"><font color="blue">

<?php
     echo nl2br($details[1]);
 ?>
</font></div>
  </td><td>
  <div class="col-lg-3">
 <font color="blue">{{$details[0]}}</font>
 </div></td>
</tr>


<tr><td>
<strong>Problem Definition (10 Marks)</strong><br>
  Method of deriving the project objectives <br>
  Significance of the project problem<br>
 <div style="vertical-align: top" ><font color="blue"> <?php echo nl2br($details[3]);
 ?></font></div>
  </td><td>
  <div class="col-lg-3">
<font color="blue">{{$details[2]}}</font>
 </div></td>
</tr>

<tr><td>
<strong>Scope (5Marks)</strong><br>
  Time frame<br>
  Depth of study<br>
  <div style="vertical-align: top" ><font color="blue"><?php echo nl2br($details[5]);
                                                                  ?></font></div>
  </td><td>
  <div class="col-lg-3">
 <font color="blue">{{$details[4]}}</font>
 </div></td>
</tr>


<tr><td>
<strong>Literature Review (25 Marks)</strong><br>
  Depth of investigation (Books, Journals, Conference papers referred) <br>
  Relevance of the paper referred <br>
  <div style="vertical-align: top"><font color="blue"> <?php echo nl2br($details[7]);
                                                                ?></font></div>
  </td><td>
  <div class="col-lg-3">
<font color="blue">{{$details[6]}}</font>
 </div></td>
</tr>


 <tr><td>
<strong>Methodology (15 Marks)</strong><br>
  Justification (Use of appropriate technology) ,Validity<br>
  Viability of the project<br>
   <div ><font color="blue"> <?php echo nl2br($details[9]);
                                      ?></font></div>
  </td>
<td>
<font color="blue">{{$details[8]}}</font>
 </td>
</tr>
<tr><td>
<strong>Work plan (10Marks)</strong><br>
  In sufficient detail and realistic<br>
  <div style="vertical-align: top" ><font color="blue"><?php echo nl2br($details[11]);
                                                                 ?></font></div>
  </td><td>
<font color="blue">
{{$details[10]}}</font>
 </td>
</tr>


<tr><td>
<strong>Presentation (25 Marks)</strong><br>
  Document (10 Marks)  <br>
  <div style="vertical-align: top" ><font color="blue"> <?php echo nl2br($details[13]);
                                                                 ?></font></div>
  </td><td>

<font color="blue">{{$details[12]}}</font>
</td>
</tr>

<tr><td>
  Oral presentation (10Marks)
  <div style="vertical-align: top" ><font color="blue"><?php echo nl2br($details[15]);
                                                                 ?></font></div>
  </td><td>

<font color="blue">{{$details[14]}}</font>
</td>
</tr>

<tr><td>
  Performance at the Q/A session (5Marks)<br>
   <div style="vertical-align: top" ><font color="blue"><?php echo nl2br($details[17]);
                                                                 ?></font></div>
  </td><td>

 <font color="blue">{{$details[16]}}</font >
</td>
</tr>



</tbody>
    </table>
    </div>
    </div>
</div>
</form>





@endsection
