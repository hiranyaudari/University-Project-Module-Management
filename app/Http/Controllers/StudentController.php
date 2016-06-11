<?php namespace App\Http\Controllers;

use App\Notice;
use App\PendingProject;
use App\Project;
use App\ProjectPool;
use App\User;
use App\ExternalSupervisor;
use App\ExtSupProject;
use App\Http\Requests;
use App\PanelMember;
use App\Student;
use App\Fileentry;
use Fenos\Notifynder\Facades\Notifynder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Input, Redirect, DB, Hash, Mail, URL, Response;
use App\newSupervisorRequest;
use App\thesisEvaluation;
use App\ProposalEvaluation;
use App\PropasalEvaluationDetails;

use Session;
class StudentController extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function showDashboard(){
        $notices = Notice
            ::all();

        return view('dashboards.student_dashboard',compact('notices'));
    }

    public function showSuccess () {
        return view('completeregister');
    }

    public function login() {
        return view('auth.login');
    }

    public function registration() {
        $supervisors = PanelMember::where('type','=','Internal Supervisor')->select('name','id')->get();
        return view('studentRegistration',compact('supervisors'));
    }

    public function doRegistration()
    {
        $validator = Student::validateFields();
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else {

            StudentController::addUser(
                Input::get('email'),
                Input::get('password'
                ));
            $studentNo = StudentController::addStudent(
                Input::get('studentname'),
                Input::get('regId'),
                Input::get('email'),
                Input::get('telephone'),
                Input::get('attempt'),
                Input::get('regId'),
                'IT'
            );
            $renamedFileName = StudentController::uploadFile(Input::file('txtFile'),'/public/uploads/projects/',Input::get('regId'));
            $supervisorType = Input::get('supervisortype');
            if ($supervisorType === 'external') {

                StudentController::addUser(
                    Input::get('supervisorEmail'),
                    str_random(10));

                //add values to panel Member table
                $supervisorID = StudentController::addPanelMember(
                    Input::get('supervisorName'),
                    Input::get('supervisorDesignation'),
                    Input::get('supervisorEmail'),
                    Input::get('supervisorTelephone'),
                    null,
                    'External Supervisor',
                    Input::get('supervisorInstitute'),
                    null,
                    null,
                    'Pending');

//                //add values to project table
                $projectId =  StudentController::addProject(
                    Input::get('projectTitle'),
                    Input::get('projectDescription'),
                    $renamedFileName,
                    $studentNo,
                    null,
                    'Pending'
                );

//
                $url ='/viewSupervisorDetails/'.$projectId.'/'.$supervisorID;
                Notifynder::category('ConfirmExternalSupervisorRequest')
                    ->from(Input::get('regId'))
                    ->to('RPC')
                    ->url($url)
                    ->send();



//                Mail::send('emails.forgotpassword', array('link' => URL::route('password-recover', $code), 'name' => $student->name, 'password' => $password, 'time' => $passwordReset->created_at->format('Y-m-d H:i:s')), function ($message) use ($student, $user) {
//                    $message->to($student->email, $student->name)->subject('Password Change Request');
//                });


            } elseif ($supervisorType === 'internal') {

                $InternalPanelMemberEmail =  PanelMember::where('id',Input::get('internalsupervisor'))->pluck('email');

                //add values to project table
                $projectId = StudentController::addProject(
                    Input::get('projectTitle'),
                    Input::get('projectDescription'),
                    $renamedFileName,
                    $studentNo,
                    null,
                    'Pending');

                $url ='/confirmForSupervisor/'.$projectId.'/'.Input::get('internalsupervisor');
                Notifynder::category('ConfirmInternalSupervisorRequest')
                    ->from(Input::get('regId'))
                    ->to('RPC')
                    ->url($url)
                    ->send();
                $url ='/RequestSupervisorAsYou/'.$projectId.'/'.$studentNo;
                Notifynder::category('RequestSupervisorAsYou')
                    ->from(Input::get('regId'))
                    ->to($InternalPanelMemberEmail)
                    //Input::get('internalsupervisor').' StudentToPanelMember'
                    ->url($url)
                    ->send();

            } elseif ($supervisorType === 'none') {
                //add values to project table
                $projectId = StudentController::addProject(
                    Input::get('projectTitle'),
                    Input::get('projectDescription'),
                    $renamedFileName,
                    $studentNo,
                    null,
                    'Pending'
                );

                $url='/doesNotHaveSupervisor/'.$studentNo.'/'.$projectId;
                Notifynder::category('HasNoSupervisor')
                    ->from(Input::get('regId'))
                    ->to('RPC')
                    ->url($url)
                    ->send();
                Notifynder::category('HasNoSupervisor')
                    ->from(Input::get('regId'))
                    ->to('AllSupervisors')
                    ->url($url)
                    ->send();
            }
            $url='/viewProjectDetails/'.$studentNo.'/'.$projectId;
            Notifynder::category('ConfirmProjectRequest')
                ->from(Input::get('regId'))
                ->to('RPC')
                ->url($url)
                ->send();

            return Redirect::to('/login');

        }
    }




    public function  view_student()
    {
        $no = Notice::all();
        return view('Student.Students', compact('no'));
    }


    public  function downloadFile($filename){
        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = storage_path('app') . '/' . $entry ->original_filename;
        return response()->download($file);
    }



    public function viewpdffile($filename1){
        $entry = Fileentry::where('filename', '=', $filename1)->firstOrFail();
        $path = storage_path('app') . '/' . $entry ->original_filename;
        header('content-type:application/pdf');
        echo file_get_contents($path);
        return view('Student.view1');

    }

    public function uploadFile($file,$destination,$filename)
    {

        if ($file != null) {
            $extension = $file->getClientOriginalExtension();
            $renamedFileName = $filename.'-'.rand(11111, 99999) . '.' . $extension;

            $file->move(
                base_path() . $destination, $renamedFileName
            );
            return $renamedFileName;
        }
    }
    public function addUser($email,$password){
        $user= Sentinel::registerAndActivate(array(
            'email'    => $email,
            'password' => $password,
        ));
//        $user = Sentinel::findById(1);
        $role = Sentinel::findRoleByName('Students');
        $role->users()->attach($user);
    }
    public function addStudent($name,$regId,$email,$tel,$attempt,$username,$courseField){
        $entry =new Student;
        $entry->name = $name;
        $entry->regId = $regId;
        $entry->email = $email;
        $entry->phone = $tel;
        $entry->attempt = $attempt;
        $entry->username = $username;
        $entry->courseField = $courseField;

        if($entry->save()){
            return $entry->id;
        }

    }

    public function addPanelMember($supName,$supDesignation,$supEmail,$supTel,$supSpeciality,$supType,$supUniversity,$supCvu,$userName,$supStatus){
        $entry =new PanelMember;
        $entry->name = $supName;
        $entry->designation = $supDesignation;
        $entry->email = $supEmail;
        $entry->phone = $supTel;
        $entry->speciality = $supSpeciality;
        $entry->type = $supType;
        $entry->university = $supUniversity;
        $entry->cv = $supCvu;
        $entry->username = $userName;
        $entry->status = $supStatus;

        if($entry->save()){

            return $entry->id;
        }

    }

    public function addProject($projectTitle,$projectDescription,$projectUrl,$projectStudentNo,$projectSupervisorId,$projectStatus){
        $entry = new Project;
        $entry->title = $projectTitle;
        $entry->description = $projectDescription;
        $entry->url = $projectUrl;
        $entry->studentId = $projectStudentNo;
        $entry->supervisorId = $projectSupervisorId;
        $entry->status = $projectStatus;

        if($entry->save()){
            return $entry->id;
        }
    }

    //VIEW SUPERVISOR CHANGE REQUEST FORM
    public function viewChangeSupervisorForm(){

        $userId = Sentinel::getUser()->id;
        $stu=Student::where('id',$userId)->select('id','name','regId')->first();
        $project=Project::where('studentId',$stu->id)->select('supervisorId','title','id')->first();

        $supervisor=PanelMember::where('id',$project->supervisorId)->pluck('name');
        $supervisors=PanelMember::where('id','!=',$project->supervisorId)->select('id','name')->get();

        return view('Student.changeSupervisor',compact('stu','project','supervisor','supervisors'));
    }

    public function insertChangeSupervisorDetails()
    {
        if (isset($_POST['change'])) {

            $validation = newSupervisorRequest::validate(Input::all());

            if ($validation->fails()) {

                return redirect('/changeSupervisor')
                    ->withErrors($validation)
                    ->withInput();
            }
            else {

                $projectID = Input::get('prjID');
                $newSupervisorID = Input::get('newSupervisor');
                $description = Input::get('description');
            }

            newSupervisorRequest::create(['projectID' => $projectID, 'newSupervisorID' => $newSupervisorID, 'description' => $description,'status'=>'Pending']);

            Session::flash('success', 'Request have been sent Successfully.');
            return redirect('changeSupervisor');

        }

    }

    //STUDENT PROGRESS VIEW
    public  function viewStatus()
    {

        $userId = Sentinel::getUser()->id;
        $prj = Project::where('studentId', $userId)->first();
        $name = PanelMember::where('id', $prj->supervisorId)->pluck('name');

        $details = thesisEvaluation::where('projectId', $prj->id)->first();

        //TOTAL MARKS
        if ($details !== NULL){
            $marks = $details->independentScientificThinking + $details->scientificKnowHow + $details->logic + $details->presentation + $details->workProcess;

            $date1 = $details->date;
            $date = date('d-m-Y', strtotime($date1));
        }

        $ev=ProposalEvaluation::where('project_id',$prj->id)->select('id','status','project_id','feedback')->first();
        if ($ev !== NULL) {
            $marksProp = PropasalEvaluationDetails::where('proposal_id', $ev->id)->sum('marks');
            $date12 = PropasalEvaluationDetails::where('proposal_id', $ev->id)->pluck('created_at');
            $dateProp = date('d-m-Y', strtotime($date12));
        }

        return view('Student.feedback',compact('details','prj','name','marks','date','ev','marksProp','dateProp'));

    }
}
