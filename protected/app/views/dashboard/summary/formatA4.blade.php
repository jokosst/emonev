@extends('layout.dashboardLayout')

@section('content')
<style>
	#wrapper {
		width: 1000px;
	}
	#table-format {
		font-size: 14px;
	}
	#table-format td b.nama-skpd{
		font-size: 16px;
	}
</style>
<h2 class="menu__header">Format A4</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom:30px;" class="form-inline" method="GET" role="form" data-toggle="validator">
	<legend>Sortir Summary</legend>
	<!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
	@if(Auth::user()->level != 'adminskpd')
	<div class="form-group">
		<label for="">Perangkat Daerah</label>
			<select name="skpd_id" class="form-control" required>
				<option value="">------ Pilih Perangkat Daerah ----------</option>
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
		<tr class="summary classheader">
			<th>No</th>
			<th>Nama Paket Pekerjaan</th>
			<th>Pagu Paket (Rp)</th>
			<th>Sumber Dana</th>
			<th>Lokasi Kegiatan</th>
			<th><span>Metode <br /> Pengadaan</span></th>
			<th>Nama KPA/PPK/PA</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>1</strong></td>
			<td><strong>Konstruksi (K)</strong></td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($konstruksi as $key => $value)
		<tr>
			<td>-</td>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{$value->sumber_dana}}</td>
			<td>{{$value->lokasi}}</td>
			<td>{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td>{{$value->pegawai}}</td>
		<tr>
		@endforeach
		<tr>
			<td><strong>2</strong></td>
			<td><strong>Barang (B)</strong></td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($barang as $key => $value)
		<tr>
			<td>-</td>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{$value->sumber_dana}}</td>
			<td>{{$value->lokasi}}</td>
			<td>{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td>{{$value->pegawai}}</td>
		<tr>
		@endforeach
		<tr>
			<td><strong>3</strong></td>
			<td><strong>Konsultasi (S)</strong></td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($konsultan as $key => $value)
		<tr>
			<td>-</td>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{$value->sumber_dana}}</td>
			<td>{{$value->lokasi}}</td>
			<td>{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td>{{$value->pegawai}}</td>
		<tr>
		@endforeach
		<tr>
			<td><strong>4</strong></td>
			<td><strong>Jasa Lainnya (J)</strong></td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($lainnya as $key => $value)
		<tr>
			<td>-</td>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{$value->sumber_dana}}</td>
			<td>{{$value->lokasi}}</td>
			<td>{{Convert::ubah_tanda_strip($value->metode)}}</td>
			<td>{{$value->pegawai}}</td>
		<tr>
		@endforeach
	</tbody>
</table>
@endsection