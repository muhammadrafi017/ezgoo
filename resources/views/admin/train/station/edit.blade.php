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
            <form action="{{ url('admin/station', $datas->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }};
                <div class="form-group">
                    <label for="nama">Station Name</label>
                    <input type="text" class="form-control" id="staion_name" name="station_name" value="{{ $datas->station_name }}">
                </div>
                <div class="form-group">
                    <label for="nama">Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $datas->code }}">
                </div>
                <div class="form-group">
                    <label for="nama">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $datas->city }}">
                </div>
                <div class="form=group">
                    <button type="submit" class="btn btn-md btn-primary">Save</button>
                    <button type="cancel" class="btn btn-md btn-danger">Cancel</button>
                </div>
            </form>
            @endforeach
        </div>
@endsection
