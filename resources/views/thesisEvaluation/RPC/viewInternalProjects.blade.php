@extends('......masterpages.master_rpc')


@section('content')
@if(Session::has('success'))
    <div class="alert  alert-success">
       {{ Session::get('success') }}
    </div>
@endif
     <div class="col-lg-12">
       <div class="ibox float-e-margins">
         <div class="ibox-title">
            <h5> Evaluated Thesis Evaluations</h5>
         </div>



<br>
          <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
              <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 100px;">Project No</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 248px;">Project</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">Supervisor</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;">Student</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;">Status</th>
                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;">Proposal Forms</th>
                </tr>
              </thead>

              <tbody>
                 @foreach($projects as $project)
                     <tr  class="gradeA even" role="row">
                        <td class="sorting_1">{{ $project->projectId }}</td>
                        <td>{{ $project->title}}</td>
                        <td><a href='/{{$project->username}}'>{{ $project->supervisor }}</a></td>
                        <td><a href="{{ asset('studentDetails/' . $project->name)}}">{{ $project->name }}</a></td>
                        <td>{{ $project->status}}</td>


                  <td class="center">
                    <a href="{{ asset('viewThesis/'.$project->projectId) }}" class="edit_btn btn btn-primary btn-xs m-l-sm">Form </a>
                  </td>
                 </tr>

                 @endforeach
              </tbody>

           </table>

             @if($publishedStatus===NULL)
                  <a href="viewInternalProjects/publish" class="btn btn-primary btn-xs m-l-sm" align="right" disabled='disabled'>Publish</a>
              @else
                <a href="viewInternalProjects/publish" class="btn btn-primary btn-xs m-l-sm" align="right">Publish</a>
              @endif

        </div>
       </div>
       </div>
</div>
</div>
@endsection