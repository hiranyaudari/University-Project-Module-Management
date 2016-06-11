<?php namespace App\Http\Controllers;

use App\freeslot;
use App\Http\Requests;
use App\Project;
use App\monthlyfeed;
use App\report;
use App\schedule;
use App\Panel_member;
use App\External_supervisor;
use App\User;


class Viewcontroller extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function viewfb()
    {
        //
        $vfb = monthlyfeed::all();
        return view('auth.viewfeedback' ,compact('vfb'));
    }

  /*  public function viewfb()
    {
        //
        $vfb = monthlyfeed::all();
        return view('auth.viewfeedback' ,compact('vfb'));
    }*/

    public function viewfs()
    {
        //
        $fs = freeslot::all();
        return view('auth.viewfreeslot' ,compact('fs'));
    }

    public function ind()
    {
        //
        $rp = report::all();
        return view('auth.reportfile' ,compact('rp'));
    }

    public function fb()
    {
        //
        $feed = monthlyfeed::all();

        $currentUserID = "johnd";//Auth::user()->username;

        $currentSupID=User::join('panelmembers','users.username','=','panelmembers.username')
            ->where('panelmembers.username','=',$currentUserID)
            ->select('panelmembers.id')
            ->get();

        $projectPool=Project::join('students','projects.studentId','=','students.id')
            ->where('projects.supervisorId','=',$currentSupID[0]->id)
            ->select('projects.title','students.regId')
            ->get();



        //$supervisors=$projectPool::lists('projects.title','projects.title');

       // $studentID =  $projectPool::lists('students.regId','students.regId');


        return view('auth.feed')->with('studentd',$projectPool);

    }

    public function pr()
    {
        //
        $prg = progress::all();
        return view('auth.feed' ,compact('prg'));
    }

    public  function panelview(){
        return view('auth.viewpanelmemb');
    }




    public  function supview(){
        return view('auth.viewextsup');
    }

   // public  function scheduleview(){
     //   return view('auth.viewschedule');
   // }



}
