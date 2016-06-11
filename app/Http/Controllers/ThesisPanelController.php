<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FreeSlots;
use App\PanelMember;
use App\ThesisPresentationPanel;
use App\Project;
use App\Student;
use Request;
use App\User;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Crypt;
use Validator, Input, Redirect, Hash, Mail, URL, Response, Log;
use Fenos\Notifynder\Facades\Notifynder;
use Session;

class ThesisPanelController extends Controller {




    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

        $panels = ThesisPresentationPanel::join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id','projects.title','thesis_presentation_panels.date','thesis_presentation_panels.venue')
            ->get();

        return view('thesispresentations.viewpanels')
            ->with('panels',$panels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $panelMembers = PanelMember::all();
        $projects = Project::leftJoin('thesis_presentation_panels', 'projects.id', '=', 'thesis_presentation_panels.projectId')
            ->whereNull('thesis_presentation_panels.projectId')
            ->where('projects.status','=','Proposal Evaluated')
            ->select('projects.id','projects.title')
            ->get();

        return view('thesispresentations.addpanel',compact('panelMembers','projects'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $ajax = Request::ajax();

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
            if($ajax) {
                return Response::json(array(
                    'message' => 'Please check all the inputs!'
                ),400);
            } else {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        else
        {
            /**  check if both panel members & supervisor have another schedule during that time */

            $member1Result = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('panelmember1'));
            $member2Result = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('panelmember2'));

            $supId = Project::find(Input::get('projects'))->supervisorId;

            //check if supervisor is available at the given time period
            $supervisorResult = $this->checkAvailabilityMember(Input::get('date'),Input::get('startTime'),Input::get('endTime'),$supId);
            //check if the presentation venue is available at the given time period
            $locationResult = $this->checkVenueAvailability(null, Input::get('date'),Input::get('startTime'),Input::get('endTime'),Input::get('presentationvenue'));

            if(!$supervisorResult) {

                if($ajax) {
                    return Response::json(array(
                        'error' => true,
                        'message' => 'Supervisor is unavailable during this time'
                    ), 400);
                } else {
                    return Redirect::back()
                        ->withErrors('Supervisor is unavailable during this time')
                        ->withInput();
                }
            }

            else if(!$member1Result) {

                if($ajax) {
                    return Response::json(array(
                        'error' => true,
                        'message' => 'Panel Member 1 is unavailable during this time'
                    ), 400);
                } else {
                    return Redirect::back()
                        ->withErrors('Panel Member 1 is unavailable during this time')
                        ->withInput();
                }
            }

            else if(!$member2Result ) {

                if($ajax) {
                    return Response::json(array(
                        'error' => true,
                        'message' => 'Panel Member 2 is unavailable during this time'
                    ), 400);
                } else {
                    return Redirect::back()
                        ->withErrors('Panel Member 2 is unavailable during this time')
                        ->withInput();
                }
            }

            /** check if another schedule allocated in same venue during that time */

            else if(!$locationResult) {

                if($ajax) {
                    return Response::json(array(
                        'error' => true,
                        'message' => 'Selected venue already has another schedule during the time period'
                    ), 400);
                } else {
                    return Redirect::back()
                        ->withErrors('Selected venue already has another schedule during the time period')
                        ->withInput();
                }
            }

            else {
                ThesisPresentationPanel::create([
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

                $date = Input::get('date');
                $startTime = Input::get('startTime');
                $endTime = Input::get('endTime');
                $venue = Input::get('presentationvenue');

//                send email to panel member 1
                $this->sendEmail($pm1,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

//                send email to panel member 2
                $this->sendEmail($pm2,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

//                send email to supervisor
                $this->sendEmail($sup,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

//                send email to student
                $this->sendEmail($student,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

                if($ajax) {
                    return Response::json(array(
                        'success' => true,
                        'message' => 'Schedule successfully added!!',
                    ));
                } else {
                    return Redirect::route('thesispanels.create')
                        ->with('message_success', 'Schedule successfully added!!');
                }
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

        $panel = ThesisPresentationPanel::Where('thesis_presentation_panels.id','=',$id)
            ->join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->join('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->select('thesis_presentation_panels.*','projects.title', 'panelmembers.name')
            ->get();


        $panelMember1 = ThesisPresentationPanel::Where('thesis_presentation_panels.id','=',$id)
            ->join('panelmembers','panelmembers.id','=','thesis_presentation_panels.memberOneId')
            ->select('panelmembers.name')
            ->first();

        $panelMember2 = ThesisPresentationPanel::Where('thesis_presentation_panels.id','=',$id)
            ->join('panelmembers','panelmembers.id','=','thesis_presentation_panels.memberTwoId')
            ->select('panelmembers.name')
            ->first();

        if($panel->count()) {
            $panel = $panel->first();

            return view('thesispresentations.paneldetails')
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
        $ajax = Request::ajax();
//        if(!$ajax) {
//            $id = Crypt::decrypt($id);
//        }

        $presentationPanel = ThesisPresentationPanel::find($id);
        $supervisor = ThesisPresentationPanel::where('thesis_presentation_panels.id','=',$id)
            ->join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->join('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->select('panelmembers.id', 'panelmembers.name')
            ->get()
            ->first();
        $project = Project::Where('projects.id','=',$presentationPanel->projectId)
            ->select('projects.id','projects.title')
            ->get();

        $projects = Project::leftJoin('thesis_presentation_panels', 'projects.id', '=', 'thesis_presentation_panels.projectId')
            ->where('projects.status','=','Proposal Evaluated')
            ->whereNull('thesis_presentation_panels.projectId')
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
            return view('thesispresentations.editpanel',compact('presentationPanel','supervisor','membersOne','membersTwo','allProjects'));
        }

        else {
            abort('500');
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
        else {
            /**  check if both panel members & supervisor have another schedule during that time */

            $member1Result = $this->checkAvailabilityMember(Input::get('date'), Input::get('startTime'), Input::get('endTime'), Input::get('panelmember1'));
            $member2Result = $this->checkAvailabilityMember(Input::get('date'), Input::get('startTime'), Input::get('endTime'), Input::get('panelmember2'));

            $supId = Project::find(Input::get('projects'))->supervisorId;

            //check if supervisor is available at the given time period
            $supervisorResult = $this->checkAvailabilityMember(Input::get('date'), Input::get('startTime'), Input::get('endTime'), $supId);
            //check if the presentation venue is available at the given time period
            $locationResult = $this->checkVenueAvailability(null, Input::get('date'), Input::get('startTime'), Input::get('endTime'), Input::get('presentationvenue'));

            if (!$supervisorResult) {
                    return Redirect::back()
                        ->withErrors('Supervisor is unavailable during this time')
                        ->withInput();
            } else if (!$member1Result) {

                    return Redirect::back()
                        ->withErrors('Panel Member 1 is unavailable during this time')
                        ->withInput();
            } else if (!$member2Result) {

                    return Redirect::back()
                        ->withErrors('Panel Member 2 is unavailable during this time')
                        ->withInput();
            } /** check if another schedule allocated in same venue during that time */

            else if (!$locationResult) {

                    return Redirect::back()
                        ->withErrors('Selected venue already has another schedule during the time period')
                        ->withInput();
            }

            else {

                $panel = ThesisPresentationPanel::find($id);
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


                $date = Input::get('date');
                $startTime = Input::get('startTime');
                $endTime = Input::get('endTime');
                $venue = Input::get('presentationvenue');

                //send email to panel member 1
                $this->sendEmail($pm1,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

                //send email to panel member 2
                $this->sendEmail($pm2,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

                //send email to supervisor
                $this->sendEmail($sup,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

                //send email to student
                $this->sendEmail($student,$pm1,$pm2,$sup,$startTime,$endTime,$date,$venue);

                return Redirect::route('thesispanels.index')
                    ->with('message_success','Schedule successfully added!!');
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
        $id = Crypt::decrypt($id);

        $model = ThesisPresentationPanel::find($id);
        $model->delete();

        return redirect('thesispanels')->with('message_success', 'Panel Deleted!');
    }

    /*
     * Get the free slots of the supervisor and return as a json array
     */

    public function getSupervisor()
    {
        $projectId = Crypt::decrypt(Input::get('projectId'));

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
     * Get the free slots of the given member id
     */

    public function getPanelMember1()
    {
        $memberId = Crypt::decrypt(Input::get('memberId'));

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
     * Check for the availability of the member during the given time period
     */

    public function checkAvailabilityMember($date, $postStart, $postEnd, $memberId) {
        $result = false;

        $postStartTime = strtotime($date.' '.$postStart);
        $postEndTime = strtotime($date.' '.$postEnd);

        $freeSlots = FreeSlots::where('freeDay','=',$date)
            ->where('memberId','=',$memberId)
            ->get();

        foreach ($freeSlots as $slot) {

            $slotStartTime = strtotime($slot->freeDay.' '.$slot->startingHour.':'.$slot->startingMin);
            $slotEndTime = strtotime($slot->freeDay.' '.$slot->endingHour.':'.$slot->endingMin);

            if($slotStartTime <= $postStartTime && $slotEndTime >= $postEndTime) {
                $result = true;
            }
        }

        return $result;
    }

    /*
     * check if the venue is available during the given time period
     */

    public function checkVenueAvailability($id, $date, $postStart, $postEnd, $venue){
        $result = true;

        if(!$id) {
            $postStartTime = strtotime($date . ' ' . $postStart);
            $postEndTime = strtotime($date . ' ' . $postEnd);

            $venueSlots = ThesisPresentationPanel::where('date', '=', $date)
                ->where('venue', '=', $venue)
                ->get();

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

    /*
        showCalendar method returns an array containing all the presentation panels scheduled
     */

    public function showCalendar() {

        $events = ThesisPresentationPanel::join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id','projects.title','thesis_presentation_panels.date','thesis_presentation_panels.venue', 'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end')
            ->get();
//        dd($events);

        return view('thesispresentations.schedulecalendar')->with('events',$events);
    }

    /*
        This method sends email to the person notifying about the presentation schedule.
    */
    public function sendEmail($toPerson, $panelMember1, $panelMember2, $supervisor, $startTime, $endTime, $date, $venue) {
        Mail::send('emails.thesispresentationschedule', array(
            'name' => $toPerson->name,
            'panelMember1' => $panelMember1->name,
            'panelMember2' => $panelMember2->name,
            'supervisor' => $supervisor->name,
            'date' => Input::get('date'),
            'startingTime' => $startTime,
            'endingTime' => $endTime,
            'venue' => $venue),
            function ($message) use ($toPerson) {
                $message->to($toPerson->email, $toPerson->name)->subject('Thesis Presentation Schedule');
            });
    }

    /*
     * Display calendar along with the projects and panel members for scheduling presentations.
     */
    public function showThesisPresentationCalendar() {

        $events = ThesisPresentationPanel::join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id','thesis_presentation_panels.projectId','projects.title','thesis_presentation_panels.date','thesis_presentation_panels.venue', 'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end')
            ->get();

        $thesisProjectsToSchedule = Project::leftJoin('thesis_presentation_panels','projects.id','=','thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id','projects.id AS projectId','projects.title','thesis_presentation_panels.date','thesis_presentation_panels.venue', 'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end')
            ->where('projects.status','Proposal Evaluated')
            ->whereNull('thesis_presentation_panels.id')
            ->get();

        $supervisors = PanelMember::all();

        return view('thesispresentations.addPanelByCalander')
            ->with('events',$events)
            ->with('thesisProjects',$thesisProjectsToSchedule)
            ->with('supervisors',$supervisors);
    }

    /*
     * Returns the list of members who are available during the free time of supervisor.
     */
    public function getAvailableMembers() {
        $date = Input::get('date');
        $memberId1 = Input::get('supervisorId');
        $isRPC = Input::get('isRPC');

        $freeSlotsOfMember = FreeSlots::join('panelmembers','freeslots.memberId','=','panelmembers.id')
            ->where('freeDay','=',$date)
            ->where('memberId',$memberId1)
            ->get();

        if($isRPC=='true') {
            $freeSlotsOfOthers = FreeSlots::join('panelmembers','freeslots.memberId','=','panelmembers.id')
                ->where('freeDay','=',$date)
                ->where('memberId','!=',$memberId1)
                ->where('panelmembers.type','!=','RPC')
                ->get();
        } else {
            $freeSlotsOfOthers = FreeSlots::join('panelmembers', 'freeslots.memberId', '=', 'panelmembers.id')
                ->where('freeDay', '=', $date)
                ->where('memberId', '!=', $memberId1)
                ->where('panelmembers.type','RPC')
                ->get();
        }
        $availableMembers = array();

        foreach($freeSlotsOfMember as $freeSlotOfMember) {
            $memberStartTime = strtotime($date.' '.$freeSlotOfMember->startingHour.':'.$freeSlotOfMember->startingMin);
            $memberEndTime = strtotime($date.' '.$freeSlotOfMember->endingHour.':'.$freeSlotOfMember->endingMin);

            foreach($freeSlotsOfOthers as $freeSlotOfOthers) {
                $otherStartTime = strtotime($date.' '.$freeSlotOfOthers->startingHour.':'.$freeSlotOfOthers->startingMin);
                $otherEndTime = strtotime($date.' '.$freeSlotOfOthers->endingHour.':'.$freeSlotOfOthers->endingMin);

                if(($otherStartTime >= $memberStartTime && $otherEndTime <= $memberEndTime) || ($otherStartTime <= $memberStartTime && $otherEndTime >= $memberEndTime) ) {
//                    array_push($availableMembers,$freeSlotOfOthers->id => $freeSlotOfOthers->name,  );
                    $availableMembers[$freeSlotOfOthers->id] = $freeSlotOfOthers->name;
                }
            }
        }

        return Response::json(array(
            'success' => $isRPC,
            'members' => $availableMembers
        ));
    }

    /*
     * Checks whether the specified user is in the RPC role
     */

    public function checkIfRPC() {

        $supervisorId = Input::get('supervisorId');
        $supervisor = PanelMember::find($supervisorId);

        $selecteduser = User::join('panelmembers','panelmembers.email','=','users.email')
            ->where('users.email','=',$supervisor->email)
            ->select('users.id')
            ->first();

        $user = Sentinel::findById($selecteduser->id);
        $result = $user->inRole('rpc');

        return Response::json(array(
            'success' => true,
            'result' => $result
        ));

    }

    /*
     * Get the thesis projects which are supervised or managed by the panel created
     */

    public function getThesisProjects() {
        $supId = Input::get('supervisorId');
        $memberOneId = Input::get('memberOneId');
        $memberTwoId = Input::get('memberTwoId');

        $thesisProjectsToSchedule = Project::leftJoin('thesis_presentation_panels','projects.id','=','thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id','projects.id AS projectId','projects.title')
            ->where('projects.status','Proposal Evaluated')
            ->whereNull('thesis_presentation_panels.id')
            ->where(function($query) use($supId,$memberOneId,$memberTwoId) {
                $query->where('supervisorId',$supId)
                    ->orWhere('supervisorId',$memberOneId)
                    ->orWhere('supervisorId',$memberTwoId);
            })
            ->get();

        $events = ThesisPresentationPanel::join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->select('thesis_presentation_panels.id','thesis_presentation_panels.projectId','projects.title','thesis_presentation_panels.date','thesis_presentation_panels.venue', 'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end')
            ->get();


        return Response::json(array(
            'success' => true,
            'projects' => $thesisProjectsToSchedule,
            'events' => $events
        ));
    }

    /*
     * Updates the presentation slot through AJAX request in the scheduler
     */

    public function updateSchedule($id)
    {
        $ajax = Request::ajax();

        $thesispanel = ThesisPresentationPanel::find($id);

        $supId = Project::find($thesispanel->projectId)->supervisorId;
        $memberOneId = $thesispanel->memberOneId;
        $memberTwoId = $thesispanel->memberTwoId;
        $venue = $thesispanel->venue;
        $date = Input::get('date');
        $startTime = Input::get('startTime');
        $endTime = Input::get('endTime');

        $member1Result = $this->checkAvailabilityMember($date, $startTime, $endTime, $memberOneId);
        $member2Result = $this->checkAvailabilityMember($date, $startTime, $endTime, $memberTwoId);

        $supId = Project::find(Input::get('projects'))->supervisorId;

        //check if supervisor is available at the given time period
        $supervisorResult = $this->checkAvailabilityMember($date, $startTime, $endTime, $supId);

        //check if the presentation venue is available at the given time period
        //commented since only one panel at a time - client
//        $locationResult = $this->checkVenueAvailability(null, $date, $startTime, $endTime, $venue);

        if (!$supervisorResult) {

            if ($ajax) {
                return Response::json(array(
                    'error' => true,
                    'message' => 'Supervisor is unavailable during this time'
                ), 400);
            } else {
                return Redirect::back()
                    ->withErrors('Supervisor is unavailable during this time')
                    ->withInput();
            }
        } else if (!$member1Result) {

            if ($ajax) {
                return Response::json(array(
                    'error' => true,
                    'message' => 'Panel Member 1 is unavailable during this time'
                ), 400);
            } else {
                return Redirect::back()
                    ->withErrors('Panel Member 1 is unavailable during this time')
                    ->withInput();
            }
        } else if (!$member2Result) {

            if ($ajax) {
                return Response::json(array(
                    'error' => true,
                    'message' => 'Panel Member 2 is unavailable during this time'
                ), 400);
            } else {
                return Redirect::back()
                    ->withErrors('Panel Member 2 is unavailable during this time')
                    ->withInput();
            }
        }

        // check if another schedule allocated in same venue during that time
        // commented out since modified the scheduler to prevent overlapping schedules.
//        else if (!$locationResult) {
//
//            if ($ajax) {
//                return Response::json(array(
//                    'error' => true,
//                    'message' => 'Selected venue already has another schedule during the time period'
//                ), 400);
//            } else {
//                return Redirect::back()
//                    ->withErrors('Selected venue already has another schedule during the time period')
//                    ->withInput();
//            }
//        }
        else {

            $panel = ThesisPresentationPanel::find($id);
            $panel->date = $date;
            $panel->time_start = Input::get('startTime');
            $panel->time_end = Input::get('endTime');
            $panel->save();


            $pm1 = PanelMember::find(Input::get('panelmember1'));
            $pm2 = PanelMember::find(Input::get('panelmember2'));
            $sup = PanelMember::find($supId);
            $stuId = Project::find(Input::get('projects'))->studentId;
            $student = Student::find($stuId);


            $date = $date;
            $startTime = Input::get('startTime');
            $endTime = Input::get('endTime');
            $venue = Input::get('presentationvenue');

            //send email to panel member 1
            $this->sendEmail($pm1, $pm1, $pm2, $sup, $startTime, $endTime, $date, $venue);

            //send email to panel member 2
            $this->sendEmail($pm2, $pm1, $pm2, $sup, $startTime, $endTime, $date, $venue);

            //send email to supervisor
            $this->sendEmail($sup, $pm1, $pm2, $sup, $startTime, $endTime, $date, $venue);

            //send email to student
            $this->sendEmail($student, $pm1, $pm2, $sup, $startTime, $endTime, $date, $venue);

            return Response::json(array(
                'success' => true,
                'message' => 'Schedule successfully shifted!!'
            ));
        }
    }

    /**
    *   Get the details of the project
     */

    public function getProjectDetail($id) {

        $projectInfo = ThesisPresentationPanel::where('thesis_presentation_panels.id',$id)
            ->join('projects','projects.id','=','thesis_presentation_panels.projectId')
            ->join('panelmembers','panelmembers.id','=','projects.supervisorId')
            ->select('thesis_presentation_panels.*','projects.title', 'panelmembers.name')
            ->get();

        $panelMember1 = ThesisPresentationPanel::where('thesis_presentation_panels.id','=',$id)
            ->join('panelmembers','panelmembers.id','=','thesis_presentation_panels.memberOneId')
            ->select('panelmembers.name')
            ->first();

        $panelMember2 = ThesisPresentationPanel::where('thesis_presentation_panels.id','=',$id)
            ->join('panelmembers','panelmembers.id','=','thesis_presentation_panels.memberTwoId')
            ->select('panelmembers.name')
            ->first();

        Return Response::json(array(
            'project' => $projectInfo,
            'panelmember1' => $panelMember1,
            'panelmember2' => $panelMember2
        ));
    }
}
