@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Format A2</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom:30px;" class="form-inline" method="GET" role="form" data-toggle="validator">
  <legend>Sortir Summary</legend>
  <!-- pilihan memilih Tahun -->
  <div class="form-group">
    <label for="">Tahun</label>
    <select name="tahun_id" class="form-control" required>
      <!-- Menampilkan Semua Tahun -->
      @foreach($Tahun as $tahun)
        <option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<!-- END FORM SORTIR SUMMARY -->
<div id="chart_div" style="max-width:950px; overflow:auto; padding-bottom:20px;"></div>
@endsection

@section('script')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      /* Fungsi Sortir Progres */
      $("#selectTahun").change(function() {
        var tahun_id = $(this).val();
        window.location = '?tahun_id='+tahun_id;
      });

      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          [{v:'TotalPagu', f:'Total Pagu<div style="color:green; font-style:italic">{{ "Rp ".number_format($paguTotal,0,',','.'); }}</div>'}, '', 'Total Pagu'],
          [{v:'BTL', f:'Belanja Tidak Langsung<div style="color:green; font-style:italic">{{ "Rp ".number_format($paguBtl,0,',','.'); }}</div>'}, 'TotalPagu', 'Belanja Tidak Langsung'],
          [{v:'BL', f:'Belanja Langsung<div style="color:green; font-style:italic">{{ "Rp ".number_format($paguBl,0,',','.') }}</div>'}, 'TotalPagu', 'Belanja Langsung'],
          [{v:'BLP', f:'Belanja Langsung Pegawai<div style="color:green; font-style:italic">{{ "Rp ".number_format($paguBlp,0,',','.') }}</div>'}, 'BL', 'Belanja Langsung Pegawai'],
          [{v:'BLNP', f:'Belanja Langsung Non Pegawai<div style="color:green; font-style:italic">{{ "Rp ".number_format($paguBlnp,0,',','.') }}</div>'}, 'BL', 'Belanja Langsung Non Pegawai'],
          [{v:'BJB', f:'Belanja Barang/Jasa<div style="color:green; font-style:italic">{{ "Rp ".number_format($barangjasa,0,',','.') }}</div>'}, 'BLNP', 'Belanja Barang / Jasa'],
          [{v:'BM', f:'Belanja Modal<div style="color:green; font-style:italic">{{ "Rp ".number_format($modal,0,',','.') }}</div>'}, 'BLNP', 'Belanja Modal'],
          [{v:'LUSULT1', f:'LU/SU/LT<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Tidak Langsung'],
          [{v:'PMLLSSS1', f:'PML/LS/SS<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Langsung'],
          [{v:'PL1', f:'PL<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Langsung Pegawai'],
          [{v:'SY1', f:'SY<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Langsung Non Pegawai'],
          [{v:'PK1', f:'PK/E-Purchasing<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Langsung Non Pegawai'],
          [{v:'SWAT1', f:'SWAT<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Barang / Jasa'],
          [{v:'SWAP1', f:'SWAP<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Modal'],
          [{v:'LUSULT2', f:'LU/SU/LT<div style="color:green; font-style:italic">Rp.</div>'}, 'BM', 'Belanja Tidak Langsung'],
          [{v:'PMLLSSS2', f:'PML/LS/SS<div style="color:green; font-style:italic">Rp.</div>'}, 'BM', 'Belanja Langsung'],
          [{v:'PL2', f:'PL<div style="color:green; font-style:italic">Rp.</div>'}, 'BM', 'Belanja Langsung Pegawai'],
          [{v:'SY2', f:'SY<div style="color:green; font-style:italic">Rp.</div>'}, 'BM', 'Belanja Langsung Non Pegawai'],
          [{v:'PK2', f:'PK/E-Purchasing<div style="color:green; font-style:italic">Rp.</div>'}, 'BJB', 'Belanja Langsung Non Pegawai'],
          [{v:'SWAT2', f:'SWAT<div style="color:green; font-style:italic">Rp.</div>'}, 'BM', 'Belanja Barang / Jasa'],
          [{v:'SWAP2', f:'SWAP<div style="color:green; font-style:italic">Rp.</div>'}, 'BM', 'Belanja Modal']
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
      }
   </script>
@endsection