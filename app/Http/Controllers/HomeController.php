<?php namespace App\Http\Controllers;

use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
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
		$vehicleIdSearched = "";
		$searchresults = array();
		$query = DB::table('vehicle');
		
		if (isset($_GET["searchText"])) //fetch query search string
		{
			$vehicleIdSearched = strtoupper($_GET["searchText"]); //convert uppercase
			$query->where('plateNumber','like',"%".$vehicleIdSearched."%");
			$searchresults = $query->get();
		}

		$vehicles = DB::select('select id, plateNumber, status from vehicle');
		$activecount = DB::select('select id from vehicle where status = "online"');
		$inactivecount = DB::select('select id from vehicle where status = "offline"');
		return view('home')->with('vehicles', $vehicles)
						   ->with('activecount', $activecount)
						   ->with('inactivecount', $inactivecount)
						   ->with('searchresults', $searchresults);
	}

	public function postSearch()
	{

	}

	public function getDownload()
	{
		
	}

}
