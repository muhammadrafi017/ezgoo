@extends('admin.layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Edit Data Kereta</li>
      </ol>
    </div><br><!--/.row-->

<body>
  <div class="row">
    <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
            <hr>
            @foreach($data as $datas)
            <form action="{{ url('admin/train/'.$datas->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put')}}
                <input type="hidden" name="id" value="{{ $datas->trainfare->id }}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama">Train Name:</label>
                        <input type="text" class="form-control" id="train_name" name="train_name" value="{{ $datas->train_name }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Economy Seat:</label>
                        <input type="text" class="form-control" id="eco_seat" name="eco_seat" value="{{ $datas->eco_seat }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Economy Seat Fare:</label>
                        <input type="number" class="form-control" id="eco_seat" name="eco_seatfare" placeholder="/ seat" value="{{ $datas->trainfare->eco_seat }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Bussines Seat:</label>
                        <input type="text" class="form-control" id="bus_seat" name="bus_seat" value="{{ $datas->bus_seat }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Bussines Seat:</label>
                        <input type="number" class="form-control" id="bus_seat" name="bus_seatfare" placeholder="/ seat" value="{{ $datas->trainfare->bus_seat }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">exec Seat:</label>
                        <input type="text" class="form-control" id="exec_seat" name="exec_seat" value="{{ $datas->exec_seat }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">exec Seat Fare:</label>
                        <input type="number" class="form-control" id="exec_seat" name="exec_seatfare" placeholder="/ seat" value="{{ $datas->trainfare->exec_seat }}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                </div>
            </form>
            @endforeach
        </div>









  @endsection
