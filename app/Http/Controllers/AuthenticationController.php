<?php namespace App\Http\Controllers;

use App\FreeSlots;
use App\Http\Requests;
use App\MonthlyReport;
use App\PanelMember;
use App\PresentationPanel;
use App\Project;
use App\ThesisPresentationPanel;
use App\User;
use Barryvdh\DomPDF\PDF;
use Validator, Input, Redirect, Hash, Mail, URL;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\PasswordReset;
use App\Student;
use Illuminate\Http\Request;
use Session;
use Response;

class AuthenticationController extends Controller
{

    public function getForgotPassword()
    {

        return view('pages.forgotpassword');
    }

    public function postForgotPassword(Request $request)
    {

        $validator = Validator::make(input::all(),
            array
            (
                'email' => 'required|email'
            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $passRst = PasswordReset::where('email', '=', Input::get('email'));

            if ($passRst) {
                $passRst->delete();
            }

            $student = Student::where('email', '=', Input::get('email'))->first();

            if ($student != null) {

                $user = User::where('email', '=', $student->email)->first();

                if ($user != null) {
                    $passwordReset = new PasswordReset;
                    //generate a new code and password
                    $code = str_random(60);
                    $password = str_random(10);

                    $passwordReset->email = $student->email;
                    $passwordReset->code = $code;
                    $passwordReset->save();

                    $tempGeneratedPassword = Hash::make($password);
                    $passwordReset->tempPassword = $tempGeneratedPassword;

                    $user->password = $tempGeneratedPassword;
                    $user->save();

                    if ($passwordReset->save()) {
                        $passwordReset = PasswordReset::Where('code', '=', $code)->first();

                        Mail::send('emails.forgotpassword', array('link' => URL::route('password-recover', $code), 'name' => $student->name, 'password' => $password, 'time' => $passwordReset->created_at->format('Y-m-d H:i:s')), function ($message) use ($student, $user) {
                            $message->to($student->email, $student->name)->subject('Password Change Request');
                        });

                        return Redirect::to('/login')->with('message_success', 'We have sent you an email that you can use to change your password');
                    }
                }
            } else {
                return Redirect::back()->withErrors('Email address does not match any records');
            }
        }

    }

    public function getRecoverPassword($code)
    {

        $pr = PasswordReset::where('code', '=', $code)->first();

        if ($pr != null) {
            return view('pages.recoverPassword', compact('pr', 'code'));
        } else {
            \Session::flash('message_error', 'Unauthorized recovery code!!');
            return view('errors.404');
        }

    }

    public function postResetPassword()
    {
        $rules = array(
            'currentPassword' => 'required', // make sure the email is an actual email
            'newPassword' => 'required|min:6', // password can only be alphanumeric and has to be greater than 3 characters
            'confirmPassword' => 'required|same:newPassword'
        );

        $messages = array(
            'currentPassword.required' => 'You have to enter the password provided in the email',
            'newPassword.required' => 'You must enter a new password',
            'confirmPassword.required' => 'You must confirm your password',
            'confirmPassword.same' => 'Both passwords do not match'
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator); // send proposalpresentations all errors to the login form;
        } else {
            Input::merge(array_map('trim', Input::all()));
            $pcode = Input::get('code');

            $passwordRst = PasswordReset::where('code', '=', $pcode)->first();
            $student = Student::where('email', '=', $passwordRst->email)->first();
            $user = User::where('email', '=', $student->email)->first();

            if ($passwordRst != null) {
                $currentPassword = Input::get('currentPassword');
                if (Hash::check($currentPassword, $passwordRst->tempPassword)) {
                    $userEmail = $passwordRst->email;
                    $user->password = Hash::make(Input::get('newPassword'));
                    $user->save();

                    $passwordRst->delete();

                    \Session::flash('message_success', 'Password successfully changed!!');
                    return Redirect::to('/login');
                } else {
                    return Redirect::back()
                        ->withErrors(['Please check your temporary password again!']);
                }

            } else {
                \Session::flash('message_error', 'Password could not be changed!!');
                return Redirect::to('/login');
            }
        }
    }

    /*
     * Check if the user is already logged in. If not show the login view.
     */

    public function showLogin()
    {

        if (Sentinel::check())
            return Redirect::to('/');

        return view('auth.login');
    }

