@extends('app')

@section('content')

    <div class="container">
        <div class="content">
            <h3>Edit Vehicle:</h3>

            <div class="modal-body">
                <!-- vehicle Saving Form -->
                <form class="form-horizontal" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group">
                        <label for="inputDriverName">Driver Name</label>
                        <select name="driverId" class="form-control">
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
                        <label for="inputVehiclePlate">Plate No.</label>
                        <input type="text" class="form-control" name="plateNumber" value="{{ $vehicleEdit->plateNumber }}" placeholder="Enter Vehicle Plate No.">
                    </div>

                    <div class="form-group">
                        <label for="inputVehicleType">Vehicle Type</label>
                        <input type="text" class="form-control" name="vehicleType" value="{{ $vehicleEdit->vehicleType }}" placeholder="Enter Vehicle Type">
                    </div>

                    <div class="form-group">
                        <label for="inputVehicleBrand">Vehicle Brand</label>
                        <input type="text" class="form-control" name="brand" value="{{ $vehicleEdit->brand }}" placeholder="Enter Vehicle Brand">
                    </div>

                    <div class="form-group">
                        <label for="inputDriverPassword">Model Year</label>
                        <input type="text" class="form-control" name="year" value="{{ $vehicleEdit->year }}" placeholder="Enter Model Year">
                    </div>

                    <!-- Footer moved up <button type="submit" class="btn btn-default">Submit</button> -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="{{ URL::to('/vehicles') }}" class="btn btn-default">Close</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
