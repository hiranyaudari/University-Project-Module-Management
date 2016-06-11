<?php namespace App\Http\Controllers;

use App\PendingProject;
use App\Project;
use App\ProjectPool;
use App\ExternalSupervisor;
use App\ExtSupProject;
use App\Http\Requests;
use App\event_time_line;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\PanelMember;
use App\Student;
use App\PresentationPanel;
use App\ThesisPresentationPanel;

class PanelMemberController extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function showDashboard(){
        //get logged Panel Member email
        $currentUserEmail = Sentinel::getUser()["email"];
        //get logged Panel Member Member ID
        $currentPanelMemberId = PanelMember::where('email',$currentUserEmail)->pluck('id');
        //get future events belongs to current panel member asc order
        $currentPanelMemberTimeLine = event_time_line::where('memberID',$currentPanelMemberId)->where('eventDate','>=',date("Y-m-d"))->where('validity','1')->orderBy('eventDate', 'asc')->get();
        //get requested Supervisor Meetings belongs to current panel member
        $SupervisorMeetingRequests =  event_time_line::where('memberID',$currentPanelMemberId)->where('validity','0')->get();
        //get Accepted Supervisor Meetings belongs to current panel member
        $AcceptedSupervisorMeetingRequests =  event_time_line::where('memberID',$currentPanelMemberId)->where('validity','1')->get();
        //get proposal presentation time slots belong to the current panel member
        $FutureProposalTimeSlotsForCurrentPanelMember = PanelMemberController::getFutureProposalTimeSlotsForCurrentPanelMember($currentPanelMemberId);
        //get Thesis presentation time slots belong to the current panel member
        $FutureThesisTimeSlotsForCurrentPanelMember = PanelMemberController::getFutureThesisTimeSlotsForCurrentPanelMember($currentPanelMemberId);
        //add Thesis presentation time slots to array
        $thesis_array = PanelMemberController::getArrayForEvents($FutureThesisTimeSlotsForCurrentPanelMember,'thesis');
        //add Proposal presentation time slots to array
        $proposal_array = PanelMemberController::getArrayForEvents($FutureProposalTimeSlotsForCurrentPanelMember,'proposal');
        //add Thesis presentation time slots to array
        $accepted_supervisor_requests_array =PanelMemberController::getSupervisorMeetingRequests($AcceptedSupervisorMeetingRequests);
        //add Supervisor Requests to array
        $supervisor_requests_array =PanelMemberController::getSupervisorMeetingRequests($SupervisorMeetingRequests);
        //merge supervisor requests,Proposal Presentation, Thesis Presentation array into one array
        $all_events_belongs_to_current_panel_member = array_merge($thesis_array,$proposal_array,$accepted_supervisor_requests_array);//array_merge($thesis_array,$proposal_array);

        return view('dashboards.panel_member_dashboard',compact('currentPanelMemberTimeLine','supervisor_requests_array','all_events_belongs_to_current_panel_member'));
    }

    public static function getArrayForEvents($panelsTimeSlots_for_current_user,$type){

        $PanelMemberFutureEvents=array();
        for($i=0;$i < $panelsTimeSlots_for_current_user->count();$i++) {
            if ($type == 'proposal') {
                $arr = array([
                    'date' => $panelsTimeSlots_for_current_user[$i]->proposal_date,
                    'time' => $panelsTimeSlots_for_current_user[$i]->proposal_time_start,
                    'eTime' => $panelsTimeSlots_for_current_user[$i]->proposal_time_end
                ]);

            } else {
                $arr = array([
                    'date' => $panelsTimeSlots_for_current_user[$i]->thesis_date,
                    'time' => $panelsTimeSlots_for_current_user[$i]->thesis_time_start,
                    'eTime' => $panelsTimeSlots_for_current_user[$i]->thesis_time_end
                ]);
            }

            array_push($PanelMemberFutureEvents,$arr);
        }
        return $PanelMemberFutureEvents;
    }
    public static function getFutureProposalTimeSlotsForCurrentPanelMember($currentPanelMemberId){

        $proposal_presentation_panelsTimeSlots_for_current_user =
            Project::join('presentationpanels','presentationpanels.projectId','=','projects.id')
                ->select('presentationpanels.id as proposal__id','projects.title as proposal__title','presentationpanels.date as proposal_date', 'presentationpanels.time_start as proposal_time_start', 'presentationpanels.time_end as proposal_time_end')
                ->where('projects.status','!=','Proposal Evaluated')
                ->where(function ($query) use ($currentPanelMemberId) {
                    $query->orwhere('presentationpanels.memberOneId',$currentPanelMemberId)
                        ->orwhere('presentationpanels.memberTwoId',$currentPanelMemberId)
                        ->orwhere('projects.supervisorId',$currentPanelMemberId);

                })->get();

        return $proposal_presentation_panelsTimeSlots_for_current_user;
    }
    public static function getFutureThesisTimeSlotsForCurrentPanelMember($currentPanelMemberId){

        $thesis_presentation_panelsTimeSlots_for_current_user = Project::join('thesis_presentation_panels','thesis_presentation_panels.projectId','=','projects.id')
            ->select('thesis_presentation_panels.id as thesis__id','projects.title as thesis__title','thesis_presentation_panels.date as thesis_date', 'thesis_presentation_panels.time_start as thesis_time_start', 'thesis_presentation_panels.time_end as thesis_time_end')
            ->where('projects.status','!=','Thesis Evaluated')
            ->where(function ($query) use ($currentPanelMemberId) {
                $query->orwhere('thesis_presentation_panels.memberOneId',$currentPanelMemberId)
                    ->orwhere('thesis_presentation_panels.memberTwoId',$currentPanelMemberId)
                    ->orwhere('projects.supervisorId',$currentPanelMemberId);
            })->get();
        return $thesis_presentation_panelsTimeSlots_for_current_user;
    }
    function getSupervisorMeetingRequests($SupervisorMeetingRequests){
        $SupervisorMeetingRequestsArr=array();
        for($i=0; $i< $SupervisorMeetingRequests->count() ;$i++){
            $studentID = $SupervisorMeetingRequests[$i]->from;
            $projectTitle = Project::where('studentId',$studentID)->pluck('title');
            $endTime='';
            if($SupervisorMeetingRequests[$i]->eventType ==='Supervisor Meeting'){

                $time = strtotime($SupervisorMeetingRequests[$i]->eventTime);
                $endTime = date("H:i:s", strtotime('+30 minutes', $time));
            }

            $arr =
                array([
                    'studentRegId'=> $studentID,
                    'projectTitle'=> $projectTitle,
                    'date' => $SupervisorMeetingRequests[$i]->eventDate,
                    'time' => $SupervisorMeetingRequests[$i]->eventTime,
                    'eventid' => $SupervisorMeetingRequests[$i]->id,
                    'reason' => $SupervisorMeetingRequests[$i]->eventName,
                    'eTime' => $endTime
                ]);
            array_push($SupervisorMeetingRequestsArr,$arr);
        }
        return $SupervisorMeetingRequestsArr;
    }
}
