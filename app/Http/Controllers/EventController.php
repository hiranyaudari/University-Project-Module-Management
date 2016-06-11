<?php


namespace App\Http\Controllers;

use App\PanelMember;
use App\Project;
use App\Student;
use  Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\UserInterface;
use View;
use Illuminate\Support\Facades\DB;
use Hash;
use Mail;
use App\monthlyfeed;
use Session;
use App\event_time_line;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Fenos\Notifynder\Facades\Notifynder;


class EventController extends Controller{

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }
    // add event to current panel Member or Supervisor Request
    public function addEvent($validity,$type,$saveType){

        $eventName =   Input::get('eventName');
        $eventDate =   Input::get('eventDate');
        $eventTime =   Input::get('eventTime');
        $eventDescription =   Input::get('eventDescription');
        $currentUserEmail = Sentinel::getUser()["email"];

        $toID='';
        if($saveType=='Request'){
            $studentDetails = Student::where('email',$currentUserEmail)->get();
            $studentId =   $studentDetails[0]->id;

            $studentName =   $studentDetails[0]->name;
            $projectDetails = Project::where('studentId',$studentId)->get();
            $toID  =  $projectDetails[0]->supervisorId;
            $projectName = $projectDetails[0]->title;
            $SupervisorId = $projectDetails[0]->supervisorId;

            $eventName= $eventName." about ". $projectName. " project" ." with ". $studentName ;
            $from = $studentDetails[0]->regId;
            $email = PanelMember::where('id',$SupervisorId)->pluck('email');


            Notifynder::category('SupervisorMeetingRequestForSupervisor')
                ->from($from.'')
                ->to($email)
                ->url('')
                ->send();

        }else{
            $toID = PanelMember::where('email',$currentUserEmail)->pluck('id');
            $from = $toID;
        }

        $entry = new event_time_line;
        $entry->memberID = $toID;
        $entry->eventType = $type;
        $entry->eventName = $eventName;
        $entry->eventDate = $eventDate;
        $entry->eventTime = $eventTime;
        $entry->eventDescription = $eventDescription;
        $entry->validity = $validity;
        $entry->from = $from;
        if($entry->save()){
            return $eventName;
        }


    }
    public function deleteEvent(){
        $eventId =  Input::get('eventId');
        event_time_line::where('id',$eventId)->delete();
        return $eventId;
    }

    public function getEventDataForPanelMember(){
        $eventId =  Input::get('eventId');
       $eventData = event_time_line::where('id',$eventId)->where('validity','1')->get();
        return $eventData;
    }

    public  function updateEvent(){
        $eventId =  Input::get('eventId');
        $eventType =  Input::get('eventType');
        $eventName =   Input::get('eventName');
        $eventDate =   Input::get('eventDate');
        $eventTime =   Input::get('eventTime');
        $Description =   Input::get('eventDescription');

        event_time_line::where('id',$eventId)->update(['eventType'=>$eventType,'eventName'=>$eventName,'eventDate'=>$eventDate,'eventTime'=>$eventTime,'eventDescription'=>$Description]);
        return $eventId;
    }
    function AcceptOrReject(){
        $eventId =  Input::get('eventId');
        $action =  Input::get('actionType');
        $studentRegId =  Input::get('studentId');
        $ReplyText =  Input::get('NAInput');

        $StudentEmail = Student::where('regId',$studentRegId)->pluck('email');

        event_time_line::where('id',$eventId)->update(['validity'=>$action]);
        $currentUserEmail = Sentinel::getUser()["email"];
        $panelMemberId =PanelMember::where('email',$currentUserEmail)->pluck('id');

    if($action='1'){

        Notifynder::category('SupervisorMeetingRequestAccepted')
            ->from('Supervisor')
            ->to($StudentEmail)
            ->url('')
            ->extra(compact($ReplyText))
            ->send();

    }else{
        Notifynder::category('SupervisorMeetingRequestRejected')
            ->from('Supervisor')
            ->to($StudentEmail)
            ->url('')
            ->extra(compact($ReplyText))
            ->send();
    }



        return $eventId;
    }
    public function getCurrentUserTodayTimeLineEvents(){

        $currentUserEmail = Sentinel::getUser()["email"];
        $currentPanelMemberId = PanelMember::where('email',$currentUserEmail)->pluck('id');
        $currentPanelMemberTimeLine = event_time_line::where('memberID',$currentPanelMemberId)->where('eventDate','=',date("Y-m-d"))->where('validity','1')->orderBy('eventDate', 'asc')->get();
        return response()->json(['today'=>$currentPanelMemberTimeLine]);
    }

}