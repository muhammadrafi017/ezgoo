<link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css" />
<div class="title">
  <h2> Report Users Registered</h2>
</div>
<table class="col-md-4">
</table>
  <table class="col-md-8 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <tr>
          <th>No.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Registered at</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $v)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$v->first_name}}</td>
          <td>{{$v->last_name}}</td>
          <td>{{$v->email}}</td>
          <td>{{$v->phone}}</td>
          <td>{{ date('l, d-M-y' ,strtotime($v->created_at))  }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
