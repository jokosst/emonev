@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Paket Tender Perangkat Daerah</h2>
<a href="{{URL::to('emonevpanel/paket-lelang/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Paket Tender</a>
<!-- Sortir Tahun -->
<div class="form-group form-inline">
	<label for="">Tahun</label>
	<select id="selectGetPaketTable" class="form-control" style="margin-bottom:10px;">
		<option value="">------ Pilih Tahun ----------</option>
		<!-- Menampilkan Semua SKPD -->
		@foreach($Tahun as $tahun)
			<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
		@endforeach
	</select>
</div>
<!-- End Sortir Tahun -->
<!-- Table Paket Lelang -->
<table id="table_id" class="table table-striped">
	<thead>
  <tr>
  	<th>No</th>
    <th>Nama Kegiatan</th>
    <th>Nama Paket</th>
    <th>Status</th>
    <th width="120px;">HPS</th>
    <th width="120px;">Aksi</th>
  </tr>
</thead>
<tbody>
	@foreach($Lelang as $key => $lelang)
		<tr>
			<td>{{$key+1}}</td>
    		<td>{{$lelang->kegiatan->kegiatan}}</td>
    		<td>{{$lelang->paket->paket}}</td>
    		<td>{{ucwords(str_replace('-',' ', $lelang->status))}}</td>
    		<td>{{$lelang->hps}}</td>
    		<td><select onchange="actionLelang(this)" data-id="{{$lelang->id}}" class="form-control">
  				<option value="">--Aksi--</option>
        	<option value="detail">Detail</option>
        	<option value="edit">Edit</option>
        	<option value="hapus">Hapus</option>
        </select></td>
		</tr>
	@endforeach
   </tbody>
</table>
<!-- End Table Paket Lelang -->

@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Fungsi Sortir Paket */
		$("#selectGetPaketTable").change(function() {
			var tahun_id = $(this).val();
			window.location = '?tahun_id='+tahun_id;
		});
		/* Fungsi Aksi Paket */
		function actionLelang(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/paket-lelang/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/paket-lelang/edit/"+id;
					break;
				case "hapus":
					var c = confirm("Apakah Anda ingin menghapus paket-lelang ini?");
					if (c == true) {
						window.location = baseUrl+"/paket-lelang/hapus/"+id;
					}
					return false;
					break;
			}
		}
	</script>
@endsection