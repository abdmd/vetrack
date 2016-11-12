@extends('app')

@section('content')

    <div class="container">
        <div class="content">

            <h3>Jobs:</h3>

              <div id="dialog" title="Jobs">
                <p>Delete this job?</p>
              </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Driver</th>
                        <th>Job Title</th>
                        <th>Job Details</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $driverId = DB::table('driver')->where('id', $job->driverId )->pluck('realName')}}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->detail }}</td>
                            <td>{{ $job->startDate }}</td>
                            <td>{{ $job->endDate }}</td>
                            <td>{{ $job->status }}</td>
                            <td><a href="{{URL::to( '/jobedit/'.$job->id)}}" ><span class="glyphicon glyphicon-pencil" style="color:black"></span></a></td>
                            <td><a class="confirmDelete" href="{{URL::to('/delete/'.$job->id)}}"><span class="glyphicon glyphicon-trash" style="color:black"></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Job
            </button>

            <!-- Add Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Job</h4>
                        </div>

                        <div class="modal-body">
                            <!-- Driver Saving Form -->
                            <form method="post">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                <div class="form-group">
                                    <label for="inputDriverName">Driver Name</label>
                                    <select name="driverId" class="form-control">
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->realName }}">{{ $driver->realName }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputTitle">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Job Title">
                                </div>

                                <div class="form-group">
                                    <label for="inputDetail">Details</label>
                                    <textarea class="form-control" rows="4" name="detail" placeholder="Job Detail"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputStartDate">StartDate</label>
                                    <input type="date" class="form-control" name="startDate" placeholder="Job Start Date">
                                </div>

                                <div class="form-group">
                                    <label  for="inputEndDate">EndDate</label>
                                    <input type="date" class="form-control" name="endDate" placeholder="Job End Date">
                                </div>

                                <div class="form-group">
                                    <label  for="inputStatus">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="In-Progress">In-Progress</option>
                                    </select>
                                </div>


                                <!-- Footer moved up <button type="submit" class="btn btn-default">Submit</button> -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
