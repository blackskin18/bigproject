var markers = [];
var comment_ids = []
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

	 for(var i = 1; i<=sum_comment; i++){
		var comment_id = $('div.show-comment div:nth-of-type('+i+') input.comment_id').val();
		addListenerForSubInput(comment_id);
		toggleShowSubComment(comment_id);
	}
}
	// function toggleShowSubComment (parent_comment_id){
	// 	$('button#btn-'+parent_comment_id).click(function(){
	//         $('div#sub-comment-layout-'+parent_comment_id).toggle();
	//     });
	// }

function addListenerForSubInput(parent_comment_id) {
		$('#input-sub-comment-'+parent_comment_id+'').on("keydown", function search(e) {
		    if(e.which == 13) {
		    	console.log(parent_comment_id);

		    	var trip_id = $('#trip_id').val();
		    	var user_id = $('#user_id').val();
		    	var data = $('#input-sub-comment-'+parent_comment_id+'').val();

	        	var url = window.location.origin + '/bigproject/public' + '/trip/detail-trip/sub-comment/'+trip_id+'/'+user_id+'/'+parent_comment_id;
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
				        	data,
				        },
				        success: function(data){
				        	// alert(parent_comment_id)
				        	//var obj = JSON.parse(data.responseText);
				        	console.log(data);
				        	$('div.sub-comment').remove();

				        	for(var i = 0; i< data.length; i++){
				        		if(data[i].parent_id == parent_comment_id) {
						        	$('#list-sub-comment-'+parent_comment_id).append(`
														<div class="sub-comment">
															<a href="#">
																<div class="avatar-user" style="background-image: url(http://localhost/bigproject/public`+data[i].avatar+`)"></div>
															</a>
															<div class="content-comment">
																<div class="">
																	<a href="#" class="" class="user-name">
																		<p>`+data[i].name+`</p>
																	</a>
																	<p>`+data[i].text+`</p>
																</div>
															</div>
														</div>
									        		`);
				        		}
				        	}
				        	var data = $('#input-sub-comment-'+parent_comment_id+'').val('');
				        	// alert('success');
				        },
				        error: function(data) {
			        		alert('error');
				        }
				});



		    }
		});
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

$(document).ready(function(){
	$('#input-comment').keypress(function(e) {
	    if(e.which == 13) {

	    	var trip_id = $('#trip_id').val();
	    	var user_id = $('#user_id').val();
	    	var data = $('#input-comment').val();
        	var url = window.location.origin + '/bigproject/public' + '/trip/detail-trip/comment/'+trip_id+'/'+user_id;
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
			        	data,
			        },
			        success: function(data){
			        	// var data = JSON.parse(data1.responseText);
			        	console.log(data.comment_id);
			        	// $('.comment').remove();
			        	// for(var i = 0; i< data.length; i++){
			        		// if(data[i].parent_id == null){
					        	$('#show-comment').append(`
													<div class="comment">
														<a href="#">
															<div class="avatar-user" style="background-image: url(`+data.avatar+`)"></div>
														</a>
														<div class="right">
															<div class="comment-and-name">
																<a href="#" class="user-name">
																	<p>`+data.name+`</p>
																</a>
																<p>`+data.text+`</p>
															</div>
															<div class="show-sub-comment">
																<button id="btn-`+data.comment_id+`" style="float:left; font-size: 13px">sub comment</button>
															</div>
															<div id="sub-comment-layout-`+data.comment_id+`" style="display: none">
																<div class="input-sub-comment" style="margin-left: 70px;">
																	<a href="a">
																		<div class="avatar-user" style="background-image: url(`+data.avatar+`)"></div>
																	</a>
																 	<div class="form-group" style="width: 860px; display: inline-block; margin-top: 10px">
																	    <input type="email" class="form-control" id="input-sub-comment">
																  	</div>
																</div>
															</div>
														</div>
													</div>
								        		`);
			        	// 	}
			        	// }
			        	toggleShowSubComment(data.comment_id);

			        	var data = $('#input-comment').val('');
			        	// alert('success');
			        },
			        error: function(data) {
		        		alert('error');
			        }
			});
	    }
	});
});
