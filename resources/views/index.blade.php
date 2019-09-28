@extends('layouts.app')

@section('content')
  @push('scripts')
    <script type="text/javascript">
      $(document).ready(function(){
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
        $('.dateB').hide();
        $('.type').change(function(){
          if ($(this).val() == 'rt') {
            $('.dateB').show();
          }else{
            $('.dateB').hide();
          }
        });
      });
    </script>
  @endpush
<!--slider-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/banner2.jpg" alt="...">
      <div class="carousel-caption">
       <h1>EZGOO Memberikan Kemudahan dalam memilih Tiket Perjalanan anda</h1>
      </div>
    </div>
    <div class="item">
      <img src="images/banner3.jpg" alt="...">
      <div class="carousel-caption">
       <h1>EZGOO Memberikan Harga yang relatif murah dan tersedia berbagai macam pilihan tiket</h1>
      </div>
    </div>

    <div class="item">
      <img src="images/pesawat.jpg" alt="...">
      <div class="carousel-caption">
        <h1>EZGOO Memberikan pilihan Maskapai dan Kereta Terbaik untuk Perjalanan Anda</h1>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- tab -->
  <div class="container">
    <div class="row">
      <div role="tabpanel">
          <div class="panel-body">
            <ul class="nav nav-tabs">
              <li class="active"> <a href="#pesawat" data-toggle="tab">Pesawat</a></li>
              <li> <a href="#kereta" data-toggle="tab">Kereta</a></li>
            </ul>
            @if (Session::has('error'))
              <div class="alert alert-danger">
                <p>{{Session::get('error')}}</p>
              </div>
            @endif
            <div class="tab-content">
              <div class="tab-pane active" id="pesawat">
                <form action="{{ url('booking/search') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="vehicle" value="plane">
                  <div class="col-md-4">
                    <label>Kota Asal</label>
                      <select class="select2 item_id" id="select2" name="from_code" >
                        <option value="">Pilih</option>
                        @foreach ($airport as $a)
                          <option value="{{$a->code}}">{{"$a->city - $a->airport_name ($a->code)"}}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="col-md-4">
                    <label>Tujuan</label>
                      <select class="select2 item_id" id="select2" name="destination_code" >
                        <option value="">Pilih</option>
                        @foreach ($airport as $a)
                          <option value="{{$a->code}}">{{"$a->city - $a->airport_name ($a->code)"}}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="col-md-4">
                    <label for="kelas penerbangan">Kelas Penerbangan</label>
                      <select class="form-control" name="class" >
                          <option value="Ekonomi">Ekonomi</option>
                          <option value="Bisnis">Bisnis</option>
                          <option value="First Class">First Class</option>
                      </select>
                  </div>

                  <div class="col-md-4">
                    <label for="Perjalanan">Perjalanan</label>
                      <select class='form-control type' name="type" >
                          <option value="st">Sekali Jalan</option>
                          <option value="rt">Pulang Pergi</option>
                      </select>
                  </div>

                  <div class="col-md-2">
                    <label for="dewasa">Dewasa</label>
                      <select class="form-control"  name="adult" >
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  </div>

                  <div class="col-md-2">
                    <label for="anak">Anak-Anak</label>
                      <select class="form-control"  id="child" name="child" >
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  </div>

                  <div class="col-md-2">
                    <label for="bayi">Bayi</label>
                      <select class="form-control"  id="baby" name="baby" >
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  </div>

                  <div class="col-md-4">
                    <label for="berangkat">Tanggal Berangkat</label>
                    <input type="text" class="form-control datepicker" name='date' placeholder="30/01/2018" >
                  </div>

                  <div class="col-md-4 dateB">
                    <label for="pulang">Tanggal Pulang</label>
                    <input type="text" class="form-control datepicker" name='dateB' placeholder="30/01/2018">
                  </div>

                  <div class="col-md-4"><br>
                    <button type="submit" class="btn btn-primary">Cari Tiket Pesawat</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="kereta">
                <form action="{{ url('booking/search') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="vehicle" value="train">
                  <div class="col-md-4">
                    <label for="from">Kota Asal</label>
                      <select class='select2' id="select2" name="from_code" >
                        <option value="">Pilih</option>
                        @foreach ($train_station as $ts)
                          <option value="{{$ts->code}}">{{"$ts->city - $ts->station_name ($ts->code)"}}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="col-md-4">
                    <label for="kotatujuan">Kota Tujuan</label>
                      <select class="select2" id="select2" name="destination_code" >
                        <option value="">Pilih</option>
                        @foreach ($train_station as $ts)
                          <option value="{{$ts->code}}">{{$ts->city}} - {{$ts->station_name}} ({{$ts->code}})</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="col-md-4">
                      <label for="kelas kereta">Kelas Kereta</label>
                        <select class="form-control" name="class">
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Bisnis">Bisnis</option>
                            <option value="Eksekutif">Eksekutif</option>
                          </select>
                  </div>

                  <div class="col-md-4">
                    <label for="Perjalanan">Perjalanan</label>
                        <select class='form-control type' name="type" >
                            <option value="st">Sekali Jalan</option>
                            <option value="rt">Pulang Pergi</option>
                          </select>
                  </div>


                  <div class="col-md-4">
                      <label for="berangkat">Tanggal Berangkat</label>
                      <input type="text" class="form-control datepicker" placeholder="30/01/2018" name='date' >
                  </div>

                  <div class="col-md-4 dateB">
                      <label for="pulang">Tanggal Pulang</label>
                      <input type="text" class="form-control datepicker" placeholder="30/01/2018" name='dateB'>
                  </div>

                  <div class="col-md-2">
                    <label for="dewasa">Dewasa</label>
                      <select class="form-control"  name="adult" >
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  </div>

                  <div class="col-md-2">
                    <label for="anak">Anak-Anak</label>
                      <select class="form-control"  id="child" name="child" >
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  </div>

                  <div class="col-md-4"><br>
                      <button type="submit" class="btn btn-primary">Cari Tiket Kereta</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

