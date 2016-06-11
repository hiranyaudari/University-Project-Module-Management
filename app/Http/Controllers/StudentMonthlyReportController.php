<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\MonthlyReport;
use App\MonthlyReportSupervisorFeedback;
use App\Project;
use App\Student;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;

class StudentMonthlyReportController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$loggedUsersEmail = Sentinel::check()->email;

		$student = Student::where('email', $loggedUsersEmail)
			->first();

		$project = Project::where('studentId',$student->id)
			->select('id', 'title')
			->where('projects.status','!=','Rejected')
			->first();

		return view('monthlyreports.studentFeedBack')
			->with('student',$student)
			->with('project',$project);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
//		dd($inputs);

		$rules = array
		(
			'projectId' => 'required',
			'months' => 'required',
			'currentStatus' => 'required',
			'workDone' => 'required'
		);

		$messages = array(
			'projectId.required' => 'Project should be available',
			'months.required' => 'Please select a month',
			'currentStatus.required' => 'Please fill out the current status field',
			'workDone.required' => 'Please fill out the work done field',
		);

		//validate the inputs
		$validator= Validator::make(Input::all(), $rules, $messages);
		if($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();

		} else {

			//check if report for the selected month is already submitted
			$isReportSubmitted = MonthlyReport::where('projectId',$inputs['projectId'])
				->where('month',$inputs['months']);

			if($isReportSubmitted->count()) {
				$monthNum = $inputs['months'];
				$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

				return Redirect::back()
					->withErrors('Monthly report for '.$monthName.' already submitted')
					->withInput();
			} else {
				//save to database
				$monthlyReport = MonthlyReport::create([
					'projectId' => $inputs['projectId'],
					'month' => $inputs['months'],
					'currentstatus' => $inputs['currentStatus'],
					'workdone' => $inputs['workDone']
				]);

				return Redirect::back()
					->with('message_success', 'Report submitted successfully!!');
			}
		}
	}

	/**
	 * Display all the feedbacks given by the supervisor to th student
	 */

	public function showFeedbacks() {
		$loggedUserEmail = Sentinel::getUser()['email'];

		$options1 = array(
			1 => 'Good',
			2 => 'Satisfactory',
			3 => 'Need Improvement',
			4 => 'Not Satisfactory'
		);

		$options2 = array(
			1 => 'Yes',
			2 => 'No'
		);

		$feedbacks = MonthlyReportSupervisorFeedback::join('monthly_reports as mr', 'monthly_report_supervisor_feedbacks.reportId', '=', 'mr.id')
			->join('projects as p', 'p.id', '=', 'mr.projectId')
			->join('students as s', 'p.studentId', '=', 's.id')
			->where('s.email', $loggedUserEmail)
			->select('monthly_report_supervisor_feedbacks.*', 'mr.month', 'mr.id')
			->get();

		foreach($feedbacks as $key => $feedback) {

			$currentStatus = $feedback['currentstatus'];
			$workDone =$feedback['workdone'];
			$timelyCompletion = $feedback['timelycompletion'];
			$supervisorContact = $feedback['supervisorcontact'];
			$overallProgress = $feedback['overallprogress'];
			$seriousProblems = $feedback['seriousproblems'];
			$monthNum = $feedback['month'];

			$feedbacks[$key]['currentstatus'] = $options1[$currentStatus];
			$feedbacks[$key]['workdone'] = $options1[$workDone];
			$feedbacks[$key]['timelycompletion'] = $options1[$timelyCompletion];
			$feedbacks[$key]['supervisorcontact'] = $options1[$supervisorContact];
			$feedbacks[$key]['overallprogress'] = $options2[$overallProgress];
			$feedbacks[$key]['seriousproblems'] = $options2[$seriousProblems];
			$feedbacks[$key]['month']  = date("F", mktime(0, 0, 0, $monthNum, 10));;
		}

		return view('monthlyreports.student_view_feedback')
			->with('feedbacks', $feedbacks);
	}


}
