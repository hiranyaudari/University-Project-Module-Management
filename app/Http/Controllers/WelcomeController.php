<?php namespace App\Http\Controllers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

class WelcomeController extends Controller {


    public function __construct()
    {
        notificationController::showNotificationAccordingToCurrentUser();

    }

	public function index()
	{
        $login = Sentinel::check();

        if($login) {

            //redirect the users to their relevant dashboards
            if ($login->inRole('students')) {
                return Redirect::to('studentdashboard');
            } elseif ($login->inRole('panelmembers')) {
                return Redirect::to('panelmemberdashboard');
            } elseif ($login->inRole('rpc')) {
                return Redirect::to('rpcdashboard');
            }
        }

        else {
            return Redirect::to('login');
        }

	}

}
