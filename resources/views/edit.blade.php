@extends('app')

@section('content')

<div class="container">
	<div class="content">
		<h3>Edit Driver:</h3>

     <div class="modal-body">
      <!-- Driver Saving Form -->
        <form class="form-horizontal" method="post">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputDriverName">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="realName" value="{{ $driverEdit->realName }}" placeholder="Enter Name">
            </div> 
          </div>
        
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputDriverName">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="loginName" value="{{ $driverEdit->loginName }}" placeholder="Enter LoginName">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputDriverAddress">Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="address" value="{{ $driverEdit->address }}" placeholder="Enter Address">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputDriverPhone">LicenseNo.</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="license" value="{{ $driverEdit->license }}" placeholder="Enter License No.">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputDriverLicense">LicenseExp.</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="licenseExpiry" value="{{ $driverEdit->licenseExpiry }}">
            </div>
          </div>
          <!-- 
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputDriverLicenseExp">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password">
            </div>
          </div>                 
          -->
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <label>
                @if ($driverEdit->isActive == '1')
                  <input type="checkbox" name="isActive" checked="checked">&nbsp; Active
                @else
                  <input type="checkbox" name="isActive">&nbsp; Active
                @endif
              </label>
            </div>
          </div>  

          <!-- Footer moved up <button type="submit" class="btn btn-default">Submit</button> -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="{{ URL::to('/drivers') }}" class="btn btn-default">Close</a>
          </div>
        </form>
     </div>    

	</div>
</div>

@endsection
