<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailTicket;
use Illuminate\Http\Request;
use App\Models\Plane;
use App\Models\Train;
use App\Models\Passenger;
use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\BankAccount;
use App\Models\Transaction;
use DB;

use Auth;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Facades\Storage;
use PDF;

class BookingController extends Controller
{
    public function __construct()
    {
      $this->plane = "App\Models\Plane";
      $this->planeFare = "App\Models\PlaneFare";
      $this->planeSchedule = "App\Models\PlaneSchedule";
      $this->train = "App\Models\Train";
      $this->trainFare = "App\Models\TrainFare";
      $this->trainSchedule = "App\Models\TrainSchedule";
    }

    public function index()
    {
      $booking = Booking::all();
      return view('admin.booking.index', compact('booking'));
    }

    public function edit($id)
    {
      $booking = Booking::find($id);
      $detail  = DetailBooking::where('booking_id', $id)->get();
      foreach($detail as $pass){
      $passengers = Passenger::where('detail_booking_id', $pass->id)->get();}
      return view('admin.booking.edit',compact('booking','detail','pass'));
    }

    public function destroy($id)
    {
      $customer = Customer::find($id);
      $customer->delete();

      return redirect('admin.booking.index');
    }

    public function search(Request $request)
    {
      $request['date'] = date('Y-m-d', strtotime($request->date));
      $request['dateB'] = date('Y-m-d', strtotime($request->dateB));
      if ($request->baby <= $request->adult){
        $vehicle = $request->vehicle;
        if ($vehicle == 'plane') {
          $total = [
            'baby' => $request->baby,
            'child'=> $request->child,
            'adult'=> $request->adult
          ];
        }elseif($vehicle == 'train'){
          $total = [
            'child'=> $request->child,
            'adult'=> $request->adult
          ];
        }
        $type = $request->type;
        $seat  = "";
        $model = "";
        //cek kendaraan
        if ($vehicle == 'plane'){
          $model = $this->planeSchedule;
        }elseif($vehicle == 'train'){
          $model = $this->trainSchedule;
        }
        //cek kursi
        if ($request->class == "Ekonomi") {
          $seat = 'eco_seat';
        }elseif($request->class == "Bisnis") {
          $seat = 'bus_seat';
        }elseif($request->class == "First Class"){
          $seat = 'first_seat';
        }elseif($request->class == "Eksekutif"){
          $seat = 'exec_seat';
        }
        //cek tipe
        if ($type == 'st'){
          $schedule = $model::findSchedule($request->from_code, $request->destination_code, $request->date, $seat, count($total));
          return view('booking.bookingSingle', compact('schedule', 'vehicle','type','total', 'seat'));
          // return $schedule;
        }elseif($type == 'rt'){
          $scheduleG = $model::findSchedule($request->from_code, $request->destination_code, $request->date, $seat, count($total));
          $scheduleB = $model::findSchedule($request->destination_code, $request->from_code, $request->dateB, $seat, count($total));
          // return $scheduleB;
          return view('booking.bookingRound', compact('scheduleG', 'scheduleB', 'vehicle','type','total', 'seat'));
        }else{
          abort(404);
        }
      }else{
        return redirect('')->withError('Bayi tidak boleh lebih dari dewasa');
      }
    }

    public function order(Request $request)
    {
      $model = "";
      $class = "";
      $vehicle = $request->vehicle;
      $id = [$request->go,$request->back];
      $fareTotal = 0;
      $bank = BankAccount::select('*')->get();
      $total = explode(',',$request->total);
      if ($vehicle == 'plane') {
        $totalCount = $total[0] + $total[1] + $total[2];
        $total = [
          'baby' => $total[0],
          'child'=> $total[1],
          'adult'=> $total[2]
        ];
      }elseif($vehicle == 'train'){
        $totalCount = $total[0] + $total[1];
        $total = [
          'child'=> $total[0],
          'adult'=> $total[1]
        ];
      }
      $seat = $request->seat;
      if ($seat == 'eco_seat') {
        $class = 'Ekonomi';
      }elseif($seat == 'bus_seat'){
        $class = 'Bisnis';
      }elseif($seat == 'first_seat'){
        $class = 'First Class';
      }elseif($seat == 'exec_seat'){
        $class = 'Eksekutif';
      }
      if ($vehicle == 'plane'){
        $model = $this->planeSchedule;
      }elseif($vehicle == 'train'){
        $model = $this->trainSchedule;
      }

      if (isset($id) && isset($seat)) {
        $schedule = $model::findWithPrice($id, $seat);
      }else{
        abort(404);
      }
      return view('booking.bookingFix', compact('schedule','vehicle', 'total', 'totalCount', 'seat', 'class', 'fareTotal', 'bank'));
    }

