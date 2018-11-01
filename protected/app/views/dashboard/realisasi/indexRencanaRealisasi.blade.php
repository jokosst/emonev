@extends('layout.dashboardLayout')

@section('content')
  <h2 class="menu__header">Rencana Realisasi</h2>
  <!-- Form Edit Rencana Realisasi -->
  <form action="" method="POST" role="form" style="display:none;" id="formEditRencana">
    <legend>Edit Form Rencana Realisasi <i class="fa fa-times icon__close"></i></legend>
    <!-- Row -->
    <div class="row">
      <!-- Col-md-6 -->
      <div class="col-md-6">
        <!-- Input Bulan -->
        <div class="form-group">
          <label for="">Bulan</label>
          <input type="text" class="form-control" id="nama_bulan" disabled="">
          <input type="hidden" name="bulan">
        </div>
        <!-- End Input Bulan -->
      </div>
      <!-- End Col-md-6 -->
      <!-- Col-md-6 -->
      <div class="col-md-6">
        <!-- Input Jenis Belanja -->
        
        <!-- End Input Jenis Belanja -->
      </div>
      <!-- End Col-md-6 -->
    </div>
    <!-- End Row -->
    <!-- Row -->
    <div class="row">
      <!-- Col-md-6 -->
      <div class="col-md-6">
        <!-- Input Rencana Fisik -->
        <div class="form-group">
          <label for="">Rencana Fisik (%)</label>
          <input type="text" class="form-control" name="rencana_fisik">
        </div>
        <!-- End Input Rencana Fisik -->
      </div>
      <!-- End Col-md-6 -->
      <!-- Col-md-6 -->
      <div class="col-md-6">
        <!-- Input Rencana Uang -->
        <div class="form-group">
          <label for="">Rencana Uang (%)</label>
          <input type="text" class="form-control" name="rencana_uang">
        </div>
        <!-- End Input Rencana Uang -->
      </div>
      <!-- End Col-md-6 -->
     </div>
     <!-- End Row -->
     <input type="hidden" name="tahun_id">
     <input type="hidden" name="id">
    <button type="submit" class="btn btn-primary" style="margin-bottom:20px;">Submit</button>
  </form>
  <!-- End Form Edit Rencana Realisasi -->
  <!-- Sortir Tahun Rencana Realisasi -->
  <div class="form-group form-inline">
    <label for="">Tahun</label>
    <select id="selectGetRencanaTable" class="form-control" style="margin-bottom:30px;">
      <option value="">------ Pilih Tahun ----------</option>
      <!-- Menampilkan Semua Tahun -->
      @foreach($Tahun as $tahun)
        <option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
      @endforeach
    </select>
  </div>
  <!-- End Sortir Tahun Rencana Realisasi -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Bulan</th>
        <th>Rencana Fisik</th>
        <th>Rencana Keuangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($Rencana as $rencana)
      <tr>
        <td>{{ Convert::ubah_bulan($rencana->bulan) }}</td>
        <td>{{$rencana->rencana_fisik.' %'}}</td>
        <td>{{$rencana->rencana_uang,' %'}}</td>
         <td><button class="btn btn-sm btn-warning editRencana" data-id="{{$rencana->id}}" data-bulan="{{$rencana->bulan}}" data-fisik="{{$rencana->rencana_fisik}}" data-uang="{{$rencana->rencana_uang}}" data-namabulan="{{Convert::ubah_bulan($rencana->bulan)}}" data-tahun="{{$rencana->tahun_id}}">Edit</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection

@section('script')
  <script type="text/javascript">
    /*custom sortir */
    $("#selectGetRencanaTable").change(function() {
      var tahun_id = $(this).val();
      window.location = '?tahun_id='+tahun_id;
    });
    /*custom Form Edit Rencana Reaslisasi*/
    $('.editRencana').click(function() {
      $('#formEditRencana').show(300);
      $("#nama_bulan").val($(this).attr('data-namabulan'));
      $("input[name='bulan']").val($(this).attr('data-bulan'));
      $("#nama_jenis_belanja").val($(this).attr('data-namajenisbelanja'));
      $("input[name='rencana_fisik']").val($(this).attr('data-fisik'));
      $("input[name='rencana_uang']").val($(this).attr('data-uang'));
      $("input[name='tahun_id']").val($(this).attr('data-tahun'));
      $("input[name='id']").val($(this).attr('data-id'));

      $("html,body").animate({scrollTop: 0}, "slow");

    });
    $('.icon__close').click(function() {
      $('#formEditRencana').hide();
    })
  </script>
@endsection