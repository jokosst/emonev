@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Realisasi Kegiatan Perangkat Daerah</h2>
	<!-- FORM REALISASI KEGIATAN -->
	<form action="{{URL::to('emonevpanel/realisasi/update')}}" method="POST" role="form" data-toggle="validator">
		<legend>Edit Realisasi</legend>
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<input type="text"class="form-control" value="{{$realisasi->skpd->skpd}}" disabled="true">
			<input type="hidden" name="skpd_id" value="{{$realisasi->skpd_id}}">
		</div>
		<!-- End Input SKPD -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-4">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text"class="form-control" value="{{$realisasi->tahun->tahun}}" disabled="true">
					<input type="hidden" name="tahun_id" value="{{$realisasi->tahun_id}}">
				</div>
				<!-- End Input Tahun -->
			</div>
			<!-- End Col-md-4 -->
			<!-- Col-md-4 -->
			<div class="col-md-4">
				<!-- Input Bulan -->
				<div class="form-group">
					<label for="">Bulan</label>
					<input type="text"class="form-control" value="{{ Convert::ubah_bulan($realisasi->bulan) }}" disabled="true">
					<input type="hidden" name="bulan" value="{{$realisasi->bulan}}">
				</div>
				<!-- End Input Bulan -->
			</div>
			<!-- End Col-md-4 -->
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Pagu Kegiatan</label>
					<input type="text" value="{{ "Rp ".number_format($realisasi->kegiatan->pagu,0,',','.'); }}" class="form-control" disabled="" id="limit_anggaran">
				</div>
			</div>
		</div>
		<!-- End Row -->
		<!-- Input Kegiatan -->
		<div class="form-group">
			<label for="">Kegiatan</label>
			<input type="text"class="form-control" value="{{$realisasi->kegiatan->kegiatan}}" disabled="true">
			<input type="hidden" name="kegiatan_id" value="{{$realisasi->kegiatan_id}}">
		</div>
		
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Realisasi Fisik -->
				<div class="form-group">
					<label for="">Realisasi Fisik</label>
					<input type="text" name="fisik" class="form-control" required placeholder="%">
				</div>
				<!-- End Input Realisasi Fisik -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Realisasi Keuangan -->
				<div class="form-group">
					<label for="">Realisasi Keuangan</label>
					<input type="text" name="pengeluaran" class="form-control setMoney" required placeholder="Rp">
					<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
				</div>
				<!-- End Input Realisasi Keuangan -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<button type="submit" class="btn btn-primary btn-lg">Update</button>
	</form>
	<!-- END FORM REALISASI KEGIATAN -->
@endsection

@section('script')

<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<script type="text/javascript">
$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
$("input[name='pengeluaran']").on("keyup", function() {
	var limit = Number($("#limit_anggaran").val().replace(/[Rp.]+/g,""));
	var input = Number($(this).val().replace(/[Rp.]+/g,""));
	if(input > limit) {
		$(".validation-text").fadeIn("fast");
	} else {
		$(".validation-text").fadeOut("fast");
	}
});
</script>

@endsection