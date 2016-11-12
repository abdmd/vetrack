<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>veTrack</title>

	<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"> <!-- browser icon -->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<!-- <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet"> -->
	<!-- <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet"> -->
    <!-- CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="{{ asset('/css/sidemenu.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }

    </style>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script
		src="http://maps.googleapis.com/maps/api/js">
	</script>

	<script>
		    
		var map, infoWindow, intervalId;
		var	markers = [];
		var markerStore = {};
		var customIcons = {
		    online: {
		        //icon: 'http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_blue.png'
		        icon: 'http://maps.google.com/mapfiles/marker_green.png'
		    },
		    offline: {
		        //icon: 'http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_red.png'
		        icon: 'http://maps.google.com/mapfiles/marker.png'
		    }
		};

		function load() {
		    map = new google.maps.Map(document.getElementById("map"), {
		        //center: new google.maps.LatLng(47.6145, -122.3418),
		        center: new google.maps.LatLng(3.082398,101.589368),
		        zoom: 15,
		        mapTypeId: 'roadmap'
		    });

		    infoWindow = new google.maps.InfoWindow;

		    // Trigger downloadUrl at an interval
		    intervalId = setInterval(triggerDownload, 5000);
		}

		function bindInfoWindow(marker, map, infoWindow, html) {
		    google.maps.event.addListener(marker, 'click', function () {
		        infoWindow.setContent(html);
		        infoWindow.open(map, marker);
		    });
		}

		function triggerDownload() {
		    // download DOM of marker data XML file
		    downloadUrl("/download/updateMarkersXML.php", function (data) {
		        var xml = data.responseXML;
		        markers = xml.documentElement.getElementsByTagName("marker");
		        //add markers
		        for (var i = 0; i < markers.length; i++) {
		        	
		            var vehicleId = markers[i].getAttribute("id");
		            var driverId = markers[i].getAttribute("driverid");
		            var realName = markers[i].getAttribute("realName");
		            var vehicleType = markers[i].getAttribute("vehicleType");
		            var plateNumber = markers[i].getAttribute("plateNumber");
		            var status = markers[i].getAttribute("status").toLowerCase();
		    		var lat = parseFloat(markers[i].getAttribute("lat"));
		            var lng = parseFloat(markers[i].getAttribute("lng"));
		            //var html = "<b>" + name + "</b> <br/>" + address + "<br/>" + point;
		            var html = "<b> Vehicle Details </b>" + 
		            		   "<br/> Driver: " + realName +
		            		   "<br/> Plate No: " + plateNumber +
		            		   "<br/> Vehicle: " + vehicleType +
		            		   "<br/> <a href='/assignjob/" + driverId + "' <button class='btn btn-default btn-xs'>Assign Job</button></a>";
		            		   
		            var icon = customIcons[status] || {};
   			            //check marker exist in markerStore
   			            var result;
   			            result = markerStore.hasOwnProperty(markers[i].getAttribute("id"));
   			        
   			            if (result) {
   			            	//update existing marker
   			            	markerStore[markers[i].getAttribute("id")].setPosition(
   			            	           	new google.maps.LatLng(lat,lng));
   			            	markerStore[markers[i].getAttribute("id")].setIcon(icon.icon);
   			            }else{
	   			            //create new marker
	   			            var marker = new google.maps.Marker({
				                map: map,
				                position: new google.maps.LatLng(lat,lng),
				                icon: icon.icon
				            });
			        		markerStore[markers[i].getAttribute("id")] = marker; //mkstore index = vehicleid
		        		}
		            
		            //stops the loop -- if marker not unique
		            bindInfoWindow(markerStore[markers[i].getAttribute("id")], map, infoWindow, html); 
		        }
		    });
		}

		function downloadUrl(url, callback) {
		    var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

		    request.onreadystatechange = function () {
		        if (request.readyState == 4) {
		            request.onreadystatechange = doNothing;
		            callback(request, request.status);
		        }
		    };

		    request.open('GET', url, true);
		    request.send(null);
		}

		function recenter(vId) {
		    for (var i = 0; i < markers.length; i++)
		    {
		    	if (markers[i].getAttribute("id") == vId) //check marker v_id match search id
		    	{
		    		//set new center latlng and zoom
					map.panTo(new google.maps.LatLng(markers[i].getAttribute("lat"), markers[i].getAttribute("lng")));
			    	map.setZoom(15);
		    		return;
		    	}
		    }
	    }

	    function searchVehicle(plate)
	    {
	    	//var plate = document.getElementsByName("searchText").value;
	    	alert(plate);
	    	for (var i = 0; i < markers.length; i++)
		    {
		    	if (markers[i].getAttribute("plateNumber") == plate) //check marker v_id match search id
		    	{
		    		//set new center latlng and zoom
					map.panTo(new google.maps.LatLng(markers[i].getAttribute("lat"), markers[i].getAttribute("lng")));
			    	map.setZoom(15);
		    		return;
		    	}
		    }
	    }

		//stub
		function doNothing() {}
	</script>

</head>
<body>
	<nav class="navbar navbar-default" style="z-index:200">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">veTrack</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="z-index:200;">
				<ul class="nav navbar-nav">
					@if (!Auth::guest())
						<li class="{{Request::path() == '/' ? 'active' : ''}}"><a href="{{ url('/') }}">Home &nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
						<li class="{{Request::path() == 'drivers' ? 'active' : ''}}"><a href="{{ url('drivers') }}">Drivers &nbsp;<span class="glyphicon glyphicon-road"></span></a></li>					
						<li class="{{Request::path() == 'vehicles' ? 'active' : ''}}"><a href="{{ url('vehicles') }}">Vehicles &nbsp;<span class="glyphicon glyphicon-map-marker"></span></a></li>
						<li class="{{Request::path() == 'jobs' ? 'active' : ''}}"><a href="{{ url('jobs') }}">Jobs &nbsp;<span class="glyphicon glyphicon-briefcase"></span></a></li>
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">Register</a></li> Backend-registration-->
					@else
						<li class="dropdown">
							<a href="{{url('/')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<!-- <span class="glyphicon glyphicon-user"></span> -->
								<img src="{{asset('images/nopic.png')}}" alt="profilepic" height="28" width="28">
								  &nbsp; {{ Auth::user()->name }} 
								<span class="caret"></span></a>

							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/editprofile') }}"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit My Profile</a></li>
								<li><a href="{{ url('/changepassword') }}"><span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Change Password</a></li>
								<li><a href="{{ url('/faq') }}"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;FAQ</a></li>
								<li role="presentation" class="divider"></li>
								<li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Register User</a></li>
								<li role="presentation" class="divider"></li>
								<li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
	
	
 <!-- Copyright footer <div id="footer">
      <div class="container">
        <p class="muted credit"><small>&copy; Copyright 2015 INTI International University &amp; Colleges. All Rights Reserved.</small></p>
      </div>
    </div> -->

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> <!-- confirm dialog -->
	<script src="{{ asset('/js/sidemenu.js') }}"></script>


</body>
</html>
