<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datepicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/images') }}">
</head>
<body>
  <div id="app" >
    <nav class="navbar navbar-inverse navbar-fixed-top" >
      <div class="navbar-header page-scroll">
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{url('')}}">
            {{ config('app.name') }}
        </a>
      </div>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            &nbsp;
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('user/booking/'.Auth::user()->id) }}">Pemesanan</a></li>
                <li><a href="{{ url('user/edit/'.Auth::user()->id.'/profile')}}">Ubah profile</a></li>
                <li><a href="{{ url('user/edit/'.Auth::user()->id.'/password')}}">Ubah password</a></li>
                <li>
                  <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      Keluar
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </nav>
      @yield('content')
  </div>
  <footer class="footer-bs">
    <div class="row">
      <div class="col-md-3 footer-brand animated fadeInLeft">
        <h2>{{config('app.name')}}</h2>
        <p>{{config('app.name')}} Booking Ticket pesawat dan kereta mudah dan aman</p>
        <p>© 2018 {{config('app.name')}}, All rights reserved</p>
      </div>
      <div class="col-md-4 footer-nav animated fadeInUp">
        <h4>Menu </h4>
        <div class="col-md-6">
          <ul class="pages">
            <li><a href="#">Travel</a></li>
            <li><a href="#">Pesawat</a></li>
            <li><a href="#">Kereta</a></li>
            <li><a href="#">Cek Pemesanan</a></li>
            <li><a href="#">Payment</a></li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="list">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contacts</a></li>
            <li><a href="#">Terms & Condition</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2 footer-social animated fadeInDown">
        <h4>Follow Us</h4>
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">RSS</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-ns animated fadeInRight">
        <h4>Newsletter</h4>
        <p>Subscribe to our newsletter now and be the first to know about {{config('app.name')}}'s latest promos!</p>
        <p>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter Your Email Here...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
            </span>
          </div>
        </p>
      </div>
    </div>
  </footer>
<section style="text-align:center; margin:10px auto;"><p>Copyright <a href="#">{{config('app.name')}} 2018</a></p></section>

    <!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('vendor/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '+1d',
    autoclose:true
  });
</script>
@stack('scripts')

</body>
</html>
