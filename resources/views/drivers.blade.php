@extends('app')

@section('content')

<div class="container">
	<div class="content">
    
   <!-- Err <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Error!</strong> Better check yourself, you're not looking too good.
    </div> -->

		<h3>Drivers List:</h3>
    
    <div id="dialog" title="Drivers">
       <p>Jobs and vehicles associated will also be deleted. Proceed?</p>
    </div>
		
    <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Real Name</th>
                  <th>Login Name</th>
                  <th>Address</th>
                  <th>License No.</th>
                  <th>License Expiry</th>
                  <th>Active</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($drivers as $driver)
                    <tr>
                      <td> {{ $driver->id }} </td>
                      <td> {{ $driver->realName }} </td>
                      <td> {{ $driver->loginName }} </td>
                      <td> {{ $driver->address }} </td>
                      <td> {{ $driver->license }} </td>
                      <td> {{ $driver->licenseExpiry }} </td>
                      @if ($driver->isActive == '1')
                        <td> Yes </td>
                      @else
                        <td> No </td>
                      @endif
                      <td><a href="{{ URL::to('drivers/edit/') }}/{{ $driver->id }}">
                        <span title="Edit" class="glyphicon glyphicon-pencil" style="color:black"></span>
                      </a></td>
                      <!-- js method <td><a href="{{ URL::to('drivers/destroy/') }}/{{ $driver->id }}" onclick="return confirm('Are you sure?');"> -->
                      <td><a class="confirmDelete" href="{{ URL::to('drivers/destroy/') }}/{{ $driver->id }}">
                        <span title="Delete" class="glyphicon glyphicon-trash" style="color:black"></span>
                      </a></td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
	    
      <br>

        <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Driver
      </button>
      <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal2">
        Delete Driver
      </button> -->

      <!-- Add Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add Driver</h4>
            </div>

            <div class="modal-body">
              <!-- Driver Saving Form -->
                <form class="form-horizontal" method="post">
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDriverName">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="realName" placeholder="Enter Name">
                    </div> 
                  </div>
                
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDriverName">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="loginName" placeholder="Enter LoginName">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDriverAddress">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="address" placeholder="Enter Address">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDriverPhone">LicenseNo.</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="license" placeholder="Enter License No.">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDriverLicense">LicenseExp.</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="licenseExpiry">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDriverLicenseExp">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="password">
                    </div>
                  </div>                 

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <label>
                        <input type="checkbox" name="isActive" value="active">&nbsp; Active
                      </label>
                    </div>
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

      <!-- Delete Modal 
      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Delete Driver</h4>
            </div>
            <div class="modal-body">
              <form>
                  <div class="form-group">
                    <label for="inputDeleteID">Driver ID</label>
                    <input type="text" class="form-control" id="id" placeholder="Enter ID">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
  </div> -->

</div>

@endsection
