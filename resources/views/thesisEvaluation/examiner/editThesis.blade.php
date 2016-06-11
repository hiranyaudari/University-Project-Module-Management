<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
   $('.marks').change(function() {
         var total= 0;
                $(".marks").each(function() {
                     var marks =parseInt($(this).val());
                     total += !isNaN (marks ) ? marks : 0;

                });
         $('#total').val(total);
	});
});
</script>

@extends('......masterpages.master_panel_member')
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Evaluate Thesis Presentation</h2>
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
<form method="post">
<div>
              <table class="table table-bordered" style="width: 400px;font-size: 13">
              <div><h2><strong>Thesis Evaluation Form</strong></h2></div>
                                <tbody>
                                <tr>
                                    <td style="width: 120px">Student ID</td>
                                    <td>{{$project->regId}}</td>
                                </tr>
                                <tr>
                                    <td>Project</td>
                                    <td>{{$project->title}}</td>
                                </tr>
                                <tr>
                                    <td>Panel member</td>
                                    <td>{{$panelMember}}</td>
                                </tr>
                                 <tr>
                                    <td>Date</td>
                                    <td>{{date("Y-m-d")}}</td>
                                 </tr>
                                </tbody>
                            </table>
                     </div>

                            <table class="table table-bordered" style="font-size: 13">
                              <tbody>
                                 <tr>
                                    <td style="width: 900px"><strong>Independent Scientific Thinking</strong></td>

                                    <td><p>{{$version->independentScientificThinking}} Marks</p><input type="text" class="marks"  name="independentScientificThinking" style="width: 80px" value={{$details->independentScientificThinking}}></td>
                                </tr>


                                 <tr>
                                  <td><strong>Scientific Know How</strong></td>

                                    <td><p>{{$version->scientificKnowHow}} Marks</p><input type="text" class="marks"  name="scientificKnowHow" style="width: 80px" value={{$details->scientificKnowHow}}></td>
                                 </tr>

                                <tr>
                                   <td><strong>Logic</strong><br>
                                                                       Justification (Use of appropriate technology) ,Validity<br>
                                                                                                            Viability of the project<br></td>

                                   <td><p>{{$version->logic}} Marks</p><input type="text" class="marks"  name="logic" style="width: 80px" value={{$details->logic}}></td>
                                 </tr>

                                 <tr>
                                  <td ><strong>Presentation </strong><br>Performance at the Q/A session<br>
                                                                      Document<br>
                                                                      Oral presentation
                                                                       </td>

                                    <td><p>{{$version->presentation}} Marks</p><input type="text" class="marks"  name="presentation" style="width: 80px" value={{$details->presentation}}></td>
                                 </tr>


                                 <tr>
                                   <td ><strong>Work Process </strong><br>
                                                                            In sufficient detail and realistic<br></td>

                                  <td><p>{{$version->workProcess}} Marks</p><input type="text" class="marks" id="marks5" name="workProcess" style="width: 80px"  value={{$details->workProcess}}></td>
                                 </tr>
                              </tbody>
                            </table>

                            <div align="right">
                               <input type="text" id="total" id="total" placeholder="Total Marks" style="width: 80px" value={{$total}} readonly> /100 Marks</div>

                           <div><textarea name="comment" rows="4" cols="80" placeholder="Comment">{{$details->comment}}</textarea></div>
                             <br>

                             <div><select name="status">
                             <option  value={{$details->status}}>{{$details->status}}</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Major modification">Major modification</option>
                                    <option value="Minor modification">Minor modification</option>
                                    <option value="Rejected">Rejected</option></select></div>

                             <div align="right"><input type='hidden' name='id' value={{$details->projectId}} >
                                  <button type='submit'  class="save_btn btn btn-primary btn-xs m-l-sm" name='editThesisMarks' >Submit</button>
                                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                             </div>
                       </form>
                        </div>
                   </div>
@endsection
