<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\vehicle;
use App\driver;
use Request;
use DB;
class VehiclesController extends Controller {

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
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('vehicles')
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers);
	}

    public function store()
    {

        $realName = Request::get('driverId');
        $plateNumber = Request::get('plateNumber');
        $vehicleType = Request::get('vehicleType');
        $brand = Request::get('brand');
        $year = Request::get('year');

        $driverId = DB::table('driver')->where('realName', $realName )->pluck('id');

        $vehi = new Vehicle();
        $vehi->driverId = $driverId;
        $vehi->plateNumber = $plateNumber;
        $vehi->vehicleType = $vehicleType;
        $vehi->brand = $brand;
        $vehi->year = $year;

        $vehi->save();

        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('vehicles')
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers);
    }

    public function delete($id)
    {
        Vehicle::find($id)->delete();
        return redirect('/vehicles');

    }

    public  function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $drivers = Driver::all();
        $driverSelected = Driver::find($vehicle->driverId);

        return view('vehiedit')
            ->with('vehicleEdit', $vehicle)
            ->with('drivers', $drivers)
            ->with('driverSelected', $driverSelected);
    }

    public function update($id)
    {
        $updatevehicle = Vehicle::find($id); //initiate object to save
        $realName = Request::get('driverId');
        $updatevehicle->plateNumber = Request::get('plateNumber');
        $updatevehicle->vehicleType = Request::get('vehicleType');
        $updatevehicle->brand = Request::get('brand');
        $updatevehicle->year = Request::get('year');
        $updatevehicle->driverId = DB::table('driver')->where('realName', $realName )->pluck('id');

        $updatevehicle->save();

        $vehicle = Vehicle::all(); //return updated vehiclelist
        $drivers = Driver::all();
        return redirect('vehicles')
            ->with('vehicles', $vehicle)
            ->with('drivers', $drivers);
    }

}
