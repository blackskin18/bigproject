@extends('layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
	<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<style type="text/css">
p{
color: red;
}
    .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
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
<div class="row">
	<h3><strong>Comment:</strong></h3>
</div>
<div >
		@foreach($comments as $comment)
			@if($comment->parent_id==0)
				<div class="row">
					<div class="input-group">
						<img src="{{asset($comment->user->avatar)}}" style="height: 70px;width: 70px;border-radius: 40px; margin: 10px;" />
						<a href="" style="margin: 5px;">{{$comment->user->name}}:</a>
						<label style="margin: 6px;">{{$comment->text}}</label>
						@foreach($comment->picture_comment as $picture_comment)
						<br>
							<div class="col-lg-offset-2">
								<img src="{{asset($picture_comment->picture)}}" style="height: 100px;width: 100px;" />
							</div>
						@endforeach
						<br>
					</div>
					<div class="panel-group row" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h5 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" href="#{{$comment->id}}">Repply</a>
								</h5>
							</div>
							<div id="{{$comment->id}}" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										@foreach($comments as $sub_comment)
											@if($sub_comment->parent_id ==$comment->id)
												<div class="col-lg-offset-2">
													<div class="row input-group" style="position: absolute;">
														<img src="{{asset($sub_comment->user->avatar)}}" style="height: 65px;width: 65px; border-radius: 40px;" >
														<a href="" style="margin: 5px;">{{$sub_comment->user->name}}:</a>
														<label>{{$sub_comment->text}}</label>
													</div><br><br><br><br><br>
												<div class="row">
													@foreach($sub_comment->picture_comment as $sub_picture_comment)
															<img src="{{asset($sub_comment->picture)}}" style="height: 120px;width: 120px;" >
													@endforeach
												</div>
												<br>
												</div>
											@endif
										@endforeach
										<div class="row input-group col-lg-offset-2 col-lg-8">
											<input type="" name="" class="form-control input-lg sub_comment_nd"  placeholder="Bình Luận ...">
												<div class="modal fade" id="sub_comment_text" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>	
																<p>Text...</p>
																<input type="text" name="" id="sub_comment_image" class="form-control">
															</div>
															<div class="modal-body col-lg-12" style="height: 500px;">
															<form action="upload.php" enctype="multipart/form-data" class="dropzone" id="image-upload">
																<div>
																	<h3>Upload Multiple Image By Click On Box</h3>
																</div>
															
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal" id="request">OK</button>
															</div>
															</form>
														</div>
													</div>
												</div>
											<span class="input-group-addon"><i class="fa fa-camera" style="font-size:24px;" id="sub_comment_image" data-toggle="modal" data-target="#sub_comment_text"></i></span><br><br>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><br>
				<input type="hidden" name="" id="sub_parent_id" value="{{$comment->id}}">
				<input type="hidden" name="" id="sub_trip_id" value="{{$comment->trip_id}}">
				<input type=hidden name="" id="sub_user_id" value="{{Auth::User()->id}}">
			@endif
		@endforeach
</div>
<div class="row input-group col-lg-11" style="margin-bottom: 20px;">
	<input type="" name="" class="form-control input-lg" placeholder="Viết bình luận...">
	<span class="input-group-addon"><i class="fa fa-camera " style="font-size: 24px;"></i></span>
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
<script type="text/javascript" src="{{asset('js/comment.js')}}"></script>
<script type="text/javascript">
	Dropzone.options.imageUpload = {
        maxFilesize:1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>
@endsection