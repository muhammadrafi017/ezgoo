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
<!-- content -->
<div class="card" style="width: 20rem;">
  <div class="card-block">
    <h4 class="card-title">	{{$booking->type}}</h4>
    <p class="card-text">	{{$booking->booking_date}}</p>
  </div>
 @foreach($detail as $data)
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{$data->class}}</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
  @endforeach


  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{$pass->name}}</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>

</div>


  </div>
</div>
