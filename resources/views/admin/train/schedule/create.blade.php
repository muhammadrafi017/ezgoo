@extends('admin.layouts.app')


@section('content')
  @push('scripts')
    <script type="text/javascript">
    $('select[name="train_id"]').on('change', function() {
      var param = $(this).val();
      if(param) {
        $.ajax({
          url: '/train/ajax/'+param,
          type: "GET",
          dataType: 'JSON',
          success:function(data) {
            console.log(data);
              $.each(data, function(index, obj) {
                $('.option').empty();
                $('#eco_seat').val(obj.eco_seat);
                $('#bus_seat').val(obj.bus_seat);
                $('#exec_seat').val(obj.exec_seat);
              });
            }
          });
        }else{
          $('select[name="eco"]').empty();
        }
    });
    $('select[name="station_id"]').on('change', function() {
      param = $(this).val();
      $.ajax({
        url: '/station/ajax/'+param,
        type: "GET",
        dataType: 'JSON',
        success:function(data) {
          console.log(data);
          $.each(data, function(index, obj) {
            $('.from').empty();
            $('#asal').append('<input type="hidden" name="from" value="'+ obj.station_name +'">');
            $('#code').append('<input type="text" name="from_code" value="'+ obj.code +'">'+ obj.code +'</input>');
          });
        }
      });
    });
    $('select[name="Tdestination"]').on('change', function() {
      param = $(this).val();
      $.ajax({
        url: '/station/ajax/'+param,
        type: "GET",
        dataType: 'JSON',
        success:function(data) {
          console.log(data);
          $.each(data, function(index, obj) {
            $('.Tdestination').empty();
            $('#codes').append('<input type="text" name="destination_code" value="'+ obj.code +'">'+ obj.code +'</input>');
          });
        }
      });
    });
    </script>
  @endpush

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">
              <em class="fa fa-home"></em>
              </a></li>
          <li class="active">Kereta Api</li>
      </ol>
    </div><br><!--/.row-->

<body>
  <div class="row">
    <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
            <hr>
            <form action="{{ url('admin/train/schedule/store') }}" method="post">
                {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="code">Asal :</label>
                    <select class="select2" name="station_id" required>
                      <option value="0">--Select Plane--</option>
                      @foreach($station as $key)
                        <option value="{{ $key->id }}">{{ $key->station_name }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" class="form-control asal" id="asal">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="code">Tujuan :</label>
                    <select class="select2" name="Tdestination" required>
                      <option value="0">--Select Plane--</option>
                      @foreach($station as $key)
                        <option value="{{ $key->id }}">{{ $key->station_name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" class="form-control from" id="code">
                  <input type="hidden" class="form-control destination" id="codes">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="code">Nama Kereta Api :</label>
                    <select class="form-control" name="train_id">
                      <option value="0">--Select Plane--</option>
                      @foreach($train as $key)
                        <option value="{{ $key->id }}">{{ $key->train_name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="code">Eco Seat:</label>
                    <input type="text" class="form-control option" id="eco_seat" name="eco_seat" readonly>
                </div>
              </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="code">Bussiness Seat:</label>
                      <input type="text" class="form-control option" id="bus_seat" name="bus_seat" readonly>
                  </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">Executive Seat:</label>
                        <input type="text" class="form-control option" id="exec_seat" name="exec_seat" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">Boarding Time:</label>
                        <div class='input-group date'>
                        <input type="text" name="boarding_time" class="form-control datetimepicker" required>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">Duration :</label>
                        <input type="time" name="duration" class="form-control" placeholder="dd/mm/yy" required>
                    </div>
                  </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="code">platform :</label>
                          <input type="text" name="platform" class="form-control" placeholder="Ex : G27" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                </div>
            </form>
        </div>







@endsection
