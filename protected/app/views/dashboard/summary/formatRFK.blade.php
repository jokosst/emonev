@extends('layout.dashboardLayout')

@section('style')
	<link rel="stylesheet" href="{{URL::to('source/plugins/datepicker/css/datepicker.css')}}">
@endsection

@section('content')

<style>
	#wrapper {
		width: 1900px;
	}
</style>

<h2 class="menu__header">Format Fisik Keuangan</h2>
<form class="form-inline" action="" method="GET" role="form" data-toggle="validator" style="margin-bottom:30px;">
	<!-- Jika selain adminskpd (root || superadmin) -->
	@if(Auth::user()->level != 'adminskpd')
		<div class="form-group">
			<label for="" style="width:50px;">Perangkat Daerah</label>
			<select name="skpd_id" class="form-control" required>
				<option value="1">------ Semua Perangkat Daerah ----------</option>
				<!-- Menampilkan Semua SKPD -->
				@foreach($Skpd as $skpd)
					<option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
				@endforeach
			</select>
		</div>
	<!-- Jika adminskpd -->
	@else
		<!-- Menampilkan 1 SKPD -->
		<div class="form-group">
			<label for="">Perangkat Daerah</label>
			<input type="text" class="form-control" value="{{$skpdSortir->skpd}}" disabled style="width:500px;">
			<input type="hidden" name="skpd_id" value="{{$skpdSortir->id}}">
		</div>
	@endif
	<div class="row" style="margin-top:10px;">
		<div class="col-md-9">
			<!-- Input Tahun -->
			<div class="form-group">
				<label for="" style="width:50px;">Tahun</label>
				<select name="tahun_id" class="form-control" required>
					<option value="">------ Pilih Tahun ----------</option>
					<!-- Menampilkan Semua Tahun -->
					@foreach($Tahun as $tahun)
						<option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
					@endforeach
				</select>
			</div>
			<!-- END Input Tahun -->
			<!-- Input Bulan -->
			<div class="form-group">
				<label for="">Bulan</label>
				<select name="bulan_id" class="form-control" required>
					<option value="">------ Pilih Bulan ----------</option>
					<!-- Menampilkan Semua Bulan -->
					<option @if(isset($bulan_id) && $bulan_id == "1") selected  @endif value="1">Januari</option>
					<option @if(isset($bulan_id) && $bulan_id == "2") selected  @endif value="2">Februari</option>
					<option @if(isset($bulan_id) && $bulan_id == "3") selected  @endif value="3">Maret</option>
					<option @if(isset($bulan_id) && $bulan_id == "4") selected  @endif value="4">April</option>
					<option @if(isset($bulan_id) && $bulan_id == "5") selected  @endif value="5">Mei</option>
					<option @if(isset($bulan_id) && $bulan_id == "6") selected  @endif value="6">Juni</option>
					<option @if(isset($bulan_id) && $bulan_id == "7") selected  @endif value="7">Juli</option>
					<option @if(isset($bulan_id) && $bulan_id == "8") selected  @endif value="8">Agustus</option>
					<option @if(isset($bulan_id) && $bulan_id == "9") selected  @endif value="9">September</option>
					<option @if(isset($bulan_id) && $bulan_id == "10") selected  @endif value="10">Oktober</option>
					<option @if(isset($bulan_id) && $bulan_id == "11") selected  @endif value="11">November</option>
					<option @if(isset($bulan_id) && $bulan_id == "12") selected  @endif value="12">Desember</option>
				</select>
			</div>
			<!-- End Input Bulan -->
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>

<!-- Inputan Export -->
@if($skpd_id != 1)
	<div style="margin-bottom:20px;">
		<p style="color: #a94442;">Masukkan Nama Pimpinan Berwenang sebelum Download Summary RFK</p>
		<form action="{{URL::to('emonevpanel/summary/download')}}" style="width:800px;">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama PA/KPA/PPK</label>
						<input type="text" name="pegawai" placeholder="Nama Pimpinan" class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>NIP</label>
						<input type="text" name="nip" placeholder="NIP" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Jabatan</label>
						<input type="text" name="jabatan" placeholder="Jabatan" class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tanggal</label>
						<input type="text" name="tanggal" placeholder="Tanggal" class="datepicker form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Export</label>
						<select name="export" id="" class="form-control">
							<option value="pdf">PDF</option>
							<option value="excel">Excel</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Lokasi</label>
						<input type="text" name="lokasi" placeholder="Lokasi" class="form-control" required>
					</div>
				</div>
			</div>
			<input type="hidden" name="skpd_id" value="{{$skpd_id}}">
			<input type="hidden" name="tahun_id" value="{{$tahun_id}}">
			<input type="hidden" name="bulan" value="{{$bulan_id}}">
			<input type="submit" class="btn btn-success" value="Download">
		</form>
	</div>
@endif

