@extends('layouts.app')

@section('content')
  <a href="{{ url('test/export/pdf') }}" target="_blank">export pdf</a>
  <a href="{{ url('test/export/xls') }}">export excel</a>
  <form action="{{ url('test/import') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="import_file">
    <button type="submit" name="button" class="btn btn-primary">import</button>
  </form>
@endsection
