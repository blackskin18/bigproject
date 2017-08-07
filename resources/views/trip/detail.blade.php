@extends('layouts.index')
<style type="text/css">
	p{
		color: red;
	}
</style>
@section('content_right')
	<div class="tab-content">
		<div class="tab-pane fade in active" id="detail" >
			<div class="row">
				@if(Auth::user()->id==$trip->user_id)
							<!-- <a href=""><button class="btn btn-success">Detail</button></a> -->
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
				<div class="col-lg-6 col-lg-offset-6">
					<div class="col-lg-offset-6 col-lg-3">
								@if($follow==1) <button  value="1" class="btn btn-success follow" >Unfollow</button>
								@else <button  value="0" class="btn btn-success follow" >Follow</button>
								@endif
								<input type="hidden" name="trip_id" value="{{$trip->id}}" id="trip_id">
								<input type="hidden" id="user_id" name="user_id" value="{{Auth::User()->id}}">

					</div>
					<div class="col-lg-3 ">
						<a href=""><button class="btn btn-warning">Join</button></a>
					</div>
				</div>
						@endif 
			</div>
			<div class="row">
				<h3>
					<strong>*Chi tiết chuyến đi:{{$trip->title}}</strong>
				</h3>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<img src="{{$trip->cover}}" title="Cover" alt="Cover" style="height: 250px; width: 450px;">
					<br>
					<br>
					<strong>-)Số thành viên tham gia:</strong>{{$trip->sum_member}}
					<br>
					<strong>-)Khởi hành ngày: </strong>{{$trip->start_date}}
					<br>
					<strong>-)Ngày kết thúc dự kiến:</strong>{{$trip->end_date}}
					<br>
					<strong>-)Trạng thái:</strong>
					@if($trip->status==1)
						<p>Đang lên kế hoạch</p>
					@elseif($trip->status==0)
						<p>Đang diễn ra</p>
						@else 
							<p>Đã kết thúc</p>
					@endif
				</div>
				<div class="col-lg-5 col-lg-offset-1">
					<div class="row col-lg-12">
						<h4>
							<strong>* Lộ trình:</strong>
						</h4>
					</div>
					<div>
						@foreach($trip->plan as $plan)
							<strong>-)From: <p>{{$plan->place_start}}</p> to: <p> {{$plan->place_end}}</p></strong>
							<strong>Hoạt động: <p>{{$plan->active}}</p></strong>
							<strong> Phương tiện:<p>{{$plan->verhicle}}</p></strong>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="hottrip">
			
		</div>
		<div class="tab-pane fade" id="newtrip">
			
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript" src="{{asset('js/follow.js')}}"></script>

@endsection