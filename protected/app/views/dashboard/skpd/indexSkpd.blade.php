@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">SKPD</h2>
	<button class="btn btn-primary" style="float:right;" id="btnAddSkpd">Tambah SKPD</button>
	<!-- FORM ADD PROGRAM -->
	<form action="{{URL::to('emonevpanel/skpd/insert')}}" method="POST" role="form" style="display:none;" data-toggle="validator" id="formAddSkpd">
		<legend style="padding-bottom:10px;">Tambah SKPD <i class="fa fa-times icon__close"></i></legend>
		<div class="form-group">
			<label for="">SKPD</label>
			<input type="text" name="skpd" class="form-control" required placeholder="Nama SKPD">
		</div>
		<div class="form-group">
			<label for="">Kode SKPD</label>
			<input type="text" name="kode_skpd" class="form-control" required placeholder="Kode SKPD">
		</div>
		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Create</button>
	</form> <!-- END FORM ADD PROGRAM -->
	<!-- FORM EDIT PROGRAM -->
	<form action="{{URL::to('emonevpanel/skpd/update')}}" method="POST" data-toggle="validator" id="formEditSkpd" style="display:none">
		<legend style="padding-bottom:10px;">Edit Skpd <i class="fa fa-times icon__close"></i></legend>
		<!-- Input SKPD -->
		<input type="hidden" id="inputEditID" name="id">
		<div class="form-group">
			<label for="">SKPD</label>
			<input type="text" name="skpd" id="inputEditSkpd" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="">Kode SKPD</label>
			<input type="text" name="kode_skpd" id="inputEditKodeSkpd" class="form-control" required>
		</div>

		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Edit</button>
	</form>
	<!-- Menampilkan konten Program pada tabel -->
	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Nama SKPD</th>
        <th>Kode SKPD</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($Skpd as $key => $skpd)
      	<tr>
      		<td>{{$key + 1}}</td>
      		<td>{{$skpd->skpd}}</td>
      		<td>{{$skpd->kode_skpd}}</td>
      		<td width="130px;">
      			<button data-id="{{$skpd->id}}" data-skpd="{{$skpd->skpd}}" data-kode="{{$skpd->kode_skpd}}" class="btn btn-default btn-sm" style="margin-right:10px;" onclick="editSkpd(this)">Edit</button>
						<button data-id="{{$skpd->id}}" class="btn btn-danger btn-sm" onclick="deleteSkpd(this)">Hapus</button>
      		</td>
      	</tr>
			@endforeach
    </tbody>
	</table>
@stop

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Button Tambah Program */
		$("#btnAddSkpd").click(function() {
			$("#formAddSkpd").slideDown(500);
		});
		/* Button Keluar Dari Program */
		$(".icon__close").click(function() {
			$("#formAddSkpd, #formEditSkpd").slideUp();
		});
		/* Fungsi Edit Untuk memunculkan Form Edit Program */
		function editSkpd(el){
			$("#formEditSkpd").slideDown(500);
			var id = $(el).attr('data-id');
			var skpd = $(el).attr('data-skpd');
			var kode = $(el).attr('data-kode');
			$("#inputEditID").val(id);
			$("#inputEditSkpd").val(skpd);
			$("#inputEditKodeSkpd").val(kode);
		}
		/* fungsi Delete Program */
		function deleteSkpd(el){
			var id = $(el).attr('data-id');
			var c = confirm("Apakah Anda Ingin Menghapus Skpd Ini");
			if(c == true) {
				window.location = 'skpd/delete?id='+id;
			}
			return false;
		}
	</script>
@stop