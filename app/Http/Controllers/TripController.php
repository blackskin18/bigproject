<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function createTrip()
    {
    	return view('trip/create');
    }
}
