<table class="table table-bordered table-striped" style="margin-top:20px;">
	<thead>
		<tr>
			<th>Title (%)</th>
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
				<td>{{ str_replace('.', ',', $value) }}</td>
				@endforeach

				@for($i = count($series_content['data']); $i < 12; $i++)
				<td></td>
				@endfor
			</tr>
			@endforeach
		</tr>
	</tbody>
</table>