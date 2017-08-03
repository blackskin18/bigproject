<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Places Searchbox</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
        width: 400px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0 auto;
        padding: 0;
        width: 100%;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
	td{
		text-align: center;
	}		

    </style>
  	</head>
  	<body>
  	<div style="width: 50%; float: left;">
		<form action="">
			<div id="form-group" class="">
				<label for=""> title </label>
				<input type="text">
			</div>

			<div id="form-group" class="">
				<label for=""> cover </label>
				<input type="file">
			</div>

		 	<div id="form-group" class="">
				<label for=""> sum member </label>
				<input type="text">
			</div>

			<div id="form-group" class="">
				<label for=""> start place </label>
				<input type="text" id="start_place">
			</div>

			<div id="form-group" class="">
				<label for=""> note </label>
				<input type="text">
			</div>

		    <div class="form-group">
		    	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
		    	<div id="map"></div>
		    </div>

			<div id="form-group" class="">
				<label for=""> lag </label>
				<input type="text" id="lat">
			</div>

			<div id="form-group" class="">
				<label for=""> lng </label>
				<input type="text" id="lng">
			</div>

			<div id="form-group" class="">
				<label for=""> lng </label>
				<input type="text" id="">
			</div>
			
			<button> save </button>
	  	</form>
	</div>
	<div style="width: 50%; height: 700px; float: left;">

<!-- 		<div class="floater content">
		  	<form class="bookmark-form">
		    	<div class="floater-top form-group">
		    		<label for="">time start</label>
		      		<input type="datetime-local" class="form-control" id="text1">
		    	</div>
		    	<div class="floater-top form-group">
		    		<label for="">time end</label>
		      		<input type="datetime-local" class="form-control" id="text2">
		    	</div>
		    	<div class="floater-top form-group">
		    	<label for=""> note</label>
		      		<input type="text" class="form-control"  id="text3">
		    	</div>
		    	<div class="floater-top form-group">
		    		<label for=""></label>
		      		<input type="text" class="form-control"  id="text4">
		    	</div>
		    	<div class="floater-bottom">
		      		<button type="submit" class="btn btn-primary btn-sm">Add</button>
		    	</div>
		  	</form>
	  	</div> -->
	  	<div class="chapter" id="list-plan">
	  		<p>----------------------------------------------------------------------------</p>
	  	</div>
		<div>
