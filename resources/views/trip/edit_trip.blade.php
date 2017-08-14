<!DOCTYPE html>
<html>
  <head>
	    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Places Searchbox</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('picker/jquery.datetimepicker.css') }}"/ >
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
	<script src="{{ asset('picker/jquery.datetimepicker.full.min.js') }}"></script>

    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/create_trip.css') }}" rel="stylesheet">
    <script src="{{ asset('js/edit_trip.js') }}"></script>
	<noscript> bạn cần bật js </noscript>
	</style>

  	</head>
  	<body>
  	<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="http://localhost/bigproject/public/user/detail-info/{{Auth::user()->id}}">Profile</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
	
	<input type="hidden" id="trip_id" value="{{$trip->id}}" disabled>
	<div id="location-input">
		@foreach($plans as $key => $plan)
			<div>
				<input type="hidden" disabled id="lat_{{$key}}" value="{{$plan->place_start_lat}}">
				<input type="hidden" disabled id="lng_{{$key}}" value="{{$plan->place_start_lng}}">
			</div>
		@endforeach
	</div>
  	<div style="width: 45%; float: left; margin-left: 10px;">
		<div style="width: 100%; height: 400px">
		</div>

	    <div class="form-group map" style="margin-top: 20px; margin-left: 10px;">
	    	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
	    	<div id="map"></div>
	    	<input onclick="addJson()" type="button" value="submit" class="button-submit">
	    </div>

    	
	</div>

	<div style="width: 50%; height: 700px; float: left;">
  	<div >
  		<div class="alert alert-danger" id="errors" >
			<ul id="show-errors">
			</ul>
  		</div>
  	</div>	

		<div class="up-div"">
			<div class="form-group" class="">
				<label for=""> title </label>
				<input type="text" class="form-control" id="trip_title" value="{{$trip->title}}">
			</div>


			<form action="/ok" enctype="multipart/form-data" id="uploadCover" method="POST">
				<div class="form-group">
					<label for=""> cover </label>
					<input type="file" id="cover" name="cover" >
				</div>	
		  	</form>
		 	

		 	<div class="form-group" class="">
				<label for=""> sum member </label>
				<input type="text" class="form-control" id="trip_sum_member" value="{{$trip->sum_member}}">
			</div>

			<div class="form-group" class="">
				<label for=""> start place </label>
				<input type="text" id="trip_start_place" class="form-control" value="{{$trip->start_place}}">
			</div>

			<div class="form-group" >
				<label for=""> status </label>
				<input type="text" class="form-control" id="trip_note" value="{{$trip->status}}">
			</div>

		</div>

	  	<div class="chapter" id="list-plan">
	  		<p></p>
	  		@foreach($plans as $plan)
	  		
			<div style="border: 5px solid #CCCCCC; padding:10px; margin: 10px; border-radius: 20px; background: #F1F1F1">	
				<label for="">place start</label> <input  class="form-control" type="text"  value="{{$plan->start_place}}">
				<label for="">place end</label> <input class="form-control" type="text"  value="{{$plan->end_place}}">
				<label for="">time start </label> <input class="datetimepicker" type="text" value="{{$plan->time_start}}" style="margin:10px; border-radius:3px; padding: 3px;"  > 
				<label for=""> time end </label><input class="datetimepicker" type="text" value="{{$plan->time_end}}" style="margin:10px 0 0 95px; border-radius:3px; padding: 3px;">
				<br>
				<label for="">vehicle </label> <input type="text" value="{{$plan->verhicle}}" style="width: 175px; border-radius:3px; padding: 4px; margin-left: 23px;" >
				<label for="" style="margin-left:10px;">active in end place </label> <input type="text" value="{{$plan->active}}" style="width: 230px; border-radius:3px; padding: 3px; margin-left:32px;" >
				<input type="hidden" disabled value="{{$plan->place_start_lat}}">
				<input type="hidden" disabled value="{{$plan->place_start_lng}}">
			</div>
			@endforeach
	  	</div>
		<div>
<!-- 		<input onclick="clearMarkers();" type=button value="Hide Markers">
		    <input onclick="showMarkers();" type=button value="Show All Markers">
		    <input onclick="deleteMarkers();" type=button value="Delete Markers">
			<input onclick="directions()" type="button" value="display route">
			<input type="button" onclick="hiddenRoute()" value="hidden route"> -->
		</div>
	</div>
	<script type="text/javascript">
		var sum_place = $('#location-input div').size();
		$(document).ready(function () {
			jQuery('#datetimepicker').datetimepicker();
			jQuery('.datetimepicker').datetimepicker();
		});
		
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlkPRpU8Qk221zsdBOpn8cVl_WDSBtIWk&libraries=places&callback=initAutocomplete"
    async defer></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>
	<script>



  </script>

  	</body>
</html>