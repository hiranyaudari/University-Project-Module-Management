@extends('masterpages.master_student')
@section('content')
   <div class="col-lg-9" >
      <form id="form1" name="form1" method="post" action="" >
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <div>
                @if ($ev !== NULL)
                    @if($ev->feedback!=0)

                        <div class="ibox-title" >

                           <strong><h2>Proposal presentation Status </h2></strong> </div>

                           <div class="ibox-content">
                               <div>
                                 Project No       :{{$ev->project_id}}<br>
                                 Project Title    :{{$prj->title}}<br>
                                 Supervisor       :{{$name}}<br>
                                 Evaluated date   :{{$dateProp}}<br>
                                 Total Marks      :{{$marksProp}}<br>
                                 Proposal status  :{{$ev->status}}
                                </div>


                                   @if($ev->status=='Rejected')
                                   <a href="projectReRegistration" align="right" class="btn btn-primary btn-xs m-l-sm">Re Registration Form</a>
                                   @endif
                             </div>
                @else
                   <div class="ibox-title" >
                     Proposal Evaluation feed back is not published yet
                   </div>
                @endif
           @endif
         </div>

           <div>
                @if ($details!== NULL)
                    @if($details->published!=0)

                        <div class="ibox-title" >

                           <strong><h2>Thesis presentation Status </h2></strong> </div>

                           <div class="ibox-content">
                               <div>
                                 Project No       :{{$details->projectId}}<br>
                                 Project Title    :{{$prj->title}}<br>
                                 Supervisor       :{{$name}}<br>
                                 Evaluated date   :{{$date}}<br>
                                 Total Marks      :{{$marks}}<br>
                                 Proposal status  :{{$details->status}}
                                </div>
                           </div>

                     @else
                         <div class="ibox-title" >
                          Thesis Evaluation feed back is not published yet
                         </div>
                     @endif
                @endif
          </div>
    </form>
</div>


</div>
@endsection

