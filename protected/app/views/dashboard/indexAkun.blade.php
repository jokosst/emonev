@extends('layout.dashboardLayout')

@section('content')
	<div class="cover"></div>
	<h2 class="menu__header">Detail Akun</h2>
	<div class="box-detailAkun">
		<h4>{{$akun->pegawai->pegawai}}</h4>
		<p><b>Username</b> : {{$akun->username}}</p>
		<p><b>Email</b> : {{$akun->pegawai->email}}</p>
		<p><b>Telepon</b> :{{$akun->pegawai->telepon}}</p>
	</div>
	<button class="btn btn-danger" id="passwordAkun">Ganti Password</button>
	<button class="btn btn-warning" id="editAkun">Edit Akun</button>

	<form action="{{URL::to('emonevpanel/pegawai/update')}}" method="POST" id="formEditAkun" data-toggle="validator" style="width:500px; margin-top:20px;display:none;">
		<i class="fa fa-times fa-2x icon__close"></i>
		<div class="form-group">
			<label for="">Nama</label>
			<input type="text" class="form-control" name="pegawai" value="{{$akun->pegawai->pegawai}}">
		</div>
		<div class="form-group">
			<label for="">NIP</label>
			<input type="text" class="form-control" name="nip" value="{{$akun->pegawai->nip}}">
		</div>
		<div class="form-group">
			<label for="">Email</label>
			<input type="email" class="form-control" name="email" data-error="Harus sesuai format email" value="{{$akun->pegawai->email}}">
			<div class="help-block with-errors"></div>
		</div>
		<div class="form-group">
			<label for="">Telepon</label>
			<input type="text" class="form-control" name="telepon" pattern="^[0-9]{1,}$" data-error="Harus sesuai format angka" value="{{$akun->pegawai->telepon}}">
			<div class="help-block with-errors"></div>
		</div>
		<input type="hidden" name="id" value="{{$akun->pegawai->id}}">
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

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
		$('#passwordAkun').click(function() {
			$('.cover,.box-float-form').show();
      $("input[name='id_operator']").val({{Auth::user()->id}});
		});
		$("#editAkun").click(function() {
			$('#formEditAkun').show(300);
		});
		$(".icon__close").click(function() {
			$('.cover,.box-float-form,#formEditAkun').hide();
		});

	</script>
@endsection