<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Grouping;
use Illuminate\Http\Request;
use \DB;
use App\Quotation;

class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function viewPool()
	{

		/*getting current logged users email*/
		$currentUserEmail = Sentinel::getUser()["email"];
		
		/*getting name for the email*/
		$leaderName= Grouping::where('email','=',$currentUserEmail)->pluck('name');
		
		/*getting current users batch from ID*/
		$id = Grouping::where('email','=',$currentUserEmail)->pluck('regId');

		/*concatenating the batch from ID array*/
		$batch = $id[2].$id[3];

		/*filtering student pool according to current user*/
		$students = DB::select("SELECT name,email 
		 FROM students
		 WHERE email!='$currentUserEmail' 
		 AND courseField = (select courseField from students where email = '$currentUserEmail')
		 AND regId LIKE '__$batch%'
		 AND grouped IS NULL
                            ");
		return view('grouping/grouping', compact('students','leaderName'));
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
	public function storetoNotifiTable($names)
	{
            dd($names[0]);
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
