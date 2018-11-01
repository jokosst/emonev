<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		html {
			margin: 20px;
		}
		.table-rfk-pdf {
			font-size: 8px;
		}
		table {
		    border-collapse: collapse;
		}

		table, th, td {
		    border: 1px solid black;
		    padding-left: 5px;
		}
	</style>
</head>
<body>
	<h3 style="text-align:center;">REKAPITULASI LAPORAN REALISASI FISIK DAN KEUANGAN PELAKSANAAN KEGIATAN PEMBANGUNAN KABUPATEN SANGGAU TAHUN ANGGARAN {{$tahun->tahun}} KEADAAN BULAN {{strtoupper(Convert::ubah_bulan($bulan)) }}</h3>
	<table class="table-rfk-pdf">
		<thead>
			<tr>
				<th rowspan="2">Kode Rekening</th>
				<th rowspan="2" style="width: 80px;">Program</th>
				<th rowspan="2">Kegiatan</th>
				<th rowspan="2" style="width: 65px;">Belanja Menurut DIPA/DPA Sebelum Perubahan</th>
				<th rowspan="2" style="width: 65px;">Belanja Menutut DIPA/DPA Sesudah Perubahan</th>
				<th rowspan="2">Bobot</th>
				<th rowspan="2">Nilai Kontrak Swakelola</th>
				<th colspan="3">Realisasi Fisik</th>
				<th colspan="4">Realisasi Keuangan</th>
				<th rowspan="2">Persentase Keuangan</th>
			</tr>
		<tr>
			<th>Rencana</th>
			<th>Realisasi</th>
			<th>Tertimbang</th>
			<th style="width: 65px;">Nilai SKO/SPD</th>
			<th style="width: 65px;">Nilai SPM/SP2D</th>
			<th style="width: 65px;">Realisasi SPM/SP2D</th>
			<th style="width: 65px;">Pengeluaran/SPJ</th>
		</tr>
		</thead>
		<tbody>
			@foreach($Kegiatan as $kegiatan)
			<tr>
				<td>{{$kegiatan->kode_anggaran}}</td>
				<td>{{$kegiatan->program}}</td>
				<td>{{$kegiatan->kegiatan}}</td>
				<td>{{ "Rp ".number_format($kegiatan->pagu_awal,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pagu_perubahan,0,',','.'); }}</td>
				<td>{{ round(Kegiatan::hitungBobot($skpd_id,$tahun_id,$kegiatan->kegiatan)) .'%'}}</td>
				<td></td>
				<td>{{ Kegiatan::getRencanaFisik($tahun_id,$bulan) .'%'}}</td>
				<td>{{ $kegiatan->fisik .'%'}}</td>
				<td>{{ round(Kegiatan::hitungTertimbang(Kegiatan::hitungBobot($skpd_id,$tahun_id,$kegiatan->kegiatan),$kegiatan->fisik)) .'%'}}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ $kegiatan->uang .'%'}}</td>
			</tr>
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
				<td> {{ round(Kegiatan::hitungTotalPengeluaran($skpd_id,$tahun_id, $bulan) / Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id) * 100, 2).' %'  }}  </td>
			</tr>
		</tbody>
	</table>

	<div style="margin-left: 700px; margin-top: 20px; page-break-inside: avoid;">
		<div>{{$lokasi}}, {{ $tanggal }}</div>
		<div style="margin-bottom: 50px;">{{$jabatan}}</div>
		<div style="text-decoration: underline;">{{$pegawai}}</div>
		<div>NIP. {{$nip}}</div>
	</div>
</body>
</html>