@extends('app')

@section('content')

<style type="text/css">

  /* Sticky footer styles
  -------------------------------------------------- */

  html,
  body {
    height: 100%;
    /* The html and body elements cannot have any padding or margin. */
  }
 </style>
  

<html>

    
<body> 


<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div class="side-menu" style="z-index:100;">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle" id="navtoggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="#">
                    Navigation
                </a>
            </div> 

            <!-- Search 
            <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                <span class="glyphicon glyphicon-search"></span>
            </a> remove search togglebox-->

            <!-- Search body -->
            <!-- <div id="search" class="panel-collapse collapse"> remove collapse -->

        </div>

    </div>

    <!-- Main Menu -->
    <!-- <div class="side-menu-container"> -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <!-- Add extra link <li><a href="#"><span class="glyphicon glyphicon-send"></span> Link</a></li> -->
            <div id="search">
                <div class="panel-body">
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                          <input type="text" name="searchText" class="form-control" placeholder="Search by plate no.">
                        </div>
                        <button class="btn btn-default " type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                </div>
            </div>

            <!-- Search results if any -->
            @if (count($searchresults) > 0)
            <div class="panel-body">
              <ul class="nav navbar-nav">
                <form action="/">
                  <li> Search Results: &nbsp;&nbsp;
                    <button class="btn btn-danger btn-xs" type="submit"> 
                      <span class="glyphicon glyphicon-remove"></span>
                    </button>
                  </li>
                </form>
                <!-- Populate vehicle list (glyphicon shows User's status) -->
                @foreach($searchresults as $searchresult)
                   @if ($searchresult->status == "online")
                      <li>
                        <a href="#" onclick="recenter({{ $searchresult->id }});return false;">

                          <span class="glyphicon glyphicon-user" style="color:green">                          
                          </span>
                          {{ $searchresult->plateNumber }}
                        </a>
                      </li>
                   @elseif ($searchresult->status == "offline") 
                      <li>
                        <a href="#" onclick="recenter({{ $searchresult->id }});return false;">

                          <span class="glyphicon glyphicon-user" style="color:red">                          
                          </span>
                          {{ $searchresult->plateNumber }}
                        </a>
                      </li>
                   @endif
                @endforeach
                @if (count($searchresults) == 0)
                  <li>No records returned!</li>
                @endif
              </ul>
            </div>
            @endif

            <!-- Dropdown Active Vehicles-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-user" style="color:green"></span> Active Vehicles <span class="caret"></span>
                </a>

                <!-- Dropdown List Active -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <!-- fetch parameters from controller & populate list -->
                            @foreach($vehicles as $vehicle)
                               @if ($vehicle->status == "online")
                                 <li><a href="#" onclick="recenter({{ $vehicle->id }});return false;">{{ $vehicle->plateNumber }}</a></li>
                               @endif
                            @endforeach
                            @if (count($activecount) == 0)
                              <li>No active vehicles!</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </li>

            <!-- Dropdown Inactive Vehicles-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl2">
                    <span class="glyphicon glyphicon-user" style="color:red"></span> Inactive Vehicles <span class="caret"></span>
                </a>

                <!-- Dropdown List Inactive -->
                <div id="dropdown-lvl2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <!-- fetch parameters from controller & populate list -->
                            @foreach($vehicles as $vehicle)
                              @if ($vehicle->status == "offline")
                                <li><a href="#" onclick="recenter({{ $vehicle->id }});return false;">{{ $vehicle->plateNumber }}</a></li>
                              @endif
                            @endforeach
                            @if (count($inactivecount) == 0)
                              <li><a href="#">No inactive vehicles!</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
</div>

        <!-- Main Content -->

  <div class="container-fluid">
    <div class="side-body">        

    </div>

      <div id="map" style="position:absolute;z-index:0;"> 
        <div id="map"><script> load(); </script></div>
      </div>

  </div>
  
</body>
</html>


@endsection
