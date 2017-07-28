@extends(layouts.app)
@section('content')
<div class="container">
	<div class="row">
		<div class="navbar-header">
        	<a class="navbar-brand" href="#">WebSiteHome</a>
    	</div>
    	<ul class="nav navbar-nav">
      		<li><a href="#">Trip Made</a></li>
      		<li><a href="#">Trip Join</a></li>
      		<li><a href="#">Trip Follow</a></li>
   		 </ul>
	</div>
	<div class="row">
		<div class="content_left col-lg-4">
			<div class="col-lg-4">
				<img src="{{$user->avatar}}">
			</div>
			<br>
			<hr>
			<div class="col-lg-4">
				<a href="">{{$user->name}}</a>
			</div>
			<br>
			<hr>
			<div class="col-lg-4">
				<table>
					<tr>
						<th>Email:</th>
						<td>{{$user->email}}</td>
					</tr>
					<tr>
						<th>Birthday:</th>
						<td>{{$user->birthday}}</td>
					</tr>
					<tr>
						<th>Gender:</th>
						@if($user->sex==1)
							<td>Female</td>
						@else<td>Male</td>
					</tr>
					<tr>
						<th>Phone:</th>
						<td>{{$user->phone}}</td>
					</tr>
					<tr>
						<th>Verhicle:</th>
						<td>{{$user->verhicle}}</td>
					</tr>
					<tr>
						<th>Note:</th>
						<td>{{$user->introduce}}</td>
					</tr>
				</table>
			</div>
			<br>
			<hr>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-4">
						<a href=""> <button class="btn btn-success">Detail</button> </a>
					</div>
					<div class="col-lg-offset-4 col-lg-4">
						<a href=""> <button class="btn btn-success">Edit</button> </a>
					</div>
				</div>
			</div>
		</div>
		<div class="content_right col-lg-8">
			
		</div>
	</div>
</div>
@stop	