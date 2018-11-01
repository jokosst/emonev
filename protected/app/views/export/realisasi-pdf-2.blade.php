<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.table-rfk-pdf {
			font-size: 10px;
		}
	</style>
</head>
<body>
	<table border="1" class="table-rfk-pdf">
		<thead>
			<tr>
				<th rowspan="2">Kode Rekening</th>
				<th rowspan="2">Program</th>
				<th rowspan="2">Kegiatan</th>
				<th rowspan="2">Belanja Menurut DIPA/DPA Sebelum Perubahan</th>
				<th rowspan="2">Belanja Menutut DIPA/DPA Sesudah Perubahan</th>
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
			<th>Nilai SKO/SPD</th>
			<th>Nilai SPM/SP2D</th>
			<th>Realisasi SPM/SP2D</th>
			<th>Pengeluaran/SPJ</th>
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
				<td></td>
				<td></td>
				<td></td>
				<td>{{ $kegiatan->fisik }}</td>
				<td></td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ "Rp ".number_format($kegiatan->pengeluaran,0,',','.'); }}</td>
				<td>{{ $kegiatan->uang }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>