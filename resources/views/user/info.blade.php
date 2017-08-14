@extends('layouts.app')
@section('content')
{{ csrf_field() }}
<div class="container " data-spy="scroll" data-target=".navbar" data-offset="50">
	<div class="row collapse navbar-collapse">
		<div class="navbar-header">
        	<a class="navbar-brand" href="#">WebSiteHome</a>
    	</div>
	</div>
	<?php 
		$link_img = asset(Auth::User()->avatar);
	?>
<div class="">
		<div class="content_left col-lg-4 " data-role="main">
			<div class="col-lg-10 col-lg-offset-2">
			<img src="{{$link_img}}" alt="Avatar" title="Ảnh Đại Diện" style="height: 100px;" id="avatar1" data-toggle="modal" data-target="#myModal"/>
			  <div class="modal fade" id="myModal" role="dialog" >
				<div class="modal-dialog" >			    
				      <div class="modal-content" style="height: 500px; width: 700px;">
				        <div class="modal-body">
				          <img src="{{$link_img}}" style="height: 380px;">
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
				      </div>
				      
				    </div>
				</div>
			</div>
			<br>
			<hr>
			<br>
			<div class="col-lg-10 col-lg-offset-2">
				<a href="">{{$user->name}}</a>
			</div>
			<hr>
			<div class="col-lg-4">
				<table>
					<tr>
						<th>Email:</th>
						<td>{{$user->email}}</td>
					</tr>
					<tr>
						<th>Birthday:</th>
						<td>{{$user->birthday}}</td>
					</tr>
					<tr>
						<th>Gender:</th>
						@if($user->sex==2)
							<td>Female</td>
						@elseif($user->sex==1)
						<td>Male</td>
							@else<td></td>
						@endif
					</tr>
					<tr>
						<th>Phone:</th>
						<td>{{$user->phone}}</td>
					</tr>
					<tr>
						<th>Verhicle:</th>
						<td>{{$user->verhicle}}</td>
					</tr>
					<tr>
						<th>Note:</th>
						<td></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-10">
					<p>{{$user->introduce}}</p>
				</div>
			</div>
			<hr>
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-offset-1 col-lg-6">
						<a href="{{url('user/edit/{id}')}}"> <button class="btn btn-success form-control">Edit Profile</button> </a>
					</div>
				</div><br>
				<div class="row">
					<div class="col-lg-offset-1 col-lg-6">
						<a href="{{url('trip/create')}}" class="create"><button class="btn btn-info form-control">Create Trip</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="content_right col-lg-8 " >
			
				<div id="tripmade" class="col-lg-12">
					<div class="">
						<h3>Trip Made</h3>
					</div>
					<div>
						@foreach($user->trip as $trip)
						<div class="col-lg-12">
							<h3><strong style="margin-right: 50px;">Note:</strong>{{$trip->title}}.Số thành viên tham gia:{{$trip->sum_member}}</h4></h3>To {{$trip->start_date}} From {{$trip->end_date}}
								<img src="{{asset($trip->cover)}}" alt="cover" title="Cover" style="height: 250px;width: 450px; " class="img-responsive ">
							<div class="col-lg-12 " style="margin-top: 10px;">
								<a href="/trip/detail/{{$trip->id}}" style="top:20%;"><button class="btn btn-danger col-lg-3" style="margin-right: 5px;" >Detail...</button></a>
								<a href="http://localhost/bigproject/public/trip/delete/{{$trip->id}}"  style="margin-left: 20px;"><button class="btn btn-warning col-lg-3" style="margin-right: 5px;">Delete</button>  </a>
								<a href="http://localhost/bigproject/public/trip/manageuser/{{$trip->id}}"><button class="btn btn-success col-lg-3">Manage User</button> </a>
							</div>
						@endforeach
						</div>
				</div>
				<hr style="border-color: red;">
				<div id="tripjoin">
					<div class="row form-group">
						<h3><strong>Trip Join</strong> </h3>
					</div>
					@foreach($user->join as $join)
						<div class="row">
							<h3>{{$join->trip->title}}</h3>
							<strong>To{{$join->trip->start_date}} From {{$join->trip->end_date}}</strong>
							<div class="col-lg-8"> 
								
								<img src="{{asset($join->trip->cover)}}" alt="Cover" title="cover" style="height: 250px;width: 450px;">
							</div>
							<div style="margin-top: 10px;" class="col-lg-4" >
								<a href="http://localhost/bigproject/public/trip/detail/{{$join->trip_id}}"><button class="btn btn-success col-lg-8 col-lg-offset-4">Detail</button></a>
							</div>
						</div>
					@endforeach
				</div>
				<hr style="border-color: red;">
				<br>
				<div id="tripfollow" class="col-lg-12" style="margin-bottom: 50px;">
					<div class="row form-group">
						<h3>
							<strong>Trip Follow</strong>
						</h3>
					</div>
					<div class="row">
					@foreach($user->follow as $follow)
						<div class="col-lg-8">
								<h4 >Note:<strong>{{$follow->trip->title}}</strong></h4>
								<h4>To {{$follow->trip->start_date}} From {{$follow->trip->end_date}}</h4>
								<div>
									<img src="{{asset($follow->trip->cover)}}" alt="Cover" title="Cover" style="height: 250px;width: 450px;">
								</div>
						</div>
						<div style="margin-top: 70px;" class="col-lg-4" >
								<a href="http://localhost/bigproject/public/trip/detail/{{$follow->trip_id}}"><button class="btn btn-success col-lg-8 col-lg-offset-4">Detail</button></a>
						</div>
						<br>
					@endforeach
					</div>
				</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script type="text/javascript">
			$('.pop').click(function(){
				$('.imagepreview').attr('src',$(this).find('img').attr('src'));
				$('#imagemodal').modal();
			});
	</script>	
@endsection