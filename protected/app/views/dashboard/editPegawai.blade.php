@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Pegawai SKPD</h2>
	<!-- FORM INPUT PEGAWAI -->
	<form action="{{URL::to('emonevpanel/pegawai/update')}}" method="POST" role="form" data-toggle="validator">
		<legend>Edit Pegawai</legend>
		<!-- Input SKPD -->
		<div class="form-group">
			<label for="">SKPD</label>
			<select id="getIdSkpd" class="form-control selectpicker" data-live-search="true" required>
				<!-- Menampilkan Semua SKPD -->
				@foreach($Skpd as $skpd)
					<option value="{{$skpd->id}}">{{$skpd->skpd}}</option>
				@endforeach
			</select>
			<input type="hidden" name="skpd_id" value="{{$pegawai->skpd_id}}">
			<input type="hidden" name="id" value="{{$pegawai->id}}">
		</div>
		
		<!-- Input Pegawai -->
		<div class="form-group">
			<label for="">Nama Pegawai</label>
			<input type="text" name="pegawai" class="form-control" value="{{$pegawai->pegawai}}" required="required">
		</div>

		<!-- Input NIP -->
		<div class="form-group">
			<label for="">NIP</label>
			<input type="text" name="nip" class="form-control" value="{{$pegawai->nip}}" required="required">
		</div>
		<!-- Input Email dan Angka -->
		<div class="row">
			<div class="col-md-6">
				<!-- Input Email -->
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control" value="{{$pegawai->email}}" required="required" data-error="Harus sesuai format email" >
					<div class="help-block with-errors"></div>
				</div>
			</div> <!-- End Col-md-6 -->
			<div class="col-md-6">
				<!-- Input Email -->
				<div class="form-group">
					<label for="">Telepon</label>
					<input type="text" name="telepon" class="form-control" value="{{$pegawai->telepon}}" required="required" data-error="Harus sesuai format angka" pattern="^[0-9]{1,}$">
					<div class="help-block with-errors"></div>
				</div>
			</div> <!-- End Col-md-6 -->
		</div>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection

@section('script')
	<script type="text/javascript">
		$("#getIdSkpd").val({{$pegawai->skpd_id}});
		$('.selectpicker').selectpicker('refresh');
	</script>
	
@endsection