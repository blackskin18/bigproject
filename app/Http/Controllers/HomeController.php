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
        // hot trip
        if($list_type == "hot-trip"){
            $trips = Trip::all();
            $all_comments = comment::all()->groupBy('trip_id');

            $trip_respone = [];
            $index_trip_respone = 0;
            $index_array = 0;

            for ($i=0; $i < 5; $i++) { 
                $max = comment::where('trip_id',$trips[0]->id)->groupBy('trip_id')->count();
                $chose = $trips[0];
                foreach ($trips as $key => $trip) {
                    $sum_comment = comment::where('trip_id',$trip->id)->groupBy('trip_id')->count();
                    if($sum_comment > $max){
                        $max = $sum_comment;
                        $chose = $trip;
                        $index_array = $key;
                    }
                }
                unset($trips[$index_array]);
                $trip_respone[$i] = $chose;
            }
        return $trip_respone;
        }

        //all trip
        if($list_type == "all-trip"){
            $trips = Trip::all();
            return $trips;
        }

        //new trip
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
