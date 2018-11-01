<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h3>REKAPITULASI LAPORAN REALISASI FISIK DAN KEUANGAN PELAKSANAAN KEGIATAN PEMBANGUNAN KABUPATEN SANGGAU TAHUN ANGGARAN {{$tahun->tahun}} KEADAAN BULAN {{strtoupper(Convert::ubah_bulan($bulan)) }}</h3>
	<table>
		<thead>
		    <tr>
		    	<th rowspan="2" style="width:20px;">Kode Rekening</th>
				<th rowspan="2" style="width:30px;">Program</th>
				<th rowspan="2" style="width:30px;">Kegiatan</th>
				<th rowspan="2" style="width:10px;">Belanja Menurut DIPA/DPA Sebelum Perubahan</th>
				<th rowspan="2" style="width:10px;">Belanja Menutut DIPA/DPA Sesudah Perubahan</th>
				<th rowspan="2">Bobot</th>
				<th rowspan="2">Nilai Kontrak Swakelola</th>
				<th colspan="3">Realisasi Fisik</th>
				<th colspan="4">Realisasi Keuangan</th>
				<th rowspan="2">Persentase Keuangan</th>
		    </tr>
		    <tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>Rencana</th>
				<th>Realisasi</th>
				<th>Tertimbang</th>
				<th>Nilai SKO/SPD</th>
				<th>Nilai SPM/SP2D</th>
				<th>Realisasi SPM/SP2D</th>
				<th>Pengeluaran/SPJ</th>
		    </tr>
		</thead>
		<tbody>
			@foreach( $Program as $program)
				{{-- */ $head_program = '<td rowspan="' . count( $Kegiatan[$program->id] ) . '">' . $program->program . '</td>'; /* --}}
				@foreach($Kegiatan[$program->id] as $kegiatan)
				<tr>
					<td>{{ $kegiatan->kode_anggaran }}</td>
					{{ $head_program }}
					<td>{{ $kegiatan->kegiatan }}</td>
					<td>{{ "Rp ".number_format($kegiatan->pagu_awal,0,',','.'); }}</td>
					<td>{{ "Rp ".number_format($kegiatan->pagu_perubahan,0,',','.'); }}</td>
					<td>{{ round(Kegiatan::hitungBobot($skpd->id,$tahun_id,$kegiatan->kegiatan)) }} %</td>
					<td></td>
					<td>{{ Kegiatan::getRencanaFisik($tahun_id,$bulan) }} %</td>
					<td>{{ $kegiatan->fisik }} %</td>
					<td> {{ round(Kegiatan::hitungTertimbang(Kegiatan::hitungBobot($skpd->id,$tahun_id,$kegiatan->kegiatan),$kegiatan->fisik)) }} %</td>
					<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
					<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
					<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
					<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
					<td>{{ $kegiatan->uang }} %</td>
	            </tr>
	            {{-- */ $head_program = '<td></td>'; /* --}}
				@endforeach
			@endforeach
			<tr style="background: #f1f1f1;">
				<td colspan="3"><b>Total</b></td>
				<td> {{ "Rp ".number_format(Kegiatan::hitungPaguAwal($skpd_id,$tahun_id),0,',','.'); }} </td>
				<td> {{ "Rp ".number_format(Kegiatan::hitungPaguPerubahan($skpd_id,$tahun_id),0,',','.'); }} </td>
				<td> {{ Kegiatan::hitungTotalBobot($skpd_id,$tahun_id).'%' }}</td>
				<td></td><td></td>
				<td> {{ round(Kegiatan::hitungTotalFisik($skpd_id, $tahun_id, $bulan),2) .'%' }} </td>
				<td> {{ round(Kegiatan::hitungTotalTertimbang($skpd_id, $tahun_id, $bulan),2) .'%' }} </td>
				<td> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan),0,',','.'); }} </td>
				<td> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan),0,',','.'); }} </td>
				<td> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan),0,',','.'); }} </td>
				<td> {{ "Rp ".number_format(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan),0,',','.'); }} </td>
				<td> {{ round(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan) / Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id) * 100, 2).' %'  }} </td>
			</tr>
		</tbody>
	</table>

	<p>{{$lokasi}}, {{ $tanggal }}</p>
	<p style="margin-bottom: 50px;">{{$jabatan}}</p>
	<p style="text-decoration: underline;">{{$pegawai}}</p>
	<p>NIP. {{$nip}}</p>

</body>
</html>