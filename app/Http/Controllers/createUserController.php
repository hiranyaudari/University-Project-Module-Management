<?php namespace App\Http\Controllers;


use App\PanelMember;
use App\User;
use App\Http\Requests;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class createUserController extends Controller {


    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function index()
    {
        return View('addUser');
    }
    public function storeUser(Request $request)
    {
        $username = $request::get('username');
        $email = $request::get('email');
        $password = bcrypt($request::get('password'));
        $designation = $request::get('designation');
        $role = $request::get('role');
        $fullname = $request::get('fullname');

        //  $enteredEmail = null;
        $enteredEmailarr = PanelMember::where('email', $email)->get();
        $enteredUserNamearrAlreadyExistInPanalMeberTable = PanelMember::where('email', $email)->get();
        $enteredUserNamearrAlreadyExistInUserTable = User::where('email', $email)->get();

if(!$enteredUserNamearrAlreadyExistInPanalMeberTable->count() && !$enteredUserNamearrAlreadyExistInUserTable->count()){
        if (!$enteredEmailarr->count()) {

            createUserController::addUser($email,$password,$role);
//            User::create(['username' => $username,
//                'password' => $password,
//                'role' => $role
//            ]);

            PanelMember::create(['name' => $fullname,
                'designation' => $designation,
                'email' => $email,
                'phone' => null,
                'speciality' => null,
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
    }else{

return Redirect::back()
->with('flash_message', 'ERROR, You Entered user Name belongs to already existing account. ')
->with('flash_type', 'alert-danger');
}


        }
    public function validateEmail(){

    }
    public static function addUser($email,$password,$role){
        $user= Sentinel::registerAndActivate(array(
            'email'    => $email,
            'password' => $password,
        ));
//        $user = Sentinel::findById(1);
        $role = Sentinel::findRoleByName($role);
        $role->users()->attach($user);
    }
function updateUserindex(){
    $categories1 =  PanelMember::lists('username','username');
    return view('updateUser',compact('categories1','user'));
}
    function updateUserindexstore(){

        $username = Input::get('username');
        $email = Input::get('email');
        $role = Input::get('role');
        $designation = Input::get('designation');
        $fullName = Input::get('fullName');

       $res= PanelMember::where('username', $username)->update([
            'name' =>$fullName ,
            'email' => $email,
            'type' => $role ,
            'designation' => $designation
        ]);


        return json_encode($res);
    }
    function search(){

        $searchName = Input::get('sid');
        $q= PanelMember::where('username', $searchName);
        $email= PanelMember::where('username', $searchName)->pluck('email');
        $fullName= PanelMember::where('username', $searchName)->pluck('name');
        $designation= PanelMember::where('username', $searchName)->pluck('designation');
        $role= PanelMember::where('username', $searchName)->pluck('type');
        $data = array("email" => $email,"designation" => $designation,"type" => $role,"name" => $fullName);
        return json_encode($data);

    }

    public function getDetails($id){
        //Retrieve post details
        $data["post"] = Blog::post_details($id);

        //Retrieve comments for this post
        $data["comments"] = $comments = Blog::post_comments($id,4);

        //Comments pagination
        $data["comments_pages"] = $comments->links();

        if(Request::ajax())
        {
            $html = View::make('blog.post_comments', $data)->render();
            return Response::json(array('html' => $html));
        }

        return View::make('blog.post', $data);
    }

}

