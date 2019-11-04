@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if (Session::has('error'))
          <div class="alert alert-danger">
            {{Session::get('error')}}
          </div>
        @elseif(Session::has('success'))
          <div class="alert alert-success">
              {{ Session::get('success') }}
          </div>
        @endif
          <div class="panel panel-default">
              <div class="panel-heading">Pembayaran booking</div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ url('booking/doPayment') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{-- <input type="hidden" name="_method" value="put"> --}}
                      <div class="form-group{{ $errors->has('sender_name') ? ' has-error' : '' }}">
                          <label for="sender_name" class="col-md-4 control-label">Kode booking</label>

                          <div class="col-md-6">
                              <input id="booking_code" type="text" class="form-control" name="booking_code" value="{{ old('booking_code') }}" required autofocus>

                              @if ($errors->has('booking_code'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('booking_code') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('sender_name') ? ' has-error' : '' }}">
                          <label for="sender_name" class="col-md-4 control-label">Nama pengirim</label>

                          <div class="col-md-6">
                              <input id="sender_name" type="text" class="form-control" name="sender_name" value="{{ old('sender_name') }}" required autofocus>

                              @if ($errors->has('sender_name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sender_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('ammount') ? ' has-error' : '' }}">
                          <label for="ammount" class="col-md-4 control-label">Jumlah uang yang dikirim</label>

                          <div class="col-md-6">
                              <input id="ammount" type="text" class="form-control" name="ammount" value="{{ old('ammount') }}" required autofocus>

                              @if ($errors->has('ammount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ammount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('receipt') ? ' has-error' : '' }}">
                          <label for="receipt" class="col-md-4 control-label">Bukti pembayaran</label>

                          <div class="col-md-6">
                              <input type="file" class="form-control" name="receipt" id="receipt">

                              @if ($errors->has('ammount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ammount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Konfirmasi
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
