<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\FreeSlots;
use App\PanelMember;
use App\PresentationPanel;
use App\Project;
use App\Student;
use Crypt;
use Validator, Input, Redirect, Hash, Mail, URL, Response;

class PanelController extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    /*
     * Show the listings of the presentation panels
     */

    public function index()
    {

        $panels = PresentationPanel::join('projects','projects.id','=','presentationpanels.projectId')
            ->select('presentationpanels.id','projects.title','presentationpanels.date','presentationpanels.venue')
            ->where('projects.status','=','Approved')
            ->get();

        return view('proposalpresentations.viewpanels')
            ->with('panels',$panels);
    }

    /**
     * Show the form to create a proposal presentation panel
     *
     */

	public function create()
	{
        $panelMembers = PanelMember::all();
        $projects = Project::leftJoin('presentationpanels', 'projects.id', '=', 'presentationpanels.projectId')
            ->whereNull('presentationpanels.projectId')
            ->select('projects.id','projects.title')
            ->get();

        return view('proposalpresentations.addpanel',compact('panelMembers','projects'));
	}

    /**
     * Store the presentation panel in the database
     *
     */

	public function store()
	{

        $rules = array
        (
            'projects' => 'required',
            'txtSupervisor' => 'required',
            'panelmember1' => 'required',
            'panelmember2' => 'required',
            'date' => 'required',
            'presentationvenue' => 'required',
            'startTime' => 'required',
            'endTime' => 'required'
        );

        $messages = array(
            'projects.required' => 'Project is required',
            'txtSupervisor.required' => 'Supervisor must be selected',
            'panelmember1.required' => 'Please select Panel Member 1',
            'panelmember2.required' => 'Please select Panel Member 2',
            'date.required' => 'Date is required.',
            'presentationvenue.required' => 'Select a location for the presentation',
            'startTime.required' => 'Select the starting time',
            'endTime.required' => 'Select the ending time'
        );

        $validator= Validator::make(Input::all(), $rules, $messages);

        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            /**  check if both panel members & supervisor have another schedule during that time */

                $member1Result = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('panelmember1'));
                $member2Result = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('panelmember2'));

                $supId = Project::find(Input::get('projects'))->supervisorId;

                $supervisorResult = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),$supId);

                $locationResult = $this->checkVenueAvailability(null, Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('presentationvenue'));


            if(!$supervisorResult) {
                    return Redirect::back()
                        ->withErrors('Supervisor is unavailable during this time')
                        ->withInput();
                }

                else if(!$member1Result) {
                    return Redirect::back()
                        ->withErrors('Panel Member 1 is unavailable during this time')
                        ->withInput();
                }

                else if(!$member2Result ) {
                    return Redirect::back()
                        ->withErrors('Panel Member 2 is unavailable during this time')
                        ->withInput();
                }

            /** check if another schedule allocated in same venue during that time */

                else if(!$locationResult) {
                    return Redirect::back()
                        ->withErrors('Selected venue already has another schedule during the time period')
                        ->withInput();
                }

            else {
                PresentationPanel::create([
                    'projectId' => Input::get('projects'),
                    'memberOneId' => Input::get('panelmember1'),
                    'memberTwoId' => Input::get('panelmember2'),
                    'venue' => Input::get('presentationvenue'),
                    'date' => Input::get('date'),
                    'time_start' => Input::get('startTime'),
                    'time_end' => Input::get('endTime'),
                ]);


                $pm1 = PanelMember::find(Input::get('panelmember1'));
                $pm2 = PanelMember::find(Input::get('panelmember2'));
                $sup = PanelMember::find($supId);
                $stuId = Project::find(Input::get('projects'))->studentId;
                $student = Student::find($stuId);

                //send email to panel member 1
                Mail::send('emails.presentationschedule', array(
                    'name'=>$pm1->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($pm1)
                {
                    $message->to($pm1->email, $pm1->name)->subject('Presentation Schedule');
                });

                //send email to panel member 2
                Mail::send('emails.presentationschedule', array(
                    'name'=>$pm2->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($pm2)
                    {
                        $message->to($pm2->email, $pm2->name)->subject('Presentation Schedule');
                    });

                //send email to supervisor
                Mail::send('emails.presentationschedule', array(
                    'name'=>$sup->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($sup)
                    {
                        $message->to($sup->email, $sup->name)->subject('Presentation Schedule');
                    });

                    //send email to student
                Mail::send('emails.presentationschedule', array(
                    'name'=>$student->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($student)
                    {
                        $message->to($student->email, $student->name)->subject('Presentation Schedule');
                    });

                return Redirect::route('proposalpanels.create')
                    ->with('message_success','Schedule successfully added!!');
            }
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $id = Crypt::decrypt($id);

		$panel = PresentationPanel::Where('presentationpanels.id','=',$id)
            ->join('projects','projects.id','=','presentationpanels.projectId')
            ->join('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->select('presentationpanels.id','projects.title','panelmembers.name','presentationpanels.date','presentationpanels.venue','presentationpanels.time_start','presentationpanels.time_end')
            ->get();


        $panelMember1 = PresentationPanel::Where('presentationpanels.id','=',$id)
            ->join('panelmembers','panelmembers.id','=','presentationpanels.memberOneId')
            ->select('panelmembers.name')
            ->first();

        $panelMember2 = PresentationPanel::Where('presentationpanels.id','=',$id)
            ->join('panelmembers','panelmembers.id','=','presentationpanels.memberTwoId')
            ->select('panelmembers.name')
            ->first();


        if($panel->count()) {
            $panel = $panel->first();
            return view('proposalpresentations.paneldetails')
                ->with('panel',$panel)
                ->with('panelMember1',$panelMember1)
                ->with('panelMember2',$panelMember2);

        }




	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $id = Crypt::decrypt($id);

        $presentationPanel = PresentationPanel::find($id);
        $supervisor = PresentationPanel::where('presentationpanels.id','=',$id)
            ->join('projects','projects.id','=','presentationpanels.projectId')
            ->join('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->select('panelmembers.id', 'panelmembers.name')
            ->get()
            ->first();


        $project = Project::Where('projects.id','=',$presentationPanel->projectId)
            ->select('projects.id','projects.title')
            ->get();

        $projects = Project::
//        join('presentationpanels', 'projects.id', '=', 'presentationpanels.projectId')
            where('projects.status','=','Approved')
//            ->whereNull('presentationpanels.projectId')
            ->select('projects.id','projects.title')
            ->get();
        $allProjects = $project->merge($projects);

        $panelMember1 = PanelMember::Where('panelmembers.id','=',$presentationPanel->memberOneId)
            ->select('panelmembers.name','panelmembers.id')->get();

        $panelMembers = PanelMember::Where('panelmembers.type','<>','RPC')
            ->where('panelmembers.id','<>',$presentationPanel->memberOneId)
            ->select('panelmembers.name','panelmembers.id')->get();

        $membersOne = $panelMember1->merge($panelMembers);

        $panelMember2 = PanelMember::Where('panelmembers.id','=',$presentationPanel->memberTwoId)
            ->select('panelmembers.name','panelmembers.id')->get();

        $panelMembers = PanelMember::Where('panelmembers.type','<>','RPC')
            ->where('panelmembers.id','<>',$presentationPanel->memberTwoId)
            ->select('panelmembers.name','panelmembers.id')->get();

        $membersTwo = $panelMember2->merge($panelMembers);

        if($presentationPanel->count()) {
            return view('proposalpresentations.editpanel',compact('presentationPanel','supervisor','membersOne','membersTwo','allProjects'));
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        $rules = array
        (
            'projects' => 'required',
            'txtSupervisor' => 'required',
            'panelmember1' => 'required',
            'panelmember2' => 'required',
            'date' => 'required',
            'presentationvenue' => 'required',
            'startTime' => 'required',
            'endTime' => 'required'
        );

        $messages = array(
            'projects.required' => 'Project is required',
            'txtSupervisor.required' => 'Supervisor must be selected',
            'panelmember1.required' => 'Please select Panel Member 1',
            'panelmember2.required' => 'Please select Panel Member 2',
            'date.required' => 'Date is required.',
            'presentationvenue.required' => 'Select a location for the presentation',
            'startTime.required' => 'Select the starting time',
            'endTime.required' => 'Select the ending time'
        );

        $validator= Validator::make(Input::all(), $rules, $messages);

        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            /**  check if both panel members & supervisor have another schedule during that time */

            $member1Result = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('panelmember1'));
            $member2Result = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('panelmember2'));

            $supId = Project::find(Input::get('projects'))->supervisorId;

            $supervisorResult = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),$supId);

            $locationResult = $this->checkVenueAvailability($id, Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('presentationvenue'));


            if(!$supervisorResult) {
                return Redirect::back()
                    ->withErrors('Supervisor is unavailable during this time')
                    ->withInput();
            }

            else if(!$member1Result) {
                return Redirect::back()
                    ->withErrors('Panel Member 1 is unavailable during this time')
                    ->withInput();
            }

            else if(!$member2Result ) {
                return Redirect::back()
                    ->withErrors('Panel Member 2 is unavailable during this time')
                    ->withInput();
            }

            /** check if another schedule allocated in same venue during that time */

            else if(!$locationResult) {
                return Redirect::back()
                    ->withErrors('Selected venue already has another schedule during the time period')
                    ->withInput();
            }

            else {

                    $panel = PresentationPanel::find(Crypt::decrypt($id));
                    $panel->projectId = Input::get('projects');
                    $panel->memberOneId = Input::get('panelmember1');
                    $panel->memberTwoId = Input::get('panelmember2');

                    $panel->venue = Input::get('presentationvenue');
                    $panel->date = Input::get('date');
                    $panel->time_start = Input::get('startTime');
                    $panel->time_end = Input::get('endTime');
                    $panel->save();


                $pm1 = PanelMember::find(Input::get('panelmember1'));
                $pm2 = PanelMember::find(Input::get('panelmember2'));
                $sup = PanelMember::find($supId);
                $stuId = Project::find(Input::get('projects'))->studentId;
                $student = Student::find($stuId);

                //send email to panel member 1
                Mail::send('emails.presentationschedule', array(
                    'name'=>$pm1->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($pm1)
                    {
                        $message->to($pm1->email, $pm1->name)->subject('Presentation Schedule');
                    });

                //send email to panel member 2
                Mail::send('emails.presentationschedule', array(
                    'name'=>$pm2->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($pm2)
                    {
                        $message->to($pm2->email, $pm2->name)->subject('Presentation Schedule');
                    });

                //send email to supervisor
                Mail::send('emails.presentationschedule', array(
                    'name'=>$sup->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($sup)
                    {
                        $message->to($sup->email, $sup->name)->subject('Presentation Schedule');
                    });

                //send email to student
                Mail::send('emails.presentationschedule', array(
                    'name'=>$student->name,
                    'panelMember1' => $pm1->name,
                    'panelMember2' => $pm2->name,
                    'supervisor' => $sup->name,
                    'date'=> Input::get('date'),
                    'startingTime' => Input::get('startTime'),
                    'endingTime' => Input::get('endTime'),
                    'venue' => Input::get('presentationvenue')),
                    function($message) use ($student)
                    {
                        $message->to($student->email, $student->name)->subject('Presentation Schedule');
                    });

                return Redirect::route('proposalpanels.index')
                    ->with('message_success','Schedule successfully Updated!!');
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$model = PresentationPanel::find(\Crypt::decrypt($id));
        $model->delete();

        return Redirect::route('proposalpanels.index')->with('message_success', 'Panel Deleted!');
	}

    public function getSupervisor()
    {
        $projectId = Input::get('projectId');
        $supervisorName = Project::join('panelmembers', 'panelmembers.id', '=', 'projects.supervisorId')->where('projects.id', '=', $projectId)->select('panelmembers.name')->first();

        $supervisorId = Project::find($projectId)->first()->supervisorId;

        $supervisorFreeSlots = FreeSlots::where('memberId','=',$supervisorId)
            ->where('freeDay','>=',date('Y-m-d'))
            ->get();



        return Response::json(array(
            'success' => true,
            'supervisor' => $supervisorName->name,
            'supervisorId' => $supervisorId,
            'supervisorSlots' => $supervisorFreeSlots
        ));

    }

    /*
     * Get the list of panel members who are available on the given day
     */


    public function getPanelMember1()
    {
        $memberId = Input::get('memberId');

        $memberFreeSlots = FreeSlots::where('memberId','=',$memberId)
            ->where('freeDay','>=',date('Y-m-d'))
            ->get();
//        dd($memberFreeSlots);

        return Response::json(array(
            'success' => true,
            'memberSlots' => $memberFreeSlots
        ));


    }

    /*
     * Check whether the specified panel member is during the allocated slot
     */

    public function checkAvailabilityMember($date, $postStart, $postEnd, $memberId) {
        $result = true;

        $postStartTime = strtotime($date.' '.$postStart);
        $postEndTime = strtotime($date.' '.$postEnd);

        //get all free slots
        $freeSlots = FreeSlots::where('freeDay','=',$date)
            ->where('memberId','=',$memberId)
            ->get();

        foreach ($freeSlots as $slot) {
            $slotStartTime = strtotime($slot->freeDay.' '.$slot->startingHour.':'.$slot->startingMin);
            $slotEndTime = strtotime($slot->freeDay.' '.$slot->endingHour.':'.$slot->endingMin);

            if($postStartTime >= $slotStartTime && $postStartTime <= $slotEndTime) {
                $result = false;
                break;
            } else if($postEndTime >= $slotStartTime && $postEndTime <= $slotEndTime) {
                $result = false;
                break;
            }

            else if( $postStartTime  >= $slotStartTime AND $postEndTime <= $slotEndTime ) {
                $result = false;
                break;
            }

            else if( $postStartTime <= $slotStartTime AND $postEndTime >= $slotEndTime) {
                $result = false;
                break;
            }
        }

        return $result;
    }

    /*
     * Check whether the venue has another presentation allocated on it
     */

    public function checkVenueAvailability($id, $date, $postStart, $postEnd, $venue){
        $result = true;

        if(!$id) {
            $postStartTime = strtotime($date . ' ' . $postStart);
            $postEndTime = strtotime($date . ' ' . $postEnd);

            $venueSlots = PresentationPanel::where('date', '=', $date)
                ->where('venue', '=', $venue)
                ->get();

//        dd($venueSlots);

            foreach ($venueSlots as $slot) {
                $slotStartTime = strtotime($slot->date . ' ' . $slot->time_start);
                $slotEndTime = strtotime($slot->date . ' ' . $slot->time_start);

                if ($postStartTime >= $slotStartTime && $postStartTime <= $slotEndTime) {
                    $result = false;
                    break;
                } else if ($postEndTime >= $slotStartTime && $postEndTime <= $slotEndTime) {
                    $result = false;
                    break;
                } else if ($postStartTime >= $slotStartTime AND $postEndTime <= $slotEndTime) {
                    $result = false;
                    break;
                } else if ($postStartTime <= $slotStartTime AND $postEndTime >= $slotEndTime) {
                    $result = false;
                    break;
                }
            }
        }

        return $result;
    }
}
