@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Daftar Paket</h2>
	<a href="{{URL::to('emonevpanel/paket/create')}}" class="btn btn-primary" style="float:right;">Tambah Paket</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Nama Perangkat Daerah</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Nama Program</b></p>
				<p><b>Nama Kegiatan</b></p>
				<p><b>Nama Paket</b></p>
				<p><b>PA/KPA/PPK</b></p>
				<p><b>Pagu Kegiatan</b></p>
				<p><b>Pagu Paket</b></p>
				<p><b>Anggaran Paket</b></p>
				<p><b>Volume</b></p>
				<p><b>Hasil Kegiatan</b></p>
				<p><b>Kualifikasi Lelang</b></p>
				<p><b>Jenis Belanja</b></p>
				<p><b>Metode</b></p>
				<p><b>pemilihan penyedia</b></p>
				<p><b>Jenis Pengadaan</b></p>
				<p><b>Lokasi</b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$paket->skpd->skpd}}</p>
				<p><span>:</span> {{$paket->tahun->tahun}}</p>
				<p><span>:</span> {{$paket->kegiatan->program->program}}</p>
				<p><span>:</span> {{$paket->kegiatan->kegiatan}}</p>
				<p><span>:</span> {{$paket->paket}}</p>
				<p><span>:</span> {{$paket->kegiatan->pegawai->pegawai}}</p>
				<p><span>:</span> {{"Rp ".number_format($paket->kegiatan->pagu,0,',','.');}}</p>
				<p><span>:</span> {{$paket->pagu_paket}}</p>
				<p><span>:</span> {{$paket->kode_anggaran_paket}}</p>
				<p><span>:</span> {{$paket->volume.' '.$paket->satuan_volume}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->hasil_kegiatan)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->kualifikasi_lelang)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->jenis_belanja_paket)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->metode)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->pemilihan_penyedia)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->jenis_pengadaan)}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($paket->lokasi->lokasi)}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/daftar-paket/edit/'.$paket->id)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Daftar Paket</a>
		</div>
	</div>
@endsection