<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Plan;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Trip;
use App\Plan;
use App\User;
use App\Follow;
class TripController extends Controller
{

 	public function __construct()
    {
        $this->middleware('auth');
    }

    public function createTrip()
    {
    	return view('trip/create');
    }

    public function detail($trip_id){
    	$tripall=Trip::all();
    	$user=User::find(Auth::User()->id);
    	$trip=Trip::find($trip_id);
    	return view('trip.detail',['trip'=>$trip,'tripall'=>$tripall,'user'=>$user]);
    }
    // public function postdetail(Request $request,$trip_id){
    //     if($request->follow=="Unfollow"){
    //         $follow=new Follow;
    //         $follow->user_id=Auth::User()->id;
    //         $follow->trip_id=$trip_id;
    //         $follow->save();
    //     }else{
    //         $follow=Follow::find($trip_id)->delete();
    //     }
    //     return redirect('/trip/detail/{trip_id}');
    // }
    public function delete($id){
    	$trip=Trip::findOrFail($id);
        
        Trip::find($id)->plan()->delete();
        $trip->delete();
    	return redirect('/user/detail-info/{{$user->id}}');
    }
    public function postTrip(Request $request)
    {
    	$user_id = Auth::user()->id;

    	$plan_jsons = $request->json;

    	$trip = new Trip;
    	$trip->title = $plan_jsons[0]['trip_title'];
    	$trip->status = $plan_jsons[0]['trip_note'];
    	$trip->sum_member = $plan_jsons[0]['trip_sum_member'];
    	$trip->start_place = $plan_jsons[0]['trip_start_place'];

    	$trip->user_id = $user_id;

    	$trip->save();
    	$id = $trip->id;

    	foreach ($plan_jsons as $key => $plan_json) {
    		$plan = new Plan;
    		$plan->trip_id = $id;
    		$plan->place_start_lat = $plan_json['place_start_lat'];
    		$plan->place_start_lng = $plan_json['place_start_lng'];
    		$plan->verhicle = $plan_json['vehicle'];
    		$plan->active = $plan_json['note'];
    		$plan->time_start = $plan_json['time_start'];
    		$plan->time_end = $plan_json['time_end'];
    		$plan->end_place = $plan_json['end_place'];
    		$plan->start_place = $plan_json['start_place'];
    		$plan->save();
    	}
    	return $trip->id;
    }

    public function postTripCover($trip_id, Request $request) {
    	$trip = Trip::find($trip_id);
    	if ($request->hasFile('cover'))
		    {
                $file = $request->file('cover');
                
                $file->move(public_path().'/img/cover/',$trip->id.'.jpg');
                $trip->cover= '/img/cover/'.$trip->id.'.jpg';
		    }
		else {
			return "không có file";
		}
		$trip->save();
    }

    function detailTrip($trip_id) {
    	$trip = Trip::find($trip_id);
    	$plans = Plan::where('trip_id',$trip_id)->orderBy('id','desc')->get();

    	return view('trip/detail_trip')->with('trip',$trip)->with('plans',$plans);
    }
    public function alltrip(){
        $tripall=Trip::all();
        return view('trip.alltrip')->with('tripall',$tripall);
    }
    public function follow(Request $request){
        $follow=new Follow;
        $follow->user_id=$request->user_id;
        $follow->trip_id=$request->trip_id;
        $follow->save();
        return $follow;
    }
    public function unfollow(Request $request){
        $follow=Follow::where('user_id',Auth::User()->id)->where('trip_id',$request->trip_id);
        $follow->delete();
        return 1;
    }


}
