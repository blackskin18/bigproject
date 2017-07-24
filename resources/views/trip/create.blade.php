<!DOCTYPE html>
<html>
<head>
	<title></title>
  <!-- Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style type="text/css">

#right-panel {
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select, #right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#map {
  margin-top: 100px; 
  height: 300px;
  float: left;
  width: 400px;
}
#right-panel {
  float: left;
  width: 34%;
  height: 100%;
}
.panel {
  height: 100%;
  overflow: auto;
}

	</style>

</head>
<body>
    <div class="col-md-offset-2">
    	<div id="map"></div>
    	<div id="right-panel">
    	  <p>Total Distance: <span id="total"></span></p>
    	</div>
    </div>
  	<!-- Replace the value of the key parameter with your own API key. -->
  	<script async defer
  	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlkPRpU8Qk221zsdBOpn8cVl_WDSBtIWk&callback=initMap">
  	</script>


	<script type="text/javascript">
		function initMap() {
		  var map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 4,
		    center: {lat: -24.345, lng: 134.46}  // Australia.
		  });

		  var directionsService = new google.maps.DirectionsService;
		  var directionsDisplay = new google.maps.DirectionsRenderer({
		    draggable: true,
		    map: map,
		    panel: document.getElementById('right-panel')
		  });

		  directionsDisplay.addListener('directions_changed', function() {
		    computeTotalDistance(directionsDisplay.getDirections());
		  });

		  displayRoute('Perth, WA', 'Sydney, NSW', directionsService,
		      directionsDisplay);



		}

		function displayRoute(origin, destination, service, display) {
		  service.route({
		    origin: origin,
		    destination: destination,
		    waypoints: [{location: 'Adelaide, SA'}, {location: 'Broken Hill, NSW'}],
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

		function computeTotalDistance(result) {
		  var total = 0;
		  var myroute = result.routes[0];
		  for (var i = 0; i < myroute.legs.length; i++) {
		    total += myroute.legs[i].distance.value;
		  }
		  total = total / 1000;
		  document.getElementById('total').innerHTML = total + ' km';
		}
	</script>

</body>
</html>