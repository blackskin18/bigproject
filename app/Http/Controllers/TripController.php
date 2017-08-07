<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Plan;
use App\User;
use App\Follow;
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
