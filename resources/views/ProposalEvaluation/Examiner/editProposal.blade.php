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
@if (count($errors) > 0)

         <div class="alert alert-danger">
             <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
             </ul>
       	</div>
       @endif

@if(Session::has('success'))
    <div class="alert alert-success">
       {{ Session::get('success') }}
    </div>
@endif

<div class="col-lg-9">

                <form id="form2" name="form1" method="post" action="">
                  <div class="ibox-content">
                    <strong>Student ID Number<l style="padding-left:20px">: {{$student->regId}}</l><br>
                              Student Name<l style="padding-left:53px">:{{$student->name}}</l><br>
                              Project title<l style="padding-left:73px"> :{{$student->title}}</l><br>

                              Evaluated Date<l style="padding-left:48px">:{{$details[18]}}</l><br>
                              Total Marks<l style="padding-left:68px">:{{$marks}}</l>
                    </strong>

                <div class="ibox-content">
                <div class="project-list">
                  <table class="table " style="font-size: 13px" >

<tbody>

<tr><p><td>
<strong>Introduction(10 Marks)</strong><br>
  Topic clearly introduced  <br>
  Project gap clearly identified<br>
  Demonstrated the depth of knowledge about subject area<br>
  <p><div style="vertical-align: top" ><textarea name="comment1" placeholder="comment" cols="60" rows="4">{{$details[1]}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="IntroductionMarks" placeholder="marks" value= {{$details[0]}}>
 </div></td></p>
</tr>


<tr><p><td>
<strong>Problem Definition (10 Marks)</strong><br>
  Method of deriving the project objectives <br>
  Significance of the project problem<br>
  <p><div style="vertical-align: top" ><textarea name="comment2" placeholder="comment" cols=60" rows="4">{{$details[3]}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="ProblemDefinitionMarks" placeholder="marks" value="{{$details[2]}}">
 </div></td></p>
</tr>

<tr><p><td>
<strong>Scope (5Marks)</strong><br>
  Time frame<br>
  Depth of study<br>
  <p><div style="vertical-align: top" ><textarea name="comment3" placeholder="comment" cols=60" rows="4">{{$details[5]}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="ScopeMarks" placeholder="marks" value="{{$details[4]}}">
 </div></td></p>
</tr>


<tr><p><td>
<strong>Literature Review (25 Marks)</strong><br>
  Depth of investigation (Books, Journals, Conference papers referred) <br>
  Relevance of the paper referred <br>
  <p><div style="vertical-align: top"><textarea name="comment4" placeholder="comment" cols=60" rows="4">{{$details[7]}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="LiteratureReviewMarks" placeholder="marks" value="{{$details[6]}}">
 </div></td></p>
</tr>
<tr><td>
<strong>Methodology (15 Marks)</strong><br>
  Justification (Use of appropriate technology) ,Validity<br>
  Viability of the project<br>
   <p><div ><textarea name="comment5" placeholder="comment" cols=60" rows="3">{{$details[9]}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3" >
  <input type="text" name="MethodologyMarks" placeholder="marks" value="{{$details[8]}}">
 </div></td>
</tr>
<tr><td>
<strong>Work plan (10Marks)</strong><br>
  In sufficient detail and realistic<br>
  <div style="vertical-align: top" ><textarea name="comment6" placeholder="comment" cols=60" rows="3">{{$details[11]}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="WorkplanMarks" placeholder="marks" value="{{$details[10]}}">
 </div></td>
</tr>


<tr><td>
<strong>Presentation (25 Marks)</strong><br>
  Document (10 Marks)  <br>
  <div style="vertical-align: top" ><textarea name="comment7" placeholder="comment" cols=60" rows="3">{{$details[13]}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="DocumentMarks" placeholder="marks" VALUE="{{$details[12]}}">
 </div></td>
</tr>

<tr><td>
  Oral presentation (10Marks)
  <div style="vertical-align: top" ><textarea name="comment8" placeholder="comment" cols=60" rows="3">{{$details[15]}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="OralpresentationMarks" placeholder="marks" value="{{$details[14]}}">
 </div></td>
</tr>

<tr><td>
  Performance at the Q/A session (5Marks)<br>
   <div style="vertical-align: top" ><textarea name="comment9" placeholder="comment" cols=60" rows="3">{{$details[17]}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="Q/AsessionMarks" placeholder="marks" value={{$details[16]}}>
 </div></td>
</tr>

</tbody>


    </table>
<div>Status :  &nbsp<select name="status">
     <option  value="{{$x->status}}">{{$x->status}}</option>
     <option value="Accepted">Accepted</option>
     <option value="Rejected">Rejected</option>
     <option value="Major modification">Major modification</option>
     <option value="Minor Modification">Minor Modification</option>
</select>
</div>

    </div>
    </div>


<div align="right"><input type='hidden' name='next'  value={{$x->id}}>
    <input type='submit'  class="save_btn btn btn-primary btn-xs m-l-sm" name='next1' value="Edit">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"></div>
    </div>
</form>

</div>
</div>
@endsection
