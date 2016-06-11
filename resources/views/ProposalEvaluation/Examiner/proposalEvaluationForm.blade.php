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

<div class="col-lg-9">

                <form id="form1" name="form1" method="post" action="">
                  <div class="ibox-content">
                   <strong>Student ID Number: &nbsp{{$student->regId}}<br>
                   Student Name:&nbsp{{$student->name}}<br>
                   Proposal title: &nbsp{{$project->title}}<br></strong>
                  </div>

                <div class="ibox-content">
                <div class="project-list">
                  <table class="table" style="font-size: 13px" >

<tbody>

<tr><p><td>
<strong>Introduction(10 Marks)</strong><br>
  Topic clearly introduced  <br>
  Project gap clearly identified<br>
  Demonstrated the depth of knowledge about subject area<br>
  <p><div style="vertical-align: top" ><textarea name="comment1" placeholder="comment" cols=60" rows="4">{{Request::old('comment1')}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="IntroductionMarks" placeholder="marks" value={{Request::old('IntroductionMarks')}}>
 </div></td></p>
</tr>


<tr><p><td>
<strong>Problem Definition (10 Marks)</strong><br>
  Method of deriving the project objectives <br>
  Significance of the project problem<br>
  <p><div style="vertical-align: top" ><textarea name="comment2" placeholder="comment" cols=60" rows="4">{{Request::old('comment2')}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="ProblemDefinitionMarks" placeholder="marks" value={{Request::old('ProblemDefinitionMarks')}}>
 </div></td></p>
</tr>

<tr><p><td>
<strong>Scope (5Marks)</strong><br>
  Time frame<br>
  Depth of study<br>
  <p><div style="vertical-align: top" ><textarea name="comment3" placeholder="comment" cols=60" rows="4">{{Request::old('comment3')}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="ScopeMarks" placeholder="marks" value={{Request::old('ScopeMarks')}}>
 </div></td></p>
</tr>


<tr><p><td>
<strong>Literature Review (25 Marks)</strong><br>
  Depth of investigation (Books, Journals, Conference papers referred) <br>
  Relevance of the paper referred <br>
  <p><div style="vertical-align: top"><textarea name="comment4" placeholder="comment" cols=60" rows="4">{{Request::old('comment4')}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="LiteratureReviewMarks" placeholder="marks" value={{Request::old('LiteratureReviewMarks')}}>
 </div></td></p>
</tr>


<tr><td>
<strong>Methodology (15 Marks)</strong><br>
  Justification (Use of appropriate technology) ,Validity<br>
  Viability of the project<br>
   <p><div ><textarea name="comment5" placeholder="comment" cols=60" rows="3">{{Request::old('comment5')}}</textarea></div></p>
  </td><td>
  <div class="col-lg-3" >
  <input type="text" name="MethodologyMarks" placeholder="marks" value={{Request::old('MethodologyMarks')}}>
 </div></td>
</tr>
<tr><td>
<strong>Work plan (10Marks)</strong><br>
  In sufficient detail and realistic<br>
  <div style="vertical-align: top" ><textarea name="comment6" placeholder="comment" cols=60" rows="3">{{Request::old('comment6')}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="WorkplanMarks" placeholder="marks" value={{Request::old('WorkplanMarks')}}>
 </div></td>
</tr>


<tr><td>
<strong>Presentation (25 Marks)</strong><br>
  Document (10 Marks)  <br>
  <div style="vertical-align: top" ><textarea name="comment7" placeholder="comment" cols=60" rows="3">{{Request::old('comment7')}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="DocumentMarks" placeholder="marks" value={{Request::old('DocumentMarks')}}>
 </div></td>
</tr>

<tr><td>
  Oral presentation (10Marks)
  <div style="vertical-align: top" ><textarea name="comment8" placeholder="comment" cols=60" rows="3">{{Request::old('comment8')}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="OralpresentationMarks" placeholder="marks" value={{Request::old('OralpresentationMarks')}}>
 </div></td>
</tr>

<tr><td>
  Performance at the Q/A session (5Marks)<br>
   <div style="vertical-align: top" ><textarea name="comment9" placeholder="comment" cols=60" rows="3">{{Request::old('comment9')}}</textarea></div>
  </td><td>
  <div class="col-lg-3">
  <input type="text" name="Q/AsessionMarks" placeholder="marks" value={{Request::old('Q/AsessionMarks')}}>
 </div></td>
</tr>

</tbody>


    </table>
    </div>
    </div>
 <div class="ibox-content"><p>
<div>Status :  &nbsp<select name="status">
     <option  selected disabled >--Status--</option>
     <option value="Accepted">Accepted</option>
     <option value="Rejected">Rejected</option>
     <option value="Major modification">Major modification</option>
     <option value="Minor Modification">Minor Modification</option>
</select>
<br><br>
Panel member :  {{$panelmember}}<br>
Date : <?php echo date("d-m-Y")?>
 <div align="right">


<input type='hidden' name='evaluation_submit' value={{$project->id}} >

 <input type='submit'  class="save_btn btn btn-primary btn-xs m-l-sm" name='next' >
 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"></div></div> </div>
</tbody>


    </table>
   </form>
   </div>
    </div>

</form>
</div>
</div>
@endsection

