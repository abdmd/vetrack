@extends('app')

@section('content')
    <div class="container">
    	@if ($success == '0')
    		<div class="alert alert-warning" role="alert">Password confirmation mismatch, minimum 4 characters required.</div>
    	@elseif ($success == '1')
    		<div class="alert alert-warning" role="alert">Current password is invalid.</div>
    	@elseif ($success == '2')
			<div class="alert alert-success" role="alert">Your password has been changed.</div>
    	@endif
      <form method="post">
      	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <h3 class="form-signin-heading">Change Password</h3>
        </br>
        <label for="inputPassword" class="sr-only">Current Password</label>
        <input type="password" name="currentpassword" class="form-control" placeholder="Current password" required>
        </br>
        <label for="inputPassword" class="sr-only">New Password</label>
        <input type="password" name="newpassword" class="form-control" placeholder="New password" required>
    	</br>
        <label for="inputPassword" class="sr-only">Confirm Password</label>
        <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password" required>
        </br>
        <button type="submit" class="btn btn-primary">Change</button>
      </form>
        
    </div> <!-- /container -->

@endsection