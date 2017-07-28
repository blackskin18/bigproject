@extends(layouts.app)
@section('content')
	<div class="row">
		<div class="left col-lg-4">
		 	<div id="avatar" class="col-lg-12">
		 		<img src="" class="col-lg-12">
		 		<div style="position: absolute;z-index: 3;"><a href="">Edit</a> </div>
		 	</div>
		</div>
		<div class="right col-lg-8">
			<div style="left: 15%;top: 20px;" class="col-lg-offset-3 col-lg-8">
				<div class="col-lg-12 input-group">
					<label class="control-label">Name</label>
					<input type="text" name="name" class="form-control" value="">
				</div><br><br>
				<div class="col-lg-12 input-group">
					<label class="control-label">Birthday</label>
					<input type="text" name="birthday" class="form-control" value="">
				</div><br><br>
				<div class="col-lg-12 input-group">
					<label class="control-label">Vehicle</label>
					<input type="text" name="vehicle" class="form-control" value="">
				</div><br><br>
				<div class="input-group col-lg-12">
					<label class="control-label">Gender</label>
					<input type="text" name="sex" class="form-control" value="">
				</div><br><br>
				<div class="input-group col-lg-12">
					<label class="control-label">Phone</label>
					<input type="text" name="phone" class="form-control" value="">
				</div>
				<br><br>
				<div class="input-group col-lg-12">
					<label class="control-label">Note</label>
					<input type="textbox" name="introduce" class="form-control" value="">
				</div>
			</div>
		</div>
	</div>
@endsection