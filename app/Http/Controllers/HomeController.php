<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
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
        $tripall=Trip::all();
        return view('trip.alltrip')->with('tripall',$tripall);
    }
}
