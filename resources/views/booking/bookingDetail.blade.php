@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding:10vh;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Pemesanan berhasil</h4>
        </div>
        <div class="panel-body text-center">
            <h4>Booking code</h4>
            <h3> <b> {{ $booking->booking_code }} </b> </h3>
            <h4>Waktu Expire : 7 jam 59 menit</h4>
            <br>
            <h4>Total yang Harus Dibayar</h4>
            <h3> <b> {{ number_format($booking->bill, 0, ',', '.') }} </b> </h3>
            <h4>*Mohon bayar sesuai dengan biaya diatas untuk menghindari error verifikasi otomatis </h4>
            <br>
            <h4>Transfer ke :</h4>
            <img src="" alt="" style="width:150px;height:150px">
            <h4>No rekening</h4>
            <h3> <b> {{ $bank->account_number }} </b> </h3>
            <h4>Atas nama</h4>
            <h3> <b> {{ $bank->account_name }} </b> </h3>
        </div>
    </div>
    <div class="text-center">
        <p>Konfirmasi pembayaran dan upload bukti setelah transfer <a href=" {{ url('booking/payment') }} ">Klik disini</a> </p>
    </div>
</div>
@endsection