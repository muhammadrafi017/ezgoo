<?php

namespace App\Http\Controllers;
Use App\Models\TrainStation;
Use App\Models\TrainSchedule;
Use App\Models\Train;
Use App\Models\TrainFare;

use Illuminate\Http\Request;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $train = Train::with('trainfare')->get();
      return view('admin.train.index',compact('train'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.train.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $train = new Train();
      $train->train_name  = $request->train_name;
      $train->eco_seat    = $request->eco_seat;
      $train->bus_seat    = $request->bus_seat;
      $train->exec_seat  = $request->exec_seat;
      $train->save();

      $trainfare = new TrainFare();
      $trainfare->train_id = $train->id;
      $trainfare->eco_seat = $request->eco_seatfare;
      $trainfare->bus_seat = $request->bus_seatfare;
      $trainfare->exec_seat = $request->exec_seatfare;
      $trainfare->unique_code = mt_rand(100,999);
      $trainfare->save();
      return redirect('admin/train');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Train::where('id',$id)->with('trainfare')->get();
      return view('admin/train/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $train = Train::findOrFail($id);
      $train->train_name  = $request->train_name;
      $train->eco_seat    = $request->eco_seat;
      $train->bus_seat    = $request->bus_seat;
      $train->exec_seat   = $request->exec_seat;
      $train->save();

      $trainfare = TrainFare::findOrFail($request->id);
      $trainfare->eco_seat    = $request->eco_seatfare;
      $trainfare->bus_seat    = $request->bus_seatfare;
      $trainfare->exec_seat   = $request->exec_seatfare;
      $trainfare->save();

      return redirect('admin/train')->with('alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Train::where('id',$id)->first();
      $data->delete();
      return redirect('admin/train')->with('alert-success','Data berhasi dihapus!');
    }

    public function schedule()
    {
      $trainSchedule = TrainSchedule::with('station','train')->get();
      return view('admin/train/schedule/index', compact('trainSchedule'));
    }

    public function detailSchedule($id)
    {
      $detail = TrainSchedule::where('id',$id)->with('Train')->get();
      return view('admin/train/schedule/show', compact('detail'));
    }

    public function createSchedule()
    {
      $train = Train::select("train_name","id")->get();
      $station = TrainStation::select("station_name","id")->get();
      return view('admin/train/schedule/create',compact('train','station'));
    }

    public function storeSchedule(Request $request)
    {
      $destination = TrainStation::find($request->Tdestination);
      $trainschedule = new TrainSchedule();
      $trainschedule->station_id        = $request->station_id;
      $trainschedule->train_id          = $request->train_id;
      $trainschedule->from              = $request->from;
      $trainschedule->destination       = $destination->station_name;
      $trainschedule->from_code         = $request->from_code;
      $trainschedule->destination_code  = $request->destination_code;
      $trainschedule->eco_seat          = $request->eco_seat;
      $trainschedule->bus_seat          = $request->bus_seat;
      $trainschedule->exec_seat         = $request->exec_seat;
      $trainschedule->boarding_time     = $request->boarding_time;
      $trainschedule->duration          = strtotime($request->duration);
      $trainschedule->platform          = $request->platform;
      $trainschedule->save();
      return redirect('admin/train/schedule/index')->with('alert-success','Berhasil Menambah Data!');
    }

    public function editSchedule($id)
    {
      $trainschedule = TrainSchedule::where('id',$id)->with('Train', 'Train.TrainFare')->get();
      $train = Train::select("train_name","id")->get();
      $station = TrainStation::select("station_name","id")->get();
      return view('admin/train/schedule/edit',compact('trainschedule','train','station'));
    }

    public function updateSchedule(Request $request, $id)
    {
      $destination = TrainStation::find($request->Tdestination);
      $trainschedule = TrainSchedule::findorFail($id);
      $trainschedule->station_id        = $request->station_id;
      $trainschedule->train_id          = $request->train_id;
      $trainschedule->from              = $request->from;
      $trainschedule->destination       = $destination->station_name;
      $trainschedule->from_code         = $request->from_code;
      $trainschedule->destination_code  = $request->destination_code;
      $trainschedule->eco_seat          = $request->eco_seat;
      $trainschedule->bus_seat          = $request->bus_seat;
      $trainschedule->exec_seat         = $request->exec_seat;
      $trainschedule->boarding_time     = $request->boarding_time;
      $trainschedule->duration          = strtotime($request->duration);
      $trainschedule->platform          = $request->platform;
      $trainschedule->save();
      return redirect('admin/train/schedule/index')->with('alert-success','Berhasil Menambah Data!');
    }

    public function destroySchedule($id)
    {
      $data = TrainSchedule::where('id',$id)->first();
      $data->delete();
      return redirect('admin/train/schedule/index')->with('alert-success','Data berhasi dihapus!');
    }
}
