@extends('layout.dashboardLayout')

@section('content')
<div class="cover"></div>
<h2 class="menu__header">Pegawai SKPD</h2>
<a href="{{URL::to('emonevpanel/pegawai/create')}}" class="btn btn-primary" style="float:right;">Tambah Pegawai</a>

<h4 class="table-title">Tabel KPA/PA/PPK</h4>
<table id="table_id" class="table table-striped">
	<thead>
    <tr>
    	<th>No</th>
    	<th>SKPD</th>
      <th>Nama KPA/PA/PPK</th>
      <th>Email</th>
      <th>Telepon</th>
      <th>NIP</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($Kpa as $key=>$kpa)
  	<tr>
  		<td>{{$key+1}}</td>
  		<td>{{$kpa->skpd->skpd}}</td>
  		<td>{{$kpa->pegawai}}</td>
  		<td>{{$kpa->email}}</td>
  		<td>{{$kpa->telepon}}</td>
  		<td>{{$kpa->nip}}</td>
  		<td><select name="actionKpa" class="form-control actionKegiatan" data-id="{{$kpa->id}}" onchange="actionKpa(this)">
        <option value="">--Aksi--</option>
        <option value="edit">Edit</option>
        <option value="hapus">Hapus</option>
      </select></td>
  	</tr>
  	@endforeach
  </tbody>
</table>
@if(Auth::user()->level != 'adminskpd')
<h4 class="table-title" style="margin-top:50px;">Tabel Operator</h4>
<table id="table_user" class="table table-striped">
	<thead>
    <tr>
    	<th>No</th>
    	<th>SKPD</th>
      <th>Nama Operator</th>
      <th>Username</th>
      <th>Email</th>
      <th>Telepon</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($Operator as $key=>$operator)
  	<tr>
  		<td>{{$key+1}}</td>
  		<td>{{$operator->skpd->skpd}}</td>
  		<td>{{$operator->pegawai}}</td>
  		<td>{{$operator->user->username}}</td>
  		<td>{{$operator->email}}</td>
  		<td>{{$operator->telepon}}</td>
  		<td><select name="actionOperator" class="form-control actionKegiatan" data-id="{{$operator->id}}" onchange="actionOperator(this)" data-id-operator="{{$operator->user->id}}">
        <option value="">--Aksi--</option>
        <option value="edit">Edit</option>
        <option value="ganti-password">Ganti Password</option>
        <option value="hapus">Hapus</option>
      </select></td>
  	</tr>
  	@endforeach
  </tbody>
</table>
@endif
<div class="box-float-form">
  <i class="fa fa-times fa-2x icon__close"></i>
  <form action="{{URL::to('emonevpanel/pegawai/change-password')}}" method="POST" role="form">
    <legend>Ganti Password</legend>
    <input type="hidden" name="id_operator">
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" class="form-control" name="password" placeholder="New Password">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection

@section('script')
	<script type="text/javascript">
		$('#table_id').DataTable();
		$('#table_user').DataTable();
    function actionKpa(el) {
      var id = $(el).attr('data-id');
      var action = $(el).val();
      switch(action) {
        case "edit":
          window.location = baseUrl+"/pegawai/edit/"+id;
          break;
        case "hapus":
          c = confirm("apakah anda ingin menghapus akun ini??");
          if(c == true) {
            window.location = baseUrl+"/pegawai/hapus/"+id;
          }
          return false;
          break;
      }
    }
    function actionOperator(el) {
      var id = $(el).attr('data-id');
      var idOperator = $(el).attr('data-id-operator');
      var action = $(el).val();
      switch(action) {
        case "edit":
          window.location = baseUrl+"/pegawai/edit/"+id;
          break;
        case "ganti-password":
          $('.cover,.box-float-form').show();
          $("input[name='id_operator']").val(idOperator);
          break;
        case "hapus":
          c = confirm("apakah anda ingin menghapus akun ini??");
          if(c == true) {
            window.location = baseUrl+"/pegawai/hapus/"+id;
          }
          return false;
          break;
      }
    }
    $('.icon__close').click(function() {
       $('.cover,.box-float-form').hide();
    })
	</script>
@stop