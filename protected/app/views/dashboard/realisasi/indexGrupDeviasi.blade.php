@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Grup Deviasi</h2>
	<!-- Form Edit Grup Realisasi -->
	<form action="" method="POST" role="form" style="display:none" id="formEditGrup">
		<legend>Edit Form Grup Deviasi <i class="fa fa-times icon__close"></i></legend>
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
        <!-- Input Grup -->
				<div class="form-group">
					<label for="">Group</label>
					 <input type="text" name="grup" class="form-control" readonly="">
				</div>
        <!-- End Input Grup -->
      </div>
      <!-- End Col-md-6 -->
    </div>
    <!-- End Row -->
    <!-- Row -->
    <div class="row">
      <!-- Col-md-6 -->
      <div class="col-md-6">
        <!-- Input Batas Bawah -->
        <div class="form-group">
          <label for="">Batas Bawah (%)</label>
          <input type="text" class="form-control" name="batas_bawah">
        </div>
        <!-- End Input Rencana Fisik -->
      </div>
      <!-- End Col-md-6 -->
      <!-- Col-md-6 -->
      <div class="col-md-6">
        <!-- Input Rencana Uang -->
        <div class="form-group">
          <label for="">Batas Atas (%)</label>
          <input type="text" class="form-control" name="batas_atas">
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
	<!-- End Form Edit Grup Realisasi -->
	<!-- Sortir Tahun Grup Realisasi -->
  <div class="form-group form-inline">
    <label for="">Tahun</label>
    <select id="selectGetGrupTable" class="form-control" style="margin-bottom:20px;">
      <option value="">------ Pilih Tahun ----------</option>
      <!-- Menampilkan Semua Tahun -->
      @foreach($Tahun as $tahun)
      <option @if(isset($tahun_id) && $tahun_id == "$tahun->id") selected  @endif value="{{$tahun->id}}">{{$tahun->tahun}}</option>
      @endforeach
    </select>
  </div>
	<!-- Sortir Tahun Grup Realisasi -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>Grup</th>
				<th>Batas Bawah</th>
				<th>Batas Atas</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($Grup as $bulan=>$value)
        <tr>
          <td rowspan="{{count($value) + 1}}">{{Convert::ubah_bulan($bulan)}}</td>
            @foreach($value as $key => $grup)
            <tr>
              <td>{{$grup->grup}}</td>
              <td>{{$grup->batas_bawah}} %</td>
              <td>{{$grup->batas_atas}} %</td>
              <td><button class="btn btn-sm btn-warning editGrup" data-id="{{$grup->id}}" data-tahun="{{$grup->tahun_id}}" data-bulan="{{$grup->bulan}}" data-namabulan="{{Convert::ubah_bulan($grup->bulan)}}" data-grup="{{$grup->grup}}" data-bawah="{{$grup->batas_bawah}}" data-atas="{{$grup->batas_atas}}">Edit</button></td>
            </tr>
            @endforeach
        </tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('script')
	<script type="text/javascript">
		 /* inisiasi datatable */
		$('#table_id').DataTable({"iDisplayLength": 50});
		/*custom sortir */
    $("#selectGetGrupTable").change(function() {
      var tahun_id = $(this).val();
      window.location = '?tahun_id='+tahun_id;
    });
    /*custom Form Edit Grup Reaslisasi*/
    $(".editGrup").click(function() {
    	$("#formEditGrup").show(300);
    	$('#nama_bulan').val($(this).attr('data-namabulan'));
    	$("input[name='bulan']").val($(this).attr('data-bulan'));
    	$("input[name='grup']").val($(this).attr('data-grup'));
    	$("input[name='batas_bawah']").val($(this).attr('data-bawah'));
    	$("input[name='batas_atas']").val($(this).attr('data-atas'));
    	$("input[name='tahun_id']").val($(this).attr('data-tahun'));
      $("input[name='id']").val($(this).attr('data-id'));

      $("html,body").animate({ scrollTop: 0}, "slow");
    });
    /* Button Keluar Dari Program */
    $(".icon__close").click(function() {
      $("#formEditGrup").slideUp();
    });
	</script>
@endsection