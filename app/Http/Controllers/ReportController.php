<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\intreport;
use App\PanelMember;
use App\feedback;
use App\Project;
use App\interimrpt;
use App\Student;
use App\Http\Controllers\Controller;
use Request;
use App\report;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ReportController extends Controller
{

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function index()
    {
        $entries['files'] = report::get();
        return view ('report', compact('entries'));
    }


    /**
     *Upload Thesis report based on student login
     * @return mixed
     *
     */
    public function add()
    {
        $rules = array(

            'date' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        // check if the validator failed -----------------------
        if ($validator->fails()) {

            return Redirect::to('report')->withErrors($validator)->withInput()->with('message', 'UPLOAD FAILED');

        } else {

            $StudentObject = Student::where('email',Sentinel::getUser()->email)->get();
            $currentUserId = $StudentObject[0]['id'];
            $currentProjectId  = Project::where ('studentId', $currentUserId)->pluck('id');
            $currentSupervisorId  = Project::where ('studentId', $currentUserId)->pluck('supervisorId');

            $file = Request::file('filefield');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put($file->getFilename() . '.' . $extension, File::get($file));
            $entry = new intreport();

            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename() . '.' . $extension;
            $entry->Student_no = $currentUserId;
            $entry->Project_id = $currentProjectId ;
            $entry->Supervisor_id = $currentSupervisorId ;
            $entry->date = Input::get('date');

            $entry->save();

            return Redirect::to('report')->with('message', 'Successfully uploaded!');
        }
    }

    public function ind()
    {
        $entries['files'] = report::get();
        return view ('report', compact('entries'));
    }

    /**
     * Display download link of thesis report for project searched by the supervisor
     * @return View
     */
    public function viewReport()
    {
        $panelMemberObject = PanelMember::where('email',Sentinel::getUser()->email)->get();
        $currentUserPanelMemberId = $panelMemberObject[0]['id'];
        $title = Input::get('title');
        $currentProjectId  = Project::where ('title', $title)->pluck('id');

        $rp=intreport::where('Supervisor_id','=',$currentUserPanelMemberId)
            ->where('Project_id','=',$currentProjectId)
            ->get();
        return view('auth.downloadreport', compact('rp'));

    }

    /**
     * @param $filename
     * @return $this
     */
    public function get($filename)
    {

        $entry = intreport::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }


    public function viewIntReport()
    {

        $StudentObject = Student::where('email',Sentinel::getUser()->email)->get();
        $currentUserId = $StudentObject[0]['id'];
        $rp = intreport::where('Student_no','=',$currentUserId)->get();

        return view ('auth.reportfile', compact('rp'));
    }

    /**
     * delete uploaded thesis report through student login. student can login, view and remove the report uploaded
     * @return mixed
     */
    public function deleterpt()
    {
        $rules = array(


            'checkbox' => 'required'


        );

        $validator = Validator::make(Input::all(), $rules);
        // check if the validator failed -----------------------
        if ($validator->fails()) {

            return Redirect::to('reportfile')->withErrors($validator)->withInput()->with('message', 'Select ID to delete');

        } else{
            if (isset($_POST['add'])) {

                foreach ($_POST['checkbox'] as $checkbox) {
                    $user = intreport::find($checkbox);


                    $user->delete();


                    return Redirect::to('reportfile')->with('message', 'Successfully deleted');
                }
            }



        }


    }


    /**
     * Supervisor can Add feedback for project progress which are under his/her supervision
     * @return mixed
     */
    public function addFeedback()
    {


        $rules = array(
            'regId' => 'required| unique:feedback,Student_no',
            'feedback' => 'required',

        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('interimfeed')->withErrors($validator)->withInput()->with('message', 'FAILED');
        } else {

            $student = Input::get('regId');
            $studentId  = Student::where ('regId', $student)->pluck('id');
            $ProjectId  = Project::where ('studentId', $studentId)->pluck('id');
            $SupervisorId  = Project::where ('studentId', $studentId)->pluck('supervisorId');

            $user = new feedback;
            $user->Student_no = $student;
            $user->Project_id = $ProjectId;
            $user->Supervisor_id = $SupervisorId;
            $user->date = Input::get('date');
            $user->feedback = Input::get('feedback');


            $user->save();


            if ($user->save())
                return Redirect::to('interimfeed')->with('message', 'Successfully saved!');


        }
    }


    /**
     *
     * @return View
     */
    public function viewFeedback()
    {
        $panelMemberObject = PanelMember::where('email',Sentinel::getUser()->email)->get();
        $currentUserPanelMemberId = $panelMemberObject[0]['id'];
        $rp =Project::join('students','projects.studentId','=','students.id')
            ->where('projects.supervisorId','=',$currentUserPanelMemberId)
            ->get();

        return view('auth.interimfeed', compact('rp'));


    }

    /**
     * suprvisor views student profile
     * @return View
     */
    public function studentInfo()
    {
        $panelMemberObject = PanelMember::where('email',Sentinel::getUser()->email)->get();
        $currentUserPanelMemberId = $panelMemberObject[0]['id'];

        $rp =Project::join('students','projects.studentId','=','students.id')
            ->where('projects.supervisorId','=',$currentUserPanelMemberId)
            ->get();
        return view('auth.studentinfo', compact('rp'));


    }

    /**
     * @return View
     *
     */
    public function downloadThesis()
    {
        $panelMemberObject = PanelMember::where('email',Sentinel::getUser()->email)->get();
        $currentUserPanelMemberId = $panelMemberObject[0]['id'];
        $rp = Project::where('supervisorId','=',$currentUserPanelMemberId)->get();
        return view('auth.downloadthesis', compact('rp'));


    }

    /**
     * @return View
     */
    public function viewProgress()
    {
        $StudentObject = Student::where('email',Sentinel::getUser()->email)->get();
        $currentUserId = $StudentObject[0]['id'];
        $studentId  = Student::where ('id', $currentUserId)->pluck('regId');

        $rp = feedback::where('Student_no','=',$studentId)->get();
        return view('auth.viewprogress', compact('rp'));


    }

    /**
     * @return View
     */
    public function viewStudentProfile(){
        $StudentObject = Student::where('email',Sentinel::getUser()->email)->get();
        $currentUserId = $StudentObject[0]['id'];
        $currentProjectId  = Project::where ('studentId', $currentUserId)->pluck('id');

        $studentProfile=Project::join('students','projects.studentId','=','students.id')
            ->join('panelmembers','projects.supervisorId','=','panelmembers.id')
            ->select('projects.id as projId','panelmembers.name as supervisorName','projects.title','projects.description as pDescription','students.regId as regId','students.name as sName','students.email','students.phone')
            ->where('projects.id','=',$currentProjectId)
            ->get();



        return view('studentprofile', compact('studentProfile'));


    }

    /**
     * @return View
     */
    public function viewStudentDetails(){
        $student = Input::get('studentId');
        $studentId  = Student::where ('regId', $student)->pluck('id');

        $ProjectId  = Project::where ('studentId', $studentId)->pluck('id');

        $Profile=Project::join('students','projects.studentId','=','students.id')
            ->join('panelmembers','projects.supervisorId','=','panelmembers.id')
            ->select('projects.id as projId','panelmembers.name as supervisorName','projects.title','projects.description as pDescription','students.regId as regId','students.name as sName','students.email','students.phone')
            ->where('projects.id','=',$ProjectId)
            ->get();



        return view('auth.profile', compact('Profile'));


    }



}