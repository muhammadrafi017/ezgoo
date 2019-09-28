@extends('admin.layouts.app');

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Pesawat</li>
      </ol>
    </div><br><!--/.row-->

<body>



<div class="row">
  <div class="col-md-12">
          <h1>Data Bandara</h1>
          <div class="panel panel-default">
            <div class="panel-body">
          <hr>
          <form action="{{ url('admin/airport') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                  <label for="nama">Nama Pesawat :</label>
                  <input type="text" class="form-control" id="airport_name" name="airport_name">
              </div>
              <div class="form-group">
                  <label for="code">Kode :</label>
                  <input type="text" class="form-control" id="code" name="code">
              </div>
              <div class="form-group">
                  <label for="city">Kota ::</label>
                  <input type="text" class="form-control" id="city" name="city">
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-md btn-primary">Submit</button>
                  <button type="reset" class="btn btn-md btn-danger">Cancel</button>
              </div>
          </form>
      </div>


  @endsection
