<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\driver;
use App\job;
use App\User;
use Request;
use DB;
use Auth;
use Hash;
use Validator;

class RegisterController extends Controller {

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
        return view('register')->with('success', $success);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function store()
    {
        $name = Request::get('name');
        $email = Request::get('email');
        $newpass = Request::get('password');
        $confirmpass = Request::get('password_confirmation');

        // get the value from the form
        $input['email'] = $email;

        // shouldnt exist in the `email` column of `users` table
        $rules = array('email' => 'unique:users,email');

        $validator = Validator::make($input, $rules);

        if (!$validator->fails()) { //check email exist already
            if ($newpass == $confirmpass && strlen($newpass) > 3) //check newpass matches confirmpass
            {
                //register new user
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->password = Hash::make($confirmpass);
                $user->save(); //update db with new pass
                $success = 2; //password changed msg
            } else {
                $success = 0; //mismatch error
            }
        } else {
            $success = 1; //email existing
        }      

        return view('register')->with('success', $success);       
    }
}