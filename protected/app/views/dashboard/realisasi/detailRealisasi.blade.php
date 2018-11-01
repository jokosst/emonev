@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Realisasi</h2>
	<a href="{{URL::to('emonevpanel/realisasi/create')}}" class="btn btn-primary" style="float:right;">Tambah Realisasi</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Nama Perangkat Daerah</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Nama Program</b></p>
				<p><b>Nama Kegiatan</b></p>
				<p><b>Bulan</b></p>
				<p><b>Pagu</b></p>
				<p><b>Pengeluaran</b></p>
				<p><b>Fisik</b></p>
				<p><b>Uang</b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$realisasi->skpd->skpd}}</p>
				<p><span>:</span> {{$realisasi->tahun->tahun}}</p>
				<p><span>:</span> @if($realisasi->kegiatan->program != '') {{$realisasi->kegiatan->program->program}} @endif</p>
				<p><span>:</span> {{$realisasi->kegiatan->kegiatan}}</p>
				<p><span>:</span> {{ Convert::ubah_bulan($realisasi->bulan) }}</p>
				<p><span>:</span> {{ "Rp ".number_format($realisasi->kegiatan->pagu,0,',','.'); }}</p>
				<p><span>:</span> {{ "Rp ".number_format($realisasi->pengeluaran,0,',','.'); }}</p>
				<p><span>:</span> {{$realisasi->fisik." %"}}</p>
				<p><span>:</span> {{$realisasi->uang." %"}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/realisasi/edit/'.$realisasi->id)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Realisasi</a>
		</div>
	</div>
@endsection