@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Paket Tender Perangkat Daerah</h2>
	<!-- FORM ADD PAKET LELANG -->
	<form action="" method="POST" role="form" data-toggle="validator">
		<legend>Tambah Paket Tender Perangkat Daerah</legend>
		<!-- Input SKPD -->
		<div class="row">
		<div class="col-md-12">
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<!-- Jika Masuk bukan sebagai Admin SKPD (root || administrator) -->
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
		</div> <!-- End Input SKPD -->
	</div>
			<div class="col-md-6">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<select name="tahun_id" class="form-control">
						@foreach($Tahun as $tahun)
						<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
				  </select>
				  <input type="hidden" id="tahunId">
				</div> <!-- End Input Tahun -->
			</div> <!-- End Col-md-6 -->
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Jenis Proses Pengadaan</label>
					<select name="jenis_proses_lelang" id="jenis_proses_lelang" class="form-control">
						<option value="0">--- Pilih Jenis Proses Pengadaan ----</option>
						<option value="e-tendering">Tender</option>
						<option value="e-purchasing">E-Purchasing</option>
						<option value="non-tender">Non-Tender</option>
					</select>
					{{-- <input type="text" name="jenis_proses_lelang" class="form-control" value="E-Procurement" disabled> --}}
				</div>
			</div>
			<div class="col-md-12">
		<div class="form-group">
			<label for="">Kegiatan</label> <i class="fa fa-circle-o-notch fa-spin icon-loading" style="display:none"></i>
			<select name="kegiatan_id" class="form-control selectpicker" data-live-search="true" id="selectKegiatanGetPaket">
				<option value="">----- Pilih Kegiatan -----</option>
				@foreach($Kegiatan as $kegiatan)
				<option value="{{$kegiatan->id}}">{{$kegiatan->kegiatan}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Paket</label>
			<select name="paket_id" class="form-control selectpicker" data-live-search="true" id="changePaket">
				<!-- Data tarik data pake json -->
			</select>
			<input type="hidden" id="limit_anggaran">
		</div>
	</div>
			<div class="col-md-12">
				<div class="form-group" id="hps">
					<label for="">HPS</label>
					<input type="text" name="hps" class="form-control setMoney" placeholder="Rp" required>
					<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
				</div>
			</div>
			<!-- <div class="col-md-6">
				<div class="form-group">
					<label for="">Bidang / Sub Bidang</label>
					<input type="text" name="kode_bidang" class="form-control" placeholder="Kode Bidang" required>
				</div>
			</div> -->
		

		
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Nomor Kontrak</label>
					<input type="text" name="nomor_kontak" class="form-control" placeholder="Nomor Kontak" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Tanggal BAST</label>
					<input type="date" name="tgl_bast" class="form-control" value="" placeholder="Tanggal BAST">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Nomor BAST</label>
					<input type="text" name="nomor_bast" class="form-control" placeholder="Nomor BAST" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Realisasi Fisik Paket</label>
					<input type="text" name="realisasi-fisik-paket" class="form-control" placeholder="Realisasi Fisik Paket" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Realisasi Keuangan Paket</label>
					<input type="text" name="realisasi-keuangan-paket" class="form-control" placeholder="Realisasi Keuangan Paket" required>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group" id="status1">
					<label for="">Status</label>
					<select name="status" class="form-control">
						<option value="belum-mengajukan-dokumen-tender">Belum Mengajukan Dokumen Tender</option>
						<option value="lelang-sedang-berjalan">Tender Sedang Berjalan</option>
						<option value="lelang-sudah-selesai">Tender Sudah Selesai</option>
						<option value="lelang-ulang">Tender Ulang</option>
						<option value="lelang-gagal">Tender Gagal</option>
						<option value="verifikasi-dokumen">Verifikasi Dokumen</option>
				  </select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id="status2">
					<label for="">Status</label>
					<select name="status" class="form-control">
						<option value="belum-proses">Belum Proses</option>
						<option value="proses-sedang-berjalan">proses sedang berjalan</option>
						<option value="proses-selesai">proses selesai</option>
				  </select>
				</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="">Rekanan</label>
				<input type="text" name="rekanan" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Nilai Kontrak</label>
				<input type="text" class="form-control setMoney" name="nilai_kontrak"  placeholder="Rp" required>
				<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Progres Pekerjaan</label>
				<select name="status_kontrak" id="" class="form-control">
					<option value="blt">Belum </option>
					<option value="sdt">Sedang Pelaksanaan</option>
					<option value="sls">Selesai</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Tanggal Mulai</label>
				<input type="text" class="datepicker form-control" name="tanggal_mulai" placeholder="Tanggal Mulai">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Tanggal Selesai</label>
				<input type="text" class="datepicker form-control" name="tanggal_selesai" placeholder="Tanggal Selesai">
			</div>
		</div>
	</div>
		
		
		<div class="col-md-12">
			<div class="form-group">
		<button type="submit" class="btn btn-primary btn-lg">Submit</button>
	</div>
	</div>
	</div>
	</form>

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

	/* onjenis proses lelang  */
	$("#status2").hide();
	$("#jenis_proses_lelang").change(function() {
		
		var jenis_proses_lelang = $(this).val();
		if(jenis_proses_lelang == "e-tendering") {
			$("#hps").show();
			$("#status1").show();
			$("#status2").hide();
		} else {
			$("#hps").hide();
			$("#status2").show();
			$("#status1").hide();
		}
	});
</script>
@stop