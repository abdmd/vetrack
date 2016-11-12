@extends('app')

@section('content')

    <div class="container">
        <div class="content">
            <h3>Vehicles List:</h3>
    
              <div id="dialog" title="Vehicles">
                <p>Delete this vehicle?</p>
              </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Driver</th>
                        <th>Plate No.</th>
                        <th>Vehicle Type</th>
                        <th>Vehicle Brand</th>
                        <th>Model Year</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $driverId = DB::table('driver')->where('id', $vehicle->driverId )->pluck('realName')}}</td>
                            <td>{{ $vehicle->plateNumber }}</td>
                            <td>{{ $vehicle->vehicleType }}</td>
                            <td>{{ $vehicle->brand }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td><a href="{{URL::to( '/vehiedit/'.$vehicle->id) }}" ><span class="glyphicon glyphicon-pencil" style="color:black"></span></a></td>
                            <td><a class="confirmDelete" href="{{URL::to('/vehidelete/'.$vehicle->id) }}"><span class="glyphicon glyphicon-trash" style="color:black"></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

            <br>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Vehicle
            </button>

            <!-- Add Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
                        </div>

                        <div class="modal-body">
                            <!-- Driver Saving Form -->
                            <form method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label for="inputDriverName">Driver Name</label>
                                    <select name="driverId" class="form-control">
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->realName }}">{{ $driver->realName }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputVehiclePlate">Plate No.</label>
                                    <input type="text" class="form-control" name="plateNumber" placeholder="Enter Vehicle Plate No." required>
                                </div>

                                <div class="form-group">
                                    <label for="inputVehicleType">Vehicle Type</label>
                                    <input type="text" class="form-control" name="vehicleType" placeholder="Enter Vehicle Type">
                                </div>

                                <div class="form-group">
                                    <label for="inputVehicleBrand">Vehicle Brand</label>
                                    <input type="text" class="form-control" name="brand" placeholder="Enter Vehicle Brand">
                                </div>

                                <div class="form-group">
                                    <label for="inputDriverPassword">Model Year</label>
                                    <input type="text" class="form-control" name="year" placeholder="Enter Model Year">
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