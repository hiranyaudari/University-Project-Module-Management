
@extends('......masterpages.master_panel_member')
@section('content')
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
              <td>{{$details->date}}</td>
           </tr>
           <tr>
             <td>Status</td>
             <td>{{$details->status}}</td>
           </tr>
          </tbody>
        </table>
      </div>

      <table class="table table-bordered" style="font-size: 13">
          <tbody>
            <tr>
              <td style="width: 900px"><strong>Independent Scientific Thinking</strong></td>

              <td><p>{{$version->independentScientificThinking}} Marks</p><input type="text"    readonly style="width: 80px"  value={{$details->independentScientificThinking}}></td>
            </tr>

            <tr>
              <td><strong>Scientific Know How</strong></td>

                                    <td><p>{{$version->scientificKnowHow}} Marks</p><input type="text"    readonly style="width: 80px"  value={{$details->scientificKnowHow}}></td>
                                 </tr>

                                <tr>
                                  <td><strong>Logic</strong><br>
                                                                      Justification (Use of appropriate technology) ,Validity<br>
                                                                                                           Viability of the project<br></td>

                                   <td><p>{{$version->logic}} Marks</p><input type="text"    readonly style="width: 80px"  value={{$details->logic}}></td>
                                 </tr>

                                 <tr>
                                  <td ><strong>Presentation </strong><br>Performance at the Q/A session<br>
                                                                      Document<br>
                                                                      Oral presentation
                                                                       </td>

                                    <td><p>{{$version->presentation}} Marks</p><input type="text"    readonly style="width: 80px"  value={{$details->presentation}}></td>
                                 </tr>


                                 <tr>
                                   <td ><strong>Work Process </strong><br>
                                                                            In sufficient detail and realistic<br></td>

                                  <td><p>{{$version->workProcess}} Marks</p><input type="text"    readonly style="width: 80px"  value={{$details->workProcess}}></td>
                                 </tr>
                              </tbody>
                            </table>

                            <div align="right">
                            <input type="text" id="total" id="total" placeholder="Total Marks" style="width: 80px" value={{$total}} readonly> /100 Marks</div>

                             <div><textarea name="comment" rows="4" cols="80"  readonly>{{$details->comment}}</textarea> </div>




                       </form>
                        </div>
                   </div>
@endsection
