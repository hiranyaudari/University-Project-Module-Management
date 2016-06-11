
@extends('masterpages.master_student')
@section('content_header')
Feedback
@stop

@section('content_sub_header')
Feedback
@stop

@section('main_content')

<div class="ibox float-e-margins">
                        <div class="ibox-title">


                        </div>
                        <div class="ibox-content">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                          <th>Edit</th>
                                          <th>Student_ID</th>
                                          <th>Project_ID</th>
                                          <th>Date</th>
                                          <th>Feedback</th>

                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($vfb as $sch)



                                       <tr>
                                       <td><input  type="checkbox" name="checkbox[]" value="{{$sch->id}}" ></td>

                                       <td> {{$sch->student_id}}</td>
                                       <td> {{ $sch->Project_id }}</td>
                                       <td> {{ $sch->date }}</td>
                                       <td> {{ $sch->feedback}}</td>

                                       </tr>




                                       @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>








 <td> <button type="submit" class="btn btn-w-m btn-primary" name="add ">Delete</button></td>


  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
@stop