@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Anggaran Perubahan</h2>
	<p style="background:#f1f1f1; padding:10px; margin-bottom:15px;"><b>Perhatian :</b> <br>
	Halaman ini ditujukan untuk melakukan <b>duplikat</b> nilai pagu setiap kegiatan menjadi pagu setelah perubahan.</p>
	<form action="" method="POST" role="form">
		<legend>Form title</legend>
		<!-- Input Tahun -->
		<div class="form-group">
			<label for="">Tahun</label>
			<select name="tahun_id" class="form-control" style="width:50%;">
				@foreach($Tahun as $tahun)
				<option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
				@endforeach
		  </select>
		</div> <!-- End Input Tahun -->
		<button type="submit" class="btn btn-primary" id="submitAnggara">Submit</button>
	</form>
@endsection

@section('script')
	<script type="text/javascript">
	$("#submitAnggaran").click(function() {
		var c = confirm("Apakah Anda Yakin akan melakukan pengcopian pada Anggaran Perubahan?");
		if(c == true) {
			return true;
		}
		return false;
	})
	</script>
@endsection