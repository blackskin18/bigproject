<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Plan;
use App\User;
use App\Follow;
use App\Join;
use Illuminate\Support\Facades\Auth;    
class TripController extends Controller
{
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
}
