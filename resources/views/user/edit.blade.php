@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Profile</div>

                <div class="panel-body">
                      @if(Session::has('alert'))
                      <div class="alert alert-success">
                          {{ Session::get('alert') }}
                          @php
                          Session::forget('alert');
                          @endphp
                      </div>
                    @elseif(Session::get('alertF'))
                      <div class="alert alert-danger">
                          {{ Session::get('alertF') }}
                          @php
                          Session::forget('alertF');
                          @endphp
                      </div>
                      @endif
                    <form class="form-horizontal" method="POST" action="{{ route('updatePass')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ Auth::User()->id }}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama_depan') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Depan</label>

                            <div class="col-md-6">
                                <input id="nama_depan" type="text" class="form-control" name="nama_depan" value="{{ old('name_depan') }}" required>

                                @if ($errors->has('nama_depan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_depan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama_belakang') ? ' has-error' : '' }}">
                            <label for="nama_belakang" class="col-md-4 control-label">Nama Belakang</label>

                            <div class="col-md-6">
                                <input id="nama_belakang" type="text" class="form-control" name="nama_belakang" value="{{ old('nama_belakang') }}" required autofocus>

                                @if ($errors->has('nama_belakang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_belakang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
