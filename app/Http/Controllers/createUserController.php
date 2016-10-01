<?php

namespace App\Http\Controllers;

use App\PanelMember;
use App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class createUserController extends Controller {

    public function __construct() {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function index() {
        $tags = DB::table('research_areas')->lists('research_area');
        //dd($tags);
        return View('addUser', compact('tags'));
    }

    public function storeUser(Request $request) {
        $username = $request::get('username');
        $email = $request::get('email');
        $password = bcrypt($request::get('password'));
        $designation = $request::get('designation');
        $role = $request::get('role');
        $fullname = $request::get('fullname');
        $researcharea = $request::get('researcharea');

        //  $enteredEmail = null;
        $enteredEmailarr = PanelMember::where('email', $email)->get();
        $enteredUserNamearrAlreadyExistInPanalMeberTable = PanelMember::where('email', $email)->get();
        $enteredUserNamearrAlreadyExistInUserTable = User::where('email', $email)->get();

        if (!$enteredUserNamearrAlreadyExistInPanalMeberTable->count() &&
                !$enteredUserNamearrAlreadyExistInUserTable->count()) {
            if (!$enteredEmailarr->count()) {

                createUserController::addUser($email, $password, $role);
//            User::create(['username' => $username,
//                'password' => $password,
//                'role' => $role
//            ]);

                PanelMember::create(['name' => $fullname,
                    'designation' => $designation,
                    'email' => $email,
                    'phone' => null,
                    'speciality' => $researcharea,
                    'type' => $role,
                    'status' => 'Approved',
                    'university' => null,
                    'cv' => null,
                ]);
            } else {

                return Redirect::back()
                                ->with('flash_message', 'ERROR, You Entered email belongs to already existing account. ')
                                ->with('flash_type', 'alert-danger');
            }
        } else {

            return Redirect::back()
                            ->with('flash_message', 'ERROR, You Entered user Name belongs to already existing account. ')
                            ->with('flash_type', 'alert-danger');
        }
    }

    public function validateEmail() {
        
    }

    public static function addUser($email, $password, $role) {
        $user = Sentinel::registerAndActivate(array(
                    'email' => $email,
                    'password' => $password,
        ));
//      $user = Sentinel::findById(1);
        $role = Sentinel::findRoleByName($role);
        $role->users()->attach($user);
    }

    function updateUserindex() {
        $categories1 = PanelMember::lists('name', 'username');
        return view('updateUser', compact('categories1', 'user'));
    }

    function updateUserindexstore() {

        $username = Input::get('username');
        $email = Input::get('email');
        $role = Input::get('role');
        $designation = Input::get('designation');
        $fullName = Input::get('fullName');

        $res = PanelMember::where('username', $username)->update([
            'name' => $fullName,
            'email' => $email,
            'type' => $role,
            'designation' => $designation
        ]);


        return json_encode($res);
    }

    function search() {

        $searchName = Input::get('sid');
        $q = PanelMember::where('username', $searchName);
        $email = PanelMember::where('username', $searchName)->pluck('email');
        $fullName = PanelMember::where('username', $searchName)->pluck('name');
        $designation = PanelMember::where('username', $searchName)->pluck('designation');
        $role = PanelMember::where('username', $searchName)->pluck('type');
        $data = array("email" => $email, "designation" => $designation, "type" => $role, "name" => $fullName);
        return json_encode($data);
    }

    public function getDetails($id) {
        //Retrieve post details
        $data["post"] = Blog::post_details($id);

        //Retrieve comments for this post
        $data["comments"] = $comments = Blog::post_comments($id, 4);

        //Comments pagination
        $data["comments_pages"] = $comments->links();

        if (Request::ajax()) {
            $html = View::make('blog.post_comments', $data)->render();
            return Response::json(array('html' => $html));
        }

        return View::make('blog.post', $data);
    }
    
    /*this method belongs to the evaluationController, had a route problem*/
    function searchforStudents() {

        $searchId = Input::get('sid');

        /*get project title according to the student's id*/
	//$protitle = \App\Evaluation::where('studentId', $searchId)->pluck('title');
        $protitle = DB::table('projects')
                    ->where('studentId', $searchId)
                    ->Where('status', 'Approved')
                    ->pluck('title');
        
        /*get project id according to the student's id*/
        //$proid = \App\Evaluation::where('studentId', $searchId)->pluck('id');
        $proid = DB::table('projects')
                    ->where('title', $protitle)
                    ->Where('status', 'Approved')
                    ->pluck('id');
        
       /*get student name according to the student's id*/
	$stuname = DB::table('students')
                    ->where('id', $searchId)
                    ->pluck('name');
	      
        $data = array("title" => $protitle, "pid" => $proid, "sname" => $stuname);
        return json_encode($data);
    }

}
