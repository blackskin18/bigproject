@extends('layouts.app')
@section('content')
{{ csrf_field() }}
<div class="container " data-spy="scroll" data-target=".navbar" data-offset="50">
	<div class="row collapse navbar-collapse">
		<div class="navbar-header">
        	<a class="navbar-brand" href="#">WebSiteHome</a>
    	</div>
	</div>
	<div class="">
		<div class="content_left col-lg-4">
			<div class="col-lg-10 col-lg-offset-2">
				<img src="{{($user->avatar)}}" alt="Avatar" title="Ảnh Đại Diện" style="height: 100px;"/>
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
						<h3>*Trip Made</h3>
					</div>
					<div>
						@foreach($user->trip as $trip)
						<div class="col-lg-12">
							<h3><strong style="margin-right: 50px;">Note:</strong>{{$trip->title}}.Số thành viên tham gia:{{$trip->sum_member}}</h4></h3>To {{$trip->start_date}} From {{$trip->end_date}}
								<img src="{{$trip->cover}}" alt="cover" title="Cover" style="height: 250px;width: 450px; " class="img-responsive col-lg-10">

								<a href="/trip/detail/{{$trip->id}}" class="col-lg-2" style="top:20%;"><button class="btn btn-danger" >Read More...</button></a>
								<a href="/trip/delete/{{$trip->id}}"  style="margin-left: 20px;"><button class="btn btn-warning">Delete</button>  </a>
							</div>
						@endforeach
					</div>
				</div>
				<hr style="border-color: red;">
				<div id="tripjoin">
					<div class="row form-group">
						<h3>*Trip Join </h3>
					</div>
					@foreach($user->join as $join)
						<div class="row">
							<h2>{{$user->name}}</h2>
							<h3>{{$join->trip->name}}</h3>
							<h3>{{$join->trip->title}}:To{{$join->trip->start_date}} From {{$join->trip->end_date}}</h3>
							<div> 
								<img src="{{$join->trip->cover}}" alt="Cover" title="cover" style="height: 250px;width: 450px;>
							</div>
						</div>
					@endforeach
				</div>
				<hr style="border-color: red;">
				<br>
				<div id="tripfollow">
					<div class="row form-group">
						<h3>
							*Trip Follow
						</h3>
					</div>
					@foreach($user->follow as $follow)
						<div class="row">
							<h3><strong>Note:{{$follow->trip->name}}</strong></h3>
							<h3>{{$follow->trip->title}}:To {{$follow->trip->start_date}} From {{$follow->trip->end_date}}</h3>
							<div>
								<img src="{{$follow->trip->cover}}" alt="Cover" title="Cover" style="height: 250px;width: 450px;>
							</div>
						</div>
					@endforeach
				</div>
		</div>
	</div>
</div>
@endsection
