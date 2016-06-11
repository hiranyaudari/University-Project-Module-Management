@extends('masterpages.master_rpc')

@section('css_links')

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

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <h2>Project Title : {{ $panel->title }}</h2>
                <hr/>
                <br>

                 <div class="form-group">
                    <label class="col-lg-2 control-label">Supervisor :</label>
                    <p class="col-lg-10">{{ $panel->name }}</p>
                </div>

                 <div class="form-group">
                    <label class="col-lg-2 control-label">Panel Member 1 :</label>
                     <p class="col-lg-10">{{ $panelMember1->name}}</p>
                </div>


                 <div class="form-group">
                    <label class="col-lg-2 control-label">Panel Member 2 :</label>
                     <p class="col-lg-10">{{ $panelMember2->name}}</p>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">Date :</label>
                    <p class="col-lg-10">{{ $panel->date }}</p>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">Venue :</label>
                    <p class="col-lg-10">{{ $panel->venue }}</p>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">Start Time :</label>
                    <p class="col-lg-10">{{ $panel->time_start }}</p>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">End Time :</label>
                    <p class="col-lg-10">{{ $panel->time_end }}</p>
                </div>

                <div class="form-group col-lg-4">
                    {!! link_to_route('proposalpanels.edit', 'Edit', Crypt::encrypt($panel->id), ['class' => 'col-lg-2 btn btn-warning btn-block']) !!}
                    <a class="col-lg-2 btn btn-success btn-block" href="{{URL::route('proposalpanels.index')}}">Cancel</a>
                    {!! Form::open(['method' => 'DELETE', 'onsubmit' => 'return confirm("Are you sure?");', 'route' => ['proposalpanels.destroy', Crypt::encrypt($panel->id)]]) !!}
                    <button type="submit" class="btn btn-danger btn-block ">Delete</button>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('ValidationJavaScript')




@endsection