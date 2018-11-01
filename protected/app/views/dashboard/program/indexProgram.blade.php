@extends('layout.dashboardLayout2')

@section('content')
	<h2 class="menu__header">Program Perangkat Daerah</h2>
	<button class="btn btn-primary" style="float:right;" id="btnAddProgram">Tambah Program</button>

	<!-- FORM ADD PROGRAM -->
	<form action="{{URL::to('emonevpanel/program/insert')}}" method="POST" role="form" style="display:none;" data-toggle="validator" id="formAddProgram">
		<legend style="padding-bottom:10px;">Tambah Program <i class="fa fa-times icon__close"></i></legend>
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<!-- Jika Masuk bukan sebagai Admin SKPD (root || administrator) -->
			@if(Auth::user()->level != 'adminskpd')
				<select name="skpd_id" class="form-control selectpicker" data-live-search="true" required="required">
					<option value="#">------ Pilih Perangkat Daerah ----------</option>
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
		</div>
		<!-- End Input SKPD -->
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Tahun</label>
					<select name="tahun_id" class="form-control">
						@foreach($Tahun as $tahun)
							<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="">Program</label>
					<input type="text" name="program" class="form-control" required placeholder="Nama Program">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Create</button>
	</form> <!-- END FORM ADD PROGRAM -->

	<!-- FORM EDIT PROGRAM -->
	<form action="{{URL::to('emonevpanel/program/update')}}" method="POST" data-toggle="validator" id="formEditProgram" style="display:none">
		<legend style="padding-bottom:10px;">Edit Program <i class="fa fa-times icon__close"></i></legend>
		<!-- Input SKPD -->
		<input type="hidden" id="inputEditID" name="id">
		<div class="form-group">
			<label for="">Program</label>
			<input type="text" name="program" id="inputEditProgram" class="form-control" required placeholder="Nama Program">
		</div>

		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Edit</button>
	</form>

	<!-- FORM SORTIR PROGRAM -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator" style="margin-bottom:20px;">
		<legend>Sortir Program</legend>
		<!-- Jika Masuk sebagai Root || superadmin ada memilih skpd-->
		@if(Auth::user()->level != 'adminskpd')
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
				<select name="skpd_id" class="form-control" required>
					<option value="">------ Pilih Perangkat Daerah ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
		</div>
		@else
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<input type="text" class="form-control" value="{{$Skpd->skpd}}" style="width:500px;" disabled="">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>
		@endif
		<div class="form-group">
			<label for="">Tahun</label>
			<select name="tahun_id" class="form-control" required>
				<option value="">------ Pilih Tahun ----------</option>
				<!-- Menampilkan Semua Tahun -->
				@foreach($Tahun as $tahun)
					<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<!-- END FORM SORTIR PROGRAM -->

	<!-- Menampilkan konten Program pada tabel -->
	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Nama Program</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(Auth::user()->level == 'adminskpd' || $Program != "0")
	      @foreach($Program as $key => $program)
	      	<tr>
	      		<td>{{$key + 1}}</td>
	      		<td>{{$program->program}}</td>
	      		<td width="130px;">
	      			<button data-id="{{$program->id}}" data-skpd="{{$program->skpd_id}}" data-program="{{$program->program}}" class="btn btn-default btn-sm btnEditProgram" style="margin-right:10px;" onclick="editProgram(this)">Edit</button>
							<button data-id="{{$program->id}}" class="btn btn-danger btn-sm btnDltProgram" onclick="deleteProgram(this)">Hapus</button>
	      		</td>
	      	</tr>
				@endforeach
      @endif
    </tbody>
	</table>
@stop

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Button Tambah Program */
		$("#btnAddProgram").click(function() {
			$("#formAddProgram").slideDown(500);
		});
		/* Button Keluar Dari Program */
		$(".icon__close").click(function() {
			$("#formAddProgram, #formEditProgram").slideUp();
		});
		/* SelectBox Untuk Mendapatkan Data Program */
		$("#selectGetProgramTable").change(function() {
			var skpd_id = $(this).val();
			window.location = '?skpd_id='+skpd_id;
		});
		/* Fungsi Edit Untuk memunculkan Form Edit Program */
		function editProgram(el){
			$("#formEditProgram").slideDown(500);
			var id = $(el).attr('data-id');
			var program = $(el).attr('data-program');
			$("#inputEditID").val(id);
			$("#inputEditProgram").val(program);

			$("html,body").animate({ scrollTop: 0}, "slow");
		}
		/* fungsi Delete Program */
		function deleteProgram(el){
			var id = $(el).attr('data-id');
			var c = confirm("Apakah Anda Ingin Menghapus Content Ini");
			if(c == true) {
				window.location = 'program/delete?id='+id;
			}
			return false;
		}
	</script>
@stop