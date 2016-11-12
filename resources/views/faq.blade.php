@extends('app')

@section('content')

    <div class="container">
        <div class="content">

            <h1>FAQ</h1>
            </br>
            <h4>1: I forgot my password, How do I reset it?</h4>
            <p> If you lost your password, you can reset your password by clicking the forgot password link and enter the email address which
            tied to your account then a link will be sent to help you reset your account password.</p>

            <h4>2: Can I register a Driver on my own?</h4>
            <p> No, you cant register drivers on your own. An Admin has the power to Add,Edit and Delete Driver Details from the website</p>

            <h4>3: Can I assign my own Vehicle?</h4>
            <p> No, vehicles will be assigned to Drivers by Operators based on your Driving skill and licenced type of Vehicles</p>

            <h4>4: Can I pick jobs on my own?</h4>
            <p> No, Operators are going to Assign the Drivers to their Jobs based on the location the driver is operating at that moment.</p>

            <h4>5: How are Vehicles Synchronized?</h4>
            <p> Operators Will assign Drivers to Vehicles than they will Assign Jobs to the Drivers. when the Driver logs on the mobile App
            the Driver will get a list oh jobs assigned to him. when the Driver selects a job the app will load the map for navigation and starts sending
            Gps location to the server and synchronized the tracker on the main page.</p>

            <h4>6: Is it possible to use this system for another purpose?</h4>
            <p>No. Currently this system is intended for company usage, and not encouraged to use for any different purposes.</p>

            <h4>7: How to contact us?</h4>
            <p> For further enquires, please feel free to contact us at vetracksys@gmail.com.</p>
        </div>
    </div>

@endsection
