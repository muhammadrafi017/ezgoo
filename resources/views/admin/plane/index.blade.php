@extends('admin.layouts.app')

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
            <h1>Data Pesawat</h1>
            <div class="panel panel-default">
              <div class="panel-body">
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <strong>{{ Session::get('alert-success') }}</strong>
                </div>
            @endif
            <a href="{{ url('admin/plane/create')}}" class="fa fa-plus-circle fa-2x"></a><h3 align="center">DAFTAR PESAWAT</h3>
            <hr>
            <table class="table table-striped table-bordered data">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pesawat</th>
                    <th>Ekonomi</th>
                    <th>Bisnis</th>
                    <th>First Class</th>
                    <th>/ Ekonomi</th>
                    <th>/ Bisnis</th>
                    <th>/ First Class</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plane as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->plane_name }}</td>
                        <td>{{ $data->eco_seat }}</td>
                        <td>{{ $data->bus_seat }}</td>
                        <td>{{ $data->first_seat }}</td>
                        <td>IDR {{ number_format($data->planefare['eco_seat'])}}</td>
                        <td>IDR {{ number_format($data->planefare['bus_seat']) }}</td>
                        <td>IDR {{ number_format($data->planefare['first_seat'])}}</td>
                        <td>
                            <form action="{{ url('admin/plane', $data->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a href="{{ url('admin/plane/'.$data->id.'/edit') }}" class=" btn btn-sm btn-primary">Update</a>
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endsection
