@extends('layouts.index')
@section('content_right')
	<div class="row">
		<div class="row">
			<h3><strong>List User Join</strong></h3>
		</div>
		<hr>
		@foreach($user_joins as $user_join)
		<div  class="user_join col-lg-12 alert alert-dismissable fade in " style="margin: 10px;">		
				<div class="col-lg-5">
					<img src="{{asset($user_join->user->avatar)}}" style="width: 200px; height: 170px;">
				</div>
				<div class="col-lg-4">
					<div class="row"><strong>Name:{{$user_join->user->name}}</strong></div>
					<div class="row">
						<strong>Email:{{$user_join->user->email}}</strong>
					</div>
					<div class="row">
						<strong>Birthday:{{$user_join->user->birthday}}</strong>
					</div>
					<div class="row">
						<strong>Phone:{{$user_join->user->phone}}</strong>
					</div>
					@if($user_join->user->sex==1)
						<div class="row"><strong>Gender:Female</strong></div>
					@else<div class="row">
						<strong>Gender:Male</strong>
					</div>
					@endif
				</div>
				<div class="col-lg-2">
					<button class="btn btn-danger delete_user_join" data-dismiss="alert">Delete</button>
				</div>
				<div><input type="hidden" name="" id="trip_id" value="{{$user_join->trip_id}}"></div>
				<div><input type="hidden" name="" id="user_id" value="{{$user_join->user_id}}"></div>
		</div>
		@endforeach
	<hr style="color: red;">
	<br>
	<br>
	</div>
	<div class="row ">
		<div class="row">
			<h3><strong>List User Request </strong></h3>
		</div>
		@foreach($user_requests as $user_request)
		<div class="col-lg-12 alert alert-dismissable fade in user_request1" style="margin: 15px;">
			
				<div class="col-lg-5 row">
					<img src="{{asset($user_request->user->avatar)}}" style="width: 200px; height: 170px;">
				</div>
				<div class="col-lg-4">
					<div class="row"><strong>Name:{{$user_request->user->name}}</strong></div>
					<div class="row">
						<strong>Email:{{$user_request->user->email}}</strong>
					</div>
					<div class="row">
						<strong>Birthday:{{$user_request->user->birthday}}</strong>
					</div>
					<div class="row">
						<strong>Phone:{{$user_request->user->phone}}</strong>
					</div>
					@if($user_request->user->sex==1)
						<div class="row"><strong>Gender:Female</strong></div>
					@else<div class="row">
						<strong>Gender:Male</strong>
					</div>
					@endif
				</div>
				<div class="col-lg-2">
					<button class="btn btn-danger delete_user_request " data-dismiss="alert">Deny</button>
				</div>
				<div><input type="hidden"  id="trip_id_request" value="{{$user_request->trip_id}}"></div>
				<div><input type="hidden"  id="user_id_request" value="{{$user_request->user_id}}"></div>
				<div class="col-lg-1">
				<a href="http://localhost/bigproject/public/trip/manageuser/{{$user_request->trip_id}}"><button class="btn btn-primary accept" data-dismiss="alert" >Accept</button></a>
				</div>		
			<hr>
		</div>
		@endforeach
	</div>
@endsection
@section('script')
	<script type="text/javascript" src="{{asset('js/delete_user_join.js')}}"></script>
@endsection