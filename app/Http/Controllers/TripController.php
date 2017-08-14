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
use DB;

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
        
    	if ($request->hasFile('cover'))
		    {
                $file = $request->file('cover');
                $file->move(public_path().'/img/cover/',$trip->id.'.jpg');
                $trip->cover= '/img/cover/'.$trip->id.'.jpg';
                $trip->save();
                return $trip_id;
		    }
        else{
            
        }
		
    }

    public function postEditTrip(Request $request, $trip_id){
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
        //edit info trip
        $trip = Trip::find($trip_id);
        $trip->title = $plan_jsons[0]['trip_title'];
        $trip->status = $plan_jsons[0]['trip_note'];
        $trip->sum_member = $plan_jsons[0]['trip_sum_member'];
        $trip->start_place = $plan_jsons[0]['trip_start_place'];
        $trip->user_id = $user_id;
        $trip->save();

        //delete all plan
        $old_plans = Trip::find($trip_id)->plan;
        foreach ($old_plans as $key => $old_plan) {
            $old_plan->delete();
        }

        // insert new plan
        foreach ($plan_jsons as $key => $plan_json) {
            $plan = new Plan;
            $plan->trip_id = $trip_id;
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

    function detailTrip($trip_id) {
    	$trip = Trip::find($trip_id);
    	$plans = Plan::where('trip_id',$trip_id)->orderBy('id','desc')->get();
        // $comments = Trip::find($trip_id)->comment;

        $comments = DB::table('comments')
                            ->join('users', 'users.id', '=', 'comments.user_id')
                            ->join('trips', 'trips.id', '=', 'comments.trip_id')
                            ->where('trips.id',$trip_id)
                            ->select('trips.*','users.*','comments.*')
                            ->orderBy('comments.id')
                            ->get();
        // dd($comments);

        foreach ($comments as $key => $value) {
               
        }

        $find_users=Join::where('user_id',Auth::User()->id )->where('trip_id',$trip_id)->get();

            if(Auth::User()->id==$trip->user_id){
                $joins=2;
            }
            elseif ($find_users->count()){
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
    	return view('trip/detail_trip')->with('trip',$trip)->with('plans',$plans)->with('joins',$joins)->with('comments',$comments);
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
            return 1;
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
        if ($trip->user_id == Auth::User()->id) {
            $plans = Plan::where('trip_id',$trip_id)->orderBy('id')->get();
            return view('trip/edit_trip')->with('trip', $trip)->with('plans', $plans);
        }
        else{   
            return redirect('/');
        }

    
    }

    public function manageuser($id){
        $user_joins=Join::where('trip_id',$id)->where('status',1)->get();
        $user_requests=Join::where('trip_id',$id)->where('status',0)->get();
        return view('user.manageuser')->with('user_joins',$user_joins)->with('user_requests',$user_requests);
    }
    public function delete_user_join(Request $request){
        Join::where('trip_id',$request->trip_id)->where('user_id',$request->user_id)->where('status',1)->delete();
        return 0;
    }
    public function delete_user_request(Request $request){
        Join::where('trip_id',$request->trip_id)->where('user_id',$request->user_id)->where('status',0)->delete();
        return 0;
    }
    public function accept(Request $request){
    Join::where('trip_id',$request->trip_id)->where('user_id',$request->user_id)->where('status',0)->update(['status'=>1]);
        // return redirect('http://localhost/bigproject/public/trip/manageuser/{id}');
        return 1;
    }
}
