@extends('masterpages.master_student')
@section('content')
<div class="col-lg-9" >
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
     <div class="ibox-title" >
           <strong><h2>Re Register for New Projects </h2></strong> </div>
       <div class="ibox-content">

       <div>
          <input name="registration_no" type="text"  id="o" placeholder="registration_no" size="50" readonly value={{$stu->regId}}>
       </div><br>

           <div>
             <input name="name" type="text"  id="o" placeholder="Name" readonly size="50"  value={{$stu->name}}>
           </div><br>
           <font color="#3cb371" ><strong>Rejected Project Details</strong></font>
           <br><br>
           <div>
              <input name="e-project" type="text"  id="b" placeholder="Earlier Project" size="50" readonly value={{$prj->title}}>
           </div><br>
           <div>
             <input name="supervisor" type="text" id="c" placeholder="Supervisor" size="50" readonly  value={{$sup}}>
           </div><br>
           <font color="#3cb371" ><strong>New Project Details</strong></font>
           <br><br>
           <div>
             <input name="NewProject" type="text"  placeholder="New Project" size="50"/>
           </div><br>
           <div>
             <textarea name="description"  placeholder="Description" cols="100" rows="6"/></textarea>
           </div><br>


    <div align="right"><button type="submit" name="Register" value="Submit" align="right" class="btn btn-primary btn-xs m-l-sm">Register</button>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="reset" name="Submit2" value="Reset" class="btn btn-primary btn-xs m-l-sm"></div>

</div>

  </form>
 </div>



</div>



@endsection

