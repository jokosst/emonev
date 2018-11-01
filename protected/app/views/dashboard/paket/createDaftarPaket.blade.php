@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Daftar Paket Perangkat Daerah</h2>
<!-- FORM ADD DAFTAR PAKET -->
<form action="" method="POST" role="form" data-toggle="validator">
	<legend>Tambah Daftar Paket</legend>
	<!-- Input SKPD -->
	<div class="form-group">
		<label for="">Perangkat Daerah</label>
		<!-- Jika Masuk bukan sebagai Admin SKPD (root || supeadmin) -->
		@if(Auth::user()->level != 'adminskpd')
			<select id="getIdSkpdAndKpa" class="form-control selectpicker" data-live-search="true" required>
				<option value="">------ Pilih Perangkat Daerah ----------</option>
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
	<!-- End Input SKPD -->
	<!-- ROW -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Tahun -->
			<div class="form-group">
				<label for="">Tahun</label>
				<select name="tahun_id" class="form-control">
					@foreach($Tahun as $tahun)
					<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
					@endforeach
			  </select>
			</div>
			<!-- End Input Tahun -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input KPA -->
			<div class="form-group">
				<label for="">PA/KPA/PPK</label>
				<select name="pegawai_id" class="selectpicker form-control" data-live-search="true">
					<!-- Jika selain adminskpd tarik data pake json -->
					@if(Auth::user()->level == 'adminskpd')
						@foreach($Pegawai as $pegawai)
							<option value="{{$pegawai->id}}">{{$pegawai->pegawai}}</option>
						@endforeach
					@endif
			  </select>
			</div>
			<!-- End Input KPA -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- END ROW -->
	<!-- Input Kegiatan -->
	<div class="form-group">
		<label for="">Kegiatan</label> <i class="fa fa-circle-o-notch fa-spin icon-loading" style="display:none"></i>
		<select name="kegiatan_id" class="form-control selectpicker" data-live-search="true" id="changeKegiatan">
			<option value="">----- Pilih Kegiatan -----</option>
		@foreach($Kegiatan as $kegiatan)
			<option value="{{$kegiatan->id}}" data-pagu="{{$kegiatan->pagu}}">{{$kegiatan->kegiatan}}</option>
		@endforeach
		</select>
		<input type="hidden" id="limit_anggaran">
	</div>
	<!-- End Input Kegiatan -->
	<!-- Input Paket -->
	<div class="form-group">
		<label for="">Paket</label>
		<input type="text" name="paket" class="form-control" required placeholder="Nama Paket">
	</div>
	<!-- End Input Paket -->
	<!-- ROW -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Pagu -->
			<div class="form-group">
				<label for="">Pagu Paket</label>
				<input type="text" class="form-control setMoney" name="pagu_paket"  placeholder="Rp" required>
				<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
			</div>
			<!-- END Input Pagu  -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Kode Anggaran  -->
			<div class="form-group">
				<label for="">Kode Anggaran Paket</label>
				<input type="text" class="form-control" name="kode_anggaran_paket"  placeholder="Kode Anggaran Paket" required>
			</div>
			<!-- END Input Kode Anggaran  -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- End ROW -->
	<!-- ROW -->
	<div class="row">
		<!-- Col-md-4 -->
		<div class="col-md-4">
			<!-- Input Volume -->
			<div class="form-group">
				<label for="">Volume</label>
				<input type="text" name="volume" class="form-control"  placeholder="Volume" required>
			</div>
			<!-- END Input Volume  -->
		</div>
		<!-- End Col-md-4 -->
		<!-- Col-md-4 -->
		<div class="col-md-4">
			<!-- Input Satuan Volume -->
			<div class="form-group">
				<label for="">Satuan Volume</label>
				<input type="text" name="satuan_volume" class="form-control"  placeholder="Satuan Volume" required>
			</div>
			<!-- END Input Satuan Volume  -->
		</div>
		<!-- End Col-md-4 -->
	</div>
	<!-- End ROW -->
	<!-- ROW -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Hasil Kegiatan -->
			<div class="form-group">
				<label for="">Hasil Kegiatan</label>
				<select name="hasil_kegiatan" class="form-control">
					<option value="konstruksi">Konstruksi</option>
					<option value="non-konstruksi">Non Konstruksi</option>
				</select>
			</div>
			<!-- End Input Hasil Kegiatan -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Kualifikasi Lelang -->
			<div class="form-group">
				<label for="">Kualifikasi Lelang</label>
				<select name="kualifikasi_lelang" class="form-control">
					<option value="kecil">Kecil</option>
					<option value="non-kecil">Non Kecil</option>
				</select>
			</div>
			<!-- End Input Kualifikasi Lelang -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- End ROW -->
	<!-- ROW -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-4">
			<!-- Input Jenis Belanja Paket -->
			<div class="form-group">
				<label for="">Jenis Belanja Paket</label>
				<select name="jenis_belanja_paket" class="form-control">
					<option value="barang-jasa">Belanja Barang / Jasa</option>
					<option value="modal">Belanja Modal</option>
				</select>
			</div>
			<!-- End Input Jenis Belanja Paket -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-4">
			<!-- Input Metode -->
			<div class="form-group">
				<label for="">Metode</label>
				<select name="metode" class="form-control">
					<option value="lelang-sederhana">Lelang Sederhana</option>
					<option value="lelang-terbatas">Lelang Terbatas</option>
					<option value="lelang-umum">Lelang Umum</option>
					<option value="pemilihan-langsung">Pemilihan Langsung</option>
					<option value="pengadaan-langsung">Pengadaan Langsung</option>
					<option value="penunjukan-langsung">Penunjukan Langsung</option>
					<option value="sayembara">Sayembara</option>
					<option value="seleksi-sederhana">Seleksi Sederhana</option>
					<option value="seleksi-umum">Seleksi Umum</option>
					<option value="swakelola-program">Swakelola Program</option>
					<option value="swakelola-rutin">Swakelola Rutin</option>
					<option value="e-purchasing">E-Purchasing</option>
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
					<option value="seleksi">Seleksi</option>
					<option value="tender">Tender</option>
					<option value="tender-cepat">Tender Cepat</option>
				</select>
			</div>
			<!-- End Input Jenis Belanja Paket -->
		</div>
	</div>
	<!-- End ROW -->
	<!-- ROW -->
	<div class="row">
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input Jenis Pengadaan -->
			<div class="form-group">
				<label for="">Jenis Pengadaan</label>
				<select name="jenis_pengadaan" class="form-control">
					<option value="barang">Barang</option>
					<option value="konstruksi">Konstruksi</option>
					<option value="konsultan-supervisi">Konsultan / Supervisi</option>
					<option value="lainnya">Jasa Lainnya</option>
				</select>
			</div>
			<!-- End Input Jenis Pengadaan -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-6">
			<!-- Input lokasi -->
			<div class="form-group">
				<label for="">Lokasi</label>
				<select name="lokasi_id" class="form-control">
					@foreach($Lokasi as $lokasi)
						<option value="{{$lokasi->id}}">{{$lokasi->lokasi}}</option>
					@endforeach
				</select>
			</div>
			<!-- End Input lokasi -->
		</div>
		<!-- End Col-md-6 -->
	</div>
	<!-- End ROW -->
	<button type="submit" class="btn btn-primary btn-lg" style="margin-top:25px;">Submit</button>
</form>
<!-- END FORM ADD DAFTAR PAKET -->

@endsection

@section('script')

<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Custom -->
<script>
	$(document).ready(function() {
		$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});

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
	});

</script>

@stop