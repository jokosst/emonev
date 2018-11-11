@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Kegiatan Perangkat Daerah</h2>
	<!-- FORM ADD KEGIATAN -->
	<form action="{{URL::to('emonevpanel/kegiatan/update')}}" method="POST" role="form" data-toggle="validator">
		<legend>Edit Kegiatan</legend>
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<input type="text" class="form-control" value="{{$kegiatan->skpd->skpd}}" disabled="true">
			<input type="hidden" name="skpd_id" value="{{$kegiatan->skpd->id}}">
		</div>
		<!-- End Input SKPD -->
		<div class="row">
			<div class="col-md-4">
				<!-- Input Tahun -->
				<div class="form-group">
					<label for="">Tahun</label>
					<input type="text" class="form-control" value="{{$kegiatan->tahun->tahun}}" disabled="true">
					<input type="hidden" name="tahun_id" value="{{$kegiatan->tahun->id}}">
				</div>
				<!-- End Input Tahun -->
			</div>
			<div class="col-md-8">
				<!-- Input Program -->
				<div class="form-group">
					<label for="">Program</label>
					<select name="program_id" class="form-control selectpicker" data-live-search="true">
						@foreach($Program as $program)
							<option @if($program->id == $kegiatan->program_id) selected @endif value="{{$program->id}}">{{$program->program}}</option>
						@endforeach
					</select>
				</div>
				<!-- End Input Program -->
			</div>
		</div>
		<!-- Input Kegiatan -->
		<div class="form-group">
			<label>Kegiatan</label>
			<input type="text" name="kegiatan" class="form-control" required data-error="Tidak boleh kosong" value="{{$kegiatan->kegiatan}}">
			<div class="help-block with-errors"></div>
		</div>
		<!-- End Input Kegiatan -->
		<!-- Input KPA -->
		<div class="form-group">
			<label for="">PA/KPA/PPK</label>
			<select name="pegawai_id" id="" class="form-control">
				@foreach($Pegawai as $pegawai)
					<option value="{{$pegawai->id}}" @if($pegawai->id == $kegiatan->pegawai_id) selected @endif>{{$pegawai->pegawai}}</option>
				@endforeach
			</select>
		</div>
		<!-- End Input KPA -->
		<!-- One Row for Tahun, Kode Anggaran, Sumber Dana -->
		<div class="row">

			<!-- Col-5 -->
			<div class="col-md-5">
				<!-- Input Kode Anggaran -->
				<div class="form-group">
					<label for="">Kode Anggaran</label>
					<input type="text" name="kode_anggaran" class="form-control" required data-error="Tidak boleh kosong" value="{{$kegiatan->kode_anggaran}}">
					<div class="help-block with-errors"></div>
				</div>
				<!-- End Input Kode Anggaran -->
			</div>
			<!-- End Col-5 -->
			<!-- Col-4 -->
			<div class="col-md-4">
				<!-- Input Sumber Dana -->
				<div class="form-group">
					<label for="">Sumber Dana</label>
					<select class="form-control" name="sumber_dana">
						<option value="APBD" @if($kegiatan->sumber_dana == "APBD") selected @endif>APBD</option>
						<option value="APBN" @if($kegiatan->sumber_dana == "APBN") selected @endif>APBN</option>
						<option value="APBD-P" @if($kegiatan->sumber_dana == "APBD-P") selected @endif>APBD-P</option>
						<option value="APBN-P" @if($kegiatan->sumber_dana == "APBN-P") selected @endif>APBN-P</option>
				  </select>
				</div>
				<!-- End Input KPA -->
			</div>
			<!-- End Col-4 -->
		</div>
		<!-- End Row -->
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
				</div>
				<!-- End Jenis Belanja -->
				<!-- Input Hidden -->
				<input type="hidden" name="id" value="{{$kegiatan->id}}">
				<input type="hidden" name="pagu_awal" value="{{$kegiatan->pagu_awal}}">
				<input type="hidden" name="pagu_perubahan" value="{{$kegiatan->pagu_perubahan}}">
				<!-- End Input Hidden -->
				<!-- Input Submit -->
				<button type="submit" class="btn btn-primary btn-lg" style="margin-top:25px;">Submit</button>
				<!-- End Input Submit -->
			</div>
			<!-- End Col-4 -->
			<!-- Col-8 -->
			<div class="col-md-8">
				<!-- Row Nested-->
				<div class="row">
					<!-- Col-md-6 -->
					<div class="col-md-6">
						<!-- Input Belanja Langung Pegawai (BLP) -->
						<div class="form-group" id="blp" style="display:none;">
							<label for="">Belanja Langsung Pegawai (BLP)</label>
							<input type="text" name="blp" class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
							<div class="help-block with-errors"></div>
						</div>
						<!-- END Input Belanja Langung Pegawai (BLP) -->
					</div>
					<!-- End Col-md-6 -->
					<div class="col-md-6">
						<!-- Input Belanja Langung Non Pegawai (BLNP) -->
						<div class="form-group" id="blnp" style="display:none;">
							<label for="">Belanja Barang/Jasa</label>
							<input type="text" name="blnp"  class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
							<div class="help-block with-errors"></div>
						</div>
						<!-- END Input Belanja Langung Non Pegawai (BLNP) -->
					</div>
					<!-- End Col-6 -->
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group" id="btlp" style="display:none;">
					<label for="">Belanja Tidak Langsung Pegawai (BTLP)</label>
					<input type="text" name="btlp" class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
					<div class="help-block with-errors"></div>
				</div>
			</div>
				<div class="col-md-6">
						<!-- Input Belanja Langung Non Pegawai (BLNP) -->
						<div class="form-group" id="blnp2" style="display:none;">
							<label for="">Belanja Tidak Langsung Non Pegawai</label>
							<input type="text" name="blnp2"  class="form-control setMoney" placeholder="Rp " required data-error="Isi dengan 0 (Nol) jika tidak ada anggaran (letakkan kursor pada form inputan)">
							<div class="help-block with-errors"></div>
						</div> <!-- END Input Belanja Langung Non Pegawai (BLNP) -->
					</div>
				</div>
				</div>
				<!-- End Row Nested-->
				<!-- Button Menghitung Pagu BL -->
					<button class="btn btn-warning btn-sm" id="hitungBl" style="margin-bottom:15px; display:none">Hitung</button>
					<button class="btn btn-warning btn-sm" id="hitungBl2" style="margin-bottom:15px; display:none">Hitung</button>
					<!-- End Button Menghitung Pagu Belanaj Langsung (BL) -->
				<!-- Input Belanja Tidak LangungPegawai (BTLP) -->

				<!-- END Input Belanja Tidak LangungPegawai (BTLP) -->
				<!-- Input Pagu (Disable) -->
				<div class="form-group">
					<label for="">Pagu</label>
					<input type="text" id="pagu" value="{{ "Rp ".number_format($kegiatan->pagu,0,',','.'); }}" class="form-control setMoneyPagu" disabled placeholder="Rp ">
					<input type="hidden" name="pagu">
				</div>
				<!-- END Input Pagu (Disable) -->
			</div>
			<!-- End Col-8 -->
		</div>
		<!-- End Row -->
	</form>
	<!-- END FORM ADD KEGIATAN -->