<table border="1" id="table-summary">
	<thead>
		<tr>
			<th rowspan="2">Program</th>
			<th rowspan="2">Kode Anggaran</th>
			<th rowspan="2">Kegiatan</th>
			<th rowspan="2">Belanja Menurut DIPA/DPA Sebelum Perubahan</th>
			<th rowspan="2">Belanja Menutut DIPA/DPA Sesudah Perubahan</th>
			<th rowspan="2">Bobot</th>
			<!-- <th rowspan="2">Nilai Kontrak Swakelola</th> -->
			<th colspan="3">Realisasi Fisik</th>
			<th colspan="2">Realisasi Keuangan</th>
		</tr>
		<tr>
			<th>Rencana</th>
			<th>Realisasi</th>
			<th>Tertimbang</th>
			<th>Pengeluaran/SPJ</th>
			<th>Persentase Keuangan</th>

		</tr>
	</thead>
	@if($skpd_id != 1)
	<tbody>
        @foreach($KegiatanBtl as $value)
		<tr>
			<td colspan="3">{{$value->kegiatan}}</td>
			<td>{{ "Rp ".number_format($value->pagu_awal,0,',','.'); }}</td>
			<td>{{ "Rp ".number_format($value->pagu_perubahan,0,',','.'); }}</td>
			<td>{{ str_replace('.', ',', round(Kegiatan::hitungBobot($skpd_id,$tahun_id,$value->kegiatan),1))  }} %</td>
			<!-- <td></td> -->
			<td>{{ Kegiatan::getRencanaFisik($tahun_id,$bulan_id) }} %</td>
			<td>{{ str_replace('.', ',', $value->fisik) }} %</td>
			<td> {{ str_replace('.', ',', round(Kegiatan::hitungTertimbang(Kegiatan::hitungBobot($skpd_id,$tahun_id,$value->kegiatan),$value->fisik),2)) }} %</td>
			
			<td>{{ "Rp ".number_format($value->pengeluaran,0,',','.'); }}</td>
			<td>{{ str_replace('.', ',', $value->uang) }} %</td>
		</tr>
		@endforeach
		@foreach($Kegiatan as $program => $kegiatan)
			{{-- */ $head_program = '<td rowspan="' . count( $kegiatan ) . '">' . $program . '</td>'; /* --}}
			@foreach($kegiatan as $key => $value)
				<tr>
					{{ $head_program }}
					<td>{{ $value->kode_anggaran }}</td>
					<td>{{ $value->kegiatan }}</td>
					<td>{{ "Rp ".number_format($value->pagu_awal,0,',','.'); }}</td>
					<td>{{ "Rp ".number_format($value->pagu_perubahan,0,',','.'); }}</td>
					<td>{{ str_replace('.', ',', round(Kegiatan::hitungBobot($skpd_id,$tahun_id,$value->kegiatan),1))  }} %</td>
					<!-- <td></td> -->
					<td>{{ Kegiatan::getRencanaFisik($tahun_id,$bulan_id) }} %</td>
					<td>{{ str_replace('.', ',', $value->fisik) }} %</td>
					<td> {{ str_replace('.', ',', round(Kegiatan::hitungTertimbang(Kegiatan::hitungBobot($skpd_id,$tahun_id,$value->kegiatan),$value->fisik),2)) }} %</td>
					
					<td>{{ "Rp ".number_format($value->pengeluaran,0,',','.'); }}</td>
					<td>{{ str_replace('.', ',', $value->uang) }} %</td>
				</tr>
				{{-- */ $head_program = ''; /* --}}
			@endforeach
		@endforeach
		<tr style="background: #f1f1f1;">
			<td colspan="3"><b>Total</b></td>
			<td> {{ "Rp ".number_format(Kegiatan::hitungPaguAwal($skpd_id,$tahun_id),0,',','.'); }} </td>
			<td> {{ "Rp ".number_format(Kegiatan::hitungPaguPerubahan($skpd_id,$tahun_id),0,',','.'); }} </td>
			<td> {{ Kegiatan::hitungTotalBobot($skpd_id,$tahun_id).'%' }}</td>
			<!-- <td></td> -->
			<td></td>
			<td> {{ str_replace('.', ',', round(Kegiatan::hitungTotalFisik($skpd_id, $tahun_id, $bulan_id),2) .'%') }} </td>
			<td> {{ str_replace('.', ',', round(Kegiatan::hitungTotalTertimbang($skpd_id, $tahun_id, $bulan_id),2) .'%') }} </td>
			
			<td> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan_id),0,',','.'); }} </td>
			<td> {{ str_replace('.', ',', round(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan_id) / Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id) * 100, 2).' %') }}  </td>
			
		</tr>
	</tbody>
	@endif
</table>

@endsection

@section('script')

<script type="text/javascript" src="{{URL::to('source/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
	$('.datepicker').datepicker({
		format: "dd-mm-yyyy"
	});
</script>
@endsection