@extends('layout.dashboardLayout')

@section('content')

<style>
	#table-summary {
		font-size: 12px;
	}
</style>

<h2 class="menu__header">Format DK1</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom:30px;" class="form-inline" method="GET" role="form" data-toggle="validator">
	<legend>Sortir Summary</legend>
	<!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
	@if(Auth::user()->level != 'adminskpd')
	<div class="form-group">
		<label for="">Perangkat Daerah</label>
			<select name="skpd_id" class="form-control" required>
				<!-- Menampilkan Semua SKPD -->
				<option value="">------ Pilih Perangkat Daerah ----------</option>
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
			<option value="">------ Pilih Tahun ----------</option>
			<!-- Menampilkan Semua Tahun -->
			@foreach($Tahun as $tahun)
				<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
			@endforeach
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<!-- END FORM SORTIR SUMMARY -->
<table class="table table-striped" border="1" id="table-summary">
	<thead>
		<tr>
			 <th>Nama Paket Pekerjaan </th>
	        <th>B/K/S/J</th>
	        <th>Nilai Kontrak</th>
	        <th>Lokasi Kegiatan</th>
	        <th>Nama KPA/PA/PPK</th>
	        <th>Rekanan</th>
	        <th>Mulai</th>
	        <th>Akhir </th>
		</tr>
	</thead>
	<tbody>
		@foreach($summary as $key => $value)
		<tr>
			<td><strong>{{$key}}</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@for($x = 0; $x < count($value); $x ++)
		<tr>
			<td>{{$value[$x]->paket}}</td>
				<td>{{ Summary::ubah_jenis_pengadaan($value[$x]->jenis_pengadaan) }}</td>
				<td>{{ "Rp ".number_format($value[$x]->nilai_kontrak,0,',','.') }}</td>
				<td>{{ Convert::ubah_kab($value[$x]->lokasi) }}</td>
				<td>{{ $value[$x]->pegawai }}</td>
				<td>{{ $value[$x]->rekanan }}</td>
				<td>{{ Convert::tgl_eng_to_ind($value[$x]->tanggal_mulai) }}</td>
				<td>{{ Convert::tgl_eng_to_ind($value[$x]->tanggal_selesai) }}</td>
		</tr>
		@endfor
		@endforeach
	</tbody>
</table>

@endsection