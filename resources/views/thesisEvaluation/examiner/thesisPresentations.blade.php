@extends('......masterpages.master_panel_member')

@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> Final Presentation Evaluation</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection
@section('content')
<div class="col-lg-12">
    <form id="" action='' method='post' >
       <div class="ibox-title">
                       <strong>Final Presentation evaluations on  <?php echo date("d-m-Y")?></strong>
       </div>
       <div class="ibox-content">
             <div class="project-list">
                     <table class="table" >
                         @foreach($projects as $project)
                            <tr>
                                <td>{{$project->id}}</td>
                                <td>{{$project->title}}</td>
                                <td>{{$project->time_start}} to  {{$project->time_end}}</td>
                                <td>
                                   <div class="col-sd-3" align="right">

                                   @if(!in_array($project->projectId, $pid))
                                     <a href="{{ asset('thesisEvaluationForm/'.$project->projectId) }}" class="edit_btn btn btn-primary btn-xs m-l-sm">Add</a>
                                     <a href="#" class="edit_btn btn btn-primary btn-xs m-l-sm" disabled='disabled'>Edit</a>
                                     <a href="#" class="edit_btn btn btn-primary btn-xs m-l-sm" disabled='disabled'>View</a>
                                  @else
                                      <a href="{{ asset('thesisEvaluationForm/'.$project->projectId) }}" class="edit_btn btn btn-primary btn-xs m-l-sm" disabled='disabled'>Add</a>
                                      <a href="{{ asset('editThesis/'.$project->projectId) }}" class="edit_btn btn btn-primary btn-xs m-l-sm">Edit</a>
                                      <a href="{{ asset('viewThesis/'.$project->projectId) }}" class="edit_btn btn btn-primary btn-xs m-l-sm">View</a>
                                  @endif


                                    </div>
                                </td>
                            </tr>
                         @endforeach
                     </table>
              </div>
            </div>
        </form>

</div>

</div>

@endsection

