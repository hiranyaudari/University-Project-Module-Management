<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Request as Request2;

class diaryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
        public function __construct() 
        {
            notificationController::showNotificationAccordingToCurrentUser();
        }
        
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('researchDiary/diaryhome');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
        public function taskopen()
        {
            $Alltasks = \App\schedule::all();
            return view('researchDiary/tasks', compact('Alltasks'));
        }
        
	public function storeTasks(Request2 $reques)
        {
                        dd('yeee');
            // validation without request clz
            $this->validate($reques, ['entertask' => 'required']);
            $this->validate($reques, ['plantof' => 'required']);
            $this->validate($reques, ['spenthours' => 'required']);

            \App\schedule::create([
                'task' => Request::get('entertask'),
                'description' => Request::get('desc'),    
                'plantofinish' => Request::get('plantof'),
                'sdate' => Request::get('start'),
                'edate' => Request::get('end'),
                'hours' => Request::get('spenthours')

                ]);

            return redirect('researchDiary/tasks');
        }
        
        public function destroy($id)
        {
            //$idi = Crypt::decrypt($id);
            //dd($id);
            $model = \App\schedule::find($id);
            //dd($model);
            $model->delete();

            return redirect('tasks')->with('message_success', 'Task Deleted!');
        }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
}
