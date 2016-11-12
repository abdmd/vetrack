<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\User;

use Auth;
use Request;

class ProfileController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$usertoedit = Auth::user();
		$success = 0;
		return view('editprofile')->with('usertoedit', $usertoedit)
								  ->with('success', $success);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$fullname = Request::get('fullname');
		$email = Request::get('emailaddress');
		$user = Auth::user();
		$user->name = $fullname;
		$user->email = $email;
		$user->save(); //update user profile		
		$success = 1;

		return view('editprofile')->with('success', $success)		
								  ->with('usertoedit', $user);
	}

}
