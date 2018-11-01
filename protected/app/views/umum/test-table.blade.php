<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test Table</title>
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama SKPD</th>
				<th>Kegiatan</th>
			</tr>
		</thead>
		<tbody>
			<?php $counter = 1; ?>
			@foreach($skpd as $index_skpd => $item_skpd)
				@foreach($kegiatan_skpd[$item_skpd->id] as $index_kegiatan => $item_kegiatan)
					@if ($index_kegiatan == 0)
					<tr valign="top">
						<td rowspan="{{ count($kegiatan_skpd[$item_skpd->id]) }}">{{ $counter }}</td>
						<td rowspan="{{ count($kegiatan_skpd[$item_skpd->id]) }}">{{ $item_skpd->skpd }}</td>
						<td>{{ $item_kegiatan->kegiatan }}</td>
					</tr>
					<?php $counter++; ?>
					@else
					<tr>
						<td>{{ $item_kegiatan->kegiatan }}</td>
					</tr>
					@endif
				@endforeach
			@endforeach
		</tbody>
	</table>
</body>
</html>