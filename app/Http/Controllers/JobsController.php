<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\driver;
use App\job;
use Request;
use DB;
class JobsController extends Controller {

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
        $jobs = Job::all();
        return view('jobs')
            ->with('jobs', $jobs)
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
        return view('jobs')
            ->with('jobs', $jobs)
            ->with('drivers', $drivers);
    }

    public function delete($id)
    {
        Job::find($id)->delete();
        return redirect('/jobs');

    }

    public  function edit($id)
    {
        $jobs = Job::find($id);
        $drivers = Driver::all();
        $driverSelected = Driver::find($jobs->driverId);

        return view('jobedit')
            ->with('jobEdit', $jobs)
            ->with('drivers', $drivers)
            ->with('driverSelected', $driverSelected);
    }

    public function update($id)
    {
        $updatejob = Job::find($id); //initiate object to save
        $realName = Request::get('driverId');
        $updatejob->title = Request::get('title');
        $updatejob->detail = Request::get('detail');
        $updatejob->status = Request::get('status');
        $updatejob->startDate = Request::get('startDate');
        $updatejob->endDate = Request::get('endDate');

        $updatejob->driverId = DB::table('driver')->where('realName', $realName )->pluck('id');

        $updatejob->save();

        $jobs = Job::all(); //return updated vehiclelist
        $drivers = Driver::all();
        return redirect('jobs')
            ->with('jobs', $jobs)
            ->with('drivers', $drivers);
    }
}