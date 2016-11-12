@extends('app')

@section('content')

    <div class="container">
        <div class="content">
            <h3>Assign Job:</h3>

            <div class="modal-body">
                <!-- vehicle Saving Form -->
                <form class="form-horizontal" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <div class="form-group">
                        <label for="inputDriverName">Driver Name</label>
                        <select name="driverId" class="form-control" value="Nabeeh">
                            @foreach($drivers as $driver)
                                @if ($driverSelected->realName != $driver->realName)
                                    <option value="{{ $driver->realName }}">{{ $driver->realName }} </option>
                                @else
                                    <option value="{{ $driver->realName }}" selected="selected">{{ $driver->realName }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Job Title" autofocus>
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
                        <a href="{{ URL::to('/') }}" class="btn btn-default">Close</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
