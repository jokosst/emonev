@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Edit Daftar Paket</h2>
<!-- FORM EDIT DAFTAR PAKET -->
<legend>Edit Daftar Paket</legend>
<form action="{{URL::to('emonevpanel/daftar-paket/update')}}" method="POST" role="form" data-toggle="validator">
	<!-- Input SKPD -->
	<div class="form-group">
		<label for="">Perangkat Daerah</label>
		<input type="text" class="form-control" value="{{$paket->skpd->skpd}}" disabled="">
		<input type="hidden" name="skpd_id" value="{{$paket->skpd->id}}">
	</div>
	<!-- End Input SKPD -->
	<!-- Row -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Tahun -->
			<div class="form-group">
				<label for="">Tahun</label>
				<input type="text" class="form-control" value="{{$paket->tahun->tahun}}" disabled="">
				<input type="hidden" name="tahun_id" value="{{$paket->tahun->id}}">
			</div>
			<!-- End Input Tahun -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input KPA -->
			<div class="form-group">
				<label for="">PA/KPA/PPK</label>
				<select name="pegawai_id" class="form-control">
					@foreach($Kpa as $pegawai)
					<option value="{{$pegawai->id}}">{{$pegawai->pegawai}}</option>
					@endforeach
				</select>
			</div>
			<!-- End Input KPA -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- End Row -->
	<!-- Input Kegiatan (bisa ubah kegiatan, sehingga input select) -->
	<div class="form-group">
		<label for="">Kegiatan</label>
		<select name="kegiatan_id" class="form-control selectpicker" data-live-search="true" id="changeKegiatan">
			@foreach($Kegiatan as $kegiatan)
			<option value="{{$kegiatan->id}}" data-pagu="{{$kegiatan->pagu}}">{{$kegiatan->kegiatan}}</option>
			@endforeach
		</select>
		<input type="hidden" id="limit_anggaran" value="{{$paket->kegiatan->pagu}}">
	</div>
	<!-- End Input Kegiatan -->
	<!-- Input Paket -->
	<div class="form-group">
		<label for="">Paket</label>
		<input type="text" name="paket" class="form-control" required value="{{$paket->paket}}">
	</div>
	<!-- End Input Paket -->
	<!-- Row -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Pagu -->
			<div class="form-group">
				<label for="">Pagu Paket</label>
				<input type="text" name="pagu_paket" class="form-control setMoney" required value="{{ "Rp ".number_format($paket->nilai_pagu_paket,0,',','.'); }}">
				<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
			</div>
			<!-- End Input Pagu -->
		</div>
		<!-- End col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Kode Anggaran Paket -->
			<div class="form-group">
				<label for="">Kode Anggaran Paket</label>
				<input type="text" class="form-control" name="kode_anggaran_paket" required value="{{$paket->kode_anggaran_paket}}">
			</div>
			<!-- End Input Kode Anggaran Paket -->
		</div>
		<!-- End col-md-6 -->
	</div>
	<!-- End Row -->
	<!--Row -->
	<div class="row">
		<!-- col-md-4 -->
		<div class="col-md-4">
			<!-- Input Volume -->
			<div class="form-group">
				<label for="">Volume</label>
				<input type="text" name="volume" class="form-control" required value="{{$paket->volume}}">
			</div>
			<!-- End Input Volume -->
		</div>
		<!-- End col-md-4 -->
		<!-- Col-md-4 -->
		<div class="col-md-4">
			<!-- Input Satuan Volume -->
			<div class="form-group">
				<label for="">Satuan Volume</label>
				<input type="text" name="satuan_volume" class="form-control" required value="{{$paket->satuan_volume}}">
			</div>
			<!-- Input Satuan Volume -->
		</div>
		<!-- End col-md-4 -->
	</div>
	<!-- End Row -->
	<!-- Row -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Hasil Kegiatan -->
			<div class="form-group">
				<label for="">Hasil Kegiatan</label>
				<select name="hasil_kegiatan" class="form-control">
					<option value="konstruksi" @if($paket->hasil_kegiatan == 'konstruksi') selected @endif>Konstruksi</option>
					<option value="non-konstruksi" @if($paket->hasil_kegiatan == 'non-konstruksi') selected @endif>Non Konstruksi</option>
				</select>
			</div>
			<!-- End Input Hasil Kegiatan -->
		</div>
		<!-- End col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Kualifikasi Lelang -->
			<div class="form-group">
				<label for="">Kualifikasi Lelang</label>
				<select name="kualifikasi_lelang" class="form-control">
					<option value="kecil" @if($paket->kualifikasi_lelang == 'kecil') selected @endif>Kecil</option>
					<option value="non-kecil" @if($paket->kualifikasi_lelang == 'non-kecil') selected @endif>Non Kecil</option>
				</select>
			</div>
			<!-- End Input Kualifikasi Lelang -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- End Row -->
	<!-- Row -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Jenis Belanja Paket -->
			<label for="">Jenis Belanja Paket</label>
			<select name="jenis_belanja_paket" class="form-control">
				<option value="barang-jasa" @if($paket->jenis_belanja_paket == 'barang-jasa') selected @endif>Belanja Barang / Jasa</option>
				<option value="modal" @if($paket->jenis_belanja_paket == 'modal') selected @endif>Belanja Modal</option>
			</select>
			<!-- End Input Jenis Belanja Paket -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Metode -->
			<div class="form-group">
				<label for="">Metode</label>
				<select name="metode" class="form-control">
					<option @if($paket->metode == 'lelang-sederhana') selected @endif value="lelang-sederhana">Lelang Sederhana</option>
					<option @if($paket->metode == 'lelang-terbatas') selected @endif value="lelang-terbatas">Lelang Terbatas</option>
					<option @if($paket->metode == 'lelang-umum') selected @endif value="lelang-umum">Lelang Umum</option>
					<option @if($paket->metode == 'pemilihan-langsung') selected @endif value="pemilihan-langsung">Pemilihan Langsung</option>
					<option @if($paket->metode == 'pengadaan-langsung') selected @endif value="pengadaan-langsung">Pengadaan Langsung</option>
					<option @if($paket->metode == 'penunjukan-langsung') selected @endif value="penunjukan-langsung">Penunjukan Langsung</option>
					<option @if($paket->metode == 'sayembara') selected @endif value="sayembara">Sayembara</option>
					<option @if($paket->metode == 'seleksi-sederhana') selected @endif value="seleksi-sederhana">Seleksi Sederhana</option>
					<option @if($paket->metode == 'seleksi-umum') selected @endif value="seleksi-umum">Seleksi Umum</option>
					<option @if($paket->metode == 'swakelola-program') selected @endif value="swakelola-program">Swakelola Program</option>
					<option @if($paket->metode == 'swakelola-rutin') selected @endif value="swakelola-rutin">Swakelola Rutin</option>
					<option @if($paket->metode == 'e-purchasing') selected @endif value="e-purchasing">E-Purchasing</option>
				</select>
			</div>
			<!-- End Input Metode -->
		</div>
		<!-- End Col-md-6 -->
		<div class="col-md-4">
			<!-- Input Jenis Belanja Paket -->
			<div class="form-group">
				<label for="">pemilihan penyedia</label>
				<select name="pemilihan_penyedia" class="form-control">
					<option value="seleksi" @if($paket->pemilihan_penyedia == 'seleksi') selected @endif>Seleksi</option>
					<option value="tender" @if($paket->pemilihan_penyedia == 'tender') selected @endif>Tender</option>
					<option value="tender-cepat" @if($paket->pemilihan_penyedia == 'tender-cepat) selected @endif>Tender Cepat</option>
				</select>
			</div>
			<!-- End Input Jenis Belanja Paket -->
		</div>
	</div>
	<!-- End Row -->
	<!-- Row -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Jenis Pengadaan -->
			<div class="form-group">
				<label for="">Jenis Pengadaan</label>
				<select name="jenis_pengadaan" class="form-control">
					<option @if($paket->jenis_pengadaan == 'barang') selected @endif value="barang">Barang</option>
					<option @if($paket->jenis_pengadaan == 'konstruksi') selected @endif value="konstruksi">Konstruksi</option>
					<option @if($paket->jenis_pengadaan == 'konsultan-supervisi') selected @endif value="konsultan-supervisi">Konsultan / Supervisi</option>
					<option @if($paket->jenis_pengadaan == 'lainnya') selected @endif value="lainnya">Jasa Lainnya</option>
				</select>
			</div>
			<!-- End Input Jenis Pengadaan -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Lokasi -->
			<div class="form-group">
				<label for="">Lokasi</label>
				<select name="lokasi_id" class="form-control">
					@foreach($Lokasi as $lokasi)
						<option @if($lokasi->id == $paket->lokasi_id) selected @endif value="{{$lokasi->id}}">{{$lokasi->lokasi}}</option>
					@endforeach
				</select>
			</div>
			<!-- End Input Lokasi -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- End Row -->
	<!-- Input Hidden -->
	<input type="hidden" name="id" value="{{$paket->id}}">
	<!-- End Input Hidden -->
	<button type="submit" class="btn btn-primary btn-lg">Update</button>
</form>
<!-- END FORM EDIT DAFTAR PAKET -->

@endsection

@section('script')

<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$("select[name='kegiatan_id']").val({{$paket->kegiatan_id}});
	$('.selectpicker').selectpicker('refresh');

	$('#changeKegiatan').change(function() {
		pagu = $(this).find(':selected').data('pagu');
		$("#limit_anggaran").val(pagu);
	});

	$("input[name='pagu_paket']").on("keyup", function() {
		var limit = $('#limit_anggaran').val();
		var input = Number($(this).val().replace(/[Rp.]+/g,""));
		if(input > limit) {
			$(".validation-text").fadeIn("fast");
		} else {
			$(".validation-text").fadeOut("fast");
		}
	});

</script>

@stop