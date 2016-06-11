<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PanelMember;
use App\PresentationPanel;
use App\Student;
use Illuminate\Http\Request;
use App\thesisEvaluation;
use Illuminate\Support\Facades\Input;
use App\Project;
use App\thesisEvaluationForm;
use Session;
use App\ThesisPresentationPanel;
use Sentinel;

class thesisEvaluationController extends Controller
{
    //VIEW THESIS PRESENTATION WHICH ARE ASSIGNED
    public function viewPresentations()
    {
        $userId = Sentinel::getUser()->id;
        $date = date("Y-m-d");

        //GET PRESENTATION DETAILS WHICH ARE ASSIGNED ON CURRENT DATE OF LOGGED IN EXAMINER
        $projects = ThesisPresentationPanel::where('date', $date)->where(function ($query) use ($userId) {
                          return $query->where('memberOneId', $userId)->orWhere('memberTwoId', $userId);
                    }) ->leftjoin('projects', 'projects.id', '=', 'thesis_presentation_panels.projectId')
                       ->select('thesis_presentation_panels.*', 'projects.*')
                       ->get();

        //GET ALREADY EVALUATED PROJECTS
        $thesisProjects = thesisEvaluation::all();
        $pid = array();
        $i = 0;

              foreach ($thesisProjects as $thesisProject) {
                $pid[$i] = $thesisProject->projectId;
                $i++;
            }

        return view('thesisEvaluation.examiner.thesisPresentations', compact('projects', 'pid'));
    }


    //VIEW THESIS EVALUATION FORM
    public function  viewThesisForm($id)
    {
        $userId = Sentinel::getUser()->id;
        $panelMember=PanelMember::where('id',$userId)->pluck('name');
        $project = Project::where('id', $id)->first();
        $student = Student::where('id', $project->studentId)->first();


        //GET NEW VERSION/UPDATED THESIS EVALUATION FORM DETAILS
        $v=thesisEvaluationForm::get()->max('id');
        $version=thesisEvaluationForm::where('id',$v)->first();

        return view('thesisEvaluation.examiner.thesisEvaluationForm', compact('project', 'student','version','panelMember'));
    }

    //SUBMIT EVALUATED FORM
    public function evaluate()
    {
        if (isset($_POST['addThesisMarks'])) {

            $validation = thesisEvaluation::validate(Input::all());
            $project = Input::get('projectId');
            $userId = Sentinel::getUser()->id;

            if ($validation->fails()) {

                return redirect('thesisEvaluationForm/' . $project)
                    ->withErrors($validation)
                    ->withInput();
            }

            else {

                $marks1 = Input::get('independentScientificThinking');
                $marks2 = Input::get('scientificKnowHow');
                $marks3 = Input::get('logic');
                $marks4 = Input::get('presentation');
                $marks5 = Input::get('workProcess');
                $comment = Input::get('comment');
                $status = Input::get('status');
                $date = date("Y-m-d");

                //GET NEW VERSION/UPDATED THESIS EVALUATION FORM ID
                $version = thesisEvaluationForm::max('id');

                thesisEvaluation::create(['projectId' => $project, 'independentScientificThinking' => $marks1, 'scientificKnowHow' => $marks2, 'logic' => $marks3, 'presentation' => $marks4,
                    'workProcess' => $marks5, 'comment' => $comment, 'status' => $status, 'panelMember' => $userId, 'date' => $date, 'formVersion' => $version,'published'=>0]);

                Session::flash('success', 'Added Successfully.');
                return redirect('/thesisPresentations');

            }
        }
    }

   //VIEW OF EDITING THESIS EVALUATION FORM
    public function editThesisEvaluation($id)
    {
        $userId = Sentinel::getUser()->id;
        $panelMember=PanelMember::where('id',$userId)->pluck('name');

        $details = thesisEvaluation::where('projectId', $id)->first();
        $project = Project::where('projects.id', $details->projectId)
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->first();

        //GET THE VERSION ID OF THESIS EVALUATION FORM WHICH IS EVALUATED
        $version=thesisEvaluationForm::where('id', $details->formVersion)->first();

        //TOTAL MARKS
        $total=$details->independentScientificThinking + $details->scientificKnowHow + $details->logic + $details->presentation + $details->workProcess;

        return view('thesisEvaluation.examiner.editThesis', compact('details', 'project','version','total','panelMember'));
    }

