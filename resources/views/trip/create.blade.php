<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Places Searchbox</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/create_trip.css') }}" rel="stylesheet">
    <script src="{{ asset('js/create_trip.js') }}"></script>

  	</head>
  	<body>
  	<div style="width: 45%; float: left; margin-left: 10px;">
		<div class="form-group" class="">
			<label for=""> title </label>
			<input type="text" class="form-control" id="trip_title">
		</div>


		<form action="/ok" enctype="multipart/form-data" id="uploadCover" method="POST">
			<div class="form-group">
				<label for=""> cover </label>
				<input type="file" id="cover" name="cover">
			</div>	
	  	</form>
	 	

	 	<div class="form-group" class="">
			<label for=""> sum member </label>
			<input type="text" class="form-control" id="trip_sum_member">
		</div>

		<div class="form-group" class="">
			<label for=""> start place </label>
			<input type="text" id="trip_start_place" class="form-control">
		</div>

		<div class="form-group" >
			<label for=""> status </label>
			<input type="text" class="form-control" id="trip_note">
		</div>

<!-- 		<form class="form-inline" accept-charset="utf-8">
			<div class="form-group" >
				<label for=""> start date </label>
				<input type="date" class="form-control" id="trip_start_date" placeholder="start date">
			</div>
			<div class="form-group">
				<label for=""> end date </label>
				<input type="date" class="form-control" placeholder="end date" id="trip_end_date">
			</div>
		</form> -->

	    <div class="form-group" style="margin-top: 20px; margin-left: 10px;">
	    	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
	    	<div id="map"></div>
	    </div>

    	<input onclick="addJson()" type="button" value="display route">
	</div>

	<div style="width: 50%; height: 700px; float: left;">

	  	<div class="chapter" id="list-plan">
	  		<p></p>
	  	</div>
		<div>
<!-- 			<input onclick="clearMarkers();" type=button value="Hide Markers">
		    <input onclick="showMarkers();" type=button value="Show All Markers">
		    <input onclick="deleteMarkers();" type=button value="Delete Markers">
			<input onclick="directions()" type="button" value="display route">
			<input type="button" onclick="hiddenRoute()" value="hidden route"> -->
			
		</div>
	</div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlkPRpU8Qk221zsdBOpn8cVl_WDSBtIWk&libraries=places&callback=initAutocomplete"
    async defer></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>
	<script>



  </script>

  	</body>
</html>