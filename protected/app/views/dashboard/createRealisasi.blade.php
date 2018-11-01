@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Realisasi Kegiatan SKPD</h2>
	<!-- FORM REALISASI KEGIATAN -->
	<form action="" method="POST" role="form" data-toggle="validator">
		<legend>Tambah Realisasi</legend>
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
		</div> <!-- End Input SKPD -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<select name="tahun_id" class="form-control" id="selectTahunGetKegiatan">
						<option value="">------ Pilih Tahun ----------</option>
						@foreach($Tahun as $tahun)
						<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
				  </select>
				  <input type="hidden" id="tahunId">
				</div>
				<!-- End Input Tahun -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
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
						<option value="12">Desember</option>
					</select>
				</div>
				<!-- End Input Bulan -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<!-- Input Kegiatan -->
		<div class="form-group">
			<label for="">Kegiatan</label> <i class="fa fa-circle-o-notch fa-spin icon-loading" style="display:none"></i>
			<select name="kegiatan_id" id="selectKegiatanGetPaket" class="form-control selectpicker" data-live-search="true">
				<!-- Data tarik data pake json -->
			</select>
		</div>
		<!-- End Input Kegiatan -->
		<!-- Input Paket -->
		<div class="form-group">
			<label for="">Paket</label>
			<select name="paket_id" id="selectKegiatanGetPaket" class="form-control selectpicker" data-live-search="true"></select>
		</div>
		<!-- End Input Paket -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Realisasi Fisik -->
				<div class="form-group">
					<label for="">Realisasi Fisik</label>
					<input type="text" name="fisik" class="form-control" required="required" placeholder="%">
				</div>
				<!-- End Input Realisasi Fisik -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Realisasi Keuangan -->
				<div class="form-group">
					<label for="">Realisasi Keuangan</label>
					<input type="text" name="pengeluaran" class="form-control setMoney" required="required" placeholder="Rp">
				</div>
				<!-- End Input Realisasi Keuangan -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<button type="submit" class="btn btn-primary btn-lg" style="margin-top:25px;">Submit</button>
	</form>
@endsection

@section('script')
<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
</script>
@stop