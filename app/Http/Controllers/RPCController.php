<?php namespace App\Http\Controllers;
use App\PanelMember;
use App\Student;
use DB;
use App\Project;
use App\Http\Requests;
use App\Pending_projects;
use Illuminate\Support\Facades\Redirect;
use App\Exsup_prj;
use Session;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Fenos\Notifynder\Facades\Notifynder;

class RPCController extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function showDashboard(){
        $ApprovedProjectCount =  Project::where('status','Approved')->count();
        $PendingProjectCount =  Project::where('status','Pending')->count();
        $RejectedProjectCount =  Project::where('status','Rejected')->count();
        $PEvaluatedProjectCount =  Project::where('status','Proposal Evaluated')->count();
        $TEvaluatedProjectCount =  Project::where('status','Thesis Approved')->count();

        $currentUserEmail = Sentinel::getUser()["email"];
        $currentPanelMemberId = PanelMember::where('email',$currentUserEmail)->pluck('id');

        $FutureProposalTimeSlotsForCurrentPanelMember = PanelMemberController::getFutureProposalTimeSlotsForCurrentPanelMember($currentPanelMemberId);
        $FutureThesisTimeSlotsForCurrentPanelMember = PanelMemberController::getFutureThesisTimeSlotsForCurrentPanelMember($currentPanelMemberId);

        $thesis_array = PanelMemberController::getArrayForEvents($FutureThesisTimeSlotsForCurrentPanelMember,'thesis');
        $proposal_array = PanelMemberController::getArrayForEvents($FutureProposalTimeSlotsForCurrentPanelMember,'proposal');

        $all_events_belongs_to_current_RPC = array_merge($thesis_array,$proposal_array);//array_merge($thesis_array,$proposal_array);


        $projectDetails = Project::join('students','projects.studentId','=','students.id')
            ->select('students.regId as StudentRegId','students.email as StudentEmail','students.phone as StudentTel','projects.title as projectTitle','projects.status as status','projects.updated_at as updatedDate')->get();




        return view('dashboards.rpc_dashboard',compact('projectDetails','all_events_belongs_to_current_RPC','ApprovedProjectCount','PendingProjectCount','RejectedProjectCount','PEvaluatedProjectCount','TEvaluatedProjectCount'));
    }

	public function viewPendingProjects()
	{

        $key2 = Project::select('projects.id','title','description','students.id','panelmembers.name')
//            ->where('panelmembers.type','=','External Supervisor')
            ->whereNull('projects.supervisorId')
//            ->orWhere('projects.status','=','Pending')
            ->leftjoin('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->leftjoin('students','students.id','=','projects.studentId')->get();

//        dd($key2);
        return view('Rpc-Projects.ViewPendingProjects',compact('extras','key2'));

    }


    public function approveRejectProjects()
    {
//        if (isset($_POST['reject'])) {
//            if (!empty($_POST['checkbox2'])) {
//
//                foreach ($_POST['checkbox2'] as $checkbox) {
//
//                    DB::table('projects')->where('id',$checkbox)->update(['projects.supervisorId'=>]);
//                    return Redirect::action('RPCController@approveRejectProjects');
//                }
//            }
//
//            else{
//
//                Session::flash('message', 'Nothing has selected');
//                return Redirect::action('RPCController@approveRejectProjects');
//            }

       if (isset($_POST['approve'])) {

            if (!empty($_POST['checkbox2'])) {


                foreach ($_POST['checkbox2'] as $checkbox) {

                    $email = Sentinel::getUser()["email"];
                    $currentUserId  = PanelMember::where('email',$email)->pluck('id');

                    DB::table('projects')->where('id','=',$checkbox)->update(['projects.supervisorId'=>$currentUserId]);
//                    DB::table('projects')->leftjoin('panelmembers','panelmembers.id','=','projects.supervisorId')->where('projects.id',$checkbox)->update(['panelmembers.status'=>'Approved']);
                    return Redirect::action('RPCController@approveRejectProjects');
                }
            }
            else{
                Session::flash('message', 'Nothing has selected');
                return Redirect::action('RPCController@approveRejectProjects');
            }


        }
    }

    public function viewOwnProjects()
    {
        $email= Sentinel::getUser()["email"];
       $panelMemberId =  PanelMember::where('email',$email)->pluck('id');
        $x=Project::select('projects.id','title','description','students.name','students.id as studentID')
            ->where('projects.supervisorId',$panelMemberId)
            ->where('projects.status','!=','Rejected')
            ->where('projects.status','!=','Pending')
            ->where('projects.status','!=','Completed')
            ->leftjoin('panelmembers','panelmembers.id','=','projects.supervisorId','AND')
            ->leftjoin('students','students.id','=','projects.studentId')->get();

        return view('RPC-Projects.RPCViewOwnProject')->with('key4',$x);
    }


    public function viewExternalSupervisorProjects()
    {

        $ExternalSupervisorProjects = Project::select('projects.id','title','description','students.name','panelmembers.email')
             ->where('panelmembers.type','External Supervisor','AND')
             ->where('panelmembers.status','Approved','AND')
             ->leftjoin('panelmembers','panelmembers.id','=','projects.supervisorId','AND')
             ->leftjoin('students','students.id','=','projects.studentId')->get();

        return view('RPC-Projects.viewExternalSupervisorProject')->with('key3',$ExternalSupervisorProjects);
    }


    public  function viewExternalSupervisorDetails($email){

       $r=PanelMember::where('email',$email)->get()->first();
       return view('RPC-Projects.externalSupervisorIDetail',compact('r'));
    }

    public  function viewStudentDetails($id){
        $r=Student::where('id',$id)->get()->first();
        return view('RPC-Projects.studentDetails',compact('r'));
    }


    public  function rejectedSupervisors(){

        $prjs = Project::select('projects.id','title','description','students.name','panelmembers.username')
            ->where('type','External Supervisor')->where('panelmembers.status','Rejected','AND')
            ->leftjoin('panelmembers','panelmembers.id','=','projects.supervisorId','AND')
            ->leftjoin('students','students.id','=','projects.studentId')->get();


        return view('Rpc-Projects.rejectedSupervisors',compact('prjs'));

    }



    public  function viewAllPanelmembers(){
        $r=PanelMember::select(DB::raw('count(projects.id) as count,name,designation,email,phone,speciality,panelmembers.id'))->where('type','!=','External Supervisor')->leftjoin('projects','projects.supervisorId','=','panelmembers.id','AND') ->groupBy('panelmembers.id')->get();
        return view('RPC-Projects.viewAllPanelmembers',compact('r'));
    }

    public  function viewProjectDetails($id){
        $t=Project::where('supervisorId',$id)->leftjoin('students','students.id','=','projects.studentId')->get();
        return view('RPC-Projects.projectDetail',compact('t'));
    }

    public  function viewAllExternalSupervisors(){
        $r=PanelMember::select(DB::raw('count(projects.id) as count,name,designation,email,phone,speciality,panelmembers.id,university,cv'))->where('type','External Supervisor')->where('panelmembers.status','Approved','AND')->leftjoin('projects','projects.supervisorId','=','panelmembers.id','AND') ->groupBy('panelmembers.id')->get();
        return view('RPC-Projects.approvedExternalSupervisors',compact('r'));
    }


    public  function viewAllProjects(){
        $AllProjects=Project::select('projects.id','title','description','students.name','panelmembers.email')
            ->where('panelmembers.status','Approved')
            ->leftjoin('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->leftjoin('students','students.id','=','projects.studentId')->get();

        return view('RPC-Projects.allProjects',compact('AllProjects'));
    }

}
