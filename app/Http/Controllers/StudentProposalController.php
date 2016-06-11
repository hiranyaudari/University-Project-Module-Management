<?php namespace App\Http\Controllers;
use App\Project;
use App\ProposalEvaluation;
use App\PropasalEvaluationDetails;
use Request;
use App\Student;
use App\PanelMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;
use Session;
use Sentinel;
class StudentProposalController extends Controller {

    //VIEW REGISTRATION FORM
    public function viewRegistrationForm(){
        $userId = Sentinel::getUser()->id;
        $stu=Student::where('id',$userId )->select('name','id','regId')->first();
        $prj=Project::where('studentId',$stu->id)->select('supervisorId','title')->first();
        $sup=PanelMember::where('id',$prj->supervisorId)->pluck('name');

        return view('ProposalEvaluation.Student.projectReRegistration',compact('stu','prj','sup'));
    }

    //REGISTER
    public function Registration(){
        if(isset($_POST['Register'])){

            $validation = Project::validate(Input::all());

            if ($validation->fails()) {

                return redirect('projectReRegistration')
                    ->withErrors($validation)
                    ->withInput();
            }

            else{
                    $name=Input::get('NewProject');
                    $desc=Input::get('description');
                    $sup=Input::get('supervisor');
                    $stu=Input::get('registration_no');


                    $stuID=Student::where('regId',$stu)->pluck('id');
                    $supID=PanelMember::where('name',$sup)->pluck('id');

                    Project::create(['title' => $name, 'description' => $desc, 'supervisorId' => $supID, 'studentId' =>$stuID ,'status'=>'Pending']);
                    Session::flash('success', 'Registered Successfully.');
                    return redirect('projectReRegistration');


                }
            }







    }

    //STUDENT PROGRESS VIEW
    public  function viewStatus(){
        $ev=ProposalEvaluation::where('student_id','IT13113728')->select('id','status','project_id','feedback')->first();
        $prj= Project::where('id',$ev->project_id)->select('title','supervisorId')->first();
        $name=PanelMember::where('id',$prj->supervisorId)->pluck('name');
        $marks=PropasalEvaluationDetails::where('proposal_id',$ev->id)->sum('marks');
        $date1=PropasalEvaluationDetails::where('proposal_id',$ev->id)->pluck('created_at');
        $date = date('d-m-Y', strtotime($date1));

        return view('ProposalEvaluation.Student.feedback',compact('ev','prj','name','marks','date'));

    }


}
