@extends('layouts.app')
@section('content')
	<div class="container" style="margin-left: 0px; text-align: center;">
		<div class="row">
			<div class="col-lg-3">
				<ul class="nav nav-pills nav-stacked" style="top:20px;">
					<li>
						<a href="" class="active">
							User
						</a>
					</li>
					<hr>
					<li>
						<a href="">Hot Trip</a>
					</li>
					<li>
						<a href="">New Trip</a>
					</li>
					<li>
						<a href="">All Trip</a>
					</li>
					<hr>
					<li>
						<a href="">
							Create Trip
						</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-9">
				@yield('content_right')
			</div>
		</div>
	</div>
@endsection