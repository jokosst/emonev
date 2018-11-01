@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Paket Lelang SKPD</h2>
	<!-- FORM EDIT PAKET LELANG -->
	<form action="{{URL::to('emonevpanel/paket-lelang/update')}}" method="POST" role="form" data-toggle="validator">
		<legend>Edit Paket Lelang Perangkat Daerah</legend>
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<input type="text" class="form-control" value="{{$lelang->skpd->skpd}}" disabled="">
			<input type="hidden" value="{{$lelang->skpd->id}}" name="skpd_id">
		</div>
		<!-- End Input SKPD -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text" class="form-control" value="{{$lelang->tahun->tahun}}" disabled="">
					<input type="hidden" value="{{$lelang->tahun->id}}" name="tahun_id">
				</div>
				<!-- End Input Tahun -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Jenis Proses Lelang -->
				<label for="">Jenis Proses Pengadaan</label>
				<select name="jenis_proses_lelang" class="form-control">
					<option @if($lelang->jenis_proses_lelang == 'e-tendering') selected @endif value="e-tendering">Tender</option>
					<option @if($lelang->jenis_proses_lelang == 'e-purchasing') selected @endif value="e-purchasing">E-Purchasing</option>
				</select>
				<!-- End Input Jenis Proses Lelang -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<!-- Input Kegiatan -->
		<div class="form-group">
			<label for="">Kegiatan</label>
			<input type="text" class="form-control" value="{{$lelang->kegiatan->kegiatan}}" disabled="">
			<input type="hidden" value="{{$lelang->kegiatan->id}}" name="kegiatan_id">
		</div>
		<!-- End Input Kegiatan -->
		<!-- Input Daftar Paket -->
		<div class="form-group">
			<label for="">Daftar Paket</label>
			<select name="paket_id" class="form-control selectpicker" data-live-search="true" id="changePaket">
				@foreach($Paket as $paket)
					<option value="{{$paket->id}}" data-pagu="{{$paket->nilai_pagu_paket}}">{{$paket->paket}}</option>
				@endforeach
			</select>
			<input type="hidden" id="limit_anggaran" value="{{$lelang->paket->nilai_pagu_paket}}">
		</div>
		<!-- End Input Daftar Paket -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input HPS -->
				<div class="form-group">
					<label for="">HPS</label>
					<input type="text" name="hps" class="form-control setMoney" required value="{{ "Rp ".number_format($lelang->nilai_hps,0,',','.'); }}">
					<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
				</div>
				<!-- End Input HPS -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<!-- <div class="col-md-6">
				<div class="form-group">
					<label for="">Kode Bidang</label>
					<input type="text" name="kode_bidang" class="form-control" value="{{$lelang->kode_bidang}}" required>
				</div>
			</div> -->
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-4 -->
			<div class="col-md-4">
				<!-- Input Produk Akhir -->
				<div class="form-group">
					<label for="">Nomor Kontak</label>
					<input type="text" name="nomor_kontak" class="form-control" value="{{$lelang->nomor_kontak}}" required>
				</div>
				<!-- End Input Produk Akhir -->
			</div>
			<!-- End Col-md-4 -->
			<!-- Col-md-4 -->
			<div class="col-md-4">
				<!-- Input Tempat Daftar -->
				<div class="form-group">
					<label for="">Tanggal BAST</label>
					<input type="date" name="tgl_bast" class="form-control" value="{{$lelang->tgl_bast}}" required>
				</div>
				<!-- End Tempat Daftar -->
			</div>
			<!-- End Col-md-4 -->
			<!-- Col-md-4 -->
			<div class="col-md-4">
				<!-- Input Status -->
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" class="form-control">
						<option @if($lelang->status == 'belum-mengajukan-dokumen-tender') selected @endif value="belum-siap-lelang">Belum Mengajukan Dokumen Tender</option>
						<option @if($lelang->status == 'lelang-sedang-berjalan') selected @endif value="lelang-sedang-berjalan">Lelang Sedang Berjalan</option>
						<option @if($lelang->status == 'lelang-sudah-selesai') selected @endif value="lelang-sudah-selesai">Lelang Sudah Selesai</option>
						<option @if($lelang->status == 'lelang-ulang') selected @endif value="lelang-ulang">Lelang Ulang</option>
						<option @if($lelang->status == 'verifikasi-dokumen') selected @endif value="verifikasi-dokumen">Verifikasi Dokumen</option>
				  </select>
				</div>
				<!-- End Input Status -->
			</div>
			<!-- End Col-md-4 -->
		</div>
		<!-- End Row -->
		<input type="hidden" name="id" value="{{$lelang->id}}">
		<button type="submit" class="btn btn-primary btn-lg">Update</button>
	</form>
	<!-- END FORM PAKET LELANG -->
@endsection

@section('script')

<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$("select[name='jenis_proses_lelang']").change(function() {
		var jenis = $(this).val();
		if(jenis == 'e-tendering') {
			$("input[name='tempat_daftar']").val("Unit Layanan Pengadaan (ULP)");
		} else if(jenis == 'e-purchasing') {
			$("input[name='tempat_daftar']").val("");
		}
	});
	$('#changePaket').change(function() {
		pagu = $(this).find(':selected').data('pagu');
		$("#limit_anggaran").val(pagu);
	});
	$("input[name='hps']").on("keyup", function() {
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