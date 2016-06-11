<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\FreeSlots;
use App\PanelMember;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class FreeSlotController extends Controller {

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    function store(){

        $freeSlotDate = Input::get("freeSlotDate");
        $startingDate =  Input::get("startingDate");
        $endingDate = Input::get("endingDate");

        $startingHour =substr($startingDate,0,2);
        $startingMin =substr($startingDate,3,4);

        $endingHour =substr($endingDate,0,2);
        $endingMin =substr($endingDate,3,4);

        $email  = Input::get('memberemail');

        $memberId  = PanelMember::where('email','=',$email)->pluck('id');


        $avalability  = $this->checkAvailabilityFreeSlot($freeSlotDate, $startingDate, $endingDate, $memberId);
            if($avalability==true) {
                $entry = new freeSlots;
                $entry->memberId = $memberId;
                $entry->freeDay = $freeSlotDate;
                $entry->startingHour = $startingHour;
                $entry->startingMin = $startingMin;
                $entry->endingHour = $endingHour;
                $entry->endingMin = $endingMin;

                if ($entry->save()) {
                    return $memberId;
                }
            }else{
                return "error";
            }

    }
    public function checkAvailabilityFreeSlot($date, $postStart, $postEnd, $memberId) {


        $postStartTime = strtotime($date.' '.$postStart);
        $postEndTime = strtotime($date.' '.$postEnd);

        $freeSlots = FreeSlots::where('freeDay',$date)
            ->where('memberId','=',$memberId)
            ->get();

        foreach ($freeSlots as $slot) {

            $slotStartTime = strtotime($slot->freeDay.' '.$slot->startingHour.':'.$slot->startingMin);
            $slotEndTime = strtotime($slot->freeDay.' '.$slot->endingHour.':'.$slot->endingMin);

            if( ($postStartTime >= $slotStartTime && $postEndTime <= $slotEndTime) ||
                ($postStartTime <= $slotStartTime && $postEndTime >= $slotStartTime) ||
                ($postStartTime <= $slotEndTime && $postEndTime >= $slotEndTime) ||
                ($postStartTime <= $slotStartTime && $postEndTime >= $slotEndTime)
              ) {
                return false;
            }

        }

        return true;
    }
//    function checkAvalabilityOfFreeSlot($memberId,$freeSlotDate,$startingHour,$startingMin,$endingHour,$endingMin){
//
//        $slotStartTimeInput = strtotime($freeSlotDate.' '.$startingHour.':'.$startingMin);
//        $slotEndTimeInput = strtotime($freeSlotDate.' '.$endingHour.':'.$endingMin);
//
//        $freeSlots =freeSlots::where('memberId',$memberId)->get();
//        foreach($freeSlots as $slot){
//
//            $slotStartTime = strtotime($slot->freeDay.' '.$slot->startingHour.':'.$slot->startingMin);
//            $slotEndTime = strtotime($slot->freeDay.' '.$slot->endingHour.':'.$slot->endingMin);
//
//            if($slotStartTime <= $slotStartTimeInput && $slotEndTime >= $slotEndTimeInput){
//                return false;
//            }
//        }
//
//
//    }
    function getSlotDetails(){

    }
    function deleteSlot(){
        $id =  Input::get('slotID');
        FreeSlots::where('id', '=', $id)->delete();
//        return json_encode($id);
    }
    function index(){
        $panelMembers = PanelMember::lists('email','name');
        $email = Sentinel::getUser()["email"];
        $currentUserSlots = FreeSlotController::getFreeSlotDetails($email);
        return view('addFreeSlot_Panel',compact('currentUserSlots','panelMembers'));
    }
    function getFreeSlotDetailsByEmail(){
        $panelMemberEmail = Input::get('panelMemberEmail');
        $currentUserSlots = FreeSlotController::getFreeSlotDetails($panelMemberEmail);
        return response()->json([
            'currentUserSolts'=>$currentUserSlots
        ]);


    }
    function getFreeSlotDetails($email){
        $panelMemberId =  PanelMember::where('email',$email)->pluck('id');
        $currentUserSlots = freeSlots::where('memberId',$panelMemberId)->get();
        return $currentUserSlots;

    }
    function load(){
        $email  = Sentinel::getUser()["email"];
        $currentUserSlots = freeSlots::where('memberId',$email)->get();
        return view('addFreeSlot_Panel',compact('currentUserSlots'));
    }
    function searchSpecificSlotByDate(){

        $freeDay =  Input::get('searchedate');
        $email  = Sentinel::getUser()["email"];
        $id =  PanelMember::where('email',$email)->pluck('id');
        $orThere = ['memberId' => $id,
            'freeDay' => $freeDay];
//        $qu = FreeSlots::where($orThere);
//        $slotId = FreeSlots::where($orThere)->pluck('id');
//        $memberId = FreeSlots::where($orThere)->pluck('memberId');
        $freeDay = FreeSlots::where($orThere)->pluck('freeDay');
//        $startingHour = FreeSlots::where($orThere)->pluck('startingHour');
//        $startingMin = FreeSlots::where($orThere)->pluck('startingMin');
//        $endingHour = FreeSlots::where($orThere)->pluck('endingHour');
//        $endingMin = FreeSlots::where($orThere)->pluck('endingMin');
        return json_encode($freeDay);
    }

    function deleteAllFreeSlots(){
        $email  = Input::get('panelMemberEmail');
        $id  = PanelMember::where('email',$email)->pluck('id');
        $result = freeSlots::where('memberId',$id)->delete();
        return json_encode($email);
    }

    function updateSpecificFreeSlot(){
        $id =  Input::get('inSlotId');
        $freeSlotDate = Input::get("freeSlotDate");
        $startingTime =  Input::get("startingTime");
        $endingTime = Input::get("EndingTime");

        $startingHour =substr($startingTime,0,2);
        $startingMin =substr($startingTime,3,4);

        $endingHour =substr($endingTime,0,2);
        $endingMin =substr($endingTime,3,4);

        $res= FreeSlots::where('id', $id)->update([
            'freeDay' =>$freeSlotDate ,
            'startingHour' => $startingHour,
            'startingMin' => $startingMin ,
            'endingHour'=> $endingHour,
            'endingMin'=> $endingMin
        ]);

        return json_encode($res);

    }
    function searchSpecificSlot(){
        $id =  Input::get('slotID');
        $memberId = freeSlots::where('id',$id)->pluck('memberId');
        $freeDay = freeSlots::where('id',$id)->pluck('freeDay');
        $startingHour = freeSlots::where('id',$id)->pluck('startingHour');
        $startingMin = freeSlots::where('id',$id)->pluck('startingMin');
        $endingHour = freeSlots::where('id',$id)->pluck('endingHour');
        $endingMin = freeSlots::where('id',$id)->pluck('endingMin');


        $stime = $startingHour.":".$startingMin;
        $etime = $endingHour.":".$endingMin;

        $newData = array(
            'id' => $id,
            "memberId" => $memberId,
            "freeDay" => $freeDay,
            "startingTime" => $stime,
            "endingTime" => $etime
        );

        return $newData;
    }


}
