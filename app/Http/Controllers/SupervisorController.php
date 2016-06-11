<?php namespace App\Http\Controllers;

use App\Http\Requests\RegSup;
use App\User;
use App\PanelMember;
use App\Project;
use App\Student;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Hash, Mail, URL;
use Session;
use Fenos\Notifynder\Facades\Notifynder;


class SupervisorController extends Controller
{

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    function updateSupindex()
    {


        $wh1 = array("type" => "Internal Supervisor");
        $wh2 = array("type" => "External Supervisor");

        $categories = PanelMember::where($wh1)->lists('username', 'username');
        $categories2 = PanelMember::where($wh2)->lists('username', 'username');

        $info = array('Select One..');
        $categories1 = $info + $categories + $categories2;
        $currentUser = "";
        $currentUserPosition = "";

        return view('UpdateExternalSupervisor', compact('currentUser', 'currentUserPosition', 'categories1', 'user'));
    }

    function updateSupervisor()
    {


    }

    function search()
    {

        $userName = Input::get('sid');
        $email = PanelMember::where('username', $userName)->pluck('email');
        $fullname = PanelMember::where('username', $userName)->pluck('name');
        $designation = PanelMember::where('username', $userName)->pluck('designation');
        $phone = PanelMember::where('username', $userName)->pluck('phone');
        $spe = PanelMember::where('username', $userName)->pluck('speciality');
        $type = PanelMember::where('username', $userName)->pluck('type');
        $status = PanelMember::where('username', $userName)->pluck('status');
        $uni = PanelMember::where('username', $userName)->pluck('university');

        $data = array(
            "email" => $email,
            "fullname" => $fullname,
            "designation" => $designation,
            "phone" => $phone,
            "spe" => $spe,
            "type" => $type,
            "status" => $status,
            "uni" => $uni);

        return json_encode($data);
    }


    function updateUserindexstore()
    {
        $UserName = Input::get('username');
        $email = Input::get('email');
        $fullName = Input::get('fullName');
        $role = Input::get('role');


        $designation = Input::get('designation');
        $tel = Input::get('tel');
        $speciality = Input::get('speciality');
        // $status = Input::get('status');
        $uni = Input::get('uni');

        $q = PanelMember::where('username', $UserName)->update(['name' => $fullName,
            'email' => $email,
            'designation' => $designation,
            'university' => $uni, 'phone' => $tel, 'speciality' => $speciality]);


        return $q;


    }




    ////////////////////////////////////////////////////////////

// Supervisor can view their own projects
    public function viewProjects($supId)
    {
        $projects = Project::join('students', 'projects.studentId', '=', 'students.id')
            ->select('projects.title', 'projects.description', 'students.regId', 'students.name', 'students.email', 'students.phone')
            ->where('projects.supervisorId', '=', $supId)
            ->get();

        return view('Final.viewProjects')->with('myProjects', $projects)->with('message', '');

    }

    public function create()
    {
        return view('Final.externalSup')->with('message', '');
    }

    //Register external supervisor
    public function store(RegSup $sup)
    {

        //dd(Input::file('cvAttachment'));

        $unique = true;

        $FullName = $sup->name;
        $Email = $sup->email;
        $contactNo = $sup->phone;
        $workPlace = $sup->university;
        $designation = $sup->designation;
        $speciality = $sup->speciality;
        $username = $sup->username;
        $password = $sup->password;


        $supervisors = PanelMember::all();
        $emailIds = $supervisors->lists('email');

        foreach ($emailIds as $email) {
            if ($email == $Email) {
                $unique = false;
            }
        }

        $logins = User::all();
        $usernames = $logins->lists('username');

        foreach ($usernames as $user) {
            if ($user == $username) {
                $unique = false;
            }
        }


        if (Input::file('cvAttachment')->isValid()) {
            $destinationPath = 'uploads/panel member/External supervisor/cv/';
            $extension = Input::file('cvAttachment')->getClientOriginalExtension();
            $fileName = Input::get('name') . '_cv' . '.' . $extension;
            Input::file('cvAttachment')->move($destinationPath, $fileName);

        }

        if ($unique) {
            User::create(['username' => $username, 'password' => $password, 'role' => 'Panel Member']);
            PanelMember::create(['name' => $FullName, 'email' => $Email, 'phone' => $contactNo, 'university' => $workPlace, 'designation' => $designation, 'speciality' => $speciality, 'username' => $username, 'password' => $password, 'cv' => $destinationPath . $fileName, 'type' => 'External Supervisor', 'status' => 'Approved']);

            \Session::flash('message_success', 'Registration Successful!!');
            return Redirect::to('/ExternalSup');


        } else {

            return view('Final.externalSup')->with('message', 'Try with a different email address');
        }


    }

