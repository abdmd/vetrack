<?php namespace App\Http\Controllers;

use Request;
use App\driver;
use DB;
use App\vehicle;
use App\job;

class DriversController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Drivers Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$drivers = Driver::all();
		return view('drivers')->with('drivers', $drivers);
	}

	public function store()
	{
		//fetch form input values
		$drName = Request::get('realName');
		$drLName = Request::get('loginName');
		$drAddress = Request::get('address');
		$drLicense = Request::get('license');
		$drLicenseExp = Request::get('licenseExpiry');
		$drPassword = Request::get('password');
		$drActive = Request::has('isActive') ? 1 : 0;
		
		//save in db
		$newdriver = new Driver(); //initiate object to save
		$newdriver->realName = $drName;
		$newdriver->loginName = $drLName;
		$newdriver->address = $drAddress;
		$newdriver->license = $drLicense;
		$newdriver->licenseExpiry = $drLicenseExp;
		$newdriver->password = md5($drPassword);
		$newdriver->isActive = $drActive; //always return 1 (tofix)

		$newdriver->save();

		$drivers = Driver::all(); //return updated driverlist
		return view('drivers')->with('drivers', $drivers);
	}

	public function edit($id)
	{
		$driver = Driver::find($id);

		return view('edit')->with('driverEdit', $driver);
	}

	public function destroy($id)
	{
		$driverToDelete = Driver::find($id);
		$driverToDelete->delete();

		//get vehicle id linked to driver id
		$driverFromVehicle = DB::table('vehicle')->where('driverId', $id)->pluck('id');
		$vehicleToDelete = Vehicle::find($driverFromVehicle);
		$vehicleToDelete->delete();
		//jobs linked to driver
		$jobsFromVehicle = DB::table('job')->where('driverId', $id)->pluck('id');
		$jobToDelete = Job::find($jobsFromVehicle);
		$jobToDelete->delete();
		
		$drivers = Driver::all(); //return updated driverlist
		return view('drivers')->with('drivers', $drivers);
	}

	public function update($id)
	{
		$updatedriver = Driver::find($id); //initiate object to save
		$updatedriver->realName = Request::get('realName');
		$updatedriver->loginName = Request::get('loginName');
		$updatedriver->address = Request::get('address');
		$updatedriver->license = Request::get('license');
		$updatedriver->licenseExpiry = Request::get('licenseExpiry');
		$updatedriver->isActive = Request::get('isActive'); //always return 1 (tofix)

		$updatedriver->save();

		$drivers = Driver::all(); //return updated driverlist
		return redirect('drivers')->with('drivers', $drivers);
	}
}
