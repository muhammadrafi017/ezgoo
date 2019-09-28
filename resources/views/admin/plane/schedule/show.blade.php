@extends('admin.layouts.app')



@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <a href="{{ url('admin/plane/schedule/index')}}" class="fa fa-arrow-circle-left fa-2x"></a>
      </ol>
    </div><br><!--/.row-->

<body>
<center>
  <div class="row">
	 <div class="col-md-12">
          <div class="card" style="width: 100rem;">
            <div class="col-md-12"><img class="card-img-top" src="{{ asset('images/plane_detail.png') }}" alt="Card image cap" height="200"></div>
            <div class="card-block">
              @foreach($detail as $data)
                  @php
                    $duration = date('h',$data->duration);
                    $range    = strtotime($data->boarding_time ."+$duration hours");
                  @endphp
                  <h4 class="card-title"><h3><b>{{ $data->boarding_time }} - {{ $data->gate }} ( {{ $duration }} Jam Penerbangan)</b><h2></h4>
                  <h4 class="card-title"><h3><b>{{ $data->plane->plane_name }}</b><h2></h4>
                  <p class="card-text"><h4><b>{{ $data->from }} ({{ $data->from_code }}) - {{ $data->destination }} ({{ $data->destination_code }})</b></h4></p>
                  <table class="table bordered" border="1">
                    <thead>
                      <tr>
                        <td><p align="center">Economi Seat</p></td>
                        <td><p align="center">Business</p></td>
                        <td><p align="center">First Class</p></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><p align="center">{{$data->eco_seat}}</p></td>
                        <td><p align="center">{{$data->bus_seat}}</p></td>
                        <td><p align="center">{{$data->first_seat}}</p></td>
                      </tr>
                    </tbody>
                  </table>
              @endforeach
            </div>
        </div>
    </div>
  </div>
</center>

@endsection
