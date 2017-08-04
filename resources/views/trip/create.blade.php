<!-- @extends('layouts.index')
@section('content_right')
		<div class="col-lg-6">
			<div class="form-group col-lg-12">
				<label class="control-label">Title:</label>
				<input type="text" name="title" class="form-control" placeholder="...">
			</div>
			<div class="form-group col-lg-12">
				<label class="control-label">Start Place:</label>
				<input type="text" name="start_place" class="form-control" placeholder="...">
			</div>
			<div class="form-group col-lg-12">
				<label class="control-label">End Place:</label>
				<input type="text" name="end_place" class="form-control" placeholder="...">
			</div>
			<div class="form-group col-lg-12">
				<label class="control-label">Date Start:</label>
				<input type="text" name="start_date" class="form-control" placeholder="...">
			</div>
			<div class="form-group col-lg-12">
				<label class="control-label">Date End:</label>
				<input type="text" name="end_date" class="form-control" placeholder="...">
			</div>
			<div class="form-group col-lg-12">
				<label class="control-label">Note:</label>
				<textarea class="form-control" placeholder="..." rows=4 name="status"></textarea>
			</div>
			<div class="form-group col-lg-12">
				<label class="control-label">Avatar:</label>
				<input type="file" name="avatar" class="form-control" >
			</div>
		</div>
		<div class="col-lg-6">
			<div class="row form-group col-lg-12 input-group">
				<h3><span class="glyphicon glyphicon-tags" style="margin-right: 10px;"></span>Lịch Trình Chuyến Đi:</h3>
			</div><hr>
			<div class="col-lg-12">
				<div class="well">
    				<a href="#" id="btnAdd"><i class="glyphicon glyphicon-plus-sign"></i> Add Tab</a>
   					<br><br>
					<ul class="nav nav-tabs" id="tabs">
       					<li class="active"><a href="#tab1">Tab 1</a></li>
    				</ul>
    
    					<div class="tab-content">
        					<div class="tab-pane active" id="tab1">Hello tab #1 content...</div>
    					</div>
  				</div>
			</div>
		</div>
		<script src="{{ asset('js/create.js')}}"></script>
@endsection

 -->