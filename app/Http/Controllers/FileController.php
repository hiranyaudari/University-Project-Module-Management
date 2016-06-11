<?php namespace App\Http\Controllers;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\report;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Session;
class fileController extends Controller
{

    public function __construct()
    {
      notificationController::showNotificationAccordingToCurrentUser();
    }

    public function select()
    {

        $rep = report::all();
        return view('auth.reportfile')->with('rr', $rep);


    }

    public function view()
    {

        return View('auth.reportfile');
    }


}