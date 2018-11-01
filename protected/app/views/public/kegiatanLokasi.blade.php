@extends('layout.publicLayout')

@section('style')
	<link rel="stylesheet" href="{{URL::to('source/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
	<div class="container">
		<h1 class="page-title" style="margin-top:20px;display:inline-block;">Realisasi Kegiatan Berdasarkan Lokasi Tahun {{$tahun}}</h1>
		<!-- Sortir Tahun Lokasi Kegiatan -->
		<form action="" class="form-inline" method="GET" role="form" style="float:right; margin-top:20px;">
			<div class="form-group">
				<label for="">Tahun</label>
				<select name="tahun_id" class="form-control">
					<!-- Menampilkan Semua SKPD -->
					@foreach($listTahun as $tahun)
						<option @if($tahun_id == "$tahun->id") selected @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-sortir">Submit</button>
		</form>
		<!-- Sortir Tahun Lokasi Kegiatan -->
		<!--Tabel Tahun Lokasi Kegiatan -->
		<table class="table table-bordered table-striped table-front" id="table_id">
			<thead>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2" width="400px;">Lokasi</th>
					<th colspan="4" width="400px;">Strategis</th>
					<th colspan="1" width="400px;">Tanda Tangan Kontrak</th>
					<th rowspan="2" width="400px;">Belum Lelang / Ulang</th>
				</tr>
				<tr>
					<th width="150px;">Rp.</th>
					<th>Jml</th>
					<th>K</th>
					<th>NK</th>
					<th>Paket</th>
				</tr>
			</thead>
			<tbody>
			@foreach($Lokasi as $key => $lokasi)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$lokasi->lokasi}}</td>
					<td>{{ "Rp ".number_format($lokasi->pagupaket,0,',','.'); }}</td>
					<td>{{$lokasi->hasilkegiatan}}</td>
					<td>{{$lokasi->konstruksi}}</td>
					<td>{{$lokasi->nonkonstruksi}}</td>
					<td>{{$lokasi->progres}}</td>
					<td>{{$lokasi->lelang}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<!--Tabel Tahun Lokasi Kegiatan -->
	</div>
	<style>
		footer {
			position: fixed;
			bottom: 0;
			width: 100%;
		}
	</style>
@endsection

@section('script')
	<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/dataTables.bootstrap.min.js')}}"></script>
		<script>
			$('#table_id').DataTable({"iDisplayLength": 50});
		</script>
@endsection