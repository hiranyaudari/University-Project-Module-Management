<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Requests;
use App\Student;
use Illuminate\Support\Facades\Input;
use Fenos\Notifynder\Facades\Notifynder;
use Crypt;
class projectController extends Controller
{

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    function externalSupervisorConfirmation($StudentId,$projectId){
        $student =Student::where('id',$StudentId)->get();
        $project = Project::where('id',$projectId)->get();
        return view('notification.external_Supervisor_confirmaion',compact('student','project'));
    }
   public function viewProjectPool()
    {
        $projectPool=Project::join('students','projects.studentId','=','students.id')
                        ->select('projects.title','projects.description','students.regId','students.name','students.email','students.phone')
                        ->where('supervisorId','=',null)
                        ->get();
        return view('Final.projectPool')->with('pro',$projectPool)->with('message','');
    }

//Supervisor view project pool
public function showProjectPool($supId){
        $count=Project::where('supervisorId','=',$supId)->count();
        if($count==10)
        {
            $projectPool=Project::join('students','projects.studentId','=','students.id')
                ->select('projects.id','projects.title','projects.description','students.regId','students.name','students.email','students.phone')
                ->where('projects.supervisorId','=',null)
                ->get();
            return view('Final.TenSelected')->with('pro',$projectPool)->with('message','You have already selected 10 projects');
        }
        else
        {
            $projectPool=Project::join('students','projects.studentId','=','students.id')
                ->select('projects.id','projects.title','projects.description','students.regId','students.name','students.email','students.phone')
                ->where('projects.supervisorId','=',null)
                ->get();
            return view('Final.projectPool')->with('pro',$projectPool)->with('message','');
        }

 }
    public function test(){
        return view('masterpages.student_master');
    }
    //Supervisor selects from project pool
    public function selectProjectPool($supId)
    {
        $count=Project::where('supervisorId','=',$supId)->count();

        if (isset($_POST['add']))
        {
            $checkCount=0;
            foreach ($_POST['checkbox'] as $checkbox)
            {
                $checkCount++;
            }
            $canSelect=(10-$count);
            if($checkCount<=$canSelect)
            {
                foreach ($_POST['checkbox'] as $checkbox)
                {
                    $proSelected=Project::find($checkbox);
                    $proSelected->supervisorId=$supId;
                    $proSelected->save();
                }
                $projectPool=Project::join('students','projects.studentId','=','students.id')
                    ->select('projects.id','projects.title','projects.description','students.regId','students.name','students.email','students.phone')
                    ->where('projects.supervisorId','=',null)
                    ->get();
                return view('Final.projectPool')->with('pro',$projectPool)->with('message',"You have successfully selected $checkCount projects");

            }
            else
            {
                $projectPool=Project::join('students','projects.studentId','=','students.id')
                    ->select('projects.id','projects.title','projects.description','students.regId','students.name','students.email','students.phone')
                    ->where('projects.supervisorId','=',null)
                    ->get();

                $message="Sorry you can only select $canSelect projects";
                return view('Final.projectPool')->with('pro',$projectPool)->with('message',$message);
            }
        }
    }


function getProjectDetailsByName(){
    $projectName = Input::get('projectId');


    $projectPool=Project::join('students','projects.studentId','=','students.id')
        ->join('panelmembers','projects.supervisorId','=','panelmembers.id')
        ->select('projects.id','panelmembers.name as supName','projects.title','projects.description as pDescription','students.regId as regId','students.name as sName','students.email','students.phone')
        ->where('projects.id','=',$projectName)
        ->get();

    $rows = Project::where('title', $projectName)->get();

    return json_encode($projectPool);
 ///   return json_encode($projectName); ///View::make('backend.admin.testResults.index')->with('rows', $rows);
}

    public  function downloadRequestedProject($filename){
        $file = public_path().'\uploads\projects\\'.$filename;
        return response()->download($file);
    }

    public function showSpecificProjectDet($studentId,$notificationId,$projectId){
//        dd(Crypt::decrypt($notificationId));
        Notifynder::readOne($notificationId);
        $project = Project::where('id',$projectId)->get()->first();
        $student = Student::where('id',$studentId)->get()->first();
        return view('notification.action_project_request',compact('student','project'));
    }

    public function AcceptProject(){
        $projectid = Input::get('projectId');
        Project::where('id',$projectid)->update([
            'status' => 'Approved'
        ]);
        return response()->json([

        ]);
    }
    public function RejectProject(){
        $projectid = Input::get('projectId');
        Project::where('id',$projectid)->update([
            'status' => 'Rejected'
        ]);
        return response()->json([

        ]);
    }
    function acceptInternalSupervisorForProject(){
        $supervisorId = Input::get('InternalSupervisorId');
        $projectId = Input::get('projectId');
        Project::where('id',$projectId)->update([
            'supervisorId'  => $supervisorId
        ]);



        $url ='/notificationForSupervisor/'.$projectId.'/'.$supervisorId;
        Notifynder::category('InternalSupervisorRequestNotification')
            ->from('RPC')
            ->to($supervisorId)
            ->url($url)
            ->send();
    }
    function rejectInternalSupervisorForProject(){
//        $supervisorId = Input::get('InternalSupervisorId');
        $projectId = Input::get('projectId');
        Project::where('id',$projectId)->update([
            'supervisorId'  => null
        ]);
    }
    function updateStatusAndSupervisor($supervisorId,$ProjecID){

    }
}