    public function fixOrder(Request $request)
    {
        $modelV = "";
        $modelF = "";
        $modelS = "";
        $vehicle = $request->vehicle;
        $id = $request->id;
        $userId = auth()->user()? auth()->user()->id : null;
        $total = $request->totalCount;
        $seat = $request->seat;
        $date = Carbon::now();
        $expire = $date->addHours(8);

        if ($vehicle == 'plane'){
          $modelV = $this->plane;
          $modelF = $this->planeFare;
          $modelS = $this->planeSchedule;
        }elseif($vehicle == 'train'){
          $modelV = $this->train;
          $modelF = $this->trainFare;
          $modelS = $this->trainSchedule;
        }else{
          abort(404);
        }

        if (isset($id)) {
          $math = $modelS::seatMath($total, $seat, $id);
          DB::beginTransaction();
          try {
            for ($i=0; $i < count($request->id); $i++) {
              $price = $modelS::findPrice($request->id[$i], $seat);
                $booking = new Booking();
                $booking->user_id = $userId;
                $booking->booking_code = str_random(4);
                $booking->vehicle = $vehicle;
                $booking->bill = $price->$seat * $total + $price->unique_code;
                $booking->schedule_id = $request->id[$i];
                $booking->expire = $expire;
                $booking->nik = $request->booking['nik'];
                $booking->name = $request->booking['name'];
                $booking->address = $request->booking['address'];
                $booking->phone = $request->booking['phone'];
                $booking->email = $request->booking['email'];
                $booking->save();
                //
                $detbook = new DetailBooking;
                $detbook->booking_id = $booking->id;
                $detbook->passenger =  $total;
                $detbook->class = $seat;
                $detbook->save();
                //
                $transaction = new Transaction;
                $transaction->booking_id = $booking->id;
                $transaction->bank = $request->bank;
                $transaction->save();
                //
                for ($j=0; $j < count($request->name); $j++) {
                  $passenger = new Passenger;
                  $passenger->detail_booking_id = $detbook->id;
                  $passenger->name = $request->name[$j];
                  $passenger->save();
                }
                $bank = BankAccount::where('bank', $request->bank)->first();
                DB::commit();
                return view('booking.bookingDetail', compact('booking', 'bank'));
              }
          } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage());
          }
        }else{
          abort(404);
        }
    }

    public function payment()
    {
      return view('booking/payment');
    }

    public function doPayment(Request $request)
    {
      try {
        $request->request->add(['status'=> 1]);
        $data = $this->validate($request,[
          'status' => 'required',
          'sender_name' => 'required',
          'ammount' => 'required|integer',
          'receipt' => 'required|mimes:jpg,png,jpeg',
        ]);
        $booking = Booking::where('booking_code', $request->booking_code)->first();
        if ($booking) {
          if ($booking->bill == $request->ammount) {
            $ext = $request->file('receipt')->getClientOriginalExtension();
            $filename = 'booking_receipt_'.$booking->id.'.'.$ext;
            Storage::putFileAs('public/uploads/receipt', $request->receipt, $filename);
            $data['receipt'] = $filename;
            Transaction::where('booking_id', $booking->id)->update($data);
            $this->sendTicket($booking->id);
            return redirect('booking/payment')->with('success', 'Pembayaran berhasil, tiket sudah dikirim ke email anda');
          }else{
            return back()->with('error', 'Jumlah uang tidak sesuai');
          }
        } else {
          return back()->with('error', 'Data booking tidak ditemukan');
        }
      } catch (\Throwable $th) {
        dd($th);
      }
    }

    public function sendTicket($id_booking)
    {
      $vehicleP = '';
      $vehicleT = '';
        $booking = Booking::find($id_booking);
        if ($booking->vehicle == 'plane') {
          $data = Booking::where(['id' => $id_booking,'vehicle'=>'plane'])->with('scheP','detail_booking','transaction')->get();
          $vehicleP = Plane::find($data[0]->scheP->plane_id);
        } elseif ($booking->vehicle == 'train') {
          $data = Booking::where(['id' => $id_booking,'vehicle'=>'train'])->with('scheT','detail_booking','transaction')->get();
          $vehicleT = Train::find($data[0]->scheT->train_id);
        }
        $passenger = Passenger::where('detail_booking_id',$data[0]->detail_booking->id)->get();
        dispatch(new SendMailTicket($data, $vehicleP, $vehicleT, $passenger));
    }

    public function test()
    {
      return view('test.testView');
    }

    public function export($type)
    {
        $data = Passenger::all();
        return Excel::create('passenger_'.date('d-m-Y'),function($excel) use ($data){
          $excel->sheet('test', function($sheet) use($data){
            $sheet->cell('A1', function($cell) {$cell->setValue('Nama');   });
              if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $i= $key+2;
                    $sheet->cell('A'.$i, $value['name']);
                }
              }
          });
        })->download($type);
    }

    public function import(Request $request)
    {
      $path = $request->file('import_file')->getRealPath();
      $data = Excel::load($path, function($reader){

      })->get();
      return $data;
    }
}
