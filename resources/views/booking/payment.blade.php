@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if (Session::has('error'))
          <div class="alert alert-danger">
            {{Session::get('error')}}
          </div>
        @endif
          <div class="panel panel-default">
              <div class="panel-heading">Pembayaran booking no {{$id_booking}}</div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ url('booking/payment/'.$id_booking) }}">
                      {{ csrf_field() }}
                      {{ method_field('put') }}
                      {{-- <input type="hidden" name="_method" value="put"> --}}
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
