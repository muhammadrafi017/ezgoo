@extends('admin.layouts.app');

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Stasiun Kereta</li>
      </ol>
    </div><br><!--/.row-->

<body>
<div class="row">
  <div class="col-md-12">
          <h1>Data Stasiun</h1>
          <div class="panel panel-default">
            <div class="panel-body">
          <hr>
          <form action="{{ url('admin/station') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                  <label for="nama">Nama Stasiun :</label>
                  <input type="text" class="form-control" id="station_name" name="station_name" placeholder="Stasiun">
              </div>
              <div class="form-group">
                  <label for="code">Code:</label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="Kode">
              </div>
              <div class="form-group">
                  <label for="city">City:</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Kota">
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-md btn-primary">Submit</button>
                  <button type="reset" class="btn btn-md btn-danger">Cancel</button>
              </div>
          </form>
      </div>


  @endsection
