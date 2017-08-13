@extends('/layouts.index')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <script  src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/detail-trip.css') }}">
    <script src="{{ asset('js/create_trip.js') }}"></script>
	<?php
		$link_img = asset($trip->cover);
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/detail-trip.css') }}">
    <script src="{{ asset('js/detail_trip.js') }}"></script>
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
	<input type="hidden" id="trip_id" value="{{$trip->id}}" disabled>
	<input type="hidden" id="user_id" value="{{ Auth::user()->id }}" disabled>
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



		<form action="http://localhost/bigproject/public/trip/edit-trip/{{$trip->id}}">
	    	<input type="submit" value="edit trip" class="btn btn-primary btn-md" />
		</form>
<!-- 		<form >
			<input type="button" name="" value="">
		</form> -->
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
	</div>
	<div class="comment-layout">
		<div class="show-comment" id="show-comment">
			@foreach($comments as $ket =>  $comment)
				@if($comment->parent_id == null)
				<div class="comment">
					<input type="hidden" class="comment_id" value="{{$comment->id}}" >
					<a href="#">
						<?php 
							$link_avatar = asset($comment->avatar);
						?>
						<div class="avatar-user" style="background-image: url({{$link_avatar}})"></div>
					</a>
					<div class="right">
						<div class="comment-and-name">
							<a href="#" class="user-name">
								<p>{{$comment->name}}</p>
							</a>
							<p> {{$comment->text}}</p>
						</div>
						<div class="show-sub-comment" style="width: 930px;">
							<button id="btn-{{$comment->id}}" style="float:left; font-size: 13px">sub comment</button>
						</div>
						<div id="sub-comment-layout-{{$comment->id}}" style="display: none">
							<div id="list-sub-comment-{{$comment->id}}">
								@foreach($comments as $ket =>  $sub_comment)
									@if($sub_comment->parent_id ==$comment->id)
										<div class="sub-comment">
												<a href="#">
													<?php 
														$link_avatar = asset($sub_comment->avatar);
													?>
													<div class="avatar-user" style="background-image: url({{$link_avatar}})"></div>
												</a>
												<div class="content-comment">
													<div class="">
														<a href="#" class="" class="user-name">
															<p>{{$sub_comment->name}}</p>
														</a>
														<p> {{$sub_comment->text}}</p>
													</div>
												</div>
										</div>
									@endif
								@endforeach
							</div>
							<div class="input-sub-comment" style=" margin-left: 70px; margin-top: 10px; width: 800px;">
								<a href="a">
									<?php
										$link_avatar_user = asset(Auth::User()->avatar)
									?>
									
									<div class="avatar-user" style="background-image: url({{$link_avatar_user}})" ></div>
								</a>
							 	<div class="input-group" style="width: 760px;  margin-top: 0px">
								    <input type="text" class="form-control" id="input-sub-comment-{{$comment->id}}"><span class="input-group-addon" id="img-sub-comment-{{$comment->id}}"><i class="fa fa-camera" ></i></span>
							  	</div>
							</div>
						</div>
					</div>
				</div>
				@endif
			@endforeach
		</div>
		<div class="input-comment" style="margin-top: 20px;">
				<a href="a">
					<?php
						$link_avatar_user = asset(Auth::User()->avatar)
					?>
					
					<div class="avatar-user" style="background-image: url({{$link_avatar_user}})"></div>
				</a>
			 	<div class="input-group" style="margin-top: 20px; width: 900px; margin-bottom: 60px;">
				    <input type="email" class="form-control" id="input-comment">
					<span class="input-group-addon" ><i class="fa fa-camera"></i></span>
			  	</div>
		</div>
	</div>

	<script type="text/javascript">
	var sum_comment = $('#show-comment div.comment').size();
	var sum_place = $('#location-input div').size();	

	$(document).ready(function() {
		$('button').click(function(){
		        $('div#sub-comment-layout').toggle();
		    });

	})
	</script>
	
<!-- 	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAFviFQyjiV9qdj1tVihht1KiZ-NtvJgo&callback=initMap"
  type="text/javascript"  async defer ></script> -->
@endsection


@section('script')
	<script type="text/javascript" src="{{asset('js/follow.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpixEk5bCGe2Qhpcn0r3_ERnf-E1ivgu4&callback=initAutocomplete"
    async defer></script>
@endsection

