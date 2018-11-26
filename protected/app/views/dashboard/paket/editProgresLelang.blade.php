@extends('layout.dashboardLayout')

@section('style')
	<link rel="stylesheet" href="{{URL::to('source/plugins/datepicker/css/datepicker.css')}}">
@endsection

@section('content')
	<h2 class="menu__header">Progres Tender</h2>
	<!-- FORM EDIT PROGRES LELANG -->
	<form action="{{URL::to('emonevpanel/progres-lelang/update')}}" method="POST" role="form" data-toggle="validator">
		<!-- Row -->
		<div class="row">
			<!-- Col-md-8 -->
			<div class="col-md-8">
				<!-- Input SKPD -->
				<div class="form-group">
					<label for="">Perangkat Daerah</label>
					<input type="text" class="form-control" value="{{$progres->skpd->skpd}}" disabled="">
					<input type="hidden" value="{{$progres->skpd->id}}" name="skpd_id">
				</div>
				<!-- End Input SKPD -->
			</div>
			<!-- End Col-md-8 -->
			<!-- Col-md-4 -->
			<div class="col-md-4">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text" class="form-control" value="{{$progres->tahun->tahun}}" disabled="">
					<input type="hidden" value="{{$progres->tahun->id}}" name="tahun_id">
				</div>
				<!-- End Input Tahun -->
			</div>
			<!-- End Col-md-4 -->
		</div>
		<!-- End Row -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Paket lelang -->
				<div class="form-group">
					<label for="">Paket Tender</label>
					<input type="text" class="form-control" value="{{$progres->lelang->paket->paket}}" disabled="">
					<input type="hidden" value="{{$progres->lelang->id}}" name="lelang_id">
					<input type="hidden" value="{{$progres->lelang->nilai_hps}}" id="limit_anggaran">
				</div>
				<!-- End Input Paket lelang -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Rekanan -->
				<div class="form-group">
					<label for="">Rekanan</label>
					<input type="text" name="rekanan" class="form-control" value="{{$progres->rekanan}}">
				</div>
				<!-- End Input Rekanan -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Nilai Kontrak -->
				<div class="form-group">
					<label for="">Nilai Kontrak</label>
					<input type="text" class="form-control setMoney" name="nilai_kontrak" value="{{ "Rp ".number_format($progres->nilai_kontrak,0,',','.'); }}"  required>
					<p class="validation-text">Nilai Inputan Melebihi Pagu</p>
				</div>
				<!-- End Input Nilai Kontrak -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Status Kontrak -->
				<div class="form-group">
					<label for="">Status Kontrak</label>
					<select name="status_kontrak" class="form-control">
						<option @if($progres->status_kontrak == 'blt') selected @endif value="blt">Belum Tanda Tangan Kontrak</option>
						<option @if($progres->status_kontrak == 'sdt') selected @endif value="sdt">Sudah Tanda Tangan Kontrak</option>
					</select>
				</div>
				<!-- End Input Status Kontrak -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Tanggal Mulai -->
				<div class="form-group">
					<label for="">Tanggal Mulai</label>
					<input type="text" class="datepicker form-control" name="tanggal_mulai" value="{{$progres->tanggal_mulai}}" required>
				</div>
				<!-- End Input Tanggal Mulai -->
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Tanggal Selesai -->
				<div class="form-group">
					<label for="">Tanggal Selesai</label>
					<input type="text" class="datepicker form-control" name="tanggal_selesai" value="{{$progres->tanggal_selesai}}">
				</div>
				<!-- End Input Tanggal Selesai -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<input type="hidden" name="id" value="{{$progres->id}}">
		<button type="submit" class="btn btn-primary btn-lg">Update</button>
	</form>
	<!-- END FORM EDIT PROGRES LELANG -->
@endsection

@section('script')
<!-- Plugin Mask Money -->

<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Plugin DatePicker -->
<script type="text/javascript" src="{{URL::to('source/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$('.datepicker').datepicker({
		format: "yyyy-mm-dd"
	});
	$("input[name='nilai_kontrak']").on("keyup", function() {
		var limit = $('#limit_anggaran').val();
		var input = Number($(this).val().replace(/[Rp.]+/g,""));
		if(input > limit) {
			$(".validation-text").fadeIn("fast");
		} else {
			$(".validation-text").fadeOut("fast");
		}
	});
</script>

@endsection