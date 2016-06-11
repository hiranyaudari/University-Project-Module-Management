<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\MonthlyReport;
use App\MonthlyReportSupervisorFeedback;
use App\PanelMember;
use App\Project;
use App\Student;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Input;
use Redirect;
use Response;


class SupervisorMonthlyReportController extends Controller {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('monthlyreports.supervisorFeedBack');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$supervisorEmail = Sentinel::getUser()['email'];
		$supervisorId = PanelMember::where('email', $supervisorEmail)
			->first()
			->pluck('id');

		//save to database
		MonthlyReportSupervisorFeedback::create([
			"reportId" => $inputs['reportNo'],
			"supervisorId" => $supervisorId,
			"currentstatus" => $inputs['currentstatus'],
			"workdone" => $inputs['workdone'],
			"timelycompletion" => $inputs['timelycompletion'],
			"supervisorcontact" => $inputs['supervisorcontact'],
			"overallprogress" => $inputs['overallprogress'],
			"seriousproblems" => $inputs['seriousproblems'],
			"comments" => $inputs['comments']
		]);

		return Redirect::back()
			->with('message_success', 'Feedback submitted successfully!!');

	}

	/*
	 * Returns the list of projects which are managed by the logged supervisor
	 */

	public function getProjects() {

		$month = Input::get('month');
		$supervisorEmail = Sentinel::getUser()['email'];

		$projects = MonthlyReport::leftJoin('monthly_report_supervisor_feedbacks','monthly_report_supervisor_feedbacks.reportId','=','monthly_reports.id')
			->join('projects','projects.id', '=', 'monthly_reports.projectId')
			->whereNull('monthly_report_supervisor_feedbacks.id')
			->select('projects.id', 'projects.title')
			->where('monthly_reports.month', $month)
			->where('projects.status','!=','Rejected')
			->distinct()
			->get();

		return Response::json(array(
			'success' => 'true',
			'projects' => $projects
		));
	}

	/*
	 * Get the list of monthly reports which are submitted by the students for the given month
	 */

	public function getMonthlyReport() {
		$projectId = Input::get('projectId');
		$month = Input::get('month');;

		$project = Project::where('id',$projectId)
			->select('id','studentId', 'title')
			->where('projects.status','!=', 'Rejected')
			->first();

		$student = Student::where('id',$project->studentId)
			->select('id','regId','name')
			->first();

		$monthlyReport = MonthlyReport::where('projectId',$projectId)
			->where('month',$month)
			->first();

		return Response::json(array(
			'success' => 'true',
			'project' => $project,
			'student' => $student,
			'monthlyReport' => $monthlyReport
		));

	}
}
