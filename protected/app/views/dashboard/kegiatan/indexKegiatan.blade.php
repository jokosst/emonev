@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Kegiatan Perangkat Daerah</h2>
	<a href="{{URL::to('emonevpanel/kegiatan/create')}}" class="btn btn-primary" style="float:right;">Tambah Kegiatan</a>

	<!-- FORM SORTIR KEGIATAN -->
	<form action="" class="form-inline" method="GET" role="form" data-toggle="validator">
		<legend>Sortir Kegiatan</legend>
		<!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
		@if(Auth::user()->level != 'adminskpd')
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
				<select name="skpd_id" class="form-control" required>
					<option value="">------ Pilih SKPD ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
		</div>
		@else
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<input type="text" value="{{$Skpd->skpd}}" disabled="" class="form-control" style="width:500px;">
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>
		@endif
		<!-- pilihan memilih Tahun -->
		<div class="form-group">
			<label for="">Tahun</label>
			<select name="tahun_id" class="form-control" required>
				<!-- Menampilkan Semua Tahun -->
				@foreach($Tahun as $tahun)
					<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<!-- END FORM SORTIR KEGIATAN -->

	<!-- Margin Bottom -->
	<div style="margin-bottom:30px;"></div>
	<!-- Menampilkan konten Kegiatan pada tabel -->
	<table id="table_id" class="table table-striped">
	  <thead>
      <tr>
      	<th>No</th>
        <th>Nama Kegiatan</th>
        <th width="150px;">Pagu</th>
        <th width="200px;">Kode Anggaran</th>
        <th width="120px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(Auth::user()->level == 'adminskpd' || $Kegiatan != "0")
	      @foreach($Kegiatan as $key => $kegiatan)
	      	<tr>
	      		<td>{{$key + 1}}</td>
	      		<td>{{$kegiatan->kegiatan}}</td>
	      		<td> {{ "Rp ".number_format($kegiatan->pagu,0,',','.'); }}</td>
	      		<td>{{$kegiatan->kode_anggaran}}</td>
	    			<td><select class="form-control" data-id="{{$kegiatan->id}}" onchange="actionKegiatan(this)">
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
		function actionKegiatan(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/kegiatan/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/kegiatan/edit/"+id;
					break;
				case "hapus":
					var c = confirm("Apakah Anda ingin menghapus kegiatan ini?");
					if (c == true) {
						window.location = baseUrl+"/kegiatan/hapus/"+id;
					}
					return false;
					break;
			}
		}
	</script>
@stop