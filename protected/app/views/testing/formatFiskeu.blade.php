@extends('layout.dashboardLayout')

@section('content')
	<style>
		#wrapper {
			/*width: 1580px;*/
		}
		#table-format {
			font-size: 12px;
		}
		#table-format td b.nama-skpd{
			font-size: 16px;
		}
	</style>
		<h2 class="menu__header">Format Fisik Keuangan</h2>
		<form class="form-inline" action="" method="GET" role="form" data-toggle="validator" style="margin-bottom:30px;">
		  <!-- Jika selain adminskpd (root || superadmin) -->
			@if(Auth::user()->level != 'adminskpd')
				<div class="form-group">
					<label for="" style="width:50px;">SKPD</label>
					<select name="skpd_id" class="form-control" required>
						<option value="1">------ Semua SKPD ----------</option>
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
					<input type="text" class="form-control" value="{{$Skpd->skpd}}" disabled>
					<input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
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

		<!-- END Form sortir -->
		<table class="table table-striped" id="table-format" border="1">
			<thead>
				<tr>
					<th rowspan="2">SKPD</th>
					<th rowspan="2">Program</th>
					<th rowspan="2">Kegiatan</th>
					<th colspan="2">Anggaran</th>
					<th rowspan="2">Pengeluaran (Rp)</th>
					<th colspan="2">Realisasi</th>
				</tr>
				<tr>
					<th>Sebelum Perubahan</th>
					<th>Setelah Perubahan</th>
					<th>Fisik (%)</th>
					<th>Uang (%)</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $Skpd as $item_Skpd)
					@if ( isset($Kegiatan[$item_Skpd->id]) )
						{{-- */ $head_skpd = '<td rowspan="' . (count( $Kegiatan[$item_Skpd->id], COUNT_RECURSIVE ) - count( $Kegiatan[$item_Skpd->id] )) . '"><b class="nama-skpd">' . $item_Skpd->skpd . '</b></td>'; /* --}}
						@foreach( $Program[$item_Skpd->id] as $item_Program)
								{{-- */ $head_program = '<td rowspan="' . count( $Kegiatan[$item_Skpd->id][$item_Program->id] ) . '">' . $item_Program->program . '</td>'; /* --}}
								@foreach( $Kegiatan[$item_Skpd->id][$item_Program->id] as $item_Kegiatan )
									<tr>
										{{ $head_skpd }}
										{{ $head_program }}
										<td>{{ $item_Kegiatan->kegiatan }}</td>
										<td>{{ "Rp ".number_format($item_Kegiatan->pagu_awal,0,',','.'); }}</td>
										<td>{{ "Rp ".number_format($item_Kegiatan->pagu_perubahan,0,',','.'); }}</td>
										<td>{{ "Rp ".number_format($item_Kegiatan->pengeluaran,0,',','.'); }}</td>
										<td>{{ $item_Kegiatan->fisik }}</td>
										<td>{{ $item_Kegiatan->uang }}</td>
									</tr>
									{{-- */ $head_skpd = ''; /* --}}
									{{-- */ $head_program = ''; /* --}}
								@endforeach
						@endforeach
					@endif
				@endforeach
			</tbody>
		</table>
@endsection
