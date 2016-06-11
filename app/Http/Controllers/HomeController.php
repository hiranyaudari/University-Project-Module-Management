<?php namespace App\Http\Controllers;
use Session;
class HomeCohomentroller extends Controller {


//    public function __construct()
//    {
////        $this->middleware('auth');
//        Session::flush();
//        Session::push('notification', notificationController::GetAllUnreadNotification('RPC'));
//    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

}
