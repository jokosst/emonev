@extends('layout.dashboardLayout')

@section('style')
	<link rel="stylesheet" href="{{URL::to('source/plugins/datepicker/css/datepicker.css')}}">
@endsection

@section('content')

<h2 class="menu__header">Progres Tender</h2>
<!-- FORM ADD PROGRES LELANG -->
<form action="" method="POST" role="form" data-toggle="validator">
	<div class="row">
		<div class="col-md-8">
			<!-- Input SKPD -->
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<!-- Jika Masuk bukan sebagai Admin SKPD (root || administrator) -->
				@if(Auth::user()->level != 'adminskpd')
					<select id="getIdSkpd" class="form-control selectpicker" data-live-search="true" required>
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
		<div class="col-md-4">
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
	</div>
	<div class="row">
		<div class="col-md-6">
			<!-- Input Paket (From Json) -->
			<div class="form-group">
				<label for="">Paket Tender</label>
				<select name="lelang_id" class="form-control selectpicker" data-live-search="true" id="changeLelang">
					<option value="">---- Pilih Paket Tender ----</option>
					@foreach($Lelang as $lelang)
					<option value="{{$lelang->id}}" data-hps="{{$lelang->nilai_hps}}">{{$lelang->paket->paket}}</option>
					@endforeach
				</select>
				<input type="hidden" id="limit_anggaran">
			</div> <!-- End Input Paket -->
		</div>
		<div class="col-md-6">
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
				<label for="">Status Kontrak</label>
				<select name="status_kontrak" id="" class="form-control">
					<option value="blt">Belum Tanda Tangan Kontrak</option>
					<option value="sdt">Sudah Tanda Tangan Kontrak</option>
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
	<input type="hidden" name="lokasi_id" value="1">
	<button type="submit" class="btn btn-lg btn-primary">Submit</button>
</form>

@endsection

@section('script')
<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('source/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$('.datepicker').datepicker({
		format: "dd-mm-yyyy"
	});
	$('#changeLelang').change(function() {
		var hps = $(this).find(':selected').data('hps');
		$("#limit_anggaran").val(hps);
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
@stop