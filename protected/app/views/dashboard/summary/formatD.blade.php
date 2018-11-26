@extends('layout.dashboardLayout')

@section('content')

<h2 class="menu__header">Format D</h2>
<!-- FORM SORTIR SUMMARY -->
<form action="" style="margin-bottom:30px;" class="form-inline" method="GET" role="form" data-toggle="validator">
  <legend>Sortir Summary</legend>
  <!-- Jika Masuk BUKAN sebagai admin skpd maka ada pilihan memilih SKPD -->
  @if(Auth::user()->level != 'adminskpd')
  <div class="form-group">
    <label for="">Perangkat Daerah</label>
      <select name="skpd_id" class="form-control" required>
        <!-- Menampilkan Semua SKPD -->
        <option value="">------ Pilih Perangkat Daerah ----------</option>
        @foreach($Skpd as $skpd)
          <option @if(isset($skpd_id) && $skpd_id == "$skpd->id") selected  @endif value="{{$skpd->id}}">{{$skpd->skpd}}</option>
        @endforeach
      </select>
  </div>
  @else
    <div class="form-group">
      <label for="">Perangkat Daerah</label>
      <input type="text" value="{{$Skpd->skpd}}" disabled="" class="form-control" style="width:500px;">
      <input type="hidden" name="skpd_id" value="{{$Skpd->id}}">
    </div>
  @endif
  <!-- pilihan memilih Tahun -->
  <div class="form-group">
    <label for="">Tahun</label>
    <select name="tahun_id" class="form-control" required>
      <option value="">------ Pilih Tahun ----------</option>
      <!-- Menampilkan Semua Tahun -->
      @foreach($Tahun as $tahun)
        <option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<!-- END FORM SORTIR SUMMARY -->
<table class="table table-striped" border="1" id="table-summary">
  <thead>
      <tr>
        <th>Nama Paket Pekerjaan </th>
        <th>B/K/S/J</th>
        <th>Nilai Kontrak</th>
        <th>Lokasi Kegiatan</th>
        <th>Nama KPA/PA/PPK</th>
        <th>Rekanan</th>
        <th>Nomor BAST </th>
        <th>Tanggal BAST </th>
        <th>Mulai</th>
        <th>Akhir </th>
        
      </tr>
  </thead>
  <tbody>
    @foreach($summary as $key => $value)
    <tr>
      <td>{{ $value->paket }}</td>
      <td>{{ Summary::ubah_jenis_pengadaan($value->jenis_pengadaan) }}</td>
      <td>{{ "Rp ".number_format($value->nilai_kontrak,0,',','.') }}</td>
      <td>{{ Convert::ubah_kab($value->lokasi) }}</td>
      <td>{{ $value->pegawai }}</td>
      <td>{{ $value->rekanan }}</td>
      <td>{{ $value->nomor_bast }}</td>
      <td>{{ $value->tgl_bast }}</td>
      <td>{{ Convert::tgl_eng_to_ind($value->tanggal_mulai) }}</td>
      <td>{{ Convert::tgl_eng_to_ind($value->tanggal_selesai) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection