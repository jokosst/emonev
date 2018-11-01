@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Daftar Paket Perangkat Daerah</h2>
	<a href="{{URL::to('emonevpanel/daftar-paket/create')}}" class="btn btn-primary" style="float:right;">Tambah Paket</a>
	<!-- FORM SORTIR DAFTAR PAKET -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator">
		<legend>Sortir Kegiatan</legend>
		<!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
		@if(Auth::user()->level != 'adminskpd')
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
				<select name="skpd_id" class="form-control" required>
					<option value="">------ Pilih Perangkat Daerah  ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
		</div>
		@else
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<input type="text" value="{{$Skpd->skpd}}" class="form-control" disabled="" style="width:500px;">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>

		@endif
		<!-- Jika masuk sebagai admin skpd maka ada pilihan memilih Tahun -->
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
	<!-- Margin Bottom -->
	<div style="margin-bottom:30px;"></div>
	<!-- Menampilkan konten Daftar Paket pada tabel -->
	<table id="table_id" class="table table-striped">
		<thead>
      <tr>
      	<th>No</th>
        <th>Paket</th>
        <th width="150px;">Pagu Paket</th>
        <th width="200px;">Kode Anggaran Paket</th>
        <th width="120px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
    	@if(Auth::user()->level == 'adminskpd' || $Paket != "0")
	    	@foreach($Paket as $key=>$paket)
	    	<tr>
	    		<td>{{$key+1}}</td>
	    		<td>{{$paket->paket}}</td>
	    		<td>{{$paket->pagu_paket}}</td>
	    		<td>{{$paket->kode_anggaran_paket}}</td>
	    		<td><select class="form-control" data-id="{{$paket->id}}" onchange="actionPaket(this)">
	  				<option value="">--Aksi--</option>
	        	<option value="detail">Detail</option>
	        	<option value="edit">Edit</option>
	        	<option value="hapus">Hapus</option>
	        </select></td>
	    	</tr>
	    	@endforeach
    	@endif
    </tbody>
	</table>
@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable();
		/* Fungsi Aksi Kegiatan */
		function actionPaket(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/daftar-paket/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/daftar-paket/edit/"+id;
					break;
				case "hapus":
					var c = confirm("Apakah Anda ingin menghapus daftar paket ini?");
					if (c == true) {
						window.location = baseUrl+"/daftar-paket/hapus/"+id;
					}
					return false;
					break;
			}
		}
	</script>
@stop