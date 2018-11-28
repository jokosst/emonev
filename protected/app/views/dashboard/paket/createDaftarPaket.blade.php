@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Daftar Paket Perangkat Daerah</h2>
<!-- FORM ADD DAFTAR PAKET -->
<form action="" method="POST" role="form" data-toggle="validator">

	<legend>Tambah Daftar Paket</legend>
	<!-- Input SKPD -->
	<div class="row">
		<div class="col-md-12">
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
</div>
	<!-- End Input SKPD -->
	<!-- ROW -->
	
		<!-- Col-md-6 -->
		<div class="col-md-12">
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
		<div class="col-md-12">
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
	
	<!-- END ROW -->
	<!-- Input Kegiatan -->
	<div class="col-md-12">
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
</div>
	<!-- End Input Kegiatan -->
	<!-- Input Paket -->
	<div class="col-md-12">
	<div class="form-group">
		<label for="">Paket</label>
		<input type="text" name="paket" class="form-control" required placeholder="Nama Paket">
	</div>
</div>
	<!-- End Input Paket -->
	<!-- ROW -->
	
		<!-- Col-md-6 -->
		<div class="col-md-12">
			<!-- Input Pagu -->
			<div class="form-group">
				<label for="">Pagu Paket</label>
				<input type="text" class="form-control setMoney" name="pagu_paket" id="pagu" placeholder="Rp" required>
				<!-- <p class="validation-text">Nilai Inputan Melebihi Pagu</p> -->
			</div>
			<!-- END Input Pagu  -->
		</div>
		<!-- End Col-md-6 -->
		<!-- Col-md-6 -->
		<div class="col-md-12">
			<!-- Input Kode Anggaran  -->
			<div class="form-group">
				<label for="">Kode Anggaran Paket</label>
				<input type="text" class="form-control" name="kode_anggaran_paket"  placeholder="Kode Anggaran Paket" required>
			</div>
			<!-- END Input Kode Anggaran  -->
		</div>
		<!-- End Col-md-6 -->
	
	<!-- End ROW -->
	<!-- ROW -->
	
		<!-- Col-md-4 -->
		<div class="col-md-12">
			<!-- Input Volume -->
			<div class="form-group">
				<label for="">Volume</label>
				<input type="text" name="volume" class="form-control"  placeholder="Volume" required>
			</div>
			<!-- END Input Volume  -->
		</div>
		<!-- End Col-md-4 -->
		<!-- Col-md-4 -->
		<!-- <div class="col-md-4"> -->
			<!-- Input Satuan Volume -->
			<!-- <div class="form-group" id="satuanvolume">
				<label for="">Satuan Volume</label>
				<input type="text" name="satuan_volume" class="form-control"  placeholder="Satuan Volume" required>
			</div> -->
			<!-- END Input Satuan Volume  -->
		<!-- </div> -->
		<!-- End Col-md-4 -->
	
	<!-- End ROW -->
	<!-- ROW -->
	
		<!-- Col-md-6 -->
		<div class="col-md-12">
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
		
				<div class="col-md-12">
			<!-- Input Kualifikasi Lelang -->
			<div class="form-group" id="kualifikasi1">
				<label for="">Kualifikasi</label>
				<select name="kualifikasi_lelang" class="form-control">
					<option value="kecil">Kecil</option>
				</select>
			</div>
			<!-- End Input Kualifikasi Lelang -->
		</div>
		<div class="col-md-12">
			<!-- Input Kualifikasi Lelang -->
			<div class="form-group" id="kualifikasi2">
				<label for="">Kualifikasi Lelang</label>
				<select name="kualifikasi_lelang" class="form-control">
					<option value="non-kecil">Non Kecil</option>
				</select>
			</div>
			<!-- End Input Kualifikasi Lelang -->
		</div>
	

		<!-- End Col-md-6 -->
	
	<!-- End ROW -->
	<!-- ROW -->
	
		<!-- Col-md-6 -->
		<div class="col-md-12">
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
		<div class="col-md-12">
			<!-- Input Metode -->
			<div class="form-group">
				<label for="">Metode Pemilihan Penyedia</label>
				<select name="metode" class="form-control">
					
					<option value="e-purchasing">E-Purchasing</option>
					<option value="pengadaan-langsung">Pengadaan Langsung</option>
					<option value="penunjukan-langsung">Penunjukan Langsung</option>
					
					
					<option value="seleksi">Seleksi</option>
					<option value="tender">Tender</option>
					<option value="tender-cepat">Tender Cepat</option>
				</select>
			</div>
			<!-- End Input Metode -->
		</div>
		<!-- End Col-md-6 -->
		
	
	<!-- End ROW -->
	<!-- ROW -->
	
		<!-- Col-md-6 -->
		<div class="col-md-12">
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
		<div class="col-md-12">
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
	
	<!-- End ROW -->
	<div class="col-md-12">
	<button type="submit" class="btn btn-primary btn-lg" style="margin-top:25px;margin-bottom: 25px">Submit</button>
</div>
</div>
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
$("#kualifikasi2").hide();
$("#satuanvolume").hide();
/* onjenis pagu  */
	$("#pagu").change(function() {
		
		var pagu = Number($(this).val().replace(/[Rp.]+/g,""));
		if(pagu <= "2500000000") {
			$("#kualifikasi1").show();
			$("#kualifikasi2").hide();
		} else {
			$("#kualifikasi1").hide();
			$("#kualifikasi2").show();
		}
	});
</script>

@stop