<hr class="half-rule">
 <!-- Services -->
<section id="services">
  <div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Why Booking with EzGo?</h2>
        </div>
    </div>

    <div class="row text-center">
      <div class="col-md-4">
          <img src="images/bayar.png" alt="">
          <h4 class="service-heading">Berbagai Pilihan Pembayaran</h4>
          <p class="text-muted">Lebih fleksibel dengan berbagai metode pembayaran dari ATM Transfer, Credit Card, hingga Internet Banking.</p>
      </div>

      <div class="col-md-4">
          <img src="images/search.png" alt="">
          <h4 class="service-heading">Hasil Pencarian paling Ekstensif</h4>
          <p class="text-muted">Dengan pencarian satu klik, temukan tiket Pesawat dan Kereta ke 100.000 rute di seluruh Asia Pasifik dan Eropa untuk penerbangan.</p>
      </div>

      <div class="col-md-4">
          <img src="images/pay.png" alt="">
          <h4 class="service-heading">Transaksi Aman Dijamin</h4>
          <p class="text-muted">Keamanan dan privasi transaksi online Anda dilindungi, anda akan Menerima konfirmasi instan dan e-ticket langsung di email anda.</p>
      </div>

    </div>
  </div>
</section>
<hr class="half-rule">

     <!-- Partners -->
<section id="partners">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading text-uppercase" id="test">Our Partners</h2>
        <img src="images/maskapai2.png" alt="">
      </div>
    </div>
  </div>

<hr class="half-rule">
</section>

 <!-- Contact -->
 <section id="contact">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Contact Us</h2>
              </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *"  data-validation--message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *"  data-validation--message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *"  data-validation--message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *"  data-validation--message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <hr class="half-rule">
@endsection