    public function changeSupervisors()
    {

        $supervisors = PanelMember::lists('name', 'id');

        $proDetails = Project::where('status', 'Approved')->lists('title', 'id');

        return view('changeSupervisor')->with('supervisors', $supervisors)->with('pro', $proDetails);
    }

    public function changeSupervisorsstore()
    {
        $projectId = Input::get('projectID');
        $supervisorId = Input::get('newSup');
        Project::where('id', $projectId)->update(['supervisorId' => $supervisorId]);
        return json_encode($projectId);
    }

    public function AcceptExternalSupervisor()
    {
        $panelMemberId = Input::get('panelMemberId');
        $panelMemberId = $panelMemberId;
        PanelMember::where('id', $panelMemberId)->update([
            'status' => 'Approved'
        ]);
        $panelMember = PanelMember::where('id', $panelMemberId);
        $email = $panelMember->pluck('email');
        $name = $panelMember->pluck('name');

        $link = '';
        Mail::send('emails.ExternalSupervisorAction', array('sds' => $link, 'name' => $name, 'projectName' => $email), function ($message) use ($email) {
            $message->to($email)->subject('Supervisor Registration into Msc Research Management');
        });

        return Response()->json([
            'success' => true,
            'email' => $email,
            'name' => $name
        ]);
    }

    public function RejectExternalSupervisor()
    {
        $panelMemberId = Input::get('panelMemberId');
        $panelMemberId = $panelMemberId;
        PanelMember::where('id', $panelMemberId)->update([
            'status' => 'Rejected'
        ]);
        return Response()->json([
            'success' => true
        ]);
    }

    function confirmSupervisorRegistration($projectId, $notificationID, $InternalSupervisorId)
    {
        Notifynder::readOne($notificationID);
        $project = Project::where('id', $projectId)->get()->first();
        $Internalsupervisor = PanelMember::where('id', $InternalSupervisorId)->get()->first();
        return View('notification.internal_supevisor_project_confirmation', compact('project', 'Internalsupervisor'));
        //dd(Crypt::decrypt($projectId));
//        Project::where('id',Crypt::decrypt($projectId))->update([
//            'supervisorId' => Crypt::decrypt($InternalSupervisorId)]);

    }


    function checkCurrentUserIsASupervisor()
    {
        $false = false;
    }

    function showDoseNotHaveSupervisor($studentId,
                                       $notificationId, $projectId)
    {
        Notifynder::readOne($notificationId);
        $project = Project::where('id', $projectId)->get()->first();
        $student = Student::where('id', $studentId)->get()->first();
        $supervisors = PanelMember::where('type', 'Internal Supervisor')->lists('name', 'id');
        return View('notification.action_project_no_supervisor', compact('student', 'project', 'supervisors'));


    }

    function SupervisorController()
    {
        $supervisorId = Input::get('panelMemberId');
        $projectId = Input::get('projectId');

        Project::where('id', $projectId)->update(['supervisorId' => $supervisorId]);

        return response()->json([
            'success' => 'true',
            'project ID' => $projectId,
            'sup_id' => $supervisorId
        ]);
    }

    function confirmproject($studentId, $projectId)
    {

        $project = Project::where('id', $projectId)->get()->first();
        $student = Student::where('id', $studentId)->get()->first();
        return View('notification.external_supervisor_confirm_view', compact('student', 'project'));
    }

    function RegisteredNotification($projectId, $notificationID, $InternalSupervisorId)
    {

        Notifynder::readOne($notificationID);
        $project = Project::where('id', $projectId)->get()->first();
        $Internalsupervisor = PanelMember::where('id', $InternalSupervisorId)->get()->first();
        return View('notification.internal_supevisor_accepted_notification_for_panel_member', compact('project', 'Internalsupervisor'));
    }

}