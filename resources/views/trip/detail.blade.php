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
					<img src="{{asset($trip->cover)}}" title="Cover" alt="Cover" style="height: 250px; width: 450px;">
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