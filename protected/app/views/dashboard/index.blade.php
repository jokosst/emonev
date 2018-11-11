@extends('layout.dashboardLayout')

@section('content')


	<h2 class="menu__header">Selamat Datang</h2>
	<div class="row">
		<div class="col-md-4">
			<div class="box__section">
				<h3>{{Auth::user()->pegawai->pegawai}}</h3>
				<p style="margin-bottom:0;"><b>Nip :</b>{{Auth::user()->pegawai->nip}}</p>
				<p><b>Level :</b> {{ucfirst(Auth::user()->level)}}</p>
			</div>
		</div>
	</div>
	
	@if(Auth::user()->level == 'adminskpd')
	<div class="row">
		<div class="col-md-6">
			<div class="box__section">
				<h3>{{Auth::user()->pegawai->skpd->skpd}}</h3>
				<p style="margin-bottom:0;"><b>Jumlah Program :</b> {{$jmlProgram}}</p>
				<p><b>Jumlah Kegiatan :</b> {{$jmlKegiatan}}</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<a href="{{URL::to('emonevpanel/copy-realisasi')}}"><div class="box__section">
				<h3>Copy Realisasi</h3>
			</div></a>
		</div>
	</div>
	@endif
	@if(Auth::user()->level != 'adminskpd')
	<div class="row">
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/skpd')}}"><div class="box__section">
				<h3>Perangkat Daerah</h3>
			</div></a>
		</div>
		<div class="col-md-2">
			<a href="{{URL::to('emonevpanel/lokasi')}}"><div class="box__section">
				<h3>Lokasi</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/tahun-baru')}}"><div class="box__section">
				<h3>Tahun Baru</h3>
			</div></a>
		</div>
		<div class="col-md-4">
			<a href="{{URL::to('emonevpanel/realisasi')}}"><div class="box__section">
				<h3>Realisasi Keuangan</h3>
			</div></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<a href="{{URL::to('emonevpanel/anggaran-perubahan')}}"><div class="box__section">
				<h3>Tetapkan Anggaran Perubahan</h3>
			</div></a>
		</div>
	</div>


	<div class="row">
	</div>
	@endif
	
@endsection