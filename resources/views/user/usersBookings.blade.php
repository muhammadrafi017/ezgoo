@extends('layouts.app')

@section('content')

<div class="container">
  @if (Session::has('error'))
    <div class="alert alert-danger">
      {{Session::get('error')}}
    </div>
  @endif
  @if ($dataP->isEmpty() && $dataT->isEmpty())
    <td colspan="5">Maaf, anda belum memesan tiket</td>
  @else
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        @if (isset($dataP))
          <div class="accordion">
            @foreach ($dataP as $data)
                <div class="panel panel-default">

                  <div class="panel-heading" id="heading{{$data->id}}">
                    <div class="row">
                      <div class="col-md-6">
                        <h5>Tiket {{$data->scheP->from}} ke {{$data->scheP->destination}}</h5>
                      </div>
                      @if ($data->transaction->status == 0)
                        <div class="col-md-5" style="color:red;">
                          <h5>Expire {{date('H:i', strtotime($data->expire))}}</h5>
                        </div>
                      @else
                        <div class="col-md-5"></div>
                      @endif
                      <div class="col-md-1">
                        <i value="heh" class="fa fa-angle-down fa-2x" data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="true" aria-controls="collapse{{$data->id}}" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>

                  <div id="collapse{{$data->id}}" class="collapse" aria-labelledby="heading{{$data->id}}" data-parent="#accordion">
                    <div class="panel-body">
                      <p class="col-md-6">Status</p>
                      @if ($data->transaction->status == 0)
                        <div class="alert alert-danger col-md-6"><center>Belum dibayar</center></div>
                      @elseif ($data->transaction->status == 1)
                        <div class="alert alert-success col-md-6"><center>Sudah dibayar</center></div>
                      @endif
                      <p class="col-md-6">Booking code</p>
                        <p class="col-md-6">{{$data->booking_code}}</p>
                      <p class="col-md-6">Keberangkatan</p>
                        <p class="col-md-6">{{date('d-m-Y H:i', strtotime($data->scheP->boarding_time))}}</p>
                        <p class="col-md-6">Gate</p>
                          <p class="col-md-6">{{$data->scheP->gate}}</p>
                      <p class="col-md-6">Durasi</p>
                        <p class="col-md-6">{{date('h',$data->scheP->duration)}} jam</p>
                      <p class="col-md-6">Total penumpang</p>
                        <p class="col-md-6">{{$data->detail_booking->passenger}}</p>
                      <p class="col-md-6">Kelas</p>
                      @if ($data->detail_booking->class == 'eco_seat')
                        <p class="col-md-6">Ekonomi</p>
                      @elseif ($data->detail_booking->class == 'bus_seat')
                        <p class="col-md-6">Bisnis</p>
                      @elseif ($data->detail_booking->class == 'first_seat')
                        <p class="col-md-6">First class</p>
                      @elseif ($data->detail_booking->class == 'exec_seat')
                        <p class="col-md-6">Eksekutif</p>
                      @endif
                      <p class="col-md-6">Bill</p>
                        <p class="col-md-6">IDR {{ number_format($data->bill, 2,',','.')}}</p>
                        @if ($data->transaction->status == 0)
                          <a href="{{url('user/booking/'.Auth::user()->id.'/'.$data->id)}}" class="btn btn-primary pull-right">Bayar</a>
                        @else
                          <a href="{{url('user/ticket/'.Auth::user()->id.'/'.$data->id)}}" class="btn btn-success pull-right">Lihat tiket</a>
                        @endif
                    </div>
                  </div>

                </div>
            @endforeach
          </div>

        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        @if (isset($dataT))
          <div class="accordion">
            @foreach ($dataT as $data)
              <div class="panel panel-default">

                <div class="panel-heading" id="heading{{$data->id}}">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Tiket {{$data->scheT->from}} ke {{$data->scheT->destination}}</h5>
                    </div>
                    @if ($data->transaction->status == 0)
                      <div class="col-md-5" style="color:red;">
                        <h5>Expire {{date('H:i', strtotime($data->expire))}}</h5>
                      </div>
                    @else
                      <div class="col-md-5"></div>
                    @endif
                    <div class="col-md-1">
                      <i value="heh" class="fa fa-angle-down fa-2x" data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="true" aria-controls="collapse{{$data->id}}" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>

                <div id="collapse{{$data->id}}" class="collapse" aria-labelledby="heading{{$data->id}}" data-parent="#accordion">
                  <div class="panel-body">
                    <p class="col-md-6">Status</p>
                    @if ($data->transaction->status == 0)
                      <div class="alert alert-danger col-md-6"><center>Belum dibayar</center></div>
                    @elseif ($data->transaction->status == 1)
                      <div class="alert alert-success col-md-6"><center>Sudah dibayar</center></div>
                    @endif
                    <p class="col-md-6">Booking code</p>
                      <p class="col-md-6">{{$data->booking_code}}</p>
                    <p class="col-md-6">Keberangkatan</p>
                      <p class="col-md-6">{{date('d-m-Y H:i', strtotime($data->scheP->boarding_time))}}</p>
                      <p class="col-md-6">Gate</p>
                        <p class="col-md-6">{{$data->scheT->platform}}</p>
                    <p class="col-md-6">Durasi</p>
                      <p class="col-md-6">{{date('h',$data->scheT->duration)}} jam</p>
                    <p class="col-md-6">Total penumpang</p>
                      <p class="col-md-6">{{$data->detail_booking->passenger}}</p>
                    <p class="col-md-6">Kelas</p>
                    @if ($data->detail_booking->class == 'eco_seat')
                      <p class="col-md-6">Ekonomi</p>
                    @elseif ($data->detail_booking->class == 'bus_seat')
                      <p class="col-md-6">Bisnis</p>
                    @elseif ($data->detail_booking->class == 'first_seat')
                      <p class="col-md-6">First class</p>
                    @elseif ($data->detail_booking->class == 'exec_seat')
                      <p class="col-md-6">Eksekutif</p>
                    @endif
                    <p class="col-md-6">Bill</p>
                      <p class="col-md-6">IDR {{ number_format($data->bill, 2,',','.')}}</p>
                      @if ($data->transaction->status == 0)
                        <a href="{{url('user/booking/'.Auth::user()->id.'/'.$data->id)}}" class="btn btn-primary pull-right">Bayar</a>
                      @else
                        <a href="{{url('user/ticket/'.Auth::user()->id.'/'.$data->id)}}" class="btn btn-success pull-right">Lihat tiket</a>
                      @endif
                  </div>
                </div>

              </div>
            @endforeach
          </div>

        @endif
      </div>
    </div>
  </div>
          @endif
        </div>
@endsection
