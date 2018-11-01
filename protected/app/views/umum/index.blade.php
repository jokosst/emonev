@extends('layout.umumLayout')

@section('content')
<div>
	SKPD :
	{{ Form::select('skpd', $skpd, $skpd_id, array('id'=>'select-skpd')) }}
</div>
<div>
	Tahun :
	{{ Form::select('tahun', $tahun, $tahun_id, array('id'=>'select-tahun')) }}
</div>
<div>
	<button id="btn-lihat-data">Lihat Data</button>
</div>
<div id="grafik-realisasi" style="width: calc( 100% - 50px);"></div>
<div id="table-realisasi">
	{{ $table_realisasi }}
</div>
<div id="grafik-realisasi-detail" style="width: calc( 100% - 50px);"></div>
<div id="table-realisasi-bulanan">
	{{ $table_realisasi_bulanan }}
</div>
@endsection


@section('js')
{{ HTML::script('source/plugins/HighCharts/js/highcharts.js') }}
{{ HTML::script('source/plugins/HighCharts/js/modules/exporting.js') }}

<script>
	$( document ).ready( function(){
		$( '#btn-lihat-data' ).click( function(){
			getData();
		});

		$( function(){
			$( '#grafik-realisasi' ).highcharts( highcharts_config );
		});

		$( function(){
			$( '#grafik-realisasi-detail' ).highcharts( detail_highcharts_config );
		})
	});

	function getData(){
		var data = {
						tahun_id: $( '#select-tahun' ).val(),
						skpd_id: $( '#select-skpd' ).val()
					};

		$.ajax({
			url: '{{ URL::to("get-data/realisasi-skpd") }}',
			type: 'post',
			data: data,
			success: function( result ){
				highcharts_config.title.text = result.chart_title;
				highcharts_config.xAxis.categories = $.parseJSON(result.categories);
				highcharts_config.series = $.parseJSON(result.series);

				$( '#grafik-realisasi' ).highcharts( highcharts_config );
				$( '#table-realisasi' ).html( result.table_realisasi );

				detail_highcharts_config.title.text = result.chart_title;
				detail_highcharts_config.series = $.parseJSON(result.series_bulanan);

				$( '#grafik-realisasi-detail' ).highcharts( detail_highcharts_config );
				$( '#table-realisasi-bulanan' ).html( result.table_realisasi_bulanan );
			},
			error: function(){
				console.log( 'error get data!' );
			}
		});
	}

	var highcharts_config = {
		chart: {
		},
		title: {
			text: '{{ $chart_title }}'
		},
		subtitle: {
			text: 'Sumber: SKPD Kabupaten Sanggau'
		},
		xAxis: {
			categories: {{ $categories }}
		},
		yAxis: {
			title: {
				text: 'Realisasi Dalam Persentase (%)',
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}],
			labels: {
				overflow: 'justify',
			}
		},
		legend : {
			// layout: 'horizontal',
			// align: 'bottom',
			// verticalAlign: 'bottom',
			borderWidth: 1
		},
		tooltip: {
			valueSuffix: '%',
		},
		plotOptions: {
			series: {
				// pointPadding: 0,
				// groupPadding: 0.1,
				// pointWidth: 15
			}
		},
		series: {{ $series }}
	};

	var detail_highcharts_config = {
		chart: {
			type: 'column',
		},
		title: {
			text: '{{ $chart_title }}'
		},
		subtitle: {
			text: 'Sumber: SKPD Kabupaten Sanggau'
		},
		xAxis: {
			categories: ['BTL Keu', 'BTL Fis', 'BL Keu', 'BL Fis', 'Total Keu', 'Total Fis']
		},
		yAxis: {
			title: {
				text: 'Data Dalam Persentase (%)',
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}],
			labels: {
				overflow: 'justify',
			},
			stackLabels: {
				enabled: true,
				style: {
					fontWeight: 'bold'
				}
			}
		},
		legend : {
			// layout: 'horizontal',
			// align: 'bottom',
			// verticalAlign: 'bottom',
			borderWidth: 1
		},
		tooltip: {
			valueSuffix: '%',
		},
		plotOptions: {
			series: {
				// pointPadding: 0,
				// groupPadding: 0.1,
				// pointWidth: 15
			},
			column: {
				stacking: 'normal'
			}
		},
		series: {{ $series_bulanan }}
	};
</script>
@endsection