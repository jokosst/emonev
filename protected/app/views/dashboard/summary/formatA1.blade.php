@extends('layout.dashboardLayout')

@section('content')

<style>
	#wrapper {min-width: 1040px;}
</style>

<h2 class="menu__header">Format A1</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom:20px;" class="form-inline" method="GET" role="form" data-toggle="validator">
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

<table border="1" id="table-summary">
	<thead>
		<tr>
			<th style="width:200px;" rowspan="2">Kegiatan</th>
			<th rowspan="2" colspan="2">Volume</th>
			<th style="width:100px;" rowspan="2">Jumlah<br>(Rp)</th>
			<th rowspan="2" class="rotate"><span>Hasil<br>(N/K)</span></th>
			<th rowspan="2" class="rotate" style="padding-top:80px;"><span style="width:35px;">Jenis Belanja<br>( BTLP/BLP/BJ/BM )</span></th>
			<th rowspan="2" class="rotate" style="padding-top:70px;"><span style="width:75px;">Metode Pengadaan<br>(LU/SU/LT/PML/LS/SS/PL/<br>PK/SWAT/SWAP/<br>SY/E-Purchasing)</span></th>
			<th rowspan="2" class="rotate" style="padding-top:80px;"><span style="width:35px;">Jenis Pengadaan<br>(B/K/S/J)</span></th>
			<th rowspan="2">Lokasi Kegiatan</th>
			<th colspan="4">Sumber Dana</th>
			<th rowspan="2">Nama KPA/PPK/PA</th>
		</tr>
		<tr>
			<th class="rotate" style="padding-top:20px;"><span style="width:15px;">APBD</span></th>
			<th class="rotate" style="padding-top:20px;"><span style="width:15px;">APBN</span></th>
			<th class="rotate" style="padding-top:30px;"><span style="width:15px;">APBD-P</span></th>
			<th class="rotate" style="padding-top:30px;"><span style="width:15px;">APBN-P</span></th>
		</tr>
	</thead>
	@if(Auth::user()->level == 'adminskpd' || $summary != "0" && $total_paket->jmlPaket != 0)
	<tbody>
		<tr>
			<td><strong>Total Pagu Paket</strong></td>
			<td>{{$total_paket->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($total_paket->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>I. Belanja Tidak Langsung (BTL)</strong></td>
			<td>{{$BTL->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($BTL->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>II. Belanja Langsung (BL)</strong></td>
			<td>{{$BL->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($BL->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>- Belanja Pegawai</strong></td>
			<td>{{$BLP->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($BLP->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($Kpa as $kpa)
		@if($kpa->pegawai != '')
		<tr>
			<td>&nbsp&nbsp&nbsp{{$kpa->pegawai}}</td>
			<td>{{$kpa->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kpa->paguPaket,0,',','.'); }}</td>
			<td>NK</td>
			<td>BLP</td>
			<td>-</td><td>-</td><td>-</td>
			<td>@if($kpa->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($kpa->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($kpa->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($kpa->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$kpa->pegawai}}</td>
		</tr>
		@endif
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>- Belanja Langsung Non Pegawai</strong></td>
			<td>{{$BLNP->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($BLNP->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>A. KONTRAKTUAL</strong></td>
			<td>{{$kontraktual->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kontraktual->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>1. Lelang Umum/Seleksi Umum/Lelang Terbatas (LU/SU/LT)</strong></td>
			<td>{{$kontraktual1->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kontraktual1->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataKontraktual1 as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>2. Lelang Sederhana/Pemilihan Langsung/Seleksi Sederhana(LS/PML/SS)</strong></td>
			<td>{{$kontraktual2->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kontraktual2->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataKontraktual2 as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>3. Penunjukan Langsung (PL)</strong></td>
			<td>{{$kontraktual3->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kontraktual3->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataKontraktual3 as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>4. Sayembara / Kontes (SY)</strong></td>
			<td>{{$kontraktual4->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kontraktual4->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataKontraktual4 as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>5. Pengadaan Langsung / E-Purchasing (PK/e-purchasing)</strong></td>
			<td>{{$kontraktual5->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($kontraktual5->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataKontraktual5 as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>B. SWAKELOLA</strong></td>
			<td>{{$swakelola->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($swakelola->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>1. Rutin Kantor (SWAT)</strong></td>
			<td>{{$swakelola_rutin->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($swakelola_rutin->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataSwakelola_rutin as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td><strong>2. Program (SWAP)</strong></td>
			<td>{{$swakelola_program->jmlPaket}}</td><td>Paket</td>
			<td>{{ "Rp ".number_format($swakelola_program->paguPaket,0,',','.'); }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		@foreach($dataSwakelola_program as $data)
		<tr>
			<td>{{$data->paket}}</td>
			<td>{{$data->volume}}</td><td>{{$data->satuan_volume}}</td>
			<td>{{$data->pagu_paket}}</td>
			<td>{{Summary::ubah_hasil_kegiatan($data->hasil_kegiatan)}}</td>
			<td>{{Summary::ubah_jenis_belanja_paket($data->jenis_belanja_paket)}}</td>
			<td>{{Summary::ubah_metode_pengadaan($data->metode)}}</td>
			<td>{{Summary::ubah_jenis_pengadaan($data->jenis_pengadaan)}}</td>
			<td>{{Convert::ubah_kab($data->lokasi) }}</td>
			<td>@if($data->sumber_dana == 'APBD') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBD-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>@if($data->sumber_dana == 'APBN-P') <i class="fa fa-check"></i> @else - @endif</td>
			<td>{{$data->pegawai}}</td>
		</tr>
		@endforeach
		<tr style="background:#f1f1f1;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
	@endif
	</tbody>
</table>

@endsection