<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Plan;
use App\User;
use App\Follow;
use Validator;
use App\Join;
>>>>>>> 39357dc51deecd7ff31cd250e4d85a83d90e951a

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
        $find_users=Join::where('user_id',Auth::User()->id )->where('trip_id',$trip_id)->get();
            if($find_users->count()){
                foreach($find_users as $find_user){
                    if($find_user->status==0){
                        $joins=0;
                    }else{
                        $joins=1;
                    }
                }
            }else{
                $joins=-1;
            }
    	return view('trip.detail',['trip'=>$trip,'tripall'=>$tripall,'user'=>$user,'joins'=>$joins]);
    }
    public function delete($id){
    	$trip=Trip::findOrFail($id);
        
        Trip::find($id)->plan()->delete();
        $trip->delete();
    	return redirect('/user/detail-info/{{$user->id}}');
    }
    public function postTrip(Request $request)
    {
        $decode = json_decode($request, true);

    	$user_id = Auth::user()->id;
    	$plan_jsons = $request->json;

        Validator::make($plan_jsons[0], [
            "trip_title" => "required",
            "trip_note" => "required",
            "trip_sum_member" => "required|Integer",
            "trip_start_place" => "required",
            ])->validate();

        foreach ($plan_jsons as $key => $value) {
            Validator::make($plan_jsons[$key], [
            "place_start_lat" => "required",
            "place_start_lng" => "required",
            "vehicle" => "required",
            "note" => "required",
            "time_start" => "required",
            "time_end" => "required",
            "end_place" => "required",
            "start_place" => "required",
            ])->validate();
        }

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

        return $request;
    	if ($request->hasFile('cover'))
		    {
                $file = $request->file('cover');
                
                $file->move(public_path().'/img/cover/',$trip->id.'.jpg');
                $trip->cover= '/img/cover/'.$trip->id.'.jpg';
                $trip->save();
                return "save complete";
		    }
		
    }


    function detailTrip($trip_id) {
    	$trip = Trip::find($trip_id);
    	$plans = Plan::where('trip_id',$trip_id)->orderBy('id','desc')->get();
        $find_users=Join::where('user_id',Auth::User()->id )->where('trip_id',$trip_id)->get();
            if($find_users->count()){
                foreach($find_users as $find_user){
                    if($find_user->status==0){
                         $joins=0;
                    }else{
                        $joins=1;
                    }
                }
            }else{
                $joins=-1;
            }
            if(Auth::User()->id==$trip->user_id){
                return;
            }else{
                    $follow=0;
                foreach($trip->follow as $follow){
                    if($follow->user_id==Auth::User()->id){
                        $follow=1;
                    }else{
                        $follow=0;
                    }
                }
            }
    	return view('trip/detail_trip')->with('trip',$trip)->with('plans',$plans)->with('joins',$joins)->with('follow',$follow);
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
    public function message(Request $request){

    }

    public function editTrip($trip_id){

        $trip = Trip::find($trip_id);
        $plans = Plan::where('trip_id',$trip_id)->orderBy('id')->get();
        return view('trip/edit_trip')->with('trip', $trip)->with('plans', $plans);
    
    }
}