    /*
     * Process the input data and log in the authenticated user
     */

    public function postLogin()
    {

        $input = Input::all();

        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        );

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $remember = (bool)Input::get('remember', false);

        //validate input against login data
        $user = Sentinel::authenticate($credentials, $remember);

        //login if the user is valid
        if ($user) {

            $login = Sentinel::login($user);

            //redirect the users to their relevant dashboards
            if ($login->inRole('students')) {
                return Redirect::to('studentdashboard');
            } elseif ($login->inRole('panelmembers')) {
                return Redirect::to('panelmemberdashboard');
            } elseif ($login->inRole('rpc')) {
                return Redirect::to('rpcdashboard');
            }
        }

        $errors = 'Email or password does not match any records';


        return Redirect::back()
            ->withInput()
            ->withErrors($errors);
    }

    public function logout()
    {
        Sentinel::logout();
        return Redirect::to('/login');
    }

    public function getTestFunction()
    {
        $month = 4;

        $proposalpanels = PresentationPanel::join('panelmembers as p1',function($query) {
                $query->on('presentationpanels.memberOneId','=','p1.id');
            })
            ->join('panelmembers as p2',function($query) {
                $query->on('presentationpanels.memberTwoId', '=', 'p2.id');
            })
            ->join('projects as prj',function($query) {
                $query->on('presentationpanels.projectId', '=', 'prj.id');
            })
            ->join('panelmembers as sup',function($query) {
                $query->on('prj.supervisorId', '=', 'sup.id');
            })
            ->select('p1.*', 'p2.*', 'sup.*')
            ->get();

        $panels = ThesisPresentationPanel::join('projects as prj','prj.id','=','thesis_presentation_panels.projectId')
            ->join('panelmembers as p1',function($query) {
                $query->on('thesis_presentation_panels.memberOneId','=','p1.id');
            })
            ->join('panelmembers as p2',function($query) {
                $query->on('thesis_presentation_panels.memberTwoId', '=', 'p2.id');
            })
            ->join('panelmembers as sup',function($query) {
                $query->on('prj.supervisorId', '=', 'sup.id');
            })
            ->select('prj.title','thesis_presentation_panels.date','thesis_presentation_panels.venue',
                'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end', 'p1.name as PanelMember1',
                'p2.name as PanelMember2', 'sup.name as `Supervisor`' )
            ->get();

        dd($panels);
    }

    public function postTestFunction()
    {

    }

    public function ajaxTestFunction() {
        $panels = ThesisPresentationPanel::join('projects as prj','prj.id','=','thesis_presentation_panels.projectId')
            ->join('panelmembers as p1',function($query) {
                $query->on('thesis_presentation_panels.memberOneId','=','p1.id');
            })
            ->join('panelmembers as p2',function($query) {
                $query->on('thesis_presentation_panels.memberTwoId', '=', 'p2.id');
            })
            ->join('panelmembers as sup',function($query) {
                $query->on('prj.supervisorId', '=', 'sup.id');
            })
            ->select('prj.title','thesis_presentation_panels.date','thesis_presentation_panels.venue',
                'thesis_presentation_panels.time_start', 'thesis_presentation_panels.time_end', 'p1.name as PanelMember1',
                'p2.name as PanelMember2', 'sup.name as `Supervisor`' )
            ->get();

        $html = "<div class=\"table-responsive\">
                    <table id=\"thesispanels\" class=\"table table-hover issue-tracker thesispanels\">
                        <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Time Slot</th>
                            <th>Supervisor</th>
                            <th>Panel Member 1</th>
                            <th>Panel Member 2</th>
                        </tr>
                        </thead>
                        <tbody>";

        foreach ($panels as $panel) {
            $html += "<tr>
                                <td class=\"text-primary\">{{ $panel->title }}</td>
                                <td>{{ $panel->title }}</td>
                                <td>{{ $panel->date }}</td>
                                <td>{{ $panel->venue }}</td>
                                <td>{{ $panel->time_start }} {{ $panel->time_end }}</td>
                                <td>{{ $panel->supervisor }}</td>
                                <td>{{ $panel->panelmember1 }}</td>
                                <td>{{ $panel->panelmember2 }}</td>
                            </tr>";
        }

        $html = "</tbody>
                    </table>
                </div>";

        return \PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->stream('presenationpanels.pdf');
    }
}
