@extends('admin.layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div><br><!--/.row-->

<body>
      <div class="panel panel-default">
        <div class="panel-body">
      @if(Session::has('alert-success'))
          <div class="alert alert-success">
              <strong>{{ Session::get('alert-success') }}</strong>
          </div>
      @endif
          <hr>
          <table class="table table-striped table-bordered data">
            <thead>
            <tr>
                <th>NO.</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No handphone</th>
                <!-- <th>Aksi</th> -->
            </tr>
            </thead>
            <tbody>
            @foreach($users as $data)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->phone }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <a href="pdfUsers"><button class="btn btn-info" type="submit" name="button">Export PDF</button></a>
        </div>
      </div>

@endsection
