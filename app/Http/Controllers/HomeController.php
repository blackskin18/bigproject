<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\comment;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tripall=Trip::orderBy('id','desc')->get();
        return view('trip.alltrip')->with('tripall',$tripall);
    }


    public function listTrip(Request $request) {

        $list_type = $request->data;
        if($list_type == "hot-trip"){
            $trips = Trip::all();
            $all_comments = comment::all()->groupBy('trip_id');

            $trip_respone = [];
            $index_trip_respone = 0;

            foreach ($trips as $key => $trip) {
                $sum_comment = comment::where('trip_id',$trip->id)->groupBy('trip_id')->count();
                
                if($sum_comment > 10){
                    $trip_respone[$index_trip_respone] = $trip;
                    $index_trip_respone++;
                }
            }
        return $trip_respone;
            // return $trips;
        }

        if($list_type == "all-trip"){
            $trips = Trip::all();
            return $trips;
        }

        if($list_type == "new-trip"){
            $yesterday = Carbon::yesterday();
            $trips = Trip::all();
            $trip_respone = [];
            $index_trip_respone = 0;
            foreach ($trips as $key => $trip) {
                if($trip->created_at > $yesterday){
                    $trip_respone[$index_trip_respone] = $trip;
                    $index_trip_respone++;
                }
            }
            return $trip_respone;
        }
    }
}
