<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\driver;
use App\job;
use Request;
use DB;
class AssignJobController extends Controller {

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
    public function index($id)
    {
        $drivers = Driver::all();
        $driverSelected = Driver::find($id);
        return view('assignjob')
            ->with('driverSelected', $driverSelected)
            ->with('drivers', $drivers);
    }

    public function store()
    {

        $realName = Request::get('driverId');
        $title = Request::get('title');
        $detail = Request::get('detail');
        $status = Request::get('status');
        $startDate = Request::get('startDate');
        $endDate = Request::get('endDate');

        $driverId = DB::table('driver')->where('realName', $realName )->pluck('id');

        $jb = new Job();
        $jb->driverId = $driverId;
        $jb->title = $title;
        $jb->detail = $detail;
        $jb->status = $status;
        $jb->startDate = $startDate;
        $jb->endDate = $endDate;

        $jb->save();

        $drivers = Driver::all();
        $jobs = Job::all();
        return redirect('jobs')
            ->with('jobs', $jobs)
            ->with('drivers', $drivers);
    }
}