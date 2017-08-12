@extends('layouts.app')
@section('content')
	<div class="row" style="height: 1000px;">
		<div class="left col-lg-3">
			<div >
				<img src="{{asset($user->avatar)}}" title="Avatar" alt="Avatar" class="col-lg-12" style="left:25%;">
			</div>
			<br>
			<div class="input-group" style="left: 60%;">
				<label class="control-label col-lg-12">Image Profile</label>
			</div>
		</div>
		<div class="right col-lg-9">
		<form method="POST" action="{{url('/user/edit/{id}')}}" autocomplete="off" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div style="left: 15%;top: 20px;" class=" col-lg-8">
					<div class="col-lg-12 input-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
						<label class="control-label">Edit Image Profile</label>
						<input type="file" name="avatar" class="form-control">
						<span class="text-danger">{{ $errors->first('avatar') }}</span>
					</div><br><br>
					<div class="col-lg-12 input-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label class="control-label">Name</label>
						<input type="text" name="name" class="form-control" value="{{$user->name}}" >
						<span class="text-danger">{{ $errors->first('name') }}</span>
					</div><br><br>
					<div class="col-lg-12 input-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label class="control-label">Email:</label>
						<input type="text" name="email" class="form-control" value="{{$user->email}}">
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div><br><br>
					<div class="col-lg-12 input-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
						<label class="control-label">Birthday</label>
						<input type="text" name="birthday" class="form-control" value="{{$user->birthday}}" placeholder="VD:1996-08-28" {{old('birthday')}}>
						<span class="text-danger">{{ $errors->first('birthday') }}</span>
					</div><br><br>
					<div class="col-lg-12 input-group {{ $errors->has('verhicle') ? 'has-error' : '' }}">
						<label class="control-label">Verhicle</label>
						<input type="text" name="verhicle" class="form-control" value="{{$user->verhicle}}" placeholder="Motobike...">
						<span class="text-danger">{{ $errors->first('verhicle') }}</span>
					</div><br><br>
					<div class="input-group col-lg-12">
						<label class="control-label">Gender</label>
						<input type="radio" name="gender" value="1" style="margin-left: 40px;">Male
						<input type="radio" name="gender" value="2" style="margin-left: 40px;">Female
					</div><br>
					<div class="input-group col-lg-12 {{ $errors->has('phone') ? 'has-error' : '' }}">
						<label class="control-label">Phone</label>
						<input type="text" name="phone" class="form-control" value="{{$user->phone}}" >
						<span class="text-danger">{{ $errors->first('phone') }}</span>
					</div>
					<br><br>
					<div class="input-group col-lg-12 {{ $errors->has('note') ? 'has-error' : '' }}">
						<label class="control-label">Note</label>
						<textarea rows="5" class="form-control" placeholder="Note..." name="note" value="" >{{$user->introduce}}</textarea>
						<span class="text-danger">{{ $errors->first('note') }}</span>
					</div>
				</div>
				<div class="row col-lg-6 col-lg-offset-2" style="margin-top: 40px;">
					<button class="form-control btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
@endsection