<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Plan;
use App\User;
use Illuminate\Support\Facades\Auth;
class TripController extends Controller
{
    public function createTrip()
    {
    	return view('trip/create');
    }
<<<<<<< HEAD
    public function detail($trip_id){
    	$tripall=Trip::all();
    	$user=User::find(Auth::User()->id);
    	$trip=Trip::find($trip_id);
    	return view('trip.detail',['trip'=>$trip,'tripall'=>$tripall,'user'=>$user]);
    }
    public function postdetail(){

    }
    public function delete($id){
    	$trip=Trip::find($id);
    	$trip->delete();
    	$plans=Plan::find($id);
    	$plans->delete();
    	return redirect('/user/detail-info/{{$user->id}}');
    }
=======

    public function postTrip(Request $request)
    {
    	
    }

>>>>>>> 4a9e790a82264abeb28ecafba556f0d473310c75
}