    //EDIT EVALUATED THESIS EVALUATION FORM
    public function editForm()
    {

        if (isset($_POST['editThesisMarks'])) {

            $validation = thesisEvaluation::validate(Input::all());
            $id = Input::get('id');


            if ($validation->fails()) {

                return redirect('editThesis/' . $id)
                    ->withErrors($validation)
                    ->withInput();
            }

            else {

                $marks1 = Input::get('independentScientificThinking');
                $marks2 = Input::get('scientificKnowHow');
                $marks3 = Input::get('logic');
                $marks4 = Input::get('presentation');
                $marks5 = Input::get('workProcess');
                $comment = Input::get('comment');
                $status = Input::get('status');

                thesisEvaluation::where('projectId', $id)->update(['independentScientificThinking' => $marks1, 'scientificKnowHow' => $marks2, 'logic' => $marks3,
                    'presentation' => $marks4, 'workProcess' => $marks5, 'comment' => $comment, 'status' => $status]);

                return redirect('/thesisPresentations');

            }
        }
    }

    //VIEW EVALUATED THESIS EVALUATION FORM
    public function viewEvaluatedForm($id)
    {
        $details = thesisEvaluation::where('projectId', $id)->first();
        $project = Project::where('projects.id', $id)
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->first();
        $panelMember=PanelMember::where('id',$details->panelMember)->pluck('name');

        $version=thesisEvaluationForm::where('id', $details->formVersion)->first();

        $total=$details->independentScientificThinking + $details->scientificKnowHow + $details->logic + $details->presentation + $details->workProcess;

        return view('thesisEvaluation.examiner.viewThesis', compact('details', 'project','version','total','panelMember'));

    }

    //VIEW THESIS EVALUATION FORM
    public function editThesisForm()
    {
           //GET NEW VERSION/UPDATED THESIS EVALUATION FORM ID
            $v=thesisEvaluationForm::get()->max('id');
            $version=thesisEvaluationForm::where('id',$v)->first();

        return view('thesisEvaluation.RPC.form',compact('version'));
    }

    //UPDATE DEFINED MARKS OF THESIS EVALUATION FORM/ CREATE NEW VERSION
    public function editThesisFormMarks()
    {
        if (isset($_POST['editThesisFormMarks'])) {

            $validation = thesisEvaluationForm::validate(Input::all());

            if ($validation->fails()) {

                return redirect('/form')
                    ->withErrors($validation)
                    ->withInput();
            }

            else {
                $marks1 = Input::get('independentScientificThinking');
                $marks2 = Input::get('scientificKnowHow');
                $marks3 = Input::get('logic');
                $marks4 = Input::get('presentation');
                $marks5 = Input::get('workProcess');
            }

            thesisEvaluationForm::create(['independentScientificThinking' => $marks1, 'scientificKnowHow' => $marks2, 'logic' => $marks3,
                'presentation' => $marks4, 'workProcess' => $marks5]);

            Session::flash('success', 'Edited Successfully.');
            return redirect('/form');

        }
    }


    //RPC VIEW EVALUATED THESIS AND STATUS
    public function viewInternalThesisEvaluation()
    {
        $projects = thesisEvaluation::select('thesis_evaluations.id', 'thesis_evaluations.projectId', 'projects.title', 'projects.description', 'students.name', 'panelmembers.name as supervisor', 'thesis_evaluations.status')
            ->leftjoin('projects', 'projects.id', '=', 'thesis_evaluations.projectId')
            ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();

        //GET STATUS WHICH ARE NOT PUBLISHED
        $publishedStatus = thesisEvaluation::where('published', 0)->first();

        return view('thesisEvaluation.RPC.viewInternalProjects', compact('projects', 'publishedStatus'));
    }

     //PUBLISH THE STATUS TO STUDENTS
        public function publishStatus(){

            thesisEvaluation::where('published', 0)->update(['published'=>1]);
            Session::flash('success', 'Published Successfully');
            return redirect('viewInternalProjects');
      }

}
