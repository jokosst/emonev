@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Paket Tender</h2>
	<a href="{{URL::to('emonevpanel/paket-lelang/update')}}" class="btn btn-primary" style="float:right;margin-top:10px;">Tambah Paket Tender</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Nama Perangkat Daerah</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Nama Kegiatan</b></p>
				<p><b>Nama Paket</b></p>
				<p><b>HPS</b></p>
				<p><b>Nomor Kontak</b></p>
				<p><b>tgl_bast</b></p>
				<p><b>Status</b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$lelang->skpd->skpd}}</p>
				<p><span>:</span> {{$lelang->tahun->tahun}}</p>
				<p><span>:</span> {{$lelang->kegiatan->kegiatan}}</p>
				<p><span>:</span> {{$lelang->paket->paket}}</p>
				<p><span>:</span> {{$lelang->hps}}</p>
				<p><span>:</span> {{$lelang->nomor_kontak}}</p>
				<p><span>:</span> {{$lelang->tgl_bast}}</p>
				<p><span>:</span> {{Convert::ubah_tanda_strip($lelang->status)}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/paket-lelang/edit/'.$lelang->id)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Paket Tender</a>
		</div>
	</div>
@endsection