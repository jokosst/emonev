@extends('layout.publicLayout')

@section('style')
	<link rel="stylesheet" href="{{URL::to('source/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
	<div class="container">
		<h1 class="page-title" style="margin-top:20px;display:inline-block;">Realisasi Keuangan Perangkat Daerah Tahun {{$tahun}}</h1>
		<form action="" class="form-inline" method="GET" role="form" style="float:right; margin-top:20px;">
			<div class="form-group">
				<label for="">Tahun</label>
				<select name="tahun_id" class="form-control">
					<!-- Menampilkan Semua SKPD -->
					@foreach($listTahun as $value)
						<option @if($tahun_id == "$value->id") selected @endif value="{{$value->id}}">{{$value->tahun}}</option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-sortir">Submit</button>
		</form>

		<table class="table table-bordered table-striped table-front" id="table_id">
			<thead>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2" width="400px;">Perangkat Daerah</th>
					<th rowspan="2" width="150px;">Pagu</th>
					<th colspan="4">Strategis</th>
					<th colspan="1">TT Kontrak</th>
					<th rowspan="2">Realisasi (%)</th>
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
			@foreach($Kegiatan as $key => $kegiatan)
				<tr>

					<td>{{ $key+1 }}</td>
					<td><a href="{{ URL::to('kegiatan-skpd/'.$kegiatan->kode_skpd.'/'.$tahun) }}" style="color: #78AD22;">{{ $kegiatan->skpd }}</a></td>
					<td>{{ "Rp ".number_format($kegiatan->pagu,0,',','.'); }}</td>
					<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
					<td>{{ $kegiatan->kegiatan }}</td>
					<td>{{ $kegiatan->konstruksi }}</td>
					<td>{{ $kegiatan->nonkonstruksi }}</td>
					<td>{{ $kegiatan->paket }}</td>
					<td>{{ str_replace('.', ',', $kegiatan->realisasi_uang) }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/dataTables.bootstrap.min.js')}}"></script>
		<script>
			$('#table_id').DataTable({"iDisplayLength": 50});
		</script>
@endsection