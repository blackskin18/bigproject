<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Join;
use App\User;
use App\Trip;
class UserController extends Controller
{
    public function info($user_id){
    	$user=User::find($user_id);
    	return view('user/info')->with('user',$user);
    }
}