<!-- 			<input onclick="clearMarkers();" type=button value="Hide Markers">
		    <input onclick="showMarkers();" type=button value="Show All Markers">
		    <input onclick="deleteMarkers();" type=button value="Delete Markers">
			<input onclick="directions()" type="button" value="display route">
			<input type="button" onclick="hiddenRoute()" value="hidden route"> -->
		</div>
	</div>



    <script>
    // bắt đầu
    	var json = [];
        var markers = [];
	    var marker;
	    var map;
	    var markers_index;
      	var directionsDisplay;
      	var directionsService;


  		function initAutocomplete() {
	    	address_index = 1;
  			var infowindow = new google.maps.InfoWindow;
        	map = new google.maps.Map(document.getElementById('map'), {
          	center: {lat: 21.0245, lng: 105.84117},
          	zoom: 13,
          	mapTypeId: 'roadmap'
        	});

			directionsService = new google.maps.DirectionsService;
		  	directionsDisplay = new google.maps.DirectionsRenderer({
			    map: map,
	  		});
	      	geocoder = new google.maps.Geocoder();

			google.maps.event.addListener(map, 'click', function(event) {
				address_index++;
				var start_place = address_index-1;
		    	//pushMarker(event.latLng);
		    	// createBookmark();
		    	$(document).ready(function() {

		    		$(`<div id ="plan`+address_index+`">
		    			<br><h6> ------------------------------------------------------------------------------------------------------------------------------------------------------------------------</h6>
		    			<label for="">time start </label> <input type="datetime-local" > 
		    			<label for=""> time end </label><input type="datetime-local">
		    			<label for="">place start</label> <input id="address`+address_index+`" type="text">
		    			<label for="">place end</label> <input id="end_place`+address_index+`" type="text">
						<label for="">vehicle </label> <input type="text" >
						<label for="">note </label> <input type="text" >
						<input id="lat`+address_index+`" type="text">
						<input id="lng`+address_index+`" type="text">
						<div>
		    			`).insertAfter('div.chapter p');
				});
		    	getAddress(event.latLng,'#list-plan div:first-of-type input:nth-last-of-type(6)');

		    	makeMaker(event.latLng);
		    	markers.push(marker);
		    	//placeMarker(event.latLng);
		    	if(markers.length > 1){
		    		json.push({ "location1": [markers[markers.length-2].getPosition().lat(), markers[markers.length-2].getPosition().lng()],
	    						"location2": [markers[markers.length-1].getPosition().lat(), markers[markers.length-1].getPosition().lng()]});
		    	}

		    	directions();
		    	// delete one marker wwhen right click
		    	//var index = markers.findIndex(function(marker) {return marker.getPosition()===event.latLng});
		    	var index = markers.findIndex(function(marker) {return marker.getPosition()===event.latLng}) + 1;
				markers[markers.findIndex(function(marker) {return marker.getPosition()===event.latLng})].addListener("rightclick", function(event) {
					// clear all marker
					clearMarkers();
					// delete maker when click;
					
					console.log(index);
					var a =  markers.findIndex(function(marker) {return marker.getPosition()===event.latLng}) + 1;
					$('#list-plan div:nth-last-of-type('+a+')').remove();
					markers.splice(markers.findIndex(function(marker) {return marker.getPosition()===event.latLng}),1);
					
					// remove input plan;
					
					// if(index == 0)
					// 	json.splice(index,1);
					// 	console.log("đầu");
					// } else if(index == markers.length) {
					// 	json.splice(index-1,1);
					// 	console.log("cuối");
					// } else {
					// 	json[index-1].location2[0] = json[index].location2[0];
					// 	json[index-1].location2[1] = json[index].location2[1];
					// 	json.splice(index,1);
					// 	console.log("giữa");
					// }

					// show all marker in markers
					showMarkers();
					if(markers.length>0){
					directions();}
					// index = markers.findIndex(function(marker) {return marker.getPosition()===event.latLng})+1;
				});
				markers[markers.findIndex(function(marker) {return marker.getPosition()===event.latLng})].addListener("dragend", function(e) {
					console.log(index);
					getAddress(e.latLng,'#list-plan div:nth-last-of-type('+index+') input:nth-last-of-type(6)');
					$('#list-plan div:nth-last-of-type('+index+') input:nth-last-of-type(2)').val(e.latLng.lat());
					$('#list-plan div:nth-last-of-type('+index+') input:nth-last-of-type(1)').val(e.latLng.lng());
					console.log(e.latLng.lat());
					directions();
				});
			});

			function makeMaker(location) {
					xmarker = new google.maps.Marker({
				    position: location,
				    animation: google.maps.Animation.DROP,
				    map: map,
				    draggable: true
					});
					marker = xmarker;
			}

	    	function placeMarker(location) {
		        document.getElementById("lat"+address_index).value=location.lat();
		        document.getElementById("lng"+address_index).value=location.lng();

		        google.maps.event.addListener(marker,'dragend', function(){
		    		var lat = marker.getPosition().lat();
		    		var lng = marker.getPosition().lng();

		    		$("#lat"+address_index).val(lat);
		    		$("#lng"+address_index).val(lng);
		    		directions();
		    	});
		        getAddress(location);
    		}

		    function getAddress(latLng,selecter) {
		        geocoder.geocode( {'latLng': latLng},
		        function(results, status) {
		            if(status == google.maps.GeocoderStatus.OK) {
		            	// console.log(google.maps.GeocoderStatus.OK);
		                if(results[0]) {
		                    $(selecter).val(results[0].formatted_address);
		                } else {
		                	$(selecter).val("No results");
		                	
		                }
		            } else {
		            	$(selecter).val(status);
		            	$(selecter).val(status);

		                // document.getElementById("address"+address_index).value = status;
		                // document.getElementById("end_place"+end_place).value = status;
		                
		            }
		        });
		    }


        	// Create the search box and link it to the UI element.
	        var input = document.getElementById('pac-input');
	        var searchBox = new google.maps.places.SearchBox(input);
	        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	        // Bias the SearchBox results towards current map's viewport.
	        map.addListener('bounds_changed', function() {
	          searchBox.setBounds(map.getBounds());
	        });

	      
	        // Listen for the event fired when the user selects a prediction and retrieve
	        // more details for that place.
	        searchBox.addListener('places_changed', function() {
	          	var places = searchBox.getPlaces();

	          	if (places.length == 0) {
	            	return;
	          	}

	          // Clear out the old markers.

	          // For each place, get the icon, name and location.
	          	var bounds = new google.maps.LatLngBounds();
	          	places.forEach(function(place) {
	            	if (!place.geometry) {
	              		console.log("Returned place contains no geometry");
	              		return;
	            	}
	            var icon = {
	              	url: place.icon,
	              	size: new google.maps.Size(71, 71),
	              	origin: new google.maps.Point(0, 0),
	              	anchor: new google.maps.Point(17, 34),
	             	scaledSize: new google.maps.Size(25, 25)
	            };

	            if (place.geometry.viewport) {
	              // Only geocodes have viewport.
	              bounds.union(place.geometry.viewport);
	            } else {
	              bounds.extend(place.geometry.location);
	            }
	          });
	          map.fitBounds(bounds);
	        });
      	}

		function directions() {
	  		directionsDisplay.setMap(map);
		  	directionsDisplay.addListener('directions_changed', function() {
			    computeTotalDistance(directionsDisplay.getDirections());
			  	});
	  		displayRoute(markers[0].getPosition(),markers[0].getPosition(), directionsService,
	      	directionsDisplay);
		}

		function displayRoute(origin, destination, service, display) {
			var markerArray = [];
			for(var i=1; i<markers.length; i++){
				markerArray.push({
					location: markers[i].getPosition(),
					stopover: true
				})
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

		function computeTotalDistance(result) {
		  	var total = 0;
		  	var myroute = result.routes[0];
		  	for (var i = 0; i < myroute.legs.length; i++) {
		    total += myroute.legs[i].distance.value;
		  	}
		  	total = total / 1000;
		}

		function setMapOnAll(map) {
	        for (var i = 0; i < markers.length; i++) {
	          markers[i].setMap(map);
	        }
  		}

		function hiddenRoute() {
			directionsDisplay.setMap(null);
		}	


	      function clearMarkers() {
	        setMapOnAll(null);
	      }

	      // Shows any markers currently in the array.
	      function showMarkers() {
	        setMapOnAll(map);
	      }

	      // Deletes all markers in the array by removing references to them.
	      function deleteMarkers() {
	        clearMarkers();
	        markers = [];
	      }

        function toggleBounce() {
		    if (marker.getAnimation() !== null) {
		      marker.setAnimation(null);
		    } else {
		      marker.setAnimation(google.maps.Animation.BOUNCE);
		    }
	  	}
	// kết thúc
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlkPRpU8Qk221zsdBOpn8cVl_WDSBtIWk&libraries=places&callback=initAutocomplete"
    async defer></script>

	<script>



  </script>

  	</body>
</html>