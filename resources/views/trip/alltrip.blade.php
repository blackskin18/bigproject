@extends('layouts.app')
@section('content')
			<div class="container" id="alltrip">
			<div class="row">
				<h3><strong>* Tất cả các chuyến đi: </strong></h3>
			</div>
			@foreach($tripall as $trip)
				<div class="row" class="col-lg-12">
					<div class="col-lg-6">
						<div class="row col-lg-offset-1">
							Chuyến đi:{{$trip->title}}
						</div>
						<img src="{{$trip->cover}}" style="width: 450px; height: 250px;" alt="Cover" title="Cover"><br>
						<strong>Số thành viên tham gia:</strong>{{$trip->sum_member}}<br>
						<strong>Ngày khởi hành :</strong>{{$trip->start_date}}<br>
						<strong>Ngày kết thúc dự kiến:</strong>{{$trip->end_date}}<br>
						<br>
						<a href="/trip/detail/{{$trip->id}}"><button class="btn btn-success">Detail</button></a>
					</div>
					<div class="col-lg-5 col-lg-offset-1">
						<div class="row">
							<strong>*Các chặng dừng chân:</strong>
						</div>
						<div>
							@foreach($trip->plan as $plan)
								<div>
									<span>+){{$plan->place_start}}.</span>
										<p>Hoạt động nổi bật:{{$plan->active}}</p>
								</div>
							@endforeach
						</div>
					</div>
				</div><br><hr>
			@endforeach
		</div>
@endsection