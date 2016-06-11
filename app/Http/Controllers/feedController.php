<?php namespace App\Http\Controllers;
use App\freeslot;
use App\Http\Requests;

use  Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\UserInterface;
use View;
use Illuminate\Support\Facades\DB;
use Hash;
use Mail;
use App\monthlyfeed;
use Session;

//use Illuminate\Http\Request;

class feedController extends Controller
{

    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();
    }

    public function addfeed()
    {


        $rules = array(
            'st_id' => 'required|min:10|alphaNum',
            'project_id' => 'required|alphaNum',
            'feedback' => 'required|min:10',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('feed')->withErrors($validator)->withInput()->with('message', 'FAILED');
        } else {

            $user = new monthlyfeed();
            $user->student_id = Input::get('st_id');
            $user->project_id = Input::get('project_id');
            $user->date = Input::get('dt');
            $user->feedback = Input::get('feedback');

            $user->save();

            if ($user->save())
                return Redirect::to('feed')->with('message', 'Successfully saved!');
        }

    }


    
    public function update()
    {
        if (isset($_POST['add'])) {
            foreach ($_POST['checkbox'] as $checkbox) {
               $user = monthlyfeed::find($checkbox);
              $user->delete();
               return Redirect::to('viewfeedback')->with('message', 'Successfully deleted');
            }
        }

    }



}