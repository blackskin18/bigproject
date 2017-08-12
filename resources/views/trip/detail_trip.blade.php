@extends('/layouts.index')
    <script  src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail-trip.css') }}">
    <script src="{{ asset('js/create_trip.js') }}"></script>
	<?php
		$link_img = asset($trip->cover);
	?>


	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/detail-trip.css') }}">
   
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

		@if(Auth::User()->id==$trip->user_id)
			
		@else
 			<?php  
				$follow=0;
			?> 
			@foreach($trip->follow as $follow)
				@if($follow->user_id==Auth::User()->id)
					<?php 
						$follow=1;
					 ?>
				 @else 
				 	<?php 
				 		$follow=0;
				 	 ?>
			 	 @endif
			@endforeach

		<form action="#follow">
				@if($follow==1) <button  value="1" class="btn btn-success follow" >Unfollow</button>
				@else <button  value="0" class="btn btn-success follow" >Follow</button>
				@endif
					<input type="hidden" name="trip_id" value="{{$trip->id}}" id="trip_id">
					<input type="hidden" id="user_id" name="user_id" value="{{Auth::User()->id}}">
		</form>
		@endif
		<form >
			@if($joins==-1)
				<div class="col-lg-3">
					<button class="btn btn-warning join"  value="-1">Join</button>
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Message  Join</h4>	
									</div>
									<div class="modal-body" style="height: 135px;">
										<h5>Lý do bạn muốn tham gia:</h5>
										<textarea rows="3" class="col-lg-8 form-control" name="message" id="message"></textarea>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal" id="request">OK</button>
									</div>
								</div>
							</div>
						</div>
				</div>
			@elseif($joins==1)
				<div class="col-lg-3" >
					<button class="btn btn-warning join" value="1">Out</button>
				</div>	
			@elseif($joins==0)
				<div class="col-lg-3" >
					<button class="btn btn-warning join" value="0">Cancel Request</button>
				</div>
			@endif
		</form>
		


		<form action="http://localhost/bigproject/public/trip/edit-trip/{{$trip->id}}">
	    	<input type="submit" value="edit trip" class="btn btn-primary btn-md" />
		</form>

<!-- 		<form >
			<input type="button" name="" value="">
		</form> -->
		
    

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

			// console.log(marker);
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpixEk5bCGe2Qhpcn0r3_ERnf-E1ivgu4&callback=initAutocomplete"
    async defer></script>
<!-- 	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAFviFQyjiV9qdj1tVihht1KiZ-NtvJgo&callback=initMap"
  type="text/javascript"  async defer ></script> -->
@endsection

@section('script')
	<script type="text/javascript" src="{{asset('js/follow.js')}}"></script>
@endsection

