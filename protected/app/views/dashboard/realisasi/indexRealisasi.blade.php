@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Realisasi Perangkat Daerah</h2>
	<!-- Kita Coba hilangkan,
			 karena sebenarnya ndak perlu, semua sudah di handle oleh proses update
	<a href="{{URL::to('emonevpanel/realisasi/create')}}" class="btn btn-primary" style="float:right;">Tambah Realisasi</a>
	-->
	<!-- Sortir Realisasi -->
	<form action="" method="GET" role="form" data-toggle="validator" style="margin-bottom:30px;">
		<legend>Sortir Realisasi</legend>
		<!-- Jika selain adminskpd (root || superadmin) -->
		@if(Auth::user()->level != 'adminskpd')
			<div class="form-group">
				<label for="">Perangkat Daerah</label>
				<select name="skpd_id" class="form-control" required >
					<option value="">------ Pilih Perangkat Daerah ----------</option>
					<!-- Menampilkan Semua SKPD -->
					@foreach($Skpd as $skpd)
						<option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
					@endforeach
				</select>
			</div>
		<!-- Jika adminskpd -->
		@else
			<!-- Menampilkan 1 SKPD -->
			<div class="form-group">
				<input type="text" class="form-control" value="{{$Skpd->skpd}}" disabled>
				<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
			</div>
		@endif
		<!-- Row -->
		<div class="row">
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Tahun -->
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
			</div>
			<!-- End Col-md-6 -->
			<!-- Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Bulan -->
					<div class="form-group">
						<label for="">Bulan</label>
						<select name="bulan" class="form-control" required>
							<option value="">------ Pilih Bulan ----------</option>
							<!-- Menampilkan Semua Bulan -->
							<option @if(isset($bulan) && $bulan == "1") selected  @endif value="1">Januari</option>
							<option @if(isset($bulan) && $bulan == "2") selected  @endif value="2">Februari</option>
							<option @if(isset($bulan) && $bulan == "3") selected  @endif value="3">Maret</option>
							<option @if(isset($bulan) && $bulan == "4") selected  @endif value="4">April</option>
							<option @if(isset($bulan) && $bulan == "5") selected  @endif value="5">Mei</option>
							<option @if(isset($bulan) && $bulan == "6") selected  @endif value="6">Juni</option>
							<option @if(isset($bulan) && $bulan == "7") selected  @endif value="7">Juli</option>
							<option @if(isset($bulan) && $bulan == "8") selected  @endif value="8">Agustus</option>
							<option @if(isset($bulan) && $bulan == "9") selected  @endif value="9">September</option>
							<option @if(isset($bulan) && $bulan == "10") selected  @endif value="10">Oktober</option>
							<option @if(isset($bulan) && $bulan == "11") selected  @endif value="11">November</option>
							<option @if(isset($bulan) && $bulan == "12") selected  @endif value="12">Desember</option>
						</select>
					</div>
				<!-- End Input Bulan -->
			</div>
			<!-- End Col-md-6 -->
		</div>
		<!-- End Row -->
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	<!-- End Sortir Realisasi -->
	<!-- Table Realisasi -->
	<table id="table_id" class="table table-striped">
		<thead>
      <tr>
      	<th>No</th>
      	{{-- <th>Program</th> --}}
        <th>Nama Kegiatan</th>
        <th width="120px;">Pagu</th>
        <th width="120px;">Pengeluaran</th>
        <th width="50px;">Fisik</th>
        <th width="50px;">Keuangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
	@foreach($Realisasi as $key => $realisasi)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{$realisasi->kegiatan->kegiatan}}</td>
			<td>{{ "Rp ".number_format($realisasi->kegiatan->pagu,0,',','.'); }}</td>
			<td>{{ "Rp ".number_format($realisasi->pengeluaran,0,',','.'); }}</td>
			<td>{{$realisasi->fisik." %"}}</td>
			<td>{{$realisasi->uang." %"}}</td>
			<td><select onchange="actionRealisasi(this)" data-id="{{$realisasi->id}}" class="form-control">
			<option value="">--Aksi--</option>
          	<option value="detail">Detail</option>
          	<option value="edit">Update Realisasi</option>
          </select></td>
		</tr>
	@endforeach
    </tbody>
	</table>
	<!-- End Table Realisasi -->
@endsection

@section('script')
	<script type="text/javascript">
		/* Deklarasi Datatable */
		$('#table_id').DataTable({"iDisplayLength": 25});
		/* Fungsi Aksi Realisasi */
		function actionRealisasi(el){
			var id = $(el).attr('data-id');
			var action = $(el).val();
			switch(action) {
				case "detail":
					window.location = baseUrl+"/realisasi/detail/"+id;
					break;
				case "edit":
					window.location = baseUrl+"/realisasi/edit/"+id;
					break;
			}
		}
	</script
@endsection