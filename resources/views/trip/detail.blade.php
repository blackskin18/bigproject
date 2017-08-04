@extends('layouts.index')
<style type="text/css">
	p{
		color: red;
	}
</style>
@section('content_right')
	<div class="tab-content">
		<div class="tab-pane fade in active" id="detail">
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
		<div class="tab-pane fade" id="alltrip">
			<div class="row">
				<h3><strong>* Tất cả các chuyến đi: </strong></h3>
			</div>
			@foreach($tripall as $trip)
				<div class="row" class="col-lg-12">
					<div class="col-lg-6">
						<div class="row">
							Chuyến đi:{{$trip->title}}
						</div>
						<img src="{{$trip->cover}}" style="width: 450px; height: 250px;" alt="Cover" title="Cover">
						<strong>-)Số thành viên tham gia:</strong>{{$trip->sum_member}}
						<strong>-)Ngày khởi hành :</strong>{{$trip->start_date}}
						<strong>-)Ngày kết thúc dự kiến:</strong>{{$trip->end_date}}
						<br>
						@if(Auth::user()->id==$trip->user_id)
							<a href=""><button class="btn btn-success">Manage</button></a>
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
							@if($follow==1) <input type="button" name="follow" value="Unfollow" class="btn btn-success follow" />
							@else <input type="button" name="follow" value="Follow" class="btn btn-success follow" />
							@endif
							<a href=""><button class="btn btn-warning">Join</button></a>
						@endif
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
		<div class="tab-pane fade" id="hottrip">
			
		</div>
		<div class="tab-pane fade" id="newtrip">
			
		</div>
	</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('.follow').click(function() {
        if ( $(this).val() == 'Unfollow') {
            $(this).val('Follow')
        } else {
            $(this).val('Unfollow')
        }
    })
})
</script>
@endsection