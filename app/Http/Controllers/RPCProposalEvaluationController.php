<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProposalEvaluation;
use App\PanelMember;
use Illuminate\Http\Request;
use Session;
use Input;
class RPCProposalEvaluationController extends Controller {

 public function viewExternalSupervisorsProposalEvaluation()
{
    $projects = ProposalEvaluation::select('proposal_evaluations.id', 'proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username')
        ->distinct()
        ->where('panelmembers.type', 'External Supervisor', 'AND')
        ->where('panelmembers.status', 'Approved', 'AND')
        ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
        ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
        ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();

    return view('ProposalEvaluation.RPC.viewExternalSupervisorsProposal', compact('projects', 'proposals'));

}

    public function viewRPCProposalEvaluation()
    {
        $projects = ProposalEvaluation::select('proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username')
            ->distinct()
            ->where('panelmembers.type', 'RPC', 'AND')
            ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
            ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();

        return view('ProposalEvaluation.RPC.viewRpcProjects', compact('projects', 'proposals'));

    }


    public function viewInternalProposalEvaluation()
    {
        $projects = ProposalEvaluation::select('proposal_evaluations.id', 'proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username', 'proposal_evaluations.status')
            ->where('panelmembers.type', 'Internal Supervisor', 'AND')
            ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
            ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();

        $panelmembers=PanelMember::where('type','Internal Supervisor')->get();
        $publishedStatus=ProposalEvaluation::where('feedback',0)->first();

        return view('ProposalEvaluation.RPC.viewInternalProposals', compact('projects', 'panelmembers','publishedStatus'));
    }


    public function  filterSearch()
    {

        if (isset($_POST['filter'])) {
            $s = Input::get('filter_t');
            $t = Input::get('filter_s');

            if($s!=NULL && $t!=NULL ) {
                $projects = ProposalEvaluation::select('proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username', 'proposal_evaluations.status')
                    ->distinct()
                    ->where('panelmembers.type', 'Internal Supervisor', 'AND')
                    ->where('proposal_evaluations.status', $s)
                    ->where('panelmembers.id', $t)
                    ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
                    ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
                    ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();
            }
            else if($s!=NULL && $t==NULL ) {
                $projects = ProposalEvaluation::select('proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username', 'proposal_evaluations.status')
                    ->distinct()
                    ->where('panelmembers.type', 'Internal Supervisor', 'AND')
                    ->where('proposal_evaluations.status', $s)
                    ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
                    ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
                    ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();
            }
            else if($s==NULL && $t!=NULL ) {
                $projects = ProposalEvaluation::select('proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username', 'proposal_evaluations.status')
                    ->distinct()
                    ->where('panelmembers.type', 'Internal Supervisor', 'AND')
                    ->where('panelmembers.id', $t)
                    ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
                    ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
                    ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();
            }

            $publishedStatus=ProposalEvaluation::where('feedback',0)->first();
            $panelmembers=PanelMember::where('type','Internal Supervisor')->get();

            return view('ProposalEvaluation.RPC.viewInternalProposals', compact('projects', 'panelmembers','publishedStatus'));
        }

    }


    public function viewExternalProposalEvaluation()
    {
        $projects = ProposalEvaluation::select('proposal_evaluations.id', 'proposal_evaluations.project_id', 'projects.title', 'projects.description', 'students.name', 'panelmembers.username', 'proposal_evaluations.status')
            ->where('panelmembers.type', 'External Supervisor', 'AND')
            ->leftjoin('projects', 'projects.id', '=', 'proposal_evaluations.project_id')
            ->leftjoin('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId', 'AND')
            ->leftjoin('students', 'students.id', '=', 'projects.studentId')->get();

        $panelmembers=PanelMember::where('type','Internal Supervisor')->get();
        $publishedStatus=ProposalEvaluation::where('feedback',0)->first();

        return view('ProposalEvaluation.RPC.viewExternalSupervisorsProposal', compact('projects', 'panelmembers','publishedStatus'));
    }




    public function publishStatus(){

        ProposalEvaluation::where('feedback',0)->update(['feedback'=>1]);
        Session::flash('success', 'Published Successfully');
        return redirect('viewInternalProposals');
    }

}
