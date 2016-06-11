<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\PanelMember;
use Illuminate\Http\Request;

use Input, Redirect, DB, Hash, Mail, URL, Response;


class profileController extends Controller {

	public function selectSupervisor()
    {
        $supervisors=PanelMember::lists('name','id');

         return view('Rubika.profileView')->with('sup',$supervisors);
    }

    public function viewPanelMemberInfo()
    {
        $ID=Input::get('supervisorID');

        $supInfo=PanelMember::where('id','=',$ID)
            ->select('name as pName','designation as designation','email as email','phone as contact','speciality as interest')->get();
//
//        $projects=Projects::where('supervisorId','=',$ID)->pluck('title');
////        ->with('projects',$projects)

        return json_encode($supInfo);

    }

    public function viewProfile()
    {
        if (isset($_POST['viewProfile'])) {
            $supervisors = PanelMember::lists('name');

            $supName = Input::get('supervisor');
            $panel = PanelMember::where('name',$supName)->get();
            $id = PanelMember::where('name', '=', $supName)->pluck('id');

           /* $name = $supId->select('name');
            $designation = $supId->select('designation');
            $email = $supId->select('email');
            $phone = $supId->select('phone');
            $interest = $supId->select('speciality');*/

            $proTitles = Project::where('supervisorId', '=',$id )->pluck('title');

            return view('Rubika.supProfile',compact($panel))->with('supervisors', $supervisors)->with('projects',$proTitles)->with('selected',$supName);
        }

    }




}
