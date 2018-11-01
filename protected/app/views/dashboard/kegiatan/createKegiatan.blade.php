@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Kegiatan Perangkat Daerah</h2>
	<!-- FORM ADD KEGIATAN -->
	<legend>Tambah Kegiatan</legend>
	<form action="" method="POST" role="form" data-toggle="validator">
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<!-- Jika Masuk bukan sebagai Admin SKPD (root || supeadmin) -->
			@if(Auth::user()->level != 'adminskpd')
				<select name="skpd_id" id="selectSkpdGetProgramAndKpaOption" class="form-control selectpicker" data-live-search="true" required>
					<option value="">------ Pilih Perangkat Daerah ----------</option>
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
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Tahun</label>
					<select class="form-control" id="selectTahunGetProgram">
						@foreach($Tahun as $tahun)
						<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
				  </select>
					<input type="hidden" name="tahun_id" id="tahunId" value="{{$tahun_id}}">
				</div>
			</div>
			<div class="col-md-8">
				<!-- Input Program -->
				<div class="form-group">
					<label for="">Program</label>
					<select name="program_id" class="form-control selectpicker" data-live-search="true">
						<!-- Jika selain adminskpd tarik data pake json -->
						@if(Auth::user()->level == 'adminskpd')
							@foreach($Program as $program)
								<option value="{{$program->id}}">{{$program->program}}</option>
							@endforeach
						@endif
					</select>
				</div>
				<!-- End Input Program -->
			</div>
		</div>
		<!-- Input Kegiatan -->
		<div class="form-group">
			<label>Kegiatan</label>
			<input type="text" name="kegiatan" class="form-control" required placeholder="Nama Kegiatan" data-error="Tidak boleh kosong">
			<div class="help-block with-errors"></div>
		</div> <!-- End Input Kegiatan -->
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
		</div> <!-- End Input KPA -->
		<!-- One Row for Tahun, Kode Anggaran, Sumber Dana -->
		<div class="row">
			<div class="col-md-5">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Kode Anggaran</label>
					<input type="text" name="kode_anggaran" class="form-control" required placeholder="Kode Anggaran" data-error="Tidak boleh kosong">
					<div class="help-block with-errors"></div>
				</div> <!-- End Input Kode Anggaran -->
			</div> <!-- End Col-5 -->
			<div class="col-md-4">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Sumber Dana</label>
					<select class="form-control" name="sumber_dana">
						<option value="APBD">APBD</option>
						<option value="APBN">APBN</option>
						<option value="APBD-P">APBD-P</option>
						<option value="APBN-P">APBN-P</option>
				  </select>
				</div> <!-- End Input KPA -->
			</div> <!-- End Col-4 -->
		</div> <!-- End Row -->
		<!-- One Row for Jenis Belanja, Pagu -->
		<div class="row">
			<div class="col-md-4">
				<!-- Input Jenis Belanja -->
				<div class="form-group">
					<label for="">Jenis Belanja</label>
					<select class="form-control" name="jenis_belanja" id="jenis_belanja" required data-error="Pilih salah satu">
						<option value="">-- Tentukan Jenis Belanja --</option>
						<option value="bl">Belanja Langsung</option>
						<option value="btl">Belanja Tidak Langsung</option>
				  </select>
				  <div class="help-block with-errors"></div>
				</div> <!-- End Jenis Belanja -->
				<button type="submit" class="btn btn-primary btn-lg" style="margin-top:25px;">Submit</button>
			</div> <!-- End Col-4 -->
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-6">
						<!-- Input Belanja Langung Pegawai (BLP) -->
						<div class="form-group" id="blp" style="display:none;">
							<label for="">Belanja Langsung Pegawai (BLP)</label>
							<input type="text" name="blp" class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
							<div class="help-block with-errors"></div>
						</div> <!-- END Input Belanja Langung Pegawai (BLP) -->
					</div> <!-- End Col-6 -->
					<div class="col-md-6">
						<!-- Input Belanja Langung Non Pegawai (BLNP) -->
						<div class="form-group" id="blnp" style="display:none;">
							<label for="">Belanja Langsung Non Pegawai (BLNP)</label>
							<input type="text" name="blnp"  class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
							<div class="help-block with-errors"></div>
						</div> <!-- END Input Belanja Langung Non Pegawai (BLNP) -->
					</div> <!-- End Col-6 -->
				</div> <!-- End Row Nested-->
				<!-- Input Belanja Tidak LangungPegawai (BTLP) -->
				<div class="form-group" id="btlp" style="display:none;">
					<label for="">Belanja Tidak Langsung Pegawai (BTLP)</label>
					<input type="text" name="btlp" class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
					<div class="help-block with-errors"></div>
				</div> <!-- END Input Belanja Tidak LangungPegawai (BTLP) -->
				<!-- Menghitung Pagu BL -->
				<button class="btn btn-warning btn-sm" id="hitungBl" style="margin-bottom:15px; display:none">Hitung</button>
				<!-- Input Pagu (Disable) -->
				<div class="form-group">
					<label for="">Pagu</label>
					<input type="text" id="pagu" class="form-control setMoneyPagu"  placeholder="Total Pagu dari Jenis Belanja" disabled>
					<input type="hidden" name="pagu">
				</div> <!-- END Input Pagu (Disable) -->
			</div> <!-- End Col-8 -->
		</div><!-- End Row -->
	</form>
	<!-- END FORM ADD KEGIATAN -->
@stop

@section('script')
<!-- Plugin Mask Money -->
<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
<!-- Custom -->
<script>
	$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
	$('#pagu').maskMoney({prefix:'Rp ', thousands:'.', decimal:','});

	$('#changeTahun').change(function() {
		var tahun_id = $(this).val();
		$("input[name='tahun_id']").val(tahun_id);
	});


</script>
@stop