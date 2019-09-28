@extends('admin.layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Data Kereta</li>
      </ol>
    </div><br><!--/.row-->

<body>
    <div class="row">
      <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
              @if(Session::has('alert-success'))
                  <div class="alert alert-success">
                      <strong>{{ Session::get('alert-success') }}</strong>
                  </div>
              @endif
              <a href="{{ url('admin/train/create') }}" class="fa fa-plus-circle fa-2x"></a></a><h3 align="center">DAFTAR KERETA API</h3>
            <hr>
            <table class="table table-striped table-bordered data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kereta</th>
                <th>Ekonomi</th>
                <th>Bisnis</th>
                <th>First Class</th>
                <th>/ Ekonomi</th>
                <th>/ Bisnis</th>
                <th>/ Eksekutif</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($train as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->train_name }}</td>
                <td>{{ $data->eco_seat }}</td>
                <td>{{ $data->bus_seat }}</td>
                <td>{{ $data->exec_seat }}</td>
                <td>IDR {{ number_format($data->trainfare['eco_seat']) }}</td>
                <td>IDR {{ number_format($data->trainfare['bus_seat']) }}</td>
                <td>IDR {{ number_format($data->trainfare['exec_seat']) }}</td>
                <td>
                  <form action="{{ url('admin/train', $data->id) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                      <a href="{{ url('admin/train/'.$data->id.'/edit') }}" class=" btn btn-sm btn-primary">Update</a>
                      <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



@endsection
