<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\TrainStation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $airport = Airport::all();
        $train_station = TrainStation::all();
        return view('index', compact('airport', 'train_station'));
    }
}
