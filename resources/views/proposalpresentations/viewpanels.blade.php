@extends('masterpages.master_rpc')

@section('css_links')

@endsection
@section('title')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Presentation Panel Management</h2>
            <ol class="breadcrumb">

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection


@section('content')
    @if (Session::has('message_error'))
        <div class="alert alert-danger" role="alert" id="divAlert" style="font-size: 14px">
            {{Session::get('message_error') }}
        </div>
    @elseif(Session::has('message_success'))
        <div class="alert alert-success" role="alert" id="divAlert" style="font-size: 14px">
            <span class="glyphicon glyphicon-envelope"></span> {{Session::get('message_success') }}
        </div>
    @endif

    <div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
    <div class="ibox-title">
<h5>Proposal Presentation Schedule</h5>
    </div>

    <div class="ibox-content">

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="table-responsive">

                <table id="proposal_panel_table" class="table table-hover issue-tracker proposal_panel_table">
                    <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($panels as $panel)
                        <tr>
                            <td class="text-primary">{{ $panel->title }}</td>
                            <td>{{ $panel->date }}</td>
                            <td>{{ $panel->venue }}</td>
                            <td>{!! link_to_route('proposalpanels.show', 'View', Crypt::encrypt($panel->id), ['class' => 'btn btn-sm btn-success']) !!}</td>
                            <td>{!! link_to_route('proposalpanels.edit', 'Edit', Crypt::encrypt($panel->id), ['class' => 'btn btn-sm btn-warning']) !!}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['proposalpanels.destroy', Crypt::encrypt($panel->id)], 'id'=>'deleteForm'])  !!}
                                <center><a onclick = "deletePresentationPanel()" class="btn btn-sm btn-danger">Delete</a></center>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    </div>
    </div>
    </div>




@endsection

@section('ValidationJavaScript')
    {{--<script>--}}
        {{--$(document).ready(function(){--}}
            {{--$('#proposal_panel_table').DataTable();--}}
        {{--});--}}
    {{--</script>--}}

    <script>
        function deletePresentationPanel(){

            swal({   title: "Are you sure?",
                        text: "Do You want to remove the presentation panel??",
                        type: "warning",   showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes!",
                        cancelButtonText: "Cancel!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function(isConfirm){

                        if (isConfirm) {
                            document.getElementById("deleteForm").submit();
                        }

                    });
//            return x;
//            confirm("Do you want to delete this Presentation panel");

        }
    </script>



    <script>
        $(document).ready(function() {
            $('.proposal_panel_table').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#proposal_panel_table').dataTable();

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