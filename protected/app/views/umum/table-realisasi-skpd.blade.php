<table border="1" cellpadding="5" cellspacing="0">
	<thead>
		<tr>
			<th>Title</th>
			@foreach($bulan as $key => $item_bulan)
			<th>{{ $item_bulan }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		<tr>
			@foreach($series as $key => $series_content)
			<tr>
				<td>{{ $series_content['name'] }}</td>
				@foreach($series_content['data'] as $value)
				<td>{{ $value }}</td>
				@endforeach
			</tr>
			@endforeach
		</tr>
	</tbody>
</table>