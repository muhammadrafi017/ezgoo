<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | E-Tiket</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
  </head>
  <body>
    @foreach ($data as $d)
      <div class="container">
        <h1><b>E-Tiket</b></h1>
        <p class="pull-right">cetak</p>
        @if ($vehicleP)
          <h4>Jadwal penerbangan {{date('d-m-Y', strtotime($d->scheP->boarding_time))}}</h4>
        @elseif ($vehicleT)
          <h4>Jadwal keberangkatan {{date('d-m-Y', strtotime($d->scheT->boarding_time))}}</h4>
        @endif
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4><b>Detail Penumpang</b></h4>
            </div>
            <div class="panel-body">
              <div class="col-md-3">
                <h4>Booking code</h4>
                <h3>{{$d->booking_code}}</h3>
              </div>
              <div class="col-md-9">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama penumpang</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($passenger as $p)
                      <tr>
                        <td>{{$p->name}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4><b>Detail Perjalanan</b></h4>
            </div>
            <div class="panel-body">
            <table class="table table-striped">
              <thead>
                @if ($vehicleP)
                  <tr>
                    <th><center>Pesawat</center></th>
                    <th><center>Gate</center></th>
                    <th><center>Keberangkatan</center></th>
                    <th><center>Ketibaan</center></th>
                  </tr>
                @elseif ($vehicleT)
                  <tr>
                    <th><center>Kereta</center></th>
                    <th><center>Platform</center></th>
                    <th><center>Keberangkatan</center></th>
                    <th><center>Ketibaan</center></th>
                  </tr>
                @endif

              </thead>
                <tr>
                  <td><center><img src="images/garuda2.png" alt="..."></center>
                    @if ($vehicleP)
                      <h5 class="card-title"><center><b>{{$vehicleP->plane_name}}</b></center></h5></td>
                      <td><b><center>{{$d->scheP->gate}}</center></b></td>
                      <td>
                        <h5 class="card-title"><b>{{$d->scheP->from}} ({{$d->scheP->from_code}})</b></h5>
                        <p class="card-text">{{date('d-m-Y', strtotime($d->scheP->boarding_time))}}</p>
                        <p class="card-text">{{date('H:i', strtotime($d->scheP->boarding_time))}}</p>
                      </td>
                      <td>
                        <h5 class="card-title"><b>{{$d->scheP->destination}} ({{$d->scheP->destination_code}})</b></h5>
                        @php
                          $duration = date('h',$d->scheP->duration);
                          $range    = strtotime($d->scheP->boarding_time ."+$duration hours");
                        @endphp
                        <p class="card-text">{{date('d-m-Y', $range)}}</p>
                        <p class="card-text">{{date('H:i', $range)}}</p>
                      </td>
                    @elseif($vehicleT)
                      <h5 class="card-title"><center><b>{{$vehicleT->train_name}}</b></center></h5></td>
                      <td><b><center>{{$d->scheT->platform}}</center></b></td>
                      <td>
                        <h5 class="card-title"><b>{{$d->scheT->from}} ({{$d->scheT->from_code}})</b></h5>
                        <p class="card-text">{{date('d-m-Y', strtotime($d->scheT->boarding_time))}}</p>
                        <p class="card-text">{{date('H:i', strtotime($d->scheT->boarding_time))}}</p>
                      </td>
                      <td>
                        <h5 class="card-title"><b>{{$d->scheT->destination}} ({{$d->scheT->destination_code}})</b></h5>
                        @php
                          $duration = date('h',$d->scheT->duration);
                          $range    = strtotime($d->scheT->boarding_time ."+$duration hours");
                        @endphp
                        <p class="card-text">{{date('d-m-Y', $range)}}</p>
                        <p class="card-text">{{date('H:i', $range)}}</p>
                      </td>
                    @endif
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </body>
</html>
