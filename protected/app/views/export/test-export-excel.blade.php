<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    table {
      border-collapse: collapse;
      font-size: 12px;
    }

    table, th, td {
        border: 1px solid black;
    }
  </style>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th rowspan="2">Kode Rekening</th>
        <th rowspan="2">Program</th>
        <th rowspan="2" style="width:30px;">Kegiatan</th>
        <th rowspan="2">Belanja Menurut DIPA/DPA Sebelum Perubahan</th>
        <th rowspan="2">Belanja Menutut DIPA/DPA Sesudah Perubahan</th>
        <th rowspan="2">Bobot</th>
        <th rowspan="2">Nilai Kontrak Swakelola</th>
        <th colspan="3">Realisasi Fisik (%)</th>
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
      @foreach( $Program as $item_Program)
          {{-- */ $head_program = '<td rowspan="' . count( $Kegiatan[$item_Program->id] ) . '">' . $item_Program->program . '</td>'; /* --}}
          @foreach( $Kegiatan[$item_Program->id] as $item_Kegiatan )
            <tr>
              <td>{{$item_Kegiatan->kode_anggaran}}</td>
              {{ $head_program }}
              <td>{{ $item_Kegiatan->kegiatan }}</td>
              <td>{{ "Rp ".number_format($item_Kegiatan->pagu_awal,0,',','.'); }}</td>
              <td>{{ "Rp ".number_format($item_Kegiatan->pagu_perubahan,0,',','.'); }}</td>
              <td>{{ round(Kegiatan::hitungBobot($skpd_id,$tahun_id,$item_Kegiatan->kegiatan)) }}</td>
              <td></td>
              <td>{{ Kegiatan::getRencanaFisik($item_Kegiatan->jenis_belanja,$tahun_id,$bulan_id) }}</td>
              <td>{{ $item_Kegiatan->fisik }}</td>
              <td> {{ round(Kegiatan::hitungTertimbang(Kegiatan::hitungBobot($skpd_id,$tahun_id,$item_Kegiatan->kegiatan),$item_Kegiatan->fisik)) }} </td>
              <td>{{ "Rp ".number_format($item_Kegiatan->pengeluaran,0,',','.'); }}</td>
              <td>{{ "Rp ".number_format($item_Kegiatan->pengeluaran,0,',','.'); }}</td>
              <td>{{ "Rp ".number_format($item_Kegiatan->pengeluaran,0,',','.'); }}</td>
              <td>{{ "Rp ".number_format($item_Kegiatan->pengeluaran,0,',','.'); }}</td>
              <td>{{ $item_Kegiatan->uang }}</td>
            </tr>

            {{-- */ $head_program = '<td></td>'; /* --}}
          @endforeach
      @endforeach
    </tbody>
  </table>
</body>
</html>

