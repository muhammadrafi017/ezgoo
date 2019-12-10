@extends('admin.layouts.app')


@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Booking</li>
      </ol>
    </div><br>
  <div class="row">
    <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <strong>{{ Session::get('alert-success') }}</strong>
                </div>
            @endif
            <hr>


<table class="table table-striped table-bordered data">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode booking</th>
                <th>Tanggal booking</th>
                <th>Kendaraan</th>
                <th>Biaya</th>
                <th>Status pembayaran</th>
                <th>Bukti Pembayaran</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
          @foreach ($booking as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->booking_code }}</td>
              <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
              @if($data->vehicle == "plane")
              <td>Pesawat</td>
            @else
              <td>Kereta Api</td>

              @endif
              <td>Rp. {{number_format($data->bill)}}</td>
              <td>
                @if ($data->transaction->status == 1)
                    LUNAS
                @else
                    BELUM DIBAYAR
                @endif
              </td>
              <td>
                @if ($data->transaction->receipt)
                    <a href=" {{ Storage::url('public/uploads/receipt/'.$data->transaction->receipt) }} " target="_blank"> {{ $data->transaction->receipt }} </a>
                @else
                    BELUM UPLOAD BUKTI
                @endif
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
