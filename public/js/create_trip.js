
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
		$(document).ready(function() {
			$(`<div style="border: 1px solid blue; padding:10px; margin: 10px;">	
				
				<label for="">place start</label> <input  class="form-control" type="text" disabled>
				<label for="">place end</label> <input class="form-control" type="text" disabled>
				<label for="">time start </label> <input type="datetime-local" style="margin:10px; border-radius:3px; padding: 3px;" > 
				<label for=""> time end </label><input  type="datetime-local" style="margin:10px; border-radius:3px; padding: 3px;">
				<br>
				<label for="">vehicle </label> <input type="text" style="width: 230px; border-radius:3px; padding: 4px; margin-left: 23px;" >
				<label for="" style="margin-left:10px;">note </label> <input type="text" style="width: 230px; border-radius:3px; padding: 3px; margin-left:32px;" >
				<input type="hidden" disabled >
				<input type="hidden" disabled>

				<div>
				`).insertAfter('div.chapter p');
		});
		console.log(event.latLng);
		makeMaker(event.latLng);
		markers.push(marker);
		placeMarker(event.latLng);

		// set name address when make a marker
		getAddress(event.latLng,'#list-plan div:first-of-type input:nth-last-of-type(8)');
		getAddress(markers[0].getPosition(),'#list-plan div:first-of-type input:nth-last-of-type(7)');
		getAddress(markers[0].getPosition(),'#trip_start_place');
		if(markers.length > 0){
			getAddress(event.latLng,'#list-plan div:nth-of-type(2) input:nth-last-of-type(7)');
		} else {

		}

		// set location for start place
		placeMarker(event.latLng,'#list-plan div:first-of-type input:nth-last-of-type(2)', '#list-plan div:first-of-type input:nth-last-of-type(1)');

		// if(markers.length > 1){
		// 	json.push({ "location1": [markers[markers.length-2].getPosition().lat(), markers[markers.length-2].getPosition().lng()],
		// 				"location2": [markers[markers.length-1].getPosition().lat(), markers[markers.length-1].getPosition().lng()]});
		// }

		directions();
		
		//remove a marker
		markers[markers.findIndex(function(marker) {return marker.getPosition()===event.latLng})].addListener("rightclick", function(event) {
			// clear all marker
			clearMarkers();
			// delete maker when click;
			var a =  markers.findIndex(function(marker) {return marker.getPosition()===event.latLng}) + 1;
			var a_up_1 = a+1;
			var a_down_1 = a-1;

			console.log("a" +a);
			// edit start name of last plan end remove plan when right click
			console.log("delete:" + $('#list-plan div:nth-last-of-type('+a_up_1+') input:nth-last-of-type(8)').val());
			$('#list-plan div:nth-last-of-type('+a_down_1+') input:nth-last-of-type(7)').val($('#list-plan div:nth-last-of-type('+a_up_1+') input:nth-last-of-type(8)').val());
			$('#list-plan div:nth-last-of-type('+a+')').remove();
			// remove marker
			markers.splice(markers.findIndex(function(marker) {return marker.getPosition()===event.latLng}),1);

			//show all marker
			showMarkers();
			if(markers.length > 0){
				getAddress(markers[0].getPosition(),'#list-plan div:first-of-type input:nth-last-of-type(7)');
				getAddress(markers[0].getPosition(),'#trip_start_place');
			}
			if(markers.length>0){
				directions();
			}
		});

		markers[markers.findIndex(function(marker) {return marker.getPosition()===event.latLng})].addListener("dragend", function(event) {
			// index of <div> in #list plan
			var b =  markers.findIndex(function(marker) {return marker.getPosition()===event.latLng}) + 1;
			var b_down_1 = b-1;
			getAddress(event.latLng,'#list-plan div:nth-last-of-type('+b+') input:nth-last-of-type(8)');
			getAddress(event.latLng,'#list-plan div:nth-last-of-type('+b_down_1+') input:nth-last-of-type(7)')
			if(markers.length > 0){
				getAddress(markers[0].getPosition(),'#list-plan div:first-of-type input:nth-last-of-type(7)');
			}
			$('#list-plan div:nth-last-of-type('+b+') input:nth-last-of-type(2)').val(event.latLng.lat());
			$('#list-plan div:nth-last-of-type('+b+') input:nth-last-of-type(1)').val(event.latLng.lng());

			
			console.log(event.latLng.lat());
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

	function placeMarker(location, selecter_lat, selecter_lng) {
		$(selecter_lat).val(location.lat());
		$(selecter_lng).val(location.lng());
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
	        } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) { 
				 	wait = true;
				setTimeout("wait = true", 200);
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

function addJson() {
	var sum_element = $('#list-plan div').size()/2;
	console.log(sum_element);

	for(var i = 1; i <=markers.length; i++){
		var place_start_lat = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(1)').val();
		var place_start_lng = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(2)').val();
		var note = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(3)').val();
		var vehicle = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(4)').val();
		var time_end = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(5)').val();
		var time_start = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(6)').val();
		var end_place = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(7)').val();
		var start_place = $('#list-plan div:nth-of-type('+i+') input:nth-last-of-type(8)').val();

		console.log(time_end);
		json.push({
			"place_start_lat": place_start_lng,
			"place_start_lng": place_start_lat,
			"note": note,
			"vehicle": vehicle,
			"time_end": time_end,
			"time_start": time_start,
			"end_place": end_place,
			"start_place": start_place,
		});
		console.log("time end:"+time_end);
	}

	var trip_note = $('#trip_note').val();
	var trip_title = $('#trip_title').val();
	var trip_sum_member = $('#trip_sum_member').val();
	var trip_start_place = $('#trip_start_place').val();

	json[0].trip_sum_member = trip_sum_member;
	json[0].trip_title = trip_title;
	json[0].trip_note = trip_note;
	json[0].trip_start_place = trip_start_place;

	var url = window.location.origin + '/bigproject/public' + '/user/create/ok';
	console.log(json);
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        // 'accepts': 'application/json',
	    }
	});

	$.ajax({
	    	url: url,
	        type: "post",
	        datatType: "json",
	        data: {
	        	json,
	        },
	        success: function(data){
	            var urlx = window.location.origin + '/bigproject/public' + '/user/create/'+data;
	            console.log(urlx);
	            $.ajax({
				    url: urlx,
				    data:new FormData($("#uploadCover")[0]),
				    dataType:'json',
				    async:false,
				    type:'post',
				    processData: false,
				    contentType: false,
				    success:function(){
				    	alert("success ");
		       		 	window.location.reload()
				    },
				    error:function() {
				    	alert("success");
				    	window.location.reload()
				    }
	    		});
	        },
	        error: function() {
	         	alert("error");
	        }
	});
	
}