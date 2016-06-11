
@extends('masterpages.master_rpc')

@section('css_links')
        <title>Approved External Supervisors</title>
@endsection
@section('title')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View All Approved External Supervisors</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


@endsection


  @section('content')



      <div class="col-lg-12">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>All Approved External Supervisors</h5>
                  <div class="ibox-tools">

                  </div>
              </div>
              <div class="ibox-content">

                  <div class="table-responsive">

                      <table style="font-size: 13px" class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">

                          <thead>
                          <tr role="row">
                              <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 189px;" aria-sort="ascending">Name</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 253px;">Designation</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 229px;">Email</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 162px;">Contact No</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 115px;">Speciality</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 115px;">University</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 115px;">CV</th>
                              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 115px;">Supervising Projects</th></tr>
                          </thead>
                          <tbody>

                          @foreach($r as $prj)
                              <tr class="gradeA even tablerow" role="row">
                                  <td class="sorting_1">{{ $prj->name }}</td>

                                  <td>{{ $prj->designation }}</td>
                                  <td class="center"><a href="">{{$prj->email}}</a></td>
                                  <td>{{ $prj->phone}}</td>
                                  <td>{{ $prj->speciality}}</td>
                                  <td>{{ $prj->university}}</td>


                                  <td>{{ $prj->cv}}</td>
                                  <td class="center">{{ $prj->count}}</td>

                              </tr>
                          @endforeach


                          </tbody>
                          <tfoot>
                          <tr>
                              <th rowspan="1" colspan="1">Name</th>
                              <th rowspan="1" colspan="1">Designation</th>
                              <th rowspan="1" colspan="1">Email</th>
                              <th rowspan="1" colspan="1">Contact No</th>
                              <th rowspan="1" colspan="1">Speciality</th>
                              <th rowspan="1" colspan="1">University</th>
                              <th rowspan="1" colspan="1">CV</th>
                              <th rowspan="1" colspan="1">Supervising Projects</th>
                          </tr>
                          </tfoot>
                      </table>

                  </div>

              </div>
          </div>
      </div>



   @endsection


@section('ValidationJavaScript')

    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( 'http://webapplayers.com/example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>

    <style>
        body.DTTT_Print {
            background: #fff;

        }
        .DTTT_Print #page-wrapper {
            margin: 0;
            background:#fff;
        }

        button.DTTT_button, div.DTTT_button, a.DTTT_button {
            border: 1px solid #e7eaec;
            background: #fff;
            color: #676a6c;
            box-shadow: none;
            padding: 6px 8px;
        }
        button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
            border: 1px solid #d2d2d2;
            background: #fff;
            color: #676a6c;
            box-shadow: none;
            padding: 6px 8px;
        }

        .dataTables_filter label {
            margin-right: 5px;

        }
    </style>
@endsection









































































































































