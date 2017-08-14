@extends('layouts.app')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    
@section('content')
	<div class="container" style="margin-left: 0px; text-align: center;">
		<div class="row">
			<div class="col-lg-3">
				<ul class="nav nav-pills nav-stacked nav-tabs" style="top:20px;">
					<li >
						<a href="http://localhost/bigproject/public/user/detail-info/{{Auth::user()->id}}" id="user">
							<div>
								<?php 
									$link_img = asset(Auth::User()->avatar);
								?>
								<img src="{{$link_img}}" class="avatar">
								<div class="col-lg-offset-2 name-user">
									<a href="http://localhost/bigproject/public/user/detail-info/{{Auth::user()->id}}">{{Auth::user()->name}}</a>
								</div>
							</div>
						</a><br>
					</li>
					<hr>
					<li>
						<a data-toggle="tab" href="#hottrip" id="hot-trip-tab">Hot Trip</a>
					</li>
					<li>
						<a data-toggle="tab" href="#newtrip" id="new-trip-tab">New Trip</a>
					</li>
					<li >
						<a  data-toggle="tab" href="#alltrip" id="all-trip-tab">All Trip</a>
					</li>
				</ul>
				<hr>
				<div class="row">
					<a href="http://localhost/bigproject/public/trip/create" class="col-lg-offset-2"><button class="btn btn-success col-lg-10 col-lg-offset-1">Create Trip</button></a>

				</div>
				<br><hr>

			</div>
			<div class="col-lg-9">
				<div class="container-list container-list-hot">
					@yield('content_right')
				</div>
			</div>
		</div>
	</div>


@endsection

@section('script')
<script type="text/javascript">
		$('#hot-trip-tab').click(function(){
			console.log('hot');
			var data = "hot-trip";
         	var url = window.location.origin + '/bigproject/public' + '/list/hot-trip';
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
			        	// var obj = JSON.parse(data.responseText);
			        	$('div.container-list a').remove();
			        	console.log(data);
			        	for(var i = 0 ; i< data.length; i++){
			        		$('div.container-list-hot').append(`
									<a href="trip/detail-trip/`+data[i].id+`" style="color: #333">
										<div class="row" class="col-lg-12">
											<div class="col-lg-6" style="width: 1000px;">
												<div class="row col-lg-offset-1" style="font-size: 30px">
													<strong> title:{{$trip->title}} </strong>
												</div>
												
												<div style="background-image: url(http://localhost/bigproject/public`+data[i].cover+`); width: 980px; height: 400px; background-size: cover; border-radius: 30px">
												</div>
												<br>
												<strong>Số thành viên tham gia:</strong>`+data[i].sum_member+`<br>
												<strong>Ngày khởi hành :</strong>`+data[i].start_date+`<br>
												<strong>Ngày kết thúc dự kiến:</strong>`+data[i].end_date+`<br>
												<br>
												
											</div>
										</div><br><hr>
									</a>
			        			`);
			        	}
			        },
			        error: function(data) {
			        	console.log(data)
			        }
			});
		});
		$('#new-trip-tab').click(function(){
			 console.log('new');
			 var data = "new-trip";
         	var url = window.location.origin + '/bigproject/public' + '/list/hot-trip';
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
			        	console.log("new");
			        	// var obj = JSON.parse(data.responseText);
			        	$('div.container-list a').remove();
			        	console.log(data);
			        	for(var i = 0 ; i< data.length; i++){
			        		$('div.container-list-hot').append(`
									<a href="trip/detail-trip/`+data[i].id+`" style="color: #333">
										<div class="row" class="col-lg-12">
											<div class="col-lg-6" style="width: 1000px;">
												<div class="row col-lg-offset-1" style="font-size: 30px">
													<strong> title:{{$trip->title}} </strong>
												</div>
												
												<div style="background-image: url(http://localhost/bigproject/public`+data[i].cover+`); width: 980px; height: 400px; background-size: cover; border-radius: 30px">
												</div>
												<br>
												<strong>Số thành viên tham gia:</strong>`+data[i].sum_member+`<br>
												<strong>Ngày khởi hành :</strong>`+data[i].start_date+`<br>
												<strong>Ngày kết thúc dự kiến:</strong>`+data[i].end_date+`<br>
												<br>
												
											</div>
										</div><br><hr>
									</a>
			        			`);
			        	}
			        },
			        error: function(data) {
			        	console.log(data)
			        }
			});
		});
		$('#all-trip-tab').click(function(){
			console.log('all');
			var data = "all-trip";
         	var url = window.location.origin + '/bigproject/public' + '/list/hot-trip';
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
			        	// var obj = JSON.parse(data.responseText);
			        	$('div.container-list a').remove();
			        	console.log(data);
			        	for(var i = 0 ; i< data.length; i++){
			        		$('div.container-list-hot').append(`
									<a href="trip/detail-trip/`+data[i].id+`" style="color: #333">
										<div class="row" class="col-lg-12">
											<div class="col-lg-6" style="width: 1000px;">
												<div class="row col-lg-offset-1" style="font-size: 30px">
													<strong> title:{{$trip->title}} </strong>
												</div>
												
												<div style="background-image: url(http://localhost/bigproject/public`+data[i].cover+`); width: 980px; height: 400px; background-size: cover; border-radius: 30px">
												</div>
												<br>
												<strong>Số thành viên tham gia:</strong>`+data[i].sum_member+`<br>
												<strong>Ngày khởi hành :</strong>`+data[i].start_date+`<br>
												<strong>Ngày kết thúc dự kiến:</strong>`+data[i].end_date+`<br>
												<br>
												
											</div>
										</div><br><hr>
									</a>
			        			`);
			        	}
			        },
			        error: function(data) {
			        	console.log(data)
			        }
			});
		});
	</script>
@endsection