@extends('/layouts.index')
	<?php
		$link_img = asset($trip->cover);
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail-trip.css') }}">
    <script src="{{ asset('js/create_trip.js') }}"></script>
	<style type="text/css" media="screen">

		div#cover{
			width: 1000px;
			height: 500px;
			background-image: url({{$link_img}});
			background-size: cover;
			border-radius: 10px;
		}


		

	</style>

@section('content_right')
	<div id="info-trip" style="width: 1150px">
		<div id="cover">
		</div>

		<div id="detail">
			<strong>
				title: {{$trip->title}}
			</strong><br>
			<strong>
				sum member: {{$trip->sum_member}}
			</strong> <br>
			<strong>
				start_place: {{$trip->start_place}}	
			</strong>
		</div>

		<div id="plan_list" >
			@foreach($plans as $key => $plan)
			<div class="plan">
				<div class = "stt">
					{{$key+1}}
				</div>
				<div class="from-to" >
					<b> from: {{$plan->start_place}} <br>  to: {{$plan->end_place}}<b>
				</div>
				<div class="time" >
					<b> time_start: {{$plan->time_start}} <br> time end: {{$plan->time_end}} </b>
				</div>
				<div class="vehicle">
					<b> vehicle: {{$plan->verhicle}} <br> active: {{$plan->active}} <b>
				</div>
			</div>
			@endforeach
		</div>

		<div id="status">
			<div style="">
				status
			</div>
			<div style="">
				{{$trip->status}}
			</div>
		</div>

		<div id="content-map" >
			<div id="location-input">
				@foreach($plans as $key => $plan)
					<div>
						<input type="hidden" disabled id="lat_{{$key}}" value="{{$plan->place_start_lat}}">
						<input type="hidden" disabled id="lng_{{$key}}" value="{{$plan->place_start_lng}}">
					</div>
				@endforeach
			</div>
			<div id="map" >
				
			</div>
		</div>
	</div>
	<div id="button">
		<form action="#cover">
	    	<input type="submit" value="show cover" class="btn btn-primary btn-md" />
		</form>
		
		<form action="#plan_list">
	    	<input type="submit" value="show plan" class="btn btn-primary btn-md" />
		</form>
		<form action="#status">
	    	<input type="submit" value="show status" class="btn btn-primary btn-md" />
		</form>
		<form action="#map">
	    	<input type="submit" value="show map" class="btn btn-primary btn-md" />
		</form>

	</div>
	<div class="comment">
		
	</div>

	<script type="text/javascript">

		var markers = [];
		var sum_place = $('#location-input div').size();

		function initAutocomplete() {

			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 21.0245, lng: 105.84117},
				zoom: 13,
				mapTypeId: 'roadmap'
			});

		  	var directionsService = new google.maps.DirectionsService;
		  	var directionsDisplay = new google.maps.DirectionsRenderer({
			    draggable: true,
			    map: map,
		  	});

			for(var i = 0; i < sum_place; i++ ){
				var lat = $('#lat_'+i).val();
				var lng = $('#lng_'+i).val();

				markers.push({
					"lat": parseFloat(lat),
					"lng": parseFloat(lng)
				});
			}

			console.log(markers);
			  displayRoute(markers[0], markers[0], directionsService, directionsDisplay);
		}

		function displayRoute(origin, destination, service, display) {
			var markerArray = [];
			for(var i=1; i<markers.length; i++){
				markerArray.push({
					location: markers[i],
					stopover: true
				});
			}

		  	service.route({
			    origin: origin,
			    destination: destination,
			    waypoints: markerArray,
			    travelMode: 'DRIVING',
			    avoidTolls: true
		  	}, function(response, status) {
			    if (status === 'OK') {
			      display.setDirections(response);
			    } else {
			      alert('Could not display directions due to: ' + status);
			    }
		  	});
		}

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlkPRpU8Qk221zsdBOpn8cVl_WDSBtIWk&libraries=places&callback=initAutocomplete"
    async defer></script>
@endsection
