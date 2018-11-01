@extends('layout.publicLayout')

@section('content')
	<div class="container">
		<h1 class="page-title" style="margin-top:20px;margin-bottom:20px;display:inline-block;">Detail Realisasi Keuangan SKPD Tahun {{$tahun}}</h1>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th rowspan="2">Program</th>
					<th rowspan="2">Kegiatan</th>
					<th colspan="2">Anggaran</th>
					<th rowspan="2" style="width: 150px;">Pengeluaran (Rp)</th>
					<th colspan="2">Realisasi</th>
				</tr>
				<tr>
					<th style="width: 150px;">Sebelum Perubahan</th>
					<th style="width: 150px;">Setelah Perubahan</th>
					<th>Fisik (%)</th>
					<th>Uang (%)</th>
				</tr>
			</thead>
			<tbody style="font-size: 14px;">
				@foreach($Kegiatan as $program => $kegiatan)
					{{-- */ $head_program = '<td rowspan="' . count( $kegiatan ) . '">' . $program . '</td>'; /* --}}
					@foreach($kegiatan as $key => $value)
						<tr>
							{{ $head_program }}
							<td>{{ $value->kegiatan }}</td>
							<td>{{ "Rp ".number_format($value->pagu_awal,0,',','.'); }}</td>
							<td>{{ "Rp ".number_format($value->pagu_perubahan,0,',','.'); }}</td>
							<td>{{ "Rp ".number_format($value->pengeluaran,0,',','.'); }}</td>
							<td>{{ str_replace('.', ',', $value->fisik) }}</td>
							<td>{{ str_replace('.', ',', $value->uang) }}</td>
						</tr>
						{{-- */ $head_program = ''; /* --}}
					@endforeach
				@endforeach
				<tr style="background: #f1f1f1;">
					<td colspan="2"><b>Total</b></td>
					<td> {{ "Rp ".number_format(Kegiatan::hitungPaguAwal($skpd_id,$tahun_id),0,',','.'); }} </td>
					<td> {{ "Rp ".number_format(Kegiatan::hitungPaguPerubahan($skpd_id,$tahun_id),0,',','.'); }} </td>
					<td> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan),0,',','.'); }} </td>
					<td> {{ round(Kegiatan::hitungTotalFisik($skpd_id, $tahun_id, $bulan),2) }} </td>
					<td> {{ round(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan) / Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id) * 100, 2) }}  </td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection