@extends('layouts.app')

@section('content')
{{ csrf_field() }}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <a href="url('user/info-detail/{user_id}')">User</a> -->
@endsection
