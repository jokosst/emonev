<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		td {
		    wrap-text:true;
		}
	</style>
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th>Nama Program</th>
				<th>Nama Kegiatan</th>
				<th>Kode Kegiatan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($program as $index_program => $value_program)
				@foreach($kegiatan[$value_program->id] as $index_kegiatan => $value_kegiatan)
					@if($index_kegiatan == 0)
					<tr valign="top">
						<td rowspan="{{ count($kegiatan[$value_program->id]) }}"> {{ $value_program->program }} </td>
						<td>{{ $value_kegiatan->kegiatan }}</td>
						<td>{{ $value_kegiatan->kode_anggaran }}</td>
					</tr>
					@else
					<tr>
						<td>{{ $value_kegiatan->kegiatan }}</td>
						<td>{{ $value_kegiatan->kode_anggaran }}</td>
					</tr>
					@endif
				@endforeach
			@endforeach
		</tbody>
	</table>

</body>
</html>