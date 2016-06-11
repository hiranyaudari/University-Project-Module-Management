@extends('masterpages.master_student')
@section('content')
<div class="col-lg-12" >
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
    <div class="alert alert-success">
       {{ Session::get('success') }}
    </div>
@endif


  <form id="form1" name="form1" method="post" action="" >
   <input type="hidden" class="form-control" name="prjID" value={{$project->id}} >
    <div class="ibox-title" >
           <strong><h2>Change Supervisor </h2></strong> </div>
       <div class="ibox-content">
           Registration No
           <div>
             <input name="id" type="text" class="form-control"  value={{$stu->regId}} readonly size="50"/>
           </div><br>

           Student Name
           <div>
             <input name="name" type="text" class="form-control"  value={{$stu->name}} readonly size="50"/>
           </div>
           <br>

           Project
           <div>
              <input name="project" type="text" class="form-control" id="b" value={{$project->title}} readonly size="50" />
           </div><br>

           Supervisor
           <div>
             <input name="o-supervisor" type="text" class="form-control" id="c" value={{$supervisor}} size="50" readonly/>
           </div><br>

           Requesting supervisor
            <div>
              <select class="form-control" id="" name="newSupervisor">
               <option selected disabled>Select a supervisor</option>
                 @foreach($supervisors as $supervisor)
                    <option value={{$supervisor->id}}>{{$supervisor->name}}</option>
                 @endforeach
              </select>
            </div><br>


           <div>
             <textarea name="description"  class="form-control" placeholder="Valid Reason" cols="100" rows="6">{{Request::old('description')}}</textarea>
           </div><br>


    <div align="right"><button type="submit" name="change" align="right" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="reset" name="Submit2" value="Reset" class="btn btn-primary"></div>

</div>

  </form>
 </div>



</div>


@endsection