@endsection

@section('script')
	<!-- Plugin Mask Money -->
	<script type="text/javascript" src="{{URL::to('source/plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js')}}"></script>
	<!-- Custom -->
	<script type="text/javascript">
		$('.setMoney').maskMoney({prefix:'Rp ', thousands:'.', decimal:',', allowZero: true, precision:0});
		$('#pagu').maskMoney({prefix:'Rp ', thousands:'.', decimal:','});

		$("#jenis_belanja").change(function() {
		$("#blp, #blnp,#blnp2, #btlp, #hitungBl,#hitungBl2").hide();
		$("input[name='blp'], input[name='blnp'],input[name='blnp2'], input[name='btlp'], #pagu").val("");
		var jb = $(this).val();
		if(jb == 'bl') {
			$("#blp, #blnp, #hitungBl").show();
		} else if(jb = 'btl') {
			$("#btlp, #blnp2, #hitungBl2").show();
			$("select[name='program_id']").html("<option value=''>-- Kosong --</option>");
			$("select[name='program_id']").selectpicker('refresh');
		}
	});
$("#hitungBl2").click(function() {
		var blp = Number($("input[name='btlp']").val().replace(/[Rp.]+/g,""));
		var blnp = Number($("input[name='blnp2']").val().replace(/[Rp.]+/g,""));
		var total = blp+blnp;
		$("#pagu").maskMoney('mask',total);
		$("input[name='pagu']").val(total);
		return false;
	});
	</script>
@endsection