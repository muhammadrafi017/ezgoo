<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} | Admin </title>

        <!-- Fonts -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/datepicker/datepicker3.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>EZ</span>Goo</a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <!-- profile -->
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">{{Auth::user()->name}}</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
    <!-- profile -->
    <!-- menu -->
        <div class="divider"></div>
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </form>
        <ul class="nav menu">
            <li><a href="{{ url('admin')}}"><em class="fa fa-home"></em> Dashboard</a></li>
            <li><a href="{{ URL('admin/users') }}"><em class="fa fa-users"></em> Users</a></li>
            <li><a href="{{ URL('admin/booking') }}"><em class="fa fa-list"></em> Booking Data </a></li>

            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-plane">&nbsp;</em> Pesawat <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li>
                        <a class="" href="{{ url('admin/airport') }}"><span class="fa fa-arrow-right"></span> Bandara</a>
                    </li>
                    <li>
                        <a class="" href="{{ url('admin/plane') }}"><span class="fa fa-arrow-right"></span> Daftar Pesawat</a>
                    </li>
                    <li>
                        <a class="" href="{{ url('admin/plane/schedule/index') }}"><span class="fa fa-arrow-right"></span> Jadwal Penerbangan </a>
                    </li>
                </ul>
            </li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-train">&nbsp;</em> Kereta Api <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">
                    <li>
                        <a class="" href="{{ url('admin/station') }}"><span class="fa fa-arrow-right">&nbsp;</span> Stasiun</a>
                    </li>
                    <li>
                        <a class="" href="{{ url('admin/train')}}"><span class="fa fa-arrow-right">&nbsp;</span> Daftar Kereta</a>
                    </li>
                    <li>
                        <a class="" href="{{ url('admin/train/schedule/index')}}"><span class="fa fa-arrow-right">&nbsp;</span> Jadwal Keberangkatan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             <span class="fa fa-power-off"></span>
                    Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
        </ul>
    </div>
    @yield('content')

<script type="text/javascript" src="{{ asset('js/jquery-1.12.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datepicker/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.data').DataTable();
  $('.datetimepicker').datetimepicker({
    format:'YYYY-MM-DD HH:mm:ss',
  });
  $('.timepicker').datetimepicker({
    format:'HH:mm',
  });
  $.fn.select2.defaults.set( "theme", "bootstrap" );
  $.fn.select2.defaults.set("width", null);
  $('.select2').select2();
  $('.select2').change(function(){
    $('.select2').find('option').prop('disabled', false);
    $('.select2').each(function(){
      var current = $(this);
      // console.log(current);
      $('.select2').not(current).find('option').each(function(){
        if($(this).val() == current.val()){
          $(this).prop('disabled', true);
        }
      });
    });
    $('.select2').select2();
  });
});
</script>
@stack('scripts')
</script>
</body>
</html>
