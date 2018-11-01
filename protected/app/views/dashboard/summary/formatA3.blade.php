@extends('layout.dashboardLayout')

@section('content')

<style>
	#wrapper {min-width: 1200px;}
</style>

<h2 class="menu__header">Format A3</h2>

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
			<th width="200px" rowspan="3">Lokasi Kegiatan (Kabupaten / Kecamatan)</th>
			<th rowspan="2" colspan="2">Total</th>
			<th colspan="8">Sumber Dana</th>
			<th colspan="12">Metode Pengadaan (BL Non Pegawai)</th>
		</tr>
		<tr>
			<th colspan="2">APBD</th>
			<th colspan="2">APBN</th>
			<th colspan="2">APBD-P</th>
			<th colspan="2">APBN-P</th>
			<th colspan="2">LU/SU/LT</th>
			<th colspan="2">LS/PML/SS</th>
			<th colspan="2">PL</th>
			<th colspan="2">SY</th>
			<th colspan="2">PK/E-Purchasing</th>
			<th colspan="2">SWA</th>
		</tr>
		<tr>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
			<th>Pkt</th>
			<th>Rp (M)</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>Total Pagu Paket</strong></td>
			<td>{{ $total_paket->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguPaket) }}</td>
			<td>{{ $total_paket->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguAPBD) }}</td>
			<td>{{ $total_paket->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguAPBN) }}</td>
			<td>{{ $total_paket->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguAPBD_P) }}</td>
			<td>{{ $total_paket->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguAPBN_P) }}</td>
			<td>{{ $total_paket->jmlMetode1 }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguMetode1) }}</td>
			<td>{{ $total_paket->jmlMetode2 }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguMetode2) }}</td>
			<td>{{ $total_paket->jmlMetode3 }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguMetode3) }}</td>
			<td>{{ $total_paket->jmlMetode4 }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguMetode4) }}</td>
			<td>{{ $total_paket->jmlMetode5 }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguMetode5) }}</td>
			<td>{{ $total_paket->jmlMetode6 }}</td>
			<td>{{ Summary::ubah_milyar($total_paket->paguMetode6) }}</td>
		</tr>
		<tr>
			<td><strong>Belanja Tidak Langsung</strong></td>
			<td>{{ $BTL->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($BTL->paguPaket) }}</td>
			<td>{{ $BTL->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($BTL->paguAPBD) }}</td>
			<td>{{ $BTL->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($BTL->paguAPBN) }}</td>
			<td>{{ $BTL->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($BTL->paguAPBD_P) }}</td>
			<td>{{ $BTL->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($BTL->paguAPBN_P) }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td>A. Pegawai</td>
			<td>{{ $BTLP->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($BTLP->paguPaket) }}</td>
			<td>{{ $BTLP->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($BTLP->paguAPBD) }}</td>
			<td>{{ $BTLP->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($BTLP->paguAPBN) }}</td>
			<td>{{ $BTLP->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($BTLP->paguAPBD_P) }}</td>
			<td>{{ $BTLP->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($BTLP->paguAPBN_P) }}</td>
			<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
		</tr>
		<tr>
			<td><strong>Belanja Langsung (BL)</strong></td>
			<td>{{ $BL->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguPaket) }}</td>
			<td>{{ $BL->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguAPBD) }}</td>
			<td>{{ $BL->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguAPBN) }}</td>
			<td>{{ $BL->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguAPBD_P) }}</td>
			<td>{{ $BL->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguAPBN_P) }}</td>
			<td>{{ $BL->jmlMetode1 }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguMetode1) }}</td>
			<td>{{ $BL->jmlMetode2 }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguMetode2) }}</td>
			<td>{{ $BL->jmlMetode3 }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguMetode3) }}</td>
			<td>{{ $BL->jmlMetode4 }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguMetode4) }}</td>
			<td>{{ $BL->jmlMetode5 }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguMetode5) }}</td>
			<td>{{ $BL->jmlMetode6 }}</td>
			<td>{{ Summary::ubah_milyar($BL->paguMetode6) }}</td>
		</tr>
		<tr>
			<td>Belanja Pegawai</td>
			<td>{{ $BLP->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguPaket) }}</td>
			<td>{{ $BLP->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguAPBD) }}</td>
			<td>{{ $BLP->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguAPBN) }}</td>
			<td>{{ $BLP->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguAPBD_P) }}</td>
			<td>{{ $BLP->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguAPBN_P) }}</td>
			<td>{{ $BLP->jmlMetode1 }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguMetode1) }}</td>
			<td>{{ $BLP->jmlMetode2 }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguMetode2) }}</td>
			<td>{{ $BLP->jmlMetode3 }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguMetode3) }}</td>
			<td>{{ $BLP->jmlMetode4 }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguMetode4) }}</td>
			<td>{{ $BLP->jmlMetode5 }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguMetode5) }}</td>
			<td>{{ $BLP->jmlMetode6 }}</td>
			<td>{{ Summary::ubah_milyar($BLP->paguMetode6) }}</td>
		</tr>
		<tr>
			<td>Belanja Non Pegawai</td>
			<td>{{ $BLNP->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguPaket) }}</td>
			<td>{{ $BLNP->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguAPBD) }}</td>
			<td>{{ $BLNP->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguAPBN) }}</td>
			<td>{{ $BLNP->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguAPBD_P) }}</td>
			<td>{{ $BLNP->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguAPBN_P) }}</td>
			<td>{{ $BLNP->jmlMetode1 }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguMetode1) }}</td>
			<td>{{ $BLNP->jmlMetode2 }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguMetode2) }}</td>
			<td>{{ $BLNP->jmlMetode3 }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguMetode3) }}</td>
			<td>{{ $BLNP->jmlMetode4 }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguMetode4) }}</td>
			<td>{{ $BLNP->jmlMetode5 }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguMetode5) }}</td>
			<td>{{ $BLNP->jmlMetode6 }}</td>
			<td>{{ Summary::ubah_milyar($BLNP->paguMetode6) }}</td>
		</tr>
		@foreach($Lokasi as $key => $lokasi)
		<tr>
			<td><strong>{{$key}}</strong></td>
			<td>{{ $lokasi[0]->jmlPaket }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguPaket) }}</td>
			<td>{{ $lokasi[0]->jmlAPBD }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguAPBD) }}</td>
			<td>{{ $lokasi[0]->jmlAPBN }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguAPBN) }}</td>
			<td>{{ $lokasi[0]->jmlAPBD_P }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguAPBD_P) }}</td>
			<td>{{ $lokasi[0]->jmlAPBN_P }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguAPBN_P) }}</td>
			<td>{{ $lokasi[0]->jmlMetode1 }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguMetode1) }}</td>
			<td>{{ $lokasi[0]->jmlMetode2 }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguMetode2) }}</td>
			<td>{{ $lokasi[0]->jmlMetode3 }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguMetode3) }}</td>
			<td>{{ $lokasi[0]->jmlMetode4 }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguMetode4) }}</td>
			<td>{{ $lokasi[0]->jmlMetode5 }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguMetode5) }}</td>
			<td>{{ $lokasi[0]->jmlMetode6 }}</td>
			<td>{{ Summary::ubah_milyar($lokasi[0]->paguMetode6) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection