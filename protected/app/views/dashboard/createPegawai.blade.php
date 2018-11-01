@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Pegawai SKPD</h2>
	<!-- FORM INPUT PEGAWAI -->
	<form action="" method="POST" role="form" data-toggle="validator">
		<legend>Tambah Pegawai</legend>
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">SKPD</label>
			<!-- Jika Masuk bukan sebagai Admin SKPD (root || administrator) -->
			@if(Auth::user()->level != 'adminskpd')
				<select id="getIdSkpd" class="form-control selectpicker" data-live-search="true" required>
					<option value="">------ Pilih SKPD ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
				<input type="hidden" name="skpd_id">
			@else
				<!-- Menampilkan 1 SKPD -->
				<input type="text" name="skpd" class="form-control" value="{{$Skpd->skpd}}" disabled="true">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			@endif
		</div>

		<!-- Input Pegawai -->
		<div class="form-group">
			<label for="">Nama Pegawai</label>
			<input type="text" name="pegawai" class="form-control" value="" required="required">
		</div>

		<!-- Input NIP -->
		<div class="form-group">
			<label for="">NIP</label>
			<input type="text" name="nip" class="form-control" value="" required="required">
		</div>
		<!-- Input Email dan Angka -->
		<div class="row">
			<div class="col-md-6">
				<!-- Input Email -->
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control" value="" required="required" data-error="Harus sesuai format email" >
					<div class="help-block with-errors"></div>
				</div>
			</div> <!-- End Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Email -->
				<div class="form-group">
					<label for="">Telepon</label>
					<input type="text" name="telepon" class="form-control" value="" data-error="Harus sesuai format angka" pattern="^[0-9]{1,}$">
					<div class="help-block with-errors"></div>
				</div>
			</div> <!-- End Col-md-6 -->
		</div>

		<div class="form-group">
			<label for="">Jabatan</label>
			<select id="selectJabatan" class="form-control" required name="kpa">
				<option value="1">KPA/PA/PPK</option>
				<option value="0">Operator</option>
			</select>
		</div>

		<div class="row" style="display:none" id="operatorJabatan">
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Username</label>
					<input type="text" name="username" class="form-control" value="" required="required">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="password" class="form-control" value="" required="required">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Level</label>
					<select class="form-control" name="level" required>
						<option value="">------- Pilih Jabatan ---------</option>
						@if(Auth::user()->level == 'root')
						<option value="root">Root</option>
						@endif
						@if(Auth::user()->level != 'adminskpd')
						<option value="administrator">Administrator</option>
						@endif
						<option value="adminskpd">Admin SKPD</option>
					</select>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection

