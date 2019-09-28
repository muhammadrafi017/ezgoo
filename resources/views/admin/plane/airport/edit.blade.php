@extends('admin.layouts.app');

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Data Bandara</li>
      </ol>
    </div><br><!--/.row-->

<body>

  <div class="row">
    <div class="col-md-12">
            <h1>Data Bandara</h1>
            <div class="panel panel-default">
              <div class="panel-body">
            <hr>
            @foreach($data as $datas)
            <form action="{{ url('admin/airport', $datas->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put')}}
                <div class="form-group">
                    <label for="nama">Nama Pesawat :</label>
                    <input type="text" class="form-control" id="airport_name" name="airport_name" value="{{ $datas->airport_name }}" required>
                </div>
                <div class="form-group">
                    <label for="code">Kode :</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $datas->code }}" required>
                </div>
                <div class="form-group">
                    <label for="city">Kota :</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $datas->city }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                </div>
            </form>
            @endforeach
        </div>









@endsection
