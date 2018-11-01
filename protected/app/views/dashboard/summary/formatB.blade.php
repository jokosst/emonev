@extends('layout.dashboardLayout')

@section('content')

<style>
	#wrapper {min-width: 1400px;}
</style>

<h2 class="menu__header">Format B</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom:20px;" class="form-inline" method="GET" role="form" data-toggle="validator">
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
<div class="keterangan-warna" style="margin-bottom:20px;">
	<h4>Keterangan Warna</h4>
	<span style="background:#2196F3">Biru: Lelang Sudah Selesai</span>
	<span style="background:#009688">Hijau: Lelang Sedang Berjalan</span>
	<span style="background:#FFAB00">Kuning: Belum Siap Lelang</span>
	<span style="background:#795548">Coklat: Lelang Ulang</span>
	<span style="background:#F44336">Merah: Lelang Gagal</span>
</div>
<table class="table table-striped" border="1" id="table-summary">
	<thead>
		<tr>
			<th rowspan="2" style="width:150px;">Paket Pekerjaan</th>
			<th rowspan="2">Pagu <br /> Rp.</th>
			<th rowspan="2">HPS <br /> Rp.</th>
			<th rowspan="2">Kualifikasi <br /> (Kecil / Non Kecil)</th>
			<th rowspan="2">Kode Bidang / <br /> Sub Bidang</th>
			<th rowspan="2">Produk Akhir</th>
			<th rowspan="2">Alamat <br />Pendaftaran</th>
			<th rowspan="2">Detail<br />Lokasi</th>
			<th rowspan="2">Nama KPA/PPK/PA</th>
			<th rowspan="2">Metode Pengadaan</th>
			<th rowspan="2" style="width:50px;">Sumber Dana</th>
			<th rowspan="2">Proses <br> Pengadaan</th>
			<th colspan="5">Status</th>
		</tr>
		<tr>
			<th style="background:#2196F3; color:white;">B</th>
			<th style="background:#009688; color:white;">H</th>
			<th style="background:#FFAB00; color:white;">K</th>
			<th style="background:#795548; color:white;">C</th>
			<th style="background:#F44336; color:white;">M</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>A. Konstruksi (K)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($konstruksi as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{ "Rp ".number_format($value->nilai_hps)}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>B. Barang (B)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($barang as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{ "Rp ".number_format($value->nilai_hps)}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>C. Konsultasi (S)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($konsultan as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{ "Rp ".number_format($value->nilai_hps)}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>D. Jasa Lainnya (J)</strong></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@foreach($lainnya as $key => $value)
		<tr>
			<td>{{$value->paket}}</td>
			<td>{{ "Rp ".number_format($value->nilai_pagu_paket,0,',','.'); }}</td>
			<td>{{ "Rp ".number_format($value->nilai_hps)}}</td>
			<td>{{ Convert::ubah_tanda_strip($value->kualifikasi_lelang) }}</td>
			<td>{{ $value->kode_bidang }}</td>
			<td>{{ $value->produk_akhir }}</td>
			<td>{{ $value->tempat_daftar }}</td>
			<td>{{ Convert::ubah_kab($value->lokasi) }}</td>
			<td>{{ $value->pegawai }}</td>
			<td>{{ Convert::ubah_tanda_strip($value->metode) }}</td>
			<td>{{ $value->sumber_dana }}</td>
			<td>{{ $value->jenis_proses_lelang}}</td>
			<td>@if($value->status == 'lelang-sudah-selesai') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-sedang-berjalan') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'belum-siap-lelang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-ulang') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($value->status == 'lelang-gagal') <i class="fa fa-check"></i> @else - @endif</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection