@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Lokasi</h2>
	<button class="btn btn-primary" style="float:right;" id="btnAddLokasi">Tambah Lokasi</button>
	<!-- FORM ADD LOKASI -->
	<form action="{{URL::to('emonevpanel/lokasi/insert')}}" method="POST" role="form" style="display:none;" data-toggle="validator" id="formAddLokasi">
		<legend style="padding-bottom:10px;">Tambah Lokasi <i class="fa fa-times icon__close"></i></legend>
		<div class="form-group">
			<label for="">Lokasi</label>
			<input type="text" name="lokasi" class="form-control" required placeholder="Nama Lokasi">
		</div>
		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Create</button>
	</form> <!-- END FORM ADD LOKASI -->
	<!-- FORM EDIT LOKASI -->
	<form action="{{URL::to('emonevpanel/lokasi/update')}}" method="POST" data-toggle="validator" id="formEditLokasi" style="display:none">
		<legend style="padding-bottom:10px;">Edit Lokasi <i class="fa fa-times icon__close"></i></legend>
		<!-- Input Lokasi -->
		<input type="hidden" id="inputEditID" name="id">
		<div class="form-group">
			<label for="">Lokasi</label>
			<input type="text" name="lokasi" id="inputEditLokasi" class="form-control" required>
		</div>
		<button type="submit" class="btn btn-primary btn-lg" style="margin-top: 20px;margin-bottom:30px;">Edit</button>
	</form>
	<!-- Menampilkan konten Lokasi pada tabel -->
	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Nama Lokasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($Lokasi as $key => $lokasi)
      	<tr>
      		<td>{{$key + 1}}</td>
      		<td>{{$lokasi->lokasi}}</td>
      		<td width="130px;">
      			<button data-id="{{$lokasi->id}}" data-lokasi="{{$lokasi->lokasi}}" class="btn btn-default btn-sm" style="margin-right:10px;" onclick="editLokasi(this)">Edit</button>
						<button data-id="{{$lokasi->id}}" class="btn btn-danger btn-sm" onclick="deleteLokasi(this)">Hapus</button>
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
		/* Button Tambah Lokasi */
		$("#btnAddLokasi").click(function() {
			$("#formAddLokasi").slideDown(500);
		});
		/* Button Keluar Dari Lokasi */
		$(".icon__close").click(function() {
			$("#formAddLokasi, #formEditLokasi").slideUp();
		});
		/* Fungsi Edit Untuk memunculkan Form Edit Lokasi */
		function editLokasi(el){
			$("#formEditLokasi").slideDown(500);
			var id = $(el).attr('data-id');
			var lokasi = $(el).attr('data-lokasi');
			$("#inputEditID").val(id);
			$("#inputEditLokasi").val(lokasi);
		}
		/* fungsi Delete Program */
		function deleteLokasi(el){
			var id = $(el).attr('data-id');
			var c = confirm("Apakah Anda Ingin Menghapus Lokasi Ini");
			if(c == true) {
				window.location = 'lokasi/delete?id='+id;
			}
			return false;
		}
	</script>
@stop