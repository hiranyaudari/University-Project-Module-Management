<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\PanelMember;
use App\Project;
use App\Student;
use Session;
use Validator, Input, Redirect, Hash, Mail, URL, Response;
use Fenos\Notifynder\Facades\Notifynder;
use Crypt;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Fenos\Notifynder\Notifable;


class notificationController extends Controller {



    public function __construct()
    {
//        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function showRpcNotification($projectId,$notificationId,$id){
        Notifynder::readOne($notificationId);
        $supervisor = PanelMember::where('id',$id)->get()->first();
        $project = Project::where('id',$projectId)->get()->first();
        $student  = Student::where('id',$project->studentId)->first();
        return View('notification.viewExternalSpecificSupervisor',
            compact('supervisor','project','student','notificationId'));
    }

    public function ReadNotification($notificationId)
    {
        Notifynder::readOne($notificationId);
        return Redirect::back();
    }
    public static function GetAllNotification($currentUserRole)
    {
        $allNotification = Notifynder::getAll($currentUserRole);
        return compact('allNotification');
    }

    public static function GetAllUnreadNotification($currentUserRole)
    {
        $allUnreadNotification = Notifynder::getNotRead($currentUserRole);
        return compact('allUnreadNotification');
    }
    public function UnreadNotification(){
        $notificationId = Input::get('notificationId');
        DB::table('notifications')->where('id',$notificationId)->update([
            'read' => 0
        ]);
        return response()->json([
            'id' => $notificationId,

        ]);
    }
    public static function showNotificationAccordingToCurrentUser()
    {

        if (Sentinel::check()) {
            $currentUserPosition = Sentinel::getUser()["roles"][0]["name"];
            $email = Sentinel::getUser()["email"];

            Session::forget('userName');
            Session::forget('userPosition');

            Session::push('userName', $email);
            Session::push('userPosition', $currentUserPosition);

            //get all notification belong to Panel Member
            $AllNotificationOnlyForCurrentPanelMemberFromStudent = notificationController::GetAllNotification(Sentinel::getUser()->email);
            $AllUnreadNotificationOnlyForCurrentPanelMemberFromStudent = notificationController::GetAllUnreadNotification(Sentinel::getUser()->email);



            if (Sentinel::check()->inRole('rpc')) {
                //if logged user role is equals to rpc do this
                Session::forget('notification.BelongsToRPC');
                Session::forget('notification.UnreadBelongsToRPC');

                //get all notification belong to RPC
                $AllNotificationOnlyForRPC = notificationController::GetAllNotification('RPC');
                $AllUnreadNotificationOnlyForRPC = notificationController::GetAllUnreadNotification('RPC');

                //push notification belong to Student to RPC Session
                Session::push('notification.BelongsToRPC', $AllNotificationOnlyForRPC);
                //push Unread notification belong to Student to RPC Session
                Session::push('notification.UnreadBelongsToRPC', $AllUnreadNotificationOnlyForRPC);
                //push notification belong to Student to BelongsToPanelMember Session
                Session::push('notification.BelongsToRPC', $AllNotificationOnlyForCurrentPanelMemberFromStudent);
                Session::push('notification.UnreadBelongsToRPC', $AllUnreadNotificationOnlyForCurrentPanelMemberFromStudent);

            } elseif (Sentinel::check()->inRole('panelmembers')) {
                //if logged user role is equals to panelmembers do this
                $panelMemberObject = PanelMember::where('email', Sentinel::getUser()->email)->get();
                $currentUserPanelMemberId = $panelMemberObject[0]['id'];
                $panelMemberType = $panelMemberObject[0]['type'];

                //get current project Supervisor project Count
                $queryGetCurrentUserProjectCount = Project::select(DB::raw('count(supervisorId) as supervisorProjectCount'))
                    ->groupBy('supervisorId')
                    ->where('supervisorId', $currentUserPanelMemberId)
                    ->get();

                Session::forget('notification.BelongsToPanelMember');
                Session::forget('notification.UnreadBelongsToPanelMember');
                //check weather current user project count less than or equal to 10
                //check weather current user is a supervisor
                //get notification from db for count less than 10
                if ($panelMemberType == 'Internal Supervisor' AND $queryGetCurrentUserProjectCount[0]['supervisorProjectCount'] <= 10) {

                    //get all notification belong to Internal Supervisor
                    $notificationForInternalSupervisor = notificationController::GetAllNotification('AllSupervisors');
                    $AllUnreadNotificationOnlyForInternalSupervisor = notificationController::GetAllUnreadNotification('AllSupervisors');

//                    $AllNotificationOnlyForCurrentUserFromRPC = notificationController::GetAllNotification(Sentinel::getUser()->email);
//                    $AllUnreadNotificationOnlyForCurrentUserFromRPC = notificationController::GetAllUnreadNotification(Sentinel::getUser()->email);

                    //push notification belong to Student to BelongsToPanelMember Session
                    Session::push('notification.BelongsToPanelMember', $notificationForInternalSupervisor);
//                    Session::push('notification.BelongsToPanelMember', $AllNotificationOnlyForCurrentUserFromRPC);

                    //push Unread notification belong to Student to BelongsToPanelMember Session
                    Session::push('notification.UnreadBelongsToPanelMember', $AllUnreadNotificationOnlyForInternalSupervisor);
//                    Session::push('notification.UnreadBelongsToPanelMember', $AllUnreadNotificationOnlyForCurrentUserFromRPC);
//                    Session::push('notification.UnreadBelongsToPanelMember', $AllUnreadNotificationOnlyForCurrentPanelMemberFromStudent);

                    //push notification belong to Student to BelongsToPanelMember Session
                    Session::push('notification.BelongsToPanelMember', $AllNotificationOnlyForCurrentPanelMemberFromStudent);
                    Session::push('notification.UnreadBelongsToPanelMember', $AllUnreadNotificationOnlyForCurrentPanelMemberFromStudent);
                }
            } elseif (Sentinel::check()->inRole('students')) {
                //if logged user role is equals to Students do this
                Session::forget('notification.BelongsToStudent');
                Session::forget('notification.UnreadBelongsToStudent');

                $studentObject = Student::where('email', Sentinel::getUser()->email)->get();
                $studentID = $studentObject[0]['id'];
//                $AllNotificationOnlyForCurrentStudent = notificationController::GetAllNotification(Sentinel::getUser()->email);
//                $AllUnreadNotificationOnlyForCurrentStudent = notificationController::GetAllUnreadNotification(Sentinel::getUser()->email);

                //get all notification belong to Student
                $AllNotificationOnlyForStudent = notificationController::GetAllNotification('Student');
                $AllUnreadNotificationOnlyForStudent = notificationController::GetAllUnreadNotification('Student');

                //push notification belong to Student to BelongsToStudent Session
                Session::push('notification.BelongsToStudent', $AllNotificationOnlyForStudent);
                Session::push('notification.UnreadBelongsToStudent', $AllUnreadNotificationOnlyForStudent);

                Session::push('notification.BelongsToStudent', $AllNotificationOnlyForCurrentPanelMemberFromStudent);
                Session::push('notification.UnreadBelongsToStudent', $AllUnreadNotificationOnlyForCurrentPanelMemberFromStudent);
                //push notification belong to Student to BelongsToStudent Session
//                Session::push('notification.BelongsToStudent', $AllNotificationOnlyForCurrentStudent);
//                Session::push('notification.UnreadBelongsToStudent', $AllUnreadNotificationOnlyForCurrentStudent);

            } else {

            }
        }
    }

}
