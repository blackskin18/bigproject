@extends('layouts.index')
@section('content_right')



<div class="container" id="alltrip">
	
	@foreach($tripall as $trip)
	<a href="trip/detail-trip/{{$trip->id}}" style="color: #333">
		<div class="row" class="col-lg-12">
			<div class="col-lg-6" style="width: 1000px;">
				<div class="row col-lg-offset-1" style="font-size: 30px">
					<strong> title:{{$trip->title}} </strong>
				</div>
				<?php
					$link_img = asset($trip->cover);
				?>
				<div style="background-image: url({{$link_img}}); width: 980px; height: 400px; background-size: cover; border-radius: 30px">
				</div>
				<!-- <img src="{{$link_img}}" style="width: 100%; height: 250px;" alt="Cover" title="Cover"> --><br>
				<strong>Số thành viên tham gia:</strong>{{$trip->sum_member}}<br>
				<strong>Ngày khởi hành :</strong>{{$trip->start_date}}<br>
				<strong>Ngày kết thúc dự kiến:</strong>{{$trip->end_date}}<br>
				<br>
				
			</div>
		</div><br><hr>
	</a>
	@endforeach
</div>
@endsection