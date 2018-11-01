<table class="table table-bordered table-striped" style="margin-top:20px; background:#f1f1f1;">
	<thead>
		<tr>
			<th rowspan="2">Progress (%)</th>
			<th colspan="2">BTL</th>
			<th colspan="2">BL</th>
			<th colspan="2">Total</th>
		</tr>
		<tr>
			<th>Keu</th>
			<th>Fis</th>
			<th>Keu</th>
			<th>Fis</th>
			<th>Keu</th>
			<th>Fis</th>
		</tr>
	</thead>
	<tbody>
		@foreach($series as $series_content)
		<tr>
			<td>{{ $series_content['name'] }}</td>
			@foreach($series_content['data'] as $value)
			<td>{{ str_replace('.', ',', $value) }}</td>
			@endforeach
		</tr>
		@endforeach
		<tr>
			<td>Realisasi s.d {{ date('d M') }}</td>
			@foreach($total_realisasi as $value)
			<td>{{ str_replace('.', ',', $value) }}</td>
			@endforeach

			@for($i = count($total_realisasi); $i < 6; $i++)
			<td></td>
			@endfor
		</tr>
	</tbody>
</table>