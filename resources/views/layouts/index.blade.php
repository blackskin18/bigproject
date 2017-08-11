@extends('layouts.app')
@section('content')
	<div class="container" style="margin-left: 0px; text-align: center;">
		<div class="row">
			<div class="col-lg-3">
				<ul class="nav nav-pills nav-stacked nav-tabs" style="top:20px;">
					<li style="text-align: center;">
						<a href="http://localhost/bigproject/public/user/detail-info/{{Auth::user()->id}}" id="user">
							<div>
								<?php 
									$link_img = asset(Auth::User()->avatar);
								?>
								<img src="{{$link_img}}" style="width: 200px;">
								<div class="col-lg-offset-2" style="text-align: center;">
									<a href="http://localhost/bigproject/public/user/detail-info/{{Auth::user()->id}}">{{Auth::user()->name}}</a>
								</div>
							</div>
						</a><br>
					</li>
					<hr style="border-color: red">
					<li>
						<a data-toggle="tab" href="#hottrip">Hot Trip</a>
					</li>
					<li>
						<a data-toggle="tab" href="#newtrip">New Trip</a>
					</li>
					<li >
						<a  data-toggle="tab" href="#alltrip" >All Trip</a>
					</li>
				</ul>
				<hr style="border-color: red;">
				<div class="row">
					<a href="http://localhost/bigproject/public/trip/create" class="col-lg-offset-2"><button class="btn btn-success col-lg-10 col-lg-offset-1">Create Trip</button></a>

				</div>
				<br><hr>

			</div>
			<div class="col-lg-9">
				@yield('content_right')
			</div>
		</div>
	</div>
@endsection