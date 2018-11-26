@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Progress Tender Perangkat Daerah</h2>
	<a href="{{URL::to('/emonevpanel/progres-lelang/create')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Progres Tender</a>
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
	<!-- TABLE PROGRES LELANG -->
	<table id="table_id" class="table table-striped">
		<thead>
      <tr>
      	<th>No</th>
        <th>Nama Rekanan</th>
        <th>Nama Paket</th>
        <th>Nilai Kontrak</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($Progres as $key => $progres)
    		<tr>
    			<td>{{$key + 1}}</td>
    			<td>{{$progres->rekanan}}</td>
    			<td>{{$progres->lelang->paket->paket}}</td>
    			<td>{{ "Rp ".number_format($progres->nilai_kontrak,0,',','.'); }}</td>
    			<td>{{Convert::ubah_status_kontrak($progres->status_kontrak)}}</td>
	    		<td><select onchange="actionProgres(this)" data-id="{{$progres->id}}" class="form-control">
	  				<option value="">--Aksi--</option>
	        	<option value="detail">Detail</option>
	        	<option value="edit">Edit</option>
	        	<option value="hapus">Hapus</option>
	        </select></td>
    		</tr>
    	@endforeach
    </tbody>
	</table>
	<!-- END TABLE PROGRES LELANG -->
@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Fungsi Sortir Progres */
		$("#selectGetPaketTable").change(function() {
			var tahun_id = $(this).val();
			window.location = '?tahun_id='+tahun_id;
		});
		/* Fungsi Aksi Paket */
		function actionProgres(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/progres-lelang/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/progres-lelang/edit/"+id;
					break;
				case "hapus":
					var c = confirm("Apakah Anda ingin menghapus paket-lelang ini?");
					if (c == true) {
						window.location = baseUrl+"/progres-lelang/hapus/"+id;
					}
					return false;
					break;
			}
		}
	</script>
@endsection