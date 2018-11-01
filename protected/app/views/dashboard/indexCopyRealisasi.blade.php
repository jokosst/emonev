@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Copy Realisasi</h2>
	<p style="background:#f1f1f1; padding:10px; margin-bottom:15px;"><b>Perhatian :</b> <br>
	Halaman ini ditujukan untuk melakukan penggandaan realisasi kegiatan skpd setiap bulan untuk bulan berikutnya</p>
	<form action="" method="POST" role="form">
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">SKPD</label>
			<!-- Jika Masuk bukan sebagai Admin SKPD (root || supeadmin) -->
			@if(Auth::user()->level != 'adminskpd')
				<select name="skpd_id" id="selectSkpdGetProgramAndKpaOption" class="form-control selectpicker" data-live-search="true" required>
					<option value="">------ Pilih SKPD ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
			@else
				<!-- Menampilkan 1 SKPD -->
				<input type="text" name="skpd" class="form-control" value="{{$Skpd->skpd}}" disabled="true">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			@endif
		</div> <!-- End Input SKPD -->
		<div class="row">
			<div class="col-md-6">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<select name="tahun_id" class="form-control">
						@foreach($Tahun as $tahun)
						<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
				  </select>
				</div> <!-- End Input Tahun -->
			</div>
			<div class="col-md-6">
				<!-- Input Bulan -->
				<div class="form-group">
					<label for="">Bulan</label>
					<select name="bulan" class="form-control" required="required">
						<option value="">-- Pilih Bulan ----</option>
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
					</select>
				</div> <!-- End Input Bulan -->
			</div>
		</div>


		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection