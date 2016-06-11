<?php namespace App\Http\Controllers;
use App\PanelMember;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PresentationPanel;
use Sentinel;
use App\PropasalEvaluationDetails;
use App\ProposalEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Student;
class ProposalEvaluationController extends Controller
{

    public function addProposalEvaluation($pid){

        $userId = Sentinel::getUser()->id;
        $panelmember=PanelMember::where('id',$userId)->pluck('name');
        $project = Project::where('id', $pid)->first();

//        dd($project);
        $student = Student::where('id', $project->studentId)->first();

        return view('ProposalEvaluation.Examiner.proposalEvaluationForm',compact('project', 'student','panelmember'));

    }

    //VIEW PROPOSAL PRESENTATIONS
    public function viewProposalPresentation()
    {
        $userid = Sentinel::getUser()->id;

        $date = date("Y-m-d");
        $projects = PresentationPanel::where('date', $date)->where(function ($query) use ($userid) {
                    return $query->where('memberOneId', $userid)
                    ->orWhere('memberTwoId', $userid);
                   })
                   ->leftjoin('projects', 'projects.id', '=', 'presentationpanels.projectId')
                   ->select('presentationpanels.*', 'projects.*')
                   ->get();

        $projectProposals = ProposalEvaluation::all();

        $pid = array();
        $i=0;

        foreach ($projectProposals as $projectProposal) {
            $pid[$i] = $projectProposal->project_id;
            $i++;
          }

        return view('ProposalEvaluation.Examiner.ProposalEvaluationPresentations', compact('projects', 'pid'));
    }




