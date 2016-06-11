

@extends('......masterpages.master_rpc')

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Thesis Evaluation Form</h2>
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
<div class="ibox-content" style="font-size: 14">
<form method="post">




                            <table class="table table-bordered">
                              <tbody>
                                 <tr>
                                    <td style="width: 1000px"><strong>Independent Scientific Thinking</strong></td>

                                    <td style="width: 200px"><p><input type="text"  style="width: 40px" name="independentScientificThinking" class="marks" value={{$version->independentScientificThinking}} > Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                                </tr>


                                 <tr>
                                   <td><strong>Scientific Know How</strong></td>

                                    <td><p><input type="text"  style="width: 40px" name="scientificKnowHow" class="marks" value ={{$version->scientificKnowHow}}> Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                                 </tr>

                                <tr>
                                   <td><strong>Logic</strong><br>
                                                                      Justification (Use of appropriate technology) ,Validity<br>
                                                                                                           Viability of the project<br></td>

                                   <td><p><input type="text" style="width: 40px" name="logic"  class="marks" value ={{$version->logic}}> Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                                 </tr>

                                 <tr>
                                  <td ><strong>Presentation </strong><br>Performance at the Q/A session<br>
                                                                      Document<br>
                                                                      Oral presentation
                                                                       </td>

                                    <td><p><input type="text"  style="width: 40px" name="presentation" class="marks" value ={{$version->presentation}}> Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                                 </tr>


                                 <tr>
                                  <td ><strong>Work Process </strong><br>
                                                                           In sufficient detail and realistic<br></td>

                                  <td><p><input type="text"  style="width: 40px" name="workProcess" class="marks" value={{$version->workProcess}}> Marks</p>  <input type="text" placeholder="0" disabled style="width: 80px"></td>
                                 </tr>

                              </tbody>
                            </table>

                            <div align="right">
                            <input type="text"  placeholder="Total Marks" style="width: 40px"  disabled> / <input type="text" name="total" id="total" style="width: 40px" readonly placeholder="100">Marks</div>

                             <div><textarea name="comment" disabled rows="4" cols="80" placeholder="Comment"></textarea></div><br>
                             <div><select name="status" disabled><option> Status </option></select></div>
                             <div align="right"> <input type='submit'  class="save_btn btn btn-primary btn-xs m-l-sm" name='editThesisFormMarks' align="right">
                             <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"></div>
</form>
                        </div>
                   </div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
   $('.marks').keyup(function() {
         var total= 0;
                $(".marks").each(function() {
                     var marks =parseInt($(this).val());
                     total += !isNaN (marks ) ? marks : 0;

                });
         $('#total').val(total);
	});
});
</script>