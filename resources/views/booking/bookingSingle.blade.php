@extends('layouts.app')

@section('content')
<!--pilihan pesawat-->

<div class="container">
  @foreach ($schedule as $s)
      <h4>Dari {{$s->from}} ke {{$s->destination}} <p class="pull-right">{{date('d-m-Y', strtotime($s->boarding_time))}}</p> </h4>
    @break($s)
  @endforeach
  <form action="{{ url('booking/order') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="vehicle" value="{{$vehicle}}">
    <input type="hidden" name="total" value="{{implode(',',$total)}}">
    <input type="hidden" name="seat" value="{{$seat}}">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            @if ($vehicle == 'plane')
              <th>Pesawat</th>
              <th>Pergi</th>
              <th>Durasi</th>
              <th>Tiba</th>
              <th>Gate</th>
              <th>/orang</th>
            @elseif($vehicle == 'train')
              <th>Kereta</th>
              <th>Pergi</th>
              <th>Durasi</th>
              <th>Tiba</th>
              <th>Peron</th>
              <th>/orang</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @if ($schedule->isEmpty())
            <td colspan="5">Maaf, jadwal dan rute yang dicari tidak ditemukan atau sudah penuh</td>
          @else
            @if ($vehicle == 'plane')
              @foreach ($schedule as $s)
                <tr>
                  <td>{{ $s->plane_name }}</td>
                  @php
                    $duration = date('h',$s->duration);
                    $range    = strtotime($s->boarding_time ."+$duration hours");
                  @endphp
                  <td>{{ date('H:i:s', strtotime($s->boarding_time)) }}</td>
                  <td>{{ $duration }} jam</td>
                  <td>{{ date('H:i:s', $range) }}</td>
                  <td>{{ $s->gate }}</td>
                  <td>IDR {{ number_format($s->$seat,2, ".", ",") }}</td>
                  <td> <button type="submit" name="go" value="{{$s->id}}">Pesan</button></td>
                </tr>
              @endforeach
            @elseif($vehicle == 'train')
              @foreach ($schedule as $s)
                <tr>
                  <td>{{ $s->train_name }}</td>
                  @php
                    $duration = date('h',$s->duration);
                    $range    = strtotime($s->boarding_time ."+$duration hours");
                  @endphp
                  <td>{{ date('H:i:s', strtotime($s->boarding_time)) }}</td>
                  <td>{{ $duration }} jam</td>
                  <td>{{ date('H:i:s', $range) }}</td>
                  <td>{{ $s->duration }}</td>
                  <td>{{ $s->platform }}</td>
                  <td>IDR {{ number_format($s->$seat,2, ".", ",") }}</td>
                  <td> <button type="submit" name="go" value="{{$s->id}}">Pesan</button></td>
                </tr>
              @endforeach
            @endif
          @endif
        </tbody>
      </table>
    </div>
  </form>
</div>

@endsection