    public function next()
    {
        $projId = $_POST['evaluation_submit'];

        if (isset($_POST['evaluation_submit'])) {

            $validation = PropasalEvaluationDetails::validate(Input::all());

            if ($validation->fails()) {

                return redirect('proposalEvaluationForm/'.$projId)
                    ->withErrors($validation)
                    ->withInput();

            }
            else {

               //$panelmember_id=Auth::user();
                $panelmember_id=1;
                $m1 = Input::get('IntroductionMarks');
                $c1 = Input::get('comment1');
                $m2 = Input::get('ProblemDefinitionMarks');
                $c2 = Input::get('comment2');
                $m3 = Input::get('ScopeMarks');
                $c3 = Input::get('comment3');
                $m4 = Input::get('LiteratureReviewMarks');
                $c4 = Input::get('comment4');
                $m5 = Input::get('MethodologyMarks');
                $c5 = Input::get('comment5');
                $m6 = Input::get('WorkplanMarks');
                $c6 = Input::get('comment6');
                $m7 = Input::get('DocumentMarks');
                $c7 = Input::get('comment7');
                $m8 = Input::get('OralpresentationMarks');
                $c8 = Input::get('comment8');
                $m9 = Input::get('Q/AsessionMarks');
                $c9 = Input::get('comment9');
                $status = Input::get('status');

                $breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");
                $d1 = str_ireplace($breaks, "\r\n", $c1);
                $d2 = str_ireplace($breaks, "\r\n", $c2);
                $d3 = str_ireplace($breaks, "\r\n", $c3);
                $d4= str_ireplace($breaks, "\r\n", $c4);
                $d5= str_ireplace($breaks, "\r\n", $c5);
                $d6= str_ireplace($breaks, "\r\n", $c6);
                $d7= str_ireplace($breaks, "\r\n", $c7);
                $d8 = str_ireplace($breaks, "\r\n", $c8);
                $d9 = str_ireplace($breaks, "\r\n", $c9);


                $x = Project::where('projects.id', $projId)
                    ->leftjoin('students', 'students.id', '=', 'projects.studentId')->first();

                $pid = ProposalEvaluation::insertGetId(['student_id' => $x->regId, 'project_id' => $x->id, 'panelmember_id' => $panelmember_id, 'status' => $status, 'feedback' => 0]);

                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 1, 'marks' => $m1, 'comment' => $d1]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 2, 'marks' => $m2, 'comment' => $d2]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 3, 'marks' => $m3, 'comment' => $d3]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 4, 'marks' => $m4, 'comment' => $d4]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 5, 'marks' => $m5, 'comment' => $d5]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 6, 'marks' => $m6, 'comment' => $d6]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 7, 'marks' => $m7, 'comment' => $d7]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 8, 'marks' => $m8, 'comment' => $d8]);
                PropasalEvaluationDetails::create(['proposal_id' => $pid, 'parts' => 9, 'marks' => $m9, 'comment' => $d9]);

                Session::flash('success', 'Added Successfully.');

                return redirect('ProposalEvaluationPresentations');
            }
        }
    }

    public function viewProposalEvaluation($id)
    {
        $x = ProposalEvaluation::where('project_id', $id)->first();

        $student = Project::where('projects.id', $x->project_id)
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->first();

        $detail1 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 1)->first();
        $detail2 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 2)->first();
        $detail3 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 3)->first();
        $detail4 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 4)->first();
        $detail5 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 5)->first();
        $detail6 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 6)->first();
        $detail7 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 7)->first();
        $detail8 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 8)->first();
        $detail9 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 9)->first();
        $date = date('d-m-Y', strtotime($detail1->created_at));



        $details = array($detail1->marks, $detail1->comment, $detail2->marks, $detail2->comment, $detail3->marks, $detail3->comment, $detail4->marks, $detail4->comment,
                  $detail5->marks, $detail5->comment, $detail6->marks, $detail6->comment, $detail7->marks, $detail7->comment, $detail8->marks, $detail8->comment,
                  $detail9->marks, $detail9->comment, $date);

        $marks=PropasalEvaluationDetails::where('proposal_id',$x->id)->sum('marks');

        return view('ProposalEvaluation.Examiner.ViewPrposal', compact('details', 'x', 'student','marks'));

    }

    public function editProposalEvaluation($id)
    {
        $x = ProposalEvaluation::where('project_id', $id)->first();

        $student = Project::where('projects.id', $x->project_id)
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->first();



        $detail1 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 1)->first();
        $detail2 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 2)->first();
        $detail3 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 3)->first();
        $detail4 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 4)->first();
        $detail5 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 5)->first();
        $detail6 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 6)->first();
        $detail7 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 7)->first();
        $detail8 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 8)->first();
        $detail9 = PropasalEvaluationDetails::where('proposal_id', $x->id)->where('parts', 9)->first();
        $date = date('d-m-Y', strtotime($detail1->created_at));

        $details = array($detail1->marks, $detail1->comment, $detail2->marks, $detail2->comment, $detail3->marks, $detail3->comment, $detail4->marks, $detail4->comment,
            $detail5->marks, $detail5->comment, $detail6->marks, $detail6->comment, $detail7->marks, $detail7->comment, $detail8->marks, $detail8->comment,
            $detail9->marks, $detail9->comment, $date);

        $marks=PropasalEvaluationDetails::where('proposal_id',$x->id)->sum('marks');

        return view('ProposalEvaluation.Examiner.editProposal', compact('details', 'x', 'student','marks'));

    }



    public function next_edit()
    {

        if (isset($_POST['next'])) {

            $projId = isset($_POST['next']);
            $x = ProposalEvaluation::where('project_id', $projId)->first();
            echo $x;

            $validation = PropasalEvaluationDetails::validate(Input::all());

            if ($validation->fails()) {

                return redirect('editProposal/' . $projId)
                    ->withErrors($validation)
                    ->withInput();

            } else {

                $m1 = Input::get('IntroductionMarks');
                $c1 = Input::get('comment1');
                $m2 = Input::get('ProblemDefinitionMarks');
                $c2 = Input::get('comment2');
                $m3 = Input::get('ScopeMarks');
                $c3 = Input::get('comment3');
                $m4 = Input::get('LiteratureReviewMarks');
                $c4 = Input::get('comment4');
                $m5 = Input::get('MethodologyMarks');
                $c5 = Input::get('comment5');
                $m6 = Input::get('WorkplanMarks');
                $c6 = Input::get('comment6');
                $m7 = Input::get('DocumentMarks');
                $c7 = Input::get('comment7');
                $m8 = Input::get('OralpresentationMarks');
                $c8 = Input::get('comment8');
                $m9 = Input::get('Q/AsessionMarks');
                $c9 = Input::get('comment9');
                $status = Input::get('status');

                $breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");
                $d1 = str_ireplace($breaks, "\r\n", $c1);
                $d2 = str_ireplace($breaks, "\r\n", $c2);
                $d3 = str_ireplace($breaks, "\r\n", $c3);
                $d4= str_ireplace($breaks, "\r\n", $c4);
                $d5= str_ireplace($breaks, "\r\n", $c5);
                $d6= str_ireplace($breaks, "\r\n", $c6);
                $d7= str_ireplace($breaks, "\r\n", $c7);
                $d8 = str_ireplace($breaks, "\r\n", $c8);
                $d9 = str_ireplace($breaks, "\r\n", $c9);

                ProposalEvaluation::where('project_id', $projId)->update(['status' => $status]);

                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',1)->update(['marks' => $m1, 'comment' => $d1]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',2)->update(['marks' => $m2, 'comment' => $d2]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',3)->update(['marks' => $m3, 'comment' => $d3]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',4)->update(['marks' => $m4, 'comment' => $d4]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',5)->update(['marks' => $m5, 'comment' => $d5]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',6)->update(['marks' => $m6, 'comment' => $d6]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',7)->update(['marks' => $m7, 'comment' => $d7]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',8)->update(['marks' => $m8, 'comment' => $d8]);
                PropasalEvaluationDetails::where('proposal_id',$x->id)->where('parts',9)->update(['marks' => $m9, 'comment' => $d9]);

                Session::flash('success', 'Edited Successfully.');
                return redirect('ProposalEvaluationPresentations');
            }
        }


    }





}

