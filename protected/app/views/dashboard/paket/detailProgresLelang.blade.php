@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Detail Progres Lelang</h2>
	<a href="{{URL::to('emonevpanel/progres-lelang/create')}}" class="btn btn-primary" style="float:right;">Tambah Progres Lelang</a>
	<div class="content__block content__detail">
		<div class="row">
			<div class="col-md-2">
				<p><b>Nama Perangkat Daerah</b></p>
				<p><b>Tahun Anggaran</b></p>
				<p><b>Nama Kegiatan</b></p>
				<p><b>Nama Paket</b></p>
				<p><b>Nilai Kontrak</b></p>
				<p><b>Rekanan</b></p>
				<p><b>Tanggal Mulai</b></p>
				<p><b>Tanggal Selesai</b></p>
				<p><b>Status Kontrak</b></p>
			</div>
			<div class="col-md-10">
				<p><span>:</span> {{$progres->lelang->skpd->skpd}}</p>
				<p><span>:</span> {{$progres->tahun->tahun}}</p>
				<p><span>:</span> {{$progres->lelang->kegiatan->kegiatan}}</p>
				<p><span>:</span> {{$progres->lelang->paket->paket}}</p>
				<p><span>:</span> {{$progres->nilai_kontrak}}</p>
				<p><span>:</span> {{$progres->rekanan}}</p>
				<p><span>:</span> {{Convert::tgl_eng_to_ind($progres->tanggal_mulai)}}</p>
				<p><span>:</span> {{Convert::tgl_eng_to_ind($progres->tanggal_selesai)}}</p>
				<p><span>:</span> {{Convert::ubah_status_kontrak($progres->status_kontrak)}}</p>
			</div>
			<a href="{{URL::to('emonevpanel/progres-lelang/edit/'.$progres->id)}}" class="btn btn-warning" style="margin-top: 20px; margin-left:15px;">Edit Progres Lelang</a>
		</div>
	</div>
@endsection