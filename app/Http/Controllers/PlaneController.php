<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\PlaneSchedule;
use App\Models\PlaneFare;
use App\Models\Plane;
use App\Models\Airport;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $plane = Plane::with('planefare')->get();
      return view('admin.plane.index',compact('plane'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.plane.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $plane = new Plane();
      $plane->plane_name  = $request->plane_name;
      $plane->eco_seat    = $request->eco_seat;
      $plane->bus_seat    = $request->bus_seat;
      $plane->first_seat  = $request->first_seat;
      $plane->save();

      $planeFare = new PlaneFare();
      $planeFare->plane_id = $plane->id;
      $planeFare->eco_seat = $request->eco_seatfare;
      $planeFare->bus_seat = $request->bus_seatfare;
      $planeFare->first_seat = $request->first_seatfare;
      $planeFare->unique_code = mt_rand(100,999);
      $planeFare->save();

      return redirect('admin/plane')->with('alert-success','Berhasil Menambah Data!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $data = Plane::where('id',$id)->with('planefare')->get();
      return view('admin.plane.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
      $plane = Plane::findOrFail($id);
      $plane->plane_name  = $request->plane_name;
      $plane->eco_seat    = $request->eco_seat;
      $plane->bus_seat    = $request->bus_seat;
      $plane->first_seat  = $request->first_seat;
      $plane->save();

      $planefare = PlaneFare::findOrFail($request->id);
      $planefare->eco_seat    = $request->eco_seatfare;
      $planefare->bus_seat    = $request->bus_seatfare;
      $planefare->first_seat  = $request->first_seatfare;
      $planefare->save();

      return redirect('admin/plane')->with('alert-success','Data berhasil diubah!');
    }

    public function destroy($id)
    {
      $data = Plane::where('id',$id)->first();
      $data->delete();
      return redirect('admin/plane')->with('alert-success','Data berhasi dihapus!');
    }

    public function schedule()
    {
      $planeSchedule = PlaneSchedule::with('airport','plane')->get();
      return view('admin.plane.schedule.index', compact('planeSchedule'));
    }

    public function detailSchedule($id)
    {
      $detail = PlaneSchedule::where('id',$id)->with('Plane')->get();
      return view('admin/plane/schedule/show', compact('detail'));
    }

    public function createSchedule()
    {
      $plane = Plane::select("plane_name","id")->get();
      $airport = Airport::select("airport_name","id")->get();
      return view('admin.plane.schedule.create',compact('plane','airport'));
    }

    public function storeSchedule(Request $request)
    {
      $destination = Airport::find($request->destination);
      $planeschedule = new PlaneSchedule();
      $planeschedule->plane_id          = $request->plane_id;
      $planeschedule->airport_id        = $request->airport_id;
      $planeschedule->from              = $request->from;
      $planeschedule->destination       = $destination->airport_name;
      $planeschedule->from_code         = $request->from_code;
      $planeschedule->destination_code  = $request->destination_code;
      $planeschedule->eco_seat          = $request->eco_seat;
      $planeschedule->bus_seat          = $request->bus_seat;
      $planeschedule->first_seat        = $request->first_seat;
      $planeschedule->boarding_time     = $request->boarding_time;
      $planeschedule->duration          = strtotime($request->duration);
      $planeschedule->gate              = $request->gate;
      $planeschedule->save();
      return redirect('admin/plane/schedule/index')->with('alert-success','Berhasil Menambah Data!');
    }

    public function editSchedule($id)
    {
      $planeschedule = PlaneSchedule::where('id',$id)->with('Plane')->get();
      $plane = Plane::select("plane_name","id")->get();
      $airport = Airport::select("airport_name","id")->get();
      return view('admin.plane.schedule.edit',compact('planeschedule','plane','airport'));
    }

    public function updateSchedule(Request $request, $id)
    {
      $destination = Airport::find($request->destination);
      $planeschedule = PlaneSchedule::findorFail($id);
      $planeschedule->plane_id          = $request->plane_id;
      $planeschedule->airport_id        = $request->airport_id;
      $planeschedule->from              = $request->from;
      $planeschedule->destination       = $destination->airport_name;
      $planeschedule->from_code         = $request->from_code;
      $planeschedule->destination_code  = $request->destination_code;
      $planeschedule->eco_seat          = $request->eco_seat;
      $planeschedule->bus_seat          = $request->bus_seat;
      $planeschedule->first_seat        = $request->first_seat;
      $planeschedule->boarding_time     = $request->boarding_time;
      $planeschedule->duration          = strtotime($request->duration);
      $planeschedule->gate              = $request->gate;
      return redirect('admin/plane/schedule/index')->with('alert-success','Berhasil Mengubah Data!');
    }

    public function destroySchedule($id)
    {
      $data = PlaneSchedule::where('id',$id)->first();
      $data->delete();
      return redirect('admin/plane/schedule/index')->with('alert-success','Data berhasi dihapus!');
    }
}
