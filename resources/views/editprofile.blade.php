@extends('app')

@section('content')
    <div class="container">
        @if ($success == '1')
            <div class="alert alert-success" role="alert">Your profile has been updated.</div>
        @endif
      <form method="post">
      	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <h3 class="form-signin-heading">Edit My Profile</h3>
        </br>
        Name:
        <input type="text" name="fullname" class="form-control" value="{{ $usertoedit->name }}" placeholder="Name" required>
        </br>
        Email:
        <input type="email" name="emailaddress" class="form-control" value="{{ $usertoedit->email }}" placeholder="Email address" required>
    	</br>
        <button type="submit" class="btn btn-primary">Change</button>
      </form>
        
    </div> <!-- /container -->

@endsection