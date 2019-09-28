@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Password</div>

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
                    <form class="form-horizontal" method="POST" action="{{ route('update')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ Auth::User()->id }}">

                        <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password lama</label>

                            <div class="col-md-6">
                                <input id="oldPassword" type="password" class="form-control" name="oldPassword" required>

                                @if ($errors->has('oldPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password baru</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ubah Password
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
