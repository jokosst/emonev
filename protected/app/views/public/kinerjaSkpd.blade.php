@extends('layout.publicLayout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-title" style="margin-top:20px;">Deviasi Keuangan Perangkat Daerah Tahun {{$tahun}}</h1>
				<form action="" class="form-inline" method="GET" role="form">
					<div class="form-group">
						<label for="">Tahun</label>
						<select name="tahun_id" class="form-control">
							<!-- Menampilkan Semua SKPD -->
							@foreach($listTahun as $tahun)
								<option @if($tahun_id == "$tahun->id") selected @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">Bulan</label>
						<select name="bulan" class="form-control" required>
							<option value="">------ Pilih Bulan ----------</option>
							<!-- Menampilkan Semua Tahun -->
							<option @if($bulan == "1") selected  @endif value="1">Januari</option>
							<option @if($bulan == "2") selected  @endif value="2">Februari</option>
							<option @if($bulan == "3") selected  @endif value="3">Maret</option>
							<option @if($bulan == "4") selected  @endif value="4">April</option>
							<option @if($bulan == "5") selected  @endif value="5">Mei</option>
							<option @if($bulan == "6") selected  @endif value="6">Juni</option>
							<option @if($bulan == "7") selected  @endif value="7">Juli</option>
							<option @if($bulan == "8") selected  @endif value="8">Agustus</option>
							<option @if($bulan == "9") selected  @endif value="9">September</option>
							<option @if($bulan == "10") selected  @endif value="10">Oktober</option>
							<option @if($bulan == "11") selected  @endif value="11">November</option>
							<option @if($bulan == "12") selected  @endif value="12">Desember</option>
						</select>
					</div>
					<button type="submit" class="btn btn-sortir">Submit</button>
				</form>
				@foreach($Grup as $grup)
				<div class="realisasi-box">
					<h2 class="realisasi-title realisasi-{{strtolower($grup->grup)}}">{{$grup->grup." - ".count($DataDeviasi[$grup->grup])." Perangkat Daerah<span> > ".$grup->batas_bawah."% <= ".$grup->batas_atas." %</span>"}}</h2>
					@if(count($DataDeviasi) > 0)
						<ul class="realisasi-list">
							@foreach($DataDeviasi[$grup->grup] as $key => $deviasi)
								<li>{{$key+1 .". ".$deviasi->skpd." <b>".$deviasi->deviasi." %</b>"}}</li>
							@endforeach
						</ul>
					@endif
				</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection