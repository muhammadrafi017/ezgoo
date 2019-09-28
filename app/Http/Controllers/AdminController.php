<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Models\Booking;

use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $plane = Booking::select('vehicle', 'created_at')
                    ->where('vehicle', 'plane')
                    ->get()
                    ->groupBy(function($date) {
                        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                        return Carbon::parse($date->created_at)->format('n'); // grouping by months
                    });
      $train = Booking::select('vehicle', 'created_at')
                    ->where('vehicle', 'train')
                    ->get()
                    ->groupBy(function($date) {
                        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                        return Carbon::parse($date->created_at)->format('n'); // grouping by months
                    });

                    $planemcount = [];
                    $planeArr = [];
                    $trainmcount = [];
                    $trainArr = [];
                    foreach ($plane as $key => $value) {
                        $planemcount[$key] = count($value);
                    }

                    for($i = 1; $i <= 12; $i++){
                        if(!empty($planemcount[$i])){
                            $planeArr[$i] = $planemcount[$i];
                        }else{
                            $planeArr[$i] = 0;
                        }
                    }
                    foreach ($train as $key => $value) {
                        $trainmcount[$key] = count($value);
                    }

                    for($i = 1; $i <= 12; $i++){
                        if(!empty($trainmcount[$i])){
                            $trainArr[$i] = $trainmcount[$i];
                        }else{
                            $trainArr[$i] = 0;
                        }
                    }
      $chartjs = app()->chartjs
      ->name('booking')
      ->type('line')
      ->size(['width' => 400, 'height' => 200])
      ->labels(['Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'])
      ->datasets([
          [
              "label" => "Pesawat",
              'backgroundColor' => "rgba(38, 185, 154, 0.31)",
              'borderColor' => "rgba(38, 185, 154, 0.7)",
              "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
              "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
              "pointHoverBackgroundColor" => "#fff",
              "pointHoverBorderColor" => "rgba(220,220,220,1)",
              'data' => [$planeArr[2],$planeArr[3],$planeArr[4],$planeArr[5],$planeArr[6],$planeArr[7],$planeArr[8],$planeArr[9],$planeArr[10],$planeArr[11],$planeArr[12]],
          ],
          [
              "label" => "Kereta",
              'backgroundColor' => "rgba(38, 185, 154, 0.31)",
              'borderColor' => "rgba(38, 185, 154, 0.7)",
              "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
              "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
              "pointHoverBackgroundColor" => "#fff",
              "pointHoverBorderColor" => "rgba(220,220,220,1)",
              'data' => [$trainArr[2],$trainArr[3],$trainArr[4],$trainArr[5],$trainArr[6],$trainArr[7],$trainArr[8],$trainArr[9],$trainArr[10],$trainArr[11],$trainArr[12]],
          ]
      ])
      ->options([]);
      return view('admin.index', compact('chartjs'));
    }
    public function showUsers()
    {
      $users = User::all();
      return view('admin.users', compact('users'));
    }

    public function planeAjax($id)
    {
      $plane = DB::table("planes")->where("id",$id)->get();
      return response()->json($plane);
    }

    public function airportAjax($id)
    {
      $airport = DB::table("airports")->where("id",$id)->get();
      return response()->json($airport);
    }

    public function trainAjax($id)
    {
      $train = DB::table("trains")->where("id",$id)->get();
      return response()->json($train);
    }

    public function stationAjax($id)
    {
      $station = DB::table("train_stations")->where("id",$id)->get();
      return response()->json($station);
    }

    public function destinationAjax($id)
    {
      $destination = DB::table("airports")->where("id",$id)->get();
      return response()->json($destination);
    }
}
