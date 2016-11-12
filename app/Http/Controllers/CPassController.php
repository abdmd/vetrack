<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\User;

use Auth;
use Request;
use Hash;

class CPassController extends Controller {

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
		//
		$success = -1; //disable error alerts
		return view('changepass')->with('success', $success);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$curpass = Request::get('currentpassword');
		$newpass = Request::get('newpassword');
		$confirmpass = Request::get('confirmpassword');
		$user = Auth::user();

		if (strlen($curpass) > 0 && Hash::check($curpass, $user->password)) //validate currentpass
		{
			if ($newpass == $confirmpass && strlen($newpass) > 3) //check newpass matches confirmpass
			{
				$user->password = Hash::make($confirmpass);
				$user->save(); //update db with new pass
				$success = 2; //password changed msg
			} else {
				$success = 0; //mismatch error
			}
		} else {
			$success = 1; //invalid currentpass
		}
		return view('changepass')->with('success', $success);		
	}

}
