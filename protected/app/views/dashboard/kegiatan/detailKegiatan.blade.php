@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Kegiatan</h2>
	<a href="{{URL::to('emonevpanel/kegiatan/create')}}" class="btn btn-primary" style="float:right;">Tambah Kegiatan</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Nama Program</b></p>
				<p><b>Nama Kegiatan</b></p>
				<p><b>Nama Perangkat Daerah</b></p>
				<p><b>Lokasi</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Pagu</b></p>
				<p><b>Kode Anggaran</b></p>
				<p><b>Jenis Belanja</b></p>
				<p><b>Sumber Dana</b></p>
				<p><b>Nama PA/KPA/PPK</b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$kegiatan->program->program}}</p>
				<p><span>:</span> {{$kegiatan->kegiatan}}</p>
				<p><span>:</span> {{$kegiatan->skpd->skpd}}</p>
				<p><span>:</span> Kabupaten Sanggau</p>
				<p><span>:</span> {{$kegiatan->tahun->tahun}}</p>
				<p><span>:</span> {{ "Rp ".number_format($kegiatan->pagu,0,',','.'); }}</p>
				<p><span>:</span> {{$kegiatan->kode_anggaran}}</p>
				<p><span>:</span> {{Convert::ubah_jenis_belanja($kegiatan->jenis_belanja)}}</p>
				<p><span>:</span> {{$kegiatan->sumber_dana}}</p>
				<p><span>:</span> {{$kegiatan->pegawai->pegawai}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/kegiatan/edit/'.$kegiatan->id)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Kegiatan</a>
		</div>
	</div>
@endsection