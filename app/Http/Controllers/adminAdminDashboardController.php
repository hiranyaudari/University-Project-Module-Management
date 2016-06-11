<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class adminAdminDashboardController extends Controller {

//
//    public function __construct()
//    {
////        $this->middleware('auth');
//        Session::flush();
//        Session::push('notification', notificationController::GetAllUnreadNotification('RPC'));
//    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
       // $member = PanelMember::where('panelmembers.username','=', Auth::user()->username)->first();
        $currentUser  = "sachithr7";//$member->name;//\Auth::user()->name;
        $currentUserPosition = "Student";//Auth::user()->role;
        return View('adminAdminDashboard',compact('currentUser','currentUserPosition'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